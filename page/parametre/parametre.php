<div class="container-fluid">
    <div class="row">
        <!-- Contenu principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Paramètres</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="?page=profil" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour au profil
                    </a>
                </div>
            </div>

            <!-- Messages d'alerte -->
            <div id="messageContainer" class="mb-3"></div>

            <!-- Cartes des paramètres -->
            <div class="row">
                <!-- Informations personnelles -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-user me-2"></i>Informations personnelles
                        </div>
                        <div class="card-body">
                            <form action="../../process/parametre.php" method="post" id="profileForm">
                                <!-- Token CSRF pour la sécurité -->
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom complet</label>
                                    <input type="text" class="form-control" id="nom" name="nom"
                                       value="<?= $_SESSION['nom'] ?>"    required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="<?= $_SESSION['email'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone"
                                           value="<?= $_SESSION['tel'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <textarea class="form-control" id="adresse" name="adresse"" rows="2"><?= $_SESSION['adresse'] ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="etablissement" class="form-label">Établissement</label>
                                    <input type="text" class="form-control" id="etablissement" name="etablissement"
                                           value="<?= $_SESSION['etablissement'] ?>">
                                </div>

                                <button type="submit" class="btn btn-primary w-100" id="saveProfileBtn">
                                    <i class="fas fa-save me-2"></i>Mettre à jour le profil
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sécurité -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <i class="fas fa-lock me-2"></i>Sécurité
                        </div>
                        <div class="card-body">
                            <form id="securityForm">
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Mot de passe actuel</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="currentPassword"
                                               name="currentPassword" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="currentPassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="newPassword"
                                               name="newPassword" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="newPassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">Minimum 8 caractères</small>
                                </div>

                                <div class="mb-4">
                                    <label for="confirmNewPassword" class="form-label">Confirmer le mot de passe</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmNewPassword"
                                               name="confirmNewPassword" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="confirmNewPassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-warning w-100" id="saveSecurityBtn">
                                    <i class="fas fa-key me-2"></i>Changer le mot de passe
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Photo de profil -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-info text-white">
                            <i class="fas fa-camera me-2"></i>Photo de profil
                        </div>
                        <div class="card-body text-center">
                            <img src="https://via.placeholder.com/150" alt="Photo de profil"
                                 class="rounded-circle mb-3" width="150" height="150" id="profileImage">

                            <div class="mb-3">
                                <input type="file" class="form-control" id="photoUpload" accept="image/*">
                            </div>

                            <button type="button" class="btn btn-outline-info w-100" onclick="uploadPhoto()">
                                <i class="fas fa-upload me-2"></i>Mettre à jour la photo
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Préférences -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <i class="fas fa-sliders-h me-2"></i>Préférences
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Notifications par email</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="notificationsEmail" checked>
                                    <label class="form-check-label" for="notificationsEmail">Activer les notifications</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Thème</label>
                                <select class="form-select" id="themeSelect">
                                    <option value="light">Clair</option>
                                    <option value="dark">Sombre</option>
                                    <option value="auto">Auto (système)</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Langue</label>
                                <select class="form-select" id="languageSelect">
                                    <option value="fr">Français</option>
                                    <option value="en">English</option>
                                    <option value="es">Español</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-success w-100" onclick="savePreferences()">
                                <i class="fas fa-check me-2"></i>Enregistrer les préférences
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pied de page -->
            <div class="text-center mt-4 pt-3 border-top">
                <small class="text-muted">Version 1.1 - ETU-PRO - Développé par AMAN</small>
            </div>
        </main>
    </div>
</div>


<style>
    /* Styles supplémentaires */
    .card {
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
        font-weight: 600;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4c6ef5;
        box-shadow: 0 0 0 0.25rem rgba(76, 110, 245, 0.25);
    }

    .btn {
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: #4c6ef5;
        border-color: #4c6ef5;
    }

    .btn-primary:hover {
        background: #3b5bdb;
        border-color: #3b5bdb;
    }

    .toggle-password {
        border-left: none;
    }

    .toggle-password:hover {
        background-color: #f8f9fa;
    }

    #profileImage {
        object-fit: cover;
        border: 4px solid #f8f9fa;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .form-check-input:checked {
        background-color: #4c6ef5;
        border-color: #4c6ef5;
    }
</style>