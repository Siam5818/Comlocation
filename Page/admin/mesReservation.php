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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mes Réservations</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 50px;
    }

    .reservation-card {
      border: 1px solid #ced4da;
      border-radius: 8px;
      margin-bottom: 20px;
      padding: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    h2 {
      color: #007bff;
    }

    h4 {
      color: #007bff;
    }

    .reservation-details {
      margin-top: 15px;
    }

    .btn-custom {
      color: #fff;
      background-color: hsl(9, 72%, 43%);
    }

    .btn-custom:hover {
      background-color: hsl(200, 69%, 14%);
      color: #fff;
    }
  </style>
</head>

<body>

  <div class="container">
    <?php
    include_once '../../db/requetes.php';
    $mesresevation[] = mesReservation();
    if ($mesresevation) {
      foreach ($mesresevation as $histo) {
        if (!empty($histo)) {
          echo "<h2 class='text-center text-uppercase'>Mes Reservations</h2>";

          foreach ($histo as $value) {

            echo "<div class='reservation-card'>";
            echo "<h4>Réservation ID: {$value['idReservation']}</h4>";
            echo "<p><strong>État de la Réservation :</strong> {$value['etatReservation']}</p>";
            echo "<p><strong>Date de Soumission :</strong> {$value['dateSoumission']}</p>";
            echo "<button class='btn btn-custom' onclick=\"basculDetails(this)\">Voir Détails</button>";

            echo "<div class='reservation-details' hidden>";
            echo "<p><strong>Informations du Client :</strong> Nom : {$value['nomClient']}, Email : {$value['emailClient']}</p>";
            echo "<p><strong>Informations de la Propriété :</strong> Type : Résidentiel, Adresse : {$value['adressePropriete']}</p>";
            echo "<p><strong>Informations du Contrat :</strong> ";
            $cont = contratSigner($value['idReservation']);
            echo !empty($cont['fk_idTypeContrat']) ? "Durée : {$cont['duree']} Jours" : "Neant";
            echo "</p>";
            if (!empty($cont['fk_idTypeContrat'])) {
              echo "<p><strong>Debut du Contrat: </strong>{$cont['date_debut']}</p>";
              echo "<p><strong>Fin du Contrat: </strong>{$cont['date_fin']}</p>";
            }
            echo !empty($cont['duree']) ? "" : "<a class='btn btn-info offset-10' href='ajoutContrat.php?id={$value['idReservation']}'>Signature</a>";
            echo "</div>";
            echo "</div>";
          }
        }
      }
    }
    ?>
  </div>

  <script>
    function basculDetails(bouton) {
      var detailsDiv = bouton.nextElementSibling;
      detailsDiv.hidden = !detailsDiv.hidden;
    }
  </script>
</body>

</html>