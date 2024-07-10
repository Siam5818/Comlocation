<?php
session_start();
function userActive($maxInactiveTime = 180)
{
    if (isset($_SESSION['derniere_activite']) && time() - $_SESSION['derniere_activite'] > $maxInactiveTime) {
        //Déconnection de user une fois la dernière activité dépasse le temps d'inactivité maximal
        session_unset();
        session_destroy();
        return false;
    }

    // Mise à jour du timestamp de la dernière activité
    $_SESSION['derniere_activite'] = time();

    return true;
}
if (isset($_SESSION['utilisateur']) && userActive()) {
    $utilisateur = $_SESSION['utilisateur'];
}else{
    echo '<meta http-equiv="refresh" content="0;url=../connexion.php">';
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Location</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5% 10%;
            background-color: hsla(0, 6%, 90%, 0.755);
        }

        .container {
            width: 87%;
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
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-uppercase">Demande de Location</h1>
            </div>
            <div class="card-body mt-3">

                <form action="../../index.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Nom du locataire:</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>

                        <div class="col-md-6">
                            <label>Téléphone du locataire:</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>

                        <div class="col-md-6">
                            <label>Email du locataire:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="col-md-6">
                            <label>Objet de la demande:</label>
                            <input type="text" class="form-control" name="objet" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description du bien à louer:</label>
                        <textarea class="form-control" name="description" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="demander">Soumettre la demande</button>
                        <button type='button' class='btn btn-danger'
                            onclick="window.location.href = '../user.php'">Annuler</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>