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
include_once '../../db/requetes.php';
if (isset($_SESSION['administrateur']) && adminActive()) {
    $admin = $_SESSION['administrateur'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo "<script>";
        echo "if (confirm('Êtes-vous sûr de vouloir desactiver cette client ?')) {";
        echo "  window.location.href = 'client.php?dactive=$id';";
        echo "} else {";
        echo "  window.location.href = 'client.php';";
        echo "}";
        echo "</script>";
    }
    if (isset($_GET['dactive'])) {
        $matToDesable = $_GET['dactive'];
        desableClient($matToDesable);
    }
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
    <title>Liste des clients</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        img {
            height: 30px;
            width: 30px;
            overflow: hidden;
            border-radius: 50%;
        }

        .btn-1 {
            background-color: hsl(9, 100%, 62%);
            color: #fff;
        }

        .btn-1:active {
            background-color: hsl(200, 69%, 14%);
            color: #fff;
        }

        .btn-2 {
            background-color: rgba(122, 32, 32, 0.874);
            color: #fff;
        }

        .btn-2:active {
            background-color: hsl(200, 69%, 14%);
            color: #fff;
        }

        .card {
            background-color: hsl(200, 69%, 14%);
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="container-fluid mt-5">
        <h1 class="card text-center text-uppercase">Nos Clients</h1>
        <table class="table table-bordered shadow table-hover">
            <thead class="thead-light">
                <tr class='text-center text-uppercase'>
                    <th>Avatar</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Telphone</th>
                    <th>Inscription</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($clients) {
                    foreach ($clients as $client) {
                        foreach ($client as $value) {
                            echo "<tr class=''>";
                            echo "<td class=''>";
                            echo "<img src='../../Asset/user.png'>";
                            echo ($value['roleClient'] == 'desable') ? "<span class='badge badge-pill badge-danger' style='margin-left: 15px;'>&bull;</span>" : "<span class='badge badge-pill badge-success' style='margin-left: 15px;'>&bull;</span>";
                            echo "</td>";
                            echo "<td class='text-uppercase'>{$value['nomClient']}</td>";
                            echo "<td class='text-uppercase'>{$value['prenomClient']}</td>";
                            echo "<td>{$value['emailClient']}</td>";
                            echo "<td>{$value['telClient']}</td>";
                            echo "<td>{$value['dateInscription']}</td>";
                            echo "<td class='action text-center'>";
                            echo "<a class='btn btn-primary' href='profilAjour.php?id={$value['matricule']}'><i class='fas fa-edit'></i></a>";
                            echo "<a class='btn btn-1 ml-1' href='historique.php?id={$value['matricule']}'><i class='fas fa-history'></i></a>";
                            echo "<a class='btn btn-2 ml-1' href='client.php?id={$value['matricule']}'><i class='fas fa-ban'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>