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
} else {
    echo '<meta http-equiv="refresh" content="0;url=../connexion.php">';
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <h1 class="text-center text-uppercase">Faire une Réservation</h1>
            </div>
            <div class="card-body">
                <form action="../../index.php" method="post" enctype="multipart/form-data">

                    <?php
                    include_once '../../db/requetes.php';
                    if (isset($_GET['id'])) {
                        $detailsProp = unProp($_GET['id']);

                        echo '<div class="form-group row">';
                        echo '<div class="col-md-6">';
                        echo '<label class="text-bold">Client</label>';
                        echo "<input type='text' class='form-control' required readonly value='{$utilisateur['nomClient']}'>";
                        echo "<input type='hidden' name='matricule' value='{$utilisateur['matricule']}'>";
                        echo '</div>';
                        echo '<div class="col-md-6">';
                        echo '<label class="text-bold">Propriété à réserver</label>';
                        echo "<input type='text' class='form-control'  required readonly value='{$detailsProp['nomPropriete']}'>";
                        echo "<input type='hidden' name='idProp' value='{$detailsProp['idPropriete']}'>";
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="form-group row">';
                        echo '<div class="col-md-6">';
                        echo '<label class="text-bold">Date Soumission</label>';
                        echo '<input type="date" class="form-control" name="Dreservation" required>';
                        echo '</div>';
                        echo '<div class="col-md-6">';
                        echo "<label class='text-bold'>Stat de la reservation</label>";
                        echo "<input type='text' name='stat' class='form-control' required readonly value='{$detailsProp['nomService']}'>";
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo '<button type="submit" class="btn btn-primary" name="reserver">Réserver</button>';
                        echo "<button type='reset' class='btn btn-danger ml-2' onclick=\"window.location.href = '../propriete.php'\">Annuler</button>";
                        echo '</div>';
                    }
                    ?>

                </form>
            </div>
        </div>
    </div>

</body>

</html>