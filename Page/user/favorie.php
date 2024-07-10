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
include_once '../../db/requetes.php';
if (isset($_SESSION['utilisateur']) && userActive()) {
    $utilisateur = $_SESSION['utilisateur'];
    if (isset($_GET['ID'])) {
        $Id = $_GET['ID'];

        addfavorie($utilisateur['matricule'], $Id);
    } else if (isset($_GET['NUM'])) {
        $id = $_GET['NUM'];
        echo "<script>";
        echo "if (confirm('Êtes-vous sûr de vouloir supprimer cette propriété de vos favoris ?')) {";
        echo "  window.location.href = 'favorie.php?delete=$id';";
        echo "} else {";
        echo "  window.location.href = 'favorie.php';";
        echo "}";
        echo "</script>";
    }

    if (isset($_GET['delete'])) {
        $idToDelete = $_GET['delete'];
        delfavorie($idToDelete);
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
    <title>Liste des favoris</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        img {
            height: 40px;
            width: 40px;
            overflow: hidden;
            border-radius: 50%;
        }

        .action button {
            margin-right: 5px;
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
    <?php
    $favorie[] = mesFavorie($utilisateur['matricule']);
    if ($favorie) {
        foreach ($favorie as $fav) {
            if (empty($fav)) {
                echo "<h3 class='text-center mt-5'>Aucun Favorie trouvé pour Vous.</h3>";
            } else {
                echo "<div class='container mt-5'>";
                echo "<h1 class='card text-center text-uppercase'>Mes favoris</h1>";
                echo "<table class='table table-bordered shadow'>";
                echo "<thead class='thead-light'>";
                echo "<tr class='text-center text-uppercase'>";
                echo "<th>Image</th>";
                echo "<th>Propriete</th>";
                echo "<th>Adresse</th>";
                echo "<th>Prix</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($fav as $value) {
                    echo "<tr class='text-center'>";
                    echo "<td><img src='../../Asset/propriete/{$value['imagePropriete']}' alt='Miniature'></td>";
                    echo "<td class='text-uppercase'>{$value['nomPropriete']}</td>";
                    echo "<td>{$value['adressePropriete']}</td>";
                    echo "<td>{$value['coutPropriete']} €</td>";
                    echo "<td class='action'>";
                    echo "<button class='btn btn-1' onclick=\"window.location.href='reservation.php?id={$value['idPropriete']}'\"><i class='fas fa-check'></i></button>";
                    echo "<button class='btn btn-2 ml-4' onclick=\"window.location.href = 'favorie.php?NUM={$value['numeroFavorie']}'\"><i class='fas fa-trash-alt'></i></a></button>";
                    echo "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
        }

    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>