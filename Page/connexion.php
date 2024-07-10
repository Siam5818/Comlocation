<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5% 10%;
            background-color: hsla(0, 6%, 90%, 0.755);
        }

        .container {
            width: 67%;
        }

        .card {
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-group {
            margin-top: 20px;
        }

        .card-header {
            background-color: hsl(200, 69%, 14%);
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card shadow">
            <div class="card-header">
                <h1 class="text-center text-uppercase">Connexion</h1>
            </div>
            <div class="card-body mt-3">
                <form method="POST" action="../index.php" onsubmit="return validateForm()">

                    <div class="input-group  mb-4"> 
                        <span class="input-group-text">
                            <i class="fa fa-user-circle"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Nom de l'utilisateur" name="nomlog"
                            id="username">
                    </div>

                    <div class="input-group  mb-4">
                        <span class="input-group-text">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" placeholder="Mot de passe" name="passlog"
                            id="password">
                    </div>

                    <div class="d-grid">
                        <button type="buton" name="valideCon" class="btn btn-primary"><i class="fa fa-sign-in"
                                aria-hidden="true"></i>
                            Se connecter</button>
                        <p class="text-center">
                            Vous n'avez pas de compte ? <a href="inscription.php">Inscription</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            var errorMessage = "";

            if (username.trim() === "") {
                errorMessage = "Veuillez saisir le nom de l'utilisateur.";
            } else if (password.trim() === "") {
                errorMessage = "Veuillez saisir le mot de passe.";
            }

            if (errorMessage !== "") {
                alert(errorMessage);
            } else {
                // Si les vérifications réussissent, vous pouvez soumettre le formulaire
                document.forms[0].submit();
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>