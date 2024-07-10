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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrats - Signé</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .contrat-card {
            border: 2px solid #007bff;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 6%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        h4 {
            color: #007bff;
        }

        img.signature {
            width: 150px;
            height: auto;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        include_once '../../db/requetes.php';
        if (!empty($mesContratSigne)) {
            foreach ($mesContratSigne as $Contrats) {

                foreach ($Contrats as $value) {

                    echo "<div class='contrat-card'>";
                    echo "<h3 class='text-bold text-center'>Contrat de Location N°: #00{$value['idContrat']}<hr></h3>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-6'>";
                    echo "<h4>Propriétaire :</h4>";
                    echo "<p><strong>Nom :</strong> {$value['nomBailleur']}</p>";
                    echo "<p><strong>Email :</strong> {$value['emailBailleur']}</p>";
                    echo "<p><strong>Téléphone :</strong> {$value['telBailleur']}</p>";
                    echo "</div>";
                    echo "<div class='col-md-6'>";
                    echo "<h4>Locataire :</h4>";
                    echo "<p><strong>Nom :</strong> {$value['nomClient']} {$value['prenomClient']}</p>";
                    echo "<p><strong>Email :</strong> {$value['emailClient']}</p>";
                    echo "<p><strong>Téléphone :</strong> {$value['telClient']}</p>";
                    echo "</div>";
                    echo "</div>";

                    echo "<hr>";

                    echo "<h4>Propriété :</h4>";
                    echo "<p><strong>Nom :</strong> {$value['nomPropriete']}</p>";
                    echo "<p><strong>Adresse :</strong> {$value['adressePropriete']}</p>";
                    echo "<p><strong>Caractéristiques :</strong> Dimension: {$value['dimension']} m², Pièces: {$value['nombrePiece']}</p>";

                    echo "<hr>";

                    echo "<h4>Contrat :</h4>";
                    echo "<p><strong>Type :</strong> {$value['nomTypeContrat']}</p>";
                    echo "<p><strong>Date de début :</strong> {$value['date_debut']}</p>";
                    echo "<p><strong>Date de fin :</strong> {$value['date_fin']}</p>";
                    echo "<p><strong>Durée :</strong> {$value['duree']} Jours</p>";
                    echo "<p><strong>Loyer mensuel :</strong> {$value['coutPropriete']} €/mois</p>";
                    echo "<div>";
                    echo "<h6 class='offset-8'> <strong>Dr</strong> Mohamed Anzize SIHAMOUDINE</h3>";
                    echo "<img src='../../Asset/Signature.png' class='signature offset-9'>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>
</body>

</html>
