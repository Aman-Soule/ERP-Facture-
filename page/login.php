<?php
if (isset($_GET['error'])) {
    $error_message = htmlspecialchars($_GET['error']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - ETU-PRO</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }
        .login-header {
            background: #4c6ef5;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .login-header i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .login-body {
            padding: 30px;
        }
        .form-control:focus {
            border-color: #4c6ef5;
            box-shadow: 0 0 0 0.25rem rgba(76, 110, 245, 0.25);
        }
        .btn-login {
            background: #4c6ef5;
            color: white;
            width: 100%;
            padding: 12px;
            font-weight: 600;
        }
        .btn-login:hover {
            background: #3b5bdb;
            color: white;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <i class="fas fa-file-invoice-dollar"></i>
        <h2 class="mb-0">ETU-PRO</h2>
        <p class="mb-0">Gestion des Cours</p>
    </div>

    <div class="login-body">
        <form action="../process/login.php" method="POST">
            <?php if (isset($_GET['error'])): ?>
            <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Identifiants incorrects
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>

            <?php endif; ?>
            <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="email" name="email"
                           placeholder="Entrez votre email" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Entrez votre mot de passe" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </button>
            </div>

            <div class="text-center mt-3">
                <small class="text-muted">Version 1.1 - Développé par AMAN</small>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const icon = this.querySelector('i');
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Form submission
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Animation du bouton
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Connexion...';
        submitBtn.disabled = true;

        // Simulation de vérification (à remplacer par une vraie requête AJAX)
        setTimeout(() => {
            // Pour l'exemple, on accepte tout
            // En réalité, il faudrait envoyer une requête AJAX au serveur
            window.location.href = 'dashboard.php';
        }, 1000);
    });
</script>
</body>
</html>