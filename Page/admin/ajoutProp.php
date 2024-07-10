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
    <title>Ajouter une Propriete</title>
    <link rel="stylesheet" href="../css/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2% 20% 0 10%;
            background-color: #f8f9fa;
            width: 80%;
            align-items: center;
        }

        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            text-align: center;
            text-transform: uppercase;
            background-color: #1e2a3a;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }

        .card-body {
            padding: 20px;
        }

        h1 {
            color: #fff;
        }

        form {
            max-width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #1e2a3a;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 13px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            background-color: #ff7f50;
            color: black;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e64a19;
        }

        .btn-danger {
            background-color: #dc3545;
            margin-left: 10%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Ajouter une Propriete</h1>
            </div>
            <div class="card-body">
                <form action="../../index.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nomProp" required
                                placeholder="Nom de la Propriete">

                            <input type="text" class="form-control" name="adresseProp" required
                                placeholder="Adresse de la Propriete">

                            <label for="imagePropriete">Télécharger une image:</label>
                            <input type="file" class="form-control" name="imageProp" accept="image/*" required>

                            <input type="number" class="form-control" name="nombrePiece" required
                                placeholder="Nombre de pièces">

                            <input type="number" class="form-control" name="dimension" required
                                placeholder="Dimension en m²">
                        </div>
                        <div class="col-md-6">
                            <textarea name="descrProp" class="form-control" placeholder="Description de la Propriete"
                                rows="2" required></textarea>

                            <input type="number" class="form-control" name="coutProp" required
                                placeholder="Coût de la Propriete">

                            <input type="text" name="Equipement" class="form-control" required placeholder="Équipement">
                            <?php
                            include_once '../../db/requetes.php';
                            if ($tyProps) {
                                foreach ($tyProps as $typrop) {
                                    echo "<select name='typeProp' class='form-select'  required>";
                                    echo "<option selected>Type de Propriete</option>";
                                    foreach ($typrop as $value) {
                                        echo "<option value='{$value['idTypePropriete']}'>{$value['nomTypePropriete']}</option>";
                                    }
                                    echo "</select>";
                                }
                            }
                            if ($bailleurs) {
                                foreach ($bailleurs as $bail) {
                                    echo "<select name='bailleur' class='form-select' required>";
                                    echo "<option selected>Bailleur</option>";
                                    foreach ($bail as $value) {
                                        echo "<option value='{$value['idBailleur']}'>{$value['nomBailleur']}</option>";
                                    }
                                    echo "</select>";
                                }
                            }
                            ?>
                        </div>
                        <div class="col-md-12">
                            <?php
                            if ($services) {
                                foreach ($services as $serv) {
                                    echo "<select name='service' class='form-select' required>";
                                    echo "<option selected>Service</option>";
                                    foreach ($serv as $value) {
                                        echo "<option value='{$value['numService']}'>{$value['nomService']}</option>";
                                    }
                                    echo "</select>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info btn-block" name="ajouter">
                                <i class="fas fa-plus"></i> Ajouter Propriete
                            </button>
                        </div>
                        <div class="col-md-4">
                            <button type="reset" class="btn btn-danger btn-block"
                                onclick="window.location.href = '../admin.php' ">
                                <i class='fas fa-sync-alt'></i> Annuler
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>