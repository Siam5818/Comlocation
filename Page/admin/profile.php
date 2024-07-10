<?php
session_start();
//Vérifier si la session est toujours active
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
// Vérifie si la session de l'utilisateur est active
if (isset($_SESSION['administrateur']) && adminActive()) {
    $admin = $_SESSION['administrateur'];
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
    <title>Profil :
        <?= $admin['nomClient'] . ' ' . $admin['prenomClient'] ?>
    </title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .card {
            width: 85%;
            margin: 5%;
        }

        .card-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-left: 35%;
        }

        .group1,
        .group2 {
            margin: 20px;
        }

        .bouton {
            background-color: #ff7f50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group {
            margin-top: 15px;
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
    </style>

</head>

<body>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="row">
                <?php
                $telClient = $admin['telClient'];

                echo "<div class='col-md-6'>";
                echo "<div class='group1 text-center mt-3'>";
                echo "<img src='../../Asset/agent.jpg' class='card-img'>";
                echo "<h2 class='card-title mt-2'>" . strtoupper($admin['nomClient']) . " {$admin['prenomClient']}</h2>";

                echo "</div>";

                echo "<div class='group1 text-center mt-3' hidden id='editForm'>";
                echo "<form action='../../index.php' method='POST'>";
                echo "<div class='form-group'>";
                echo "<input type='number' class='form-control' name='matricule' value='{$admin['matricule']}' readonly>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<input type='text' class='form-control' name='newNom' value='{$admin['nomClient']}' placeholder='Nouvel Nom :' onfocus=\"if(this.value=='{$admin['nomClient']}') this.value='';\" onblur=\"if(this.value=='') this.value='{$admin['nomClient']}';\">";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<input type='text' class='form-control' name='newPrenom' value='{$admin['prenomClient']}' placeholder='Nouvel Prénom :' onfocus=\"if(this.value=='{$admin['prenomClient']}') this.value='';\" onblur=\"if(this.value=='') this.value='{$admin['prenomClient']}';\">";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<input type='text' class='form-control' name='newEmail' value='{$admin['emailClient']}' placeholder='Nouvel Email :' onfocus=\"if(this.value=='{$admin['emailClient']}') this.value='';\" onblur=\"if(this.value=='') this.value='{$admin['emailClient']}';\">";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<input type='text' class='form-control' name='newTel' value='{$admin['telClient']}' placeholder='Nouvel Tél :' onfocus=\"if(this.value=='{$admin['telClient']}') this.value='';\" onblur=\"if(this.value=='') this.value='{$admin['telClient']}';\">";
                echo "</div>";
                echo "<div class='btn-group'>";
                echo "<button type='submit' name='sauvegarder' class='btn-1 btn-success btn-sm'><i class='fas fa-check'></i> Sauvegarder</button>";
                echo "<button type='button' class='btn-2 btn-danger btn-sm ml-5' onclick='EditForm()'><i class='fas fa-times'></i> Annuler</button>";
                echo "</div>";
                echo "</form>";
                echo "</div>";

                echo "</div>";

                echo "<div class='col-md-6'>";
                echo "<div class='group2'>";
                echo "<div>";
                echo "<h4>Informations Admin</h4>";
                echo "<p><strong>Email :</strong> {$admin['emailClient']}</p>";
                if (strlen($telClient) >= 12) {

                    $formattedPhoneNumber = sprintf(
                        "%s %s %s %s %s",
                        substr($telClient, 0, 5),
                        substr($telClient, 5, 2),
                        substr($telClient, 7, 3),
                        substr($telClient, 10, 2),
                        substr($telClient, 12)
                    );

                    echo "<p><strong>Téléphone :</strong> $formattedPhoneNumber</p>";
                } else {
                    echo "<p><strong>Téléphone :</strong> Numéro de téléphone non valide</p>";
                }
                echo "<p><strong>Date Prise de Fonction :</strong> {$admin['dateInscription']}</p>";
                echo "</div>";
                echo "<button class='bouton btn-info btn-sm' onclick='EditForm()'><i class='fas fa-edit'></i> Éditer le Profil</button>";
                echo "</div>";
                echo "</div>";
                ?>
            </div>
        </div>
    </div>
    <script>
        function EditForm() {
            var editForm = document.getElementById('editForm');
            editForm.hidden = !editForm.hidden;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>