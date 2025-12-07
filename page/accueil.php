<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - FACT-PRO</title>

    <!-- Styles supplémentaires pour le dashboard -->
    <style>
        :root {
            --primary-color: #4c6ef5;
            --secondary-color: #3b5bdb;
            --success-color: #40c057;
            --warning-color: #fab005;
            --danger-color: #fa5252;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem 0;
            border-radius: 15px;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .stat-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .quick-action-card {
            background: var(--light-color);
            border-radius: 12px;
            padding: 1.5rem;
            height: 100%;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .quick-action-card:hover {
            border-color: var(--primary-color);
            background: white;
        }

        .quick-action-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 1rem;
        }

        .recent-activity {
            max-height: 400px;
            overflow-y: auto;
        }

        .activity-item {
            padding: 1rem;
            border-left: 4px solid var(--primary-color);
            background: var(--light-color);
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .welcome-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            display: inline-block;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.8rem;
            }

            .dashboard-header {
                padding: 1.5rem 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header du Dashboard -->
    <div class="dashboard-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <span class="welcome-badge mb-3">
                        <i class="fas fa-calendar-day me-2"></i><?php echo date('d/m/Y'); ?>
                    </span>
                    <h1 class="display-5 fw-bold mb-3">
                        Bonjour, <?php echo htmlspecialchars($_SESSION['nom']); ?> !
                        <i class="fas fa-hand-wave ms-2"></i>
                    </h1>
                    <p class="lead mb-0 opacity-75">
                        Bienvenue sur votre tableau de bord FACT-PRO. Gérez vos factures en toute simplicité.
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="avatar-container">
                        <div class="position-relative d-inline-block">
                            <div class="bg-white rounded-circle p-3">
                                <i class="fas fa-user-tie text-primary fa-3x"></i>
                            </div>
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle">
                                <span class="visually-hidden">En ligne</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Statistiques -->
    <div class="container mb-5">
        <div class="row g-4">
            <!-- Total Factures -->
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <div>
                                <div class="stat-label">Factures Total</div>
                                <div class="stat-value" id="totalFactures">0</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-arrow-up me-1"></i> +12% ce mois
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Factures Payées -->
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <div class="stat-label">Payées</div>
                                <div class="stat-value" id="facturesPayees">0</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Montant Total -->
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-warning bg-opacity-10 text-warning me-3">
                                <i class="fas fa-coins"></i>
                            </div>
                            <div>
                                <div class="stat-label">Chiffre d'affaires</div>
                                <div class="stat-value" id="chiffreAffaires">0 €</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-warning bg-opacity-10 text-warning">
                                <i class="fas fa-chart-line me-1"></i> +8.5%
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En attente -->
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-danger bg-opacity-10 text-danger me-3">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <div class="stat-label">En attente</div>
                                <div class="stat-value" id="facturesAttente">0</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                <i class="fas fa-exclamation-circle me-1"></i> À traiter
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Actions Rapides & Activités -->
    <div class="container mb-5">
        <div class="row g-4">
            <!-- Actions Rapides -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pb-0">
                        <h4 class="card-title mb-4">
                            <i class="fas fa-bolt text-warning me-2"></i>Actions Rapides
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="?page=factures&action=create" class="text-decoration-none">
                                    <div class="quick-action-card text-center">
                                        <div class="quick-action-icon bg-primary bg-opacity-10 text-primary mx-auto">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <h5 class="mb-2">Nouvelle Facture</h5>
                                        <p class="text-muted small mb-0">Créer une nouvelle facture</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="?page=factures" class="text-decoration-none">
                                    <div class="quick-action-card text-center">
                                        <div class="quick-action-icon bg-success bg-opacity-10 text-success mx-auto">
                                            <i class="fas fa-list"></i>
                                        </div>
                                        <h5 class="mb-2">Voir Factures</h5>
                                        <p class="text-muted small mb-0">Liste complète des factures</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#exportModal">
                                    <div class="quick-action-card text-center">
                                        <div class="quick-action-icon bg-info bg-opacity-10 text-info mx-auto">
                                            <i class="fas fa-file-export"></i>
                                        </div>
                                        <h5 class="mb-2">Exporter</h5>
                                        <p class="text-muted small mb-0">Exporter les données</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#reportModal">
                                    <div class="quick-action-card text-center">
                                        <div class="quick-action-icon bg-warning bg-opacity-10 text-warning mx-auto">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                        <h5 class="mb-2">Rapports</h5>
                                        <p class="text-muted small mb-0">Analyses et statistiques</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#" class="text-decoration-none">
                                    <div class="quick-action-card text-center">
                                        <div class="quick-action-icon bg-danger bg-opacity-10 text-danger mx-auto">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <h5 class="mb-2">Clients</h5>
                                        <p class="text-muted small mb-0">Gérer les clients</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#settingsModal">
                                    <div class="quick-action-card text-center">
                                        <div class="quick-action-icon bg-secondary bg-opacity-10 text-secondary mx-auto">
                                            <i class="fas fa-cog"></i>
                                        </div>
                                        <h5 class="mb-2">Paramètres</h5>
                                        <p class="text-muted small mb-0">Configurer l'application</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graphique simple -->
                <div class="chart-container mt-4">
                    <h5 class="mb-4">
                        <i class="fas fa-chart-line text-primary me-2"></i>Évolution mensuelle
                    </h5>
                    <div class="text-center py-5" id="chartPlaceholder">
                        <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Graphique des ventes mensuelles</p>
                        <div class="d-flex justify-content-center align-items-end mt-4" style="height: 150px;">
                            <div class="mx-2">
                                <div class="bg-primary rounded" style="width: 30px; height: 80px;"></div>
                                <div class="mt-2 small">Jan</div>
                            </div>
                            <div class="mx-2">
                                <div class="bg-primary rounded" style="width: 30px; height: 120px;"></div>
                                <div class="mt-2 small">Fév</div>
                            </div>
                            <div class="mx-2">
                                <div class="bg-primary rounded" style="width: 30px; height: 90px;"></div>
                                <div class="mt-2 small">Mar</div>
                            </div>
                            <div class="mx-2">
                                <div class="bg-primary rounded" style="width: 30px; height: 150px;"></div>
                                <div class="mt-2 small">Avr</div>
                            </div>
                            <div class="mx-2">
                                <div class="bg-success rounded" style="width: 30px; height: 180px;"></div>
                                <div class="mt-2 small">Mai</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activités Récentes -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-history text-info me-2"></i>Activités Récentes
                        </h4>
                    </div>
                    <div class="card-body recent-activity">
                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Nouvelle facture créée</h6>
                                    <p class="mb-0 text-muted small">Facture #FAC-2024-0012 pour "Entreprise ABC"</p>
                                </div>
                                <span class="activity-time">10 min</span>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Facture payée</h6>
                                    <p class="mb-0 text-muted small">Facture #FAC-2024-0011 marquée comme payée</p>
                                </div>
                                <span class="activity-time">2h</span>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Export réalisé</h6>
                                    <p class="mb-0 text-muted small">Export PDF des factures du mois</p>
                                </div>
                                <span class="activity-time">5h</span>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Nouveau client ajouté</h6>
                                    <p class="mb-0 text-muted small">"Société XYZ" ajoutée à la base clients</p>
                                </div>
                                <span class="activity-time">1 jour</span>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Mise à jour système</h6>
                                    <p class="mb-0 text-muted small">Application mise à jour vers la version 2.1</p>
                                </div>
                                <span class="activity-time">2 jours</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 text-center">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-list me-1"></i> Voir toutes les activités
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Objectifs -->
    <div class="container mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h4 class="card-title mb-0">
                    <i class="fas fa-bullseye text-success me-2"></i>Objectifs du mois
                </h4>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5>Objectif de facturation : 15 000 €</h5>
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                 style="width: 65%">
                                <span class="progress-text">9 750 € / 15 000 €</span>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">Objectif atteint à 65%. Continuez vos efforts !</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="display-4 fw-bold text-success">65%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Export -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Exporter les données</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Sélectionnez le format d'export :</p>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-file-pdf text-danger me-2"></i> PDF
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-file-excel text-success me-2"></i> Excel
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-file-csv text-info me-2"></i> CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts pour animer les statistiques -->
    <script>
    // Animation des statistiques
    document.addEventListener('DOMContentLoaded', function() {
        // Données simulées (à remplacer par des appels AJAX réels)
        const stats = {
            totalFactures: 142,
            facturesPayees: 106,
            chiffreAffaires: "9 750",
            facturesAttente: 18
        };

        // Fonction pour animer les nombres
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = end >= 1000 ? value.toLocaleString() : value;
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Animer chaque statistique
        setTimeout(() => {
            animateValue(document.getElementById('totalFactures'), 0, stats.totalFactures, 1000);
            animateValue(document.getElementById('facturesPayees'), 0, stats.facturesPayees, 1000);
            document.getElementById('chiffreAffaires').textContent = stats.chiffreAffaires + ' €';
            animateValue(document.getElementById('facturesAttente'), 0, stats.facturesAttente, 1000);
        }, 500);

        // Mettre à jour l'heure en temps réel
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('fr-FR', {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.querySelector('.welcome-badge i.fa-calendar-day').parentElement.textContent =
                `${now.toLocaleDateString('fr-FR')} ${timeString}`;
        }

        setInterval(updateTime, 60000);
        updateTime();
    });

    // Tooltips Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    </script>
</body>
</html>