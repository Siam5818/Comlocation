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
}else{
    header("Location: ../connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        img {
            height: 60px;
            width: 70px;
            overflow: hidden;
            border-radius: 20%;
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
        h1{
            padding: 16px;
        }
    </style>
</head>

<body>

    <div class="container mt-3">
        <?php
        include_once '../../db/requetes.php';
        if ($proprietes) {
            foreach ($proprietes as $propriete) {
                echo "<h1 class='card text-center text-uppercase'>Mes Proprietes</h1>";
                echo "<table class='table table-bordered shadow table-hover'>";
                echo "<thead class='thead-light'>";
                echo "<tr class='text-center text-uppercase'>";
                echo "<th scope='col'>N°</th>";
                echo "<th scope='col'>Image</th>";
                echo "<th scope='col'>Propriete</th>";
                echo "<th scope='col'>Prix</th>";
                echo "<th scope='col'>Action</th>";
                echo "</tr>";
                echo "</thead>";
                //corps du tableau
                foreach ($propriete as $value) {
                    echo "<tbody>";
                    echo "<tr class='text-center'>";
                    echo "<th scope='row'>{$value['idPropriete']}</th>";
                    echo "<td><img src='../../Asset/propriete/{$value['imagePropriete']}' alt='Miniature'  class='shadow'></td>";
                    echo "<td class='text-bold'>{$value['nomPropriete']}</td>";
                    echo "<td>{$value['coutPropriete']} €</td>";
                    echo "<td class='action text-center'>";
                    echo "<a class='btn btn-1' href='modifform.php?id={$value['idPropriete']}'><i class='fas fa-pen'></i></a>";
                    echo "<button class='btn btn-2 ml-5' href='#?id={$value['idPropriete']}'><i class='fas fa-stats-alt'></i></button>";
                    echo "</td>";
                    echo "</tr>";
                    echo "</tbody>";
                }
                echo "</table>";

            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>