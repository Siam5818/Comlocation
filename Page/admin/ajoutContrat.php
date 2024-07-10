<?php
session_start();
function adminActive($maxInactiveTime = 180)
{
    if (isset($_SESSION['derniere_activite']) && time() - $_SESSION['derniere_activite'] > $maxInactiveTime) {
        session_unset();
        session_destroy();
        return false;
    }

    $_SESSION['derniere_activite'] = time();

    return true;
}
if (isset($_SESSION['administrateur']) && adminActive()) {
    $admin = $_SESSION['administrateur'];
} else {
    header("Location: ../connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/css/bootstrap.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5% 10%;
            background-color: #f8f9fa;
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
                <h1 class="text-center text-uppercase">Signé Un Contrat</h1>
            </div>
            <div class="card-body">
                <?php
                include_once '../../db/requetes.php';
                if (isset($_GET['id'])) {
                    $idReser = $_GET['id'];
                    echo '<form action="../../index.php" method="post" enctype="multipart/form-data">';

                    echo '<div class="form-group row">';
                    echo '<div class="col-md-6">';
                    echo '<label class="text-bold">Reservation</label>';
                    echo "<input type='text' class='form-control' name='idReservation' required readonly value='{$idReser}'>";
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<label class="text-bold">Contrat</label>';
                    foreach ($typecontrat as $type) {
                        echo '<select name="idTypCont" class="form-select" required>';
                        echo '<option selected>Type de Contrat</option>';
                        foreach ($type as $value) {
                            echo "<option value='{$value['idTypeContrat']}' required>".mb_strtoupper(htmlspecialchars($value['nomTypeContrat'], ENT_QUOTES)).": {$value['detailleTypeContrat']}</option>";
                        }
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="form-group row">';
                    echo '<div class="col-md-6">';
                    echo '<label class="text-bold">Date debut</label>';
                    echo '<input type="date" class="form-control" name="debutContrat" required>';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<label class="text-bold">Date fin</label>';
                    echo '<input type="date" class="form-control" name="finContrat" required>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo '<button type="submit" class="btn btn-primary" name="signer">Signer</button>';
                    echo '<button type="reset" class="btn btn-danger ml-2" onclick="window.location.href = \'client.php\'">Annuler</button>';
                    echo '</div>';

                    echo '</form>';
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>