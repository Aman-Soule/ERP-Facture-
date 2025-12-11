<!-- Header du Profil -->
<div class="profile-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                <div class="position-relative d-inline-block">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['nom']); ?>&background=4c6ef5&color=fff&size=200"
                         alt="Photo de profil" class="avatar-large">
                    <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-3 border-white rounded-circle">
                            <span class="visually-hidden">En ligne</span>
                        </span>
                </div>
            </div>
            <div class="col-md-6 text-center text-md-start">
                <h1 class="display-5 fw-bold mb-2">
                    <?php echo htmlspecialchars($_SESSION['nom']); ?>
                    <span class="badge bg-light text-primary fs-6 ms-2">PRO</span>
                </h1>
                <p class="lead mb-3">
                    <i class="fas fa-briefcase me-2"></i>
                    <?php echo htmlspecialchars($_SESSION['etablissement'] ?? 'Non defini'); ?>
                </p>
                <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                        <span class="badge-plan">
                            <i class="fas fa-crown me-1"></i> Plan Premium
                        </span>
                    <span class="badge bg-light text-dark">
                            <i class="fas fa-star text-warning me-1"></i> Membre depuis
                            <?php echo date('m/Y', strtotime($_SESSION['date_creation'] ?? '2024-01-01')); ?>
                        </span>
                </div>
            </div>
            <div class="col-md-3 text-center text-md-end">
                <a href="?page=parametre" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-cog me-2"></i> Modifier
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Section Informations -->
<div class="container">
    <div class="row g-4">
        <!-- Informations Personnelles -->
        <div class="col-lg-8">
            <div class="profile-card card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h4 class="section-title">
                        <i class="fas fa-user-circle me-2"></i>Informations Personnelles
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-badge">
                                <small class="text-muted d-block">Nom complet</small>
                                <strong><?php echo htmlspecialchars($_SESSION['prenom'] ?? '') . ' ' . htmlspecialchars($_SESSION['nom']); ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-badge">
                                <small class="text-muted d-block">Email</small>
                                <strong><?php echo htmlspecialchars($_SESSION['email'] ?? 'non défini'); ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-badge">
                                <small class="text-muted d-block">Téléphone</small>
                                <strong><?php echo htmlspecialchars($_SESSION['tel'] ?? 'Non renseigné'); ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-badge">
                                <small class="text-muted d-block">Etablissement</small>
                                <strong><?php echo htmlspecialchars($_SESSION['etablissement'] ?? 'Entrepreneur indépendant'); ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-badge">
                                <small class="text-muted d-block">SIRET</small>
                                <strong><?php echo htmlspecialchars($_SESSION['siret'] ?? 'Non renseigné'); ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-badge">
                                <small class="text-muted d-block">Adresse</small>
                                <strong><?php echo htmlspecialchars($_SESSION['adresse'] ?? 'Non renseignée'); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques du profil -->
            <div class="profile-card card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h4 class="section-title">
                        <i class="fas fa-chart-bar me-2"></i>Statistiques
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 col-6 mb-4">
                            <div class="stat-circle bg-primary bg-opacity-10 text-white">
                                <span class="display-6 fw-bold">142</span>
                                <small>Cours</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="stat-circle bg-success bg-opacity-10 text-white">
                                <span class="display-6 fw-bold">48</span>
                                <small>Clients</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="stat-circle bg-warning bg-opacity-10 text-white">
                                <span class="display-6 fw-bold">94%</span>
                                <small>Taux de paiement</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="stat-circle bg-info bg-opacity-10 text-white">
                                <span class="display-6 fw-bold">28</span>
                                <small>Projets</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activités Récentes -->
            <div class="profile-card card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h4 class="section-title">
                        <i class="fas fa-history me-2"></i>Activités Récentes
                    </h4>
                </div>
                <div class="card-body">
                    <div class="activity-timeline">
                        <div class="timeline-item">
                            <h6 class="mb-1">Connexion réussie</h6>
                            <p class="text-muted small mb-0">Vous vous êtes connecté avec succès</p>
                            <small class="text-muted">Aujourd'hui, 09:45</small>
                        </div>
                        <div class="timeline-item">
                            <h6 class="mb-1">Facture #FAC-2024-015 créée</h6>
                            <p class="text-muted small mb-0">Nouvelle facture pour "Entreprise ABC"</p>
                            <small class="text-muted">Hier, 14:20</small>
                        </div>
                        <div class="timeline-item">
                            <h6 class="mb-1">Mise à jour du profil</h6>
                            <p class="text-muted small mb-0">Informations personnelles modifiées</p>
                            <small class="text-muted">12 mai 2024, 11:30</small>
                        </div>
                        <div class="timeline-item">
                            <h6 class="mb-1">Nouveau client ajouté</h6>
                            <p class="text-muted small mb-0">"Société XYZ" ajoutée à votre base</p>
                            <small class="text-muted">10 mai 2024, 16:45</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne Latérale -->
        <div class="col-lg-4">
            <!-- Compétences -->
            <div class="profile-card card border-0 shadow-sm mb-4" hidden>
                <div class="card-header bg-white border-0">
                    <h5 class="section-title">
                        <i class="fas fa-tools me-2"></i>Compétences
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Gestion des factures</span>
                            <span>95%</span>
                        </div>
                        <div class="skill-progress">
                            <div class="skill-progress-bar" style="width: 95%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Relations clients</span>
                            <span>88%</span>
                        </div>
                        <div class="skill-progress">
                            <div class="skill-progress-bar" style="width: 88%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Gestion financière</span>
                            <span>92%</span>
                        </div>
                        <div class="skill-progress">
                            <div class="skill-progress-bar" style="width: 92%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Utilisation de ETU-PRO</span>
                            <span>98%</span>
                        </div>
                        <div class="skill-progress">
                            <div class="skill-progress-bar" style="width: 98%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Abonnement -->
            <div class="profile-card card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0">
                    <h5 class="section-title">
                        <i class="fas fa-crown me-2"></i>Votre Abonnement
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="badge-plan mb-3">Plan Premium</div>
                        <h3 class="fw-bold">29,99€ <small class="text-muted fs-6">/mois</small></h3>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Factures illimitées
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Clients illimités
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Support prioritaire
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Export PDF/Excel
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Rapports avancés
                        </li>
                    </ul>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-sync me-2"></i>Mettre à niveau
                        </button>
                        <button class="btn btn-light">
                            <i class="fas fa-file-invoice me-2"></i>Voir les détails
                        </button>
                    </div>
                </div>
            </div>

            <!-- Actions Rapides -->
            <div class="profile-card card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="section-title">
                        <i class="fas fa-bolt me-2"></i>Actions Rapides
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="?page=parametre" class="btn btn-outline-primary">
                            <i class="fas fa-cog me-2"></i>Paramètres du compte
                        </a>
                        <a href="#" class="btn btn-outline-success">
                            <i class="fas fa-lock me-2"></i>Changer le mot de passe
                        </a>
                        <a href="#" class="btn btn-outline-warning">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                        <a href="#" class="btn btn-outline-danger">
                            <i class="fas fa-file-export me-2"></i>Exporter mes données
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour modifier la photo de profil -->
<div class="modal fade" id="changePhotoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Changer la photo de profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="photoForm">
                    <div class="mb-3">
                        <label for="profilePhoto" class="form-label">Sélectionner une image</label>
                        <input class="form-control" type="file" id="profilePhoto" accept="image/*">
                        <div class="form-text">Formats acceptés : JPG, PNG, GIF. Taille max : 2MB</div>
                    </div>
                    <div class="text-center mb-3">
                        <img id="photoPreview" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['nom']); ?>&size=200"
                             alt="Aperçu" class="img-thumbnail" style="width: 150px; height: 150px;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="updateProfilePhoto()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion de la photo de profil
        const profilePhotoInput = document.getElementById('profilePhoto');
        const photoPreview = document.getElementById('photoPreview');

        if (profilePhotoInput) {
            profilePhotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        photoPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    function updateProfilePhoto() {
        const fileInput = document.getElementById('profilePhoto');
        if (fileInput.files.length > 0) {
            // Simuler l'upload (à remplacer par une vraie requête AJAX)
            const file = fileInput.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                // Mettre à jour l'image principale
                document.querySelector('.avatar-large').src = e.target.result;
                // Fermer le modal
                bootstrap.Modal.getInstance(document.getElementById('changePhotoModal')).hide();

                // Afficher une notification
                showNotification('Photo de profil mise à jour avec succès !', 'success');
            };
            reader.readAsDataURL(file);
        }
    }

    function showNotification(message, type) {
        // Créer une notification temporaire
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
        alert.style.zIndex = '1060';
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alert);

        setTimeout(() => {
            alert.remove();
        }, 3000);
    }
</script>
