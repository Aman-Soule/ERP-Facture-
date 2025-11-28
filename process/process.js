let table;
$(document).ready(function() {
    // Initialisation unique de DataTable
    table = $('#factureTable').DataTable({
        destroy: true,
        ajax: 'factures.php',
        columns: [
            { data: 'id' },
            { data: 'customer' },
            { data: 'cashier' }, // peut être vide
            { data: 'amount' },
            { data: 'received' }, // peut être vide
            { data: 'returned' }, // peut être vide
            { data: 'status' },
            { data: null, defaultContent:
                    '<a href="#" class="text-info me-2"><i class="fas fa-info-circle"></i></a>' +
                    '<a href="#" class="text-primary me-2"><i class="fas fa-edit"></i></a>' +
                    '<a href="#" class="btn-pdf text-primary me-2"><i class="fas fa-folder-blank"></i></a>' +
                    '<a href="#" class="text-danger me-2"><i class="fas fa-trash-alt"></i></a>'
            }
        ]
    });
    //when we click on #battlefield
    $("#create").click(function(e) {
        let formOrder = $("#formOrder");
        if (formOrder[0].checkValidity()) {
            $.ajax({
                type: 'post',
                url: 'process/process.php',
                data: formOrder.serialize() + "&action=create",
                success: function(response) {
                    console.log(response);
                }
            });
        }
    });

    // Gestion du clic sur le bouton PDF
    $('#factureTable tbody').on('click', 'a.btn-pdf', function (e) {
        e.preventDefault();

        // Récupérer la ligne correspondante
        var data = table.row($(this).parents('tr')).data();

        if (!data) {
            console.error("Pas de données pour cette ligne !");
            return;
        }

        // Générer le PDF avec jsPDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // --- En-tête ---
        doc.setFontSize(18);
        doc.text(`FACTURE Nº 0006-2025-AM00${data.id}`, 105, 20, { align: "center" });
        doc.setFontSize(12);
        doc.text("Entreprise XYZ", 20, 30);
        doc.text("Adresse: Dakar, Sénégal", 20, 36);
        doc.text("Tel: +221 78 753 76 88", 20, 42);

        // --- Infos client ---
        doc.setFontSize(12);
        doc.text(`Client: ${data.customer}`, 20, 60);
        doc.text(`Caissier: ${data.cashier || '-'}`, 20, 66);
        doc.text(`Date: ${new Date().toLocaleDateString()}`, 20, 72);


        // --- Tableau des montants ---
        doc.autoTable({
            startY: 90,
            head: [['Montant', 'Perçu', 'Retourné', 'État']],
            body: [[data.amount +' FCFA', data.received+ ' FCFA' || '-', data.returned+ ' FCFA' || '-', data.status]]
        });

        // --- Pied de page ---
        doc.setFontSize(10);
        doc.text("FactPro by AMAN.", 105, 280, { align: "center" });
        // Télécharger le fichier
        doc.save(`facture_${data.id}.pdf`);
    });
});



let selectedDeleteId = null; // stocker l'ID de la facture à supprimer

// Clic sur le bouton poubelle
// Clic sur le bouton poubelle
$('#factureTable tbody').on('click', 'a.text-danger', function (e) {
    e.preventDefault();
    const data = table.row($(this).parents('tr')).data();
    if (!data) return;

    selectedDeleteId = data.id;

    const modalEl = document.getElementById('confirmDeleteModal');
    const myModal = new bootstrap.Modal(modalEl);
    myModal.show();

    // Quand la modal se ferme, replacer le focus sur le bouton déclencheur
    modalEl.addEventListener('hidden.bs.modal', () => {
        $(this).focus();
    }, { once: true });
});

// Confirmation de suppression
$('#confirmDelete').on('click', function () {
    if (!selectedDeleteId) return;

    $.ajax({
        type: 'post',
        url: 'process/process.php',
        data: { action: 'delete', id: selectedDeleteId },
        success: function (response) {
            if (response === "success") {
                alert("Facture supprimée avec succès !");
                table.ajax.reload(null, false); // rafraîchir sans reset pagination
            } else {
                alert("Erreur lors de la suppression.");
            }
        }
    });

    // Fermer la modal avec Bootstrap 5
    const modalEl = document.getElementById('confirmDeleteModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    modal.hide();
});


//Exportation
