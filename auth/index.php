<?php
include "../functions/login_user.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../styles/login.module.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/feather-icons"></script>

    <title>Se connecter</title>
</head>

<body>
    <div class="container">
        <form method="post" class="form">

            <div class="form-title">
                <div>
                    <p>Login</p>
                    <span style="align-self:flex-end;">
                        <i style="width:18px;" data-feather="x"></i>
                    </span>
                </div>
                <p>Entrer vos identifiants pour accéder à votre compte</p>
            </div>

            <div class="form-group">
                <label for="cin">CIN</label>
                <input placeholder="cin..." type="text" name="cin" id="cin" autocomplete="no" required>
            </div>

            <div class="form-group">
                <label for="password">passowrd</label>
                <input placeholder="mot de passe..." type="password" name="password" id="password" autocomplete="no" required>
            </div>

            <div class="form-group">
                <a href="./reset-password.php">Mot de passe oublié ?</a>
            </div>

            <div class="form-group">
                <button name="connecter">
                    <i style="width:18px;opacity:0;" data-feather="arrow-right"></i>
                    <p>se connecter</p>
                    <i style="width:18px;" data-feather="arrow-right"></i>
                </button>
            </div>

        </form>
    </div>

</body>
<script src="../config/feather.config.js"></script>

</html>