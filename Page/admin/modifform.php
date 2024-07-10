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
    <title>Modifier une Propriete</title>
    <link rel="stylesheet" href="../css/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5% 10%;
            background-color: hsla(0, 6%, 90%, 0.755);
        }

        .container {
            width: 87%;
            border-radius: 6%;
        }

        .card {
            margin-top: 7%;
        }

        .form-group {
            margin-bottom: 3%;
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
                <h1 class="text-center text-uppercase">Modifier une Propriete</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="../../index.php" enctype="multipart/form-data">
                    <?php
                    include_once '../../db/requetes.php';
                    if (isset($_GET['id'])) {
                        $detailsProp = unProp($_GET['id']);

                        echo "<div class='form-group row'>";
                        echo "<input type='number' class='form-control' name='idProp' value='{$detailsProp['idPropriete']}' readonly>";
                        echo "</div>";
                        echo "<div class='form-group row'>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Propriete</label>";
                        echo "<input type='text' class='form-control' name='nomProp' required value='{$detailsProp['nomPropriete']}'>";
                        echo "</div>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Adresse</label>";
                        echo "<input type='text' class='form-control' name='adresseProp' required value='{$detailsProp['adressePropriete']}'>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='form-group row'>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Télécharger une nouvelle image:</label>";
                        echo "<input type='file' class='form-control-file' name='imageProp' accept='image/*'>";
                        echo "</div>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Pièce</label>";
                        echo "<input type='number' class='form-control' name='nombrePiece' require value='{$detailsProp['nombrePiece']}'>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='form-group row'>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Dimension (m²)</label>";
                        echo "<input type='number' class='form-control' name='dimension' required value='{$detailsProp['dimension']}'>";
                        echo "</div>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Description</label>";
                        echo "<textarea class='form-control' name='descrProp' rows='2' required>{$detailsProp['descriptionPropriete']}</textarea>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='form-group row'>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Prix (€)</label>";
                        echo "<input type='number' class='form-control' name='coutProp' required value='{$detailsProp['coutPropriete']}'>";
                        echo "</div>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Equipement</label>";
                        echo "<input type='text' class='form-control' name='Equipement' value='{$detailsProp['Equipement']}'>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='form-group row'>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Type de Propriété</label>";
                        echo "<select name='typeProp' class='form-select' required>";
                        foreach ($tyProps as $typrop) {
                            foreach ($typrop as $value) {
                                $selectedType = ($value['idTypePropriete'] == $detailsProp['fk_idTypePropriete']) ? 'selected' : '';
                                echo "<option value='{$value['idTypePropriete']}' $selectedType>{$value['nomTypePropriete']}</option>";
                            }
                        }
                        echo "</select>";
                        echo "</div>";
                        echo "<div class='col-md-6'>";
                        echo "<label class='text-bold'>Bailleur</label>";
                        echo "<select name='bailleur' class='form-select'  required>";
                        foreach ($bailleurs as $bail) {
                            foreach ($bail as $value) {
                                $selectedBailleur = ($value['idBailleur'] == $detailsProp['fk_idBailleur']) ? 'selected' : '';
                                echo "<option value='{$value['idBailleur']}' $selectedBailleur>{$value['nomBailleur']}</option>";
                            }
                        }
                        echo "</select>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label class='text-bold'>Service</label>";
                        echo "<select name='services' class='form-select'  required>";
                        foreach ($services as $serv) {
                            foreach ($serv as $value) {
                                $selectedService = ($value['numService'] == $detailsProp['fk_Service']) ? 'selected' : '';
                                echo "<option value='{$value['numService']}' $selectedService>{$value['nomService']}</option>";
                            }
                        }
                        echo "</select>";
                        echo "</div>";

                        echo "<div class='form-group row d-flex justify-content-center'>";
                        echo "<div class='col-md-4'>";
                        echo "<button type='submit' class='btn btn-primary' name='modifier'><i class='fas fa-save'></i> Modifier Propriete</button>";
                        echo "</div>";
                        echo "<div class='col-md-4'>";
                        echo "<button type='reset' class='btn btn-danger' onclick=\"window.location.href = 'modifProp.php'\"><i class='fas fa-sync-alt'></i> Annuler</button>";
                        echo "</div>";
                        echo "</div>";



                    }
                    ?>
                </form>

            </div>
        </div>
    </div>
</body>

</html>