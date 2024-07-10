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

include_once '../../db/requetes.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Les Demandes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: hsla(0, 6%, 90%, 0.755);
        }

        .container {
            margin-top: 50px;
        }

        .demande-card {
            border: 1px solid #ced4da;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        h4 {
            color: #007bff;
        }

        .demande-details {
            display: none;
            margin-top: 10px;
        }

        .btn-custom {
            color: #fff;
            background-color: hsl(9, 72%, 43%);
        }

        .btn-custom:hover {
            background-color: hsl(200, 69%, 14%);
            color: #fff;
        }

        .card {
            background-color: hsl(200, 69%, 14%);
            color: #fff;
            padding: 5px;
        }
    </style>
</head>

<body>

    <div class="container-fluid mt-4">
        <h1 class="card text-center text-uppercase">Liste des Demandes</h1>
        <?php
        if ($demande) {
            foreach ($demande as $dem) {
                foreach ($dem as $value) {
                    echo "<div class='demande-card'>";
                    echo "<div class='card-body'>";
                    echo "<h4 class='card-title text-uppercase text-bold'>Demande ID: OOd-{$value['idDemande']}</h4>";
                    echo "<p class='card-text'><strong>Locataire :</strong> {$value['nomLocatiare']}</p>";
                    echo "<p class='card-text'><strong>Objet de la Demande :</strong> {$value['ObjetDemande']}</p>";
                    echo "<button class='btn btn-custom' onclick=\"toggleDetails(this, 'demande-details')\">Voir Détails</button>";
                    echo "<div class='demande-details'>";
                    echo "<p class='card-text'><strong>Email :</strong> {$value['emailLocataire']}</p>";
                    echo "<p class='card-text'><strong>Teléphone :</strong> {$value['telLocataire']}</p>";
                    echo "<p class='card-text'><strong>Description de la Demande :</strong> {$value['descriptionDemande']}</p>";
                    echo "<a class='btn btn-info offset-10' href='mailto:<{$value['emailLocataire']}>&subject=" . urlencode("Réponse à votre demande") . "&body=" . urlencode("{$value['ObjetDemande']}") . "%0A%0ACordialement,%0A{$admin['nomClient']} {$admin['prenomClient']}'>Repondre</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>

    <script>
        function toggleDetails(button, targetClass) {
            var detailsDiv = button.parentNode.querySelector('.' + targetClass);
            detailsDiv.style.display = (detailsDiv.style.display === 'none' || detailsDiv.style.display === '') ? 'block' : 'none';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

</body>

</html>