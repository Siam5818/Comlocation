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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <title>Modifier le profil</title>
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
    <div class="container mt-5">
        <?php
        include_once '../../db/requetes.php';
        if ($_GET['id']) {
            $idProfile = $_GET['id'];
            $profil = uneClient($idProfile);
            if ($profil) {
                echo '<div class="card shadow">';
                echo '<div class="card-header">';
                echo "<h1 class='text-center text-uppercase'>Modifier le profil : {$profil['nomClient']}</h1>";
                echo "</div>";
                echo "<div class='card-body mt-3'>";
                echo "<form method='POST' action='../../index.php' onsubmit='return validateForm()'>";
                echo "<div class='form-group row'>";
                echo "<div class='col-md-12'>";
                echo "<input type='text' name='matricule' class='form-control' value='{$profil['matricule']} ' readonly>";
                echo "</div>";
                echo "</div>";
                echo "<div class='form-group row'>";
                echo "<div class='col-md-6'>";
                echo "<input type='text' name='nom' class='form-control' value='{$profil['nomClient']}'>";
                echo "</div>";
                echo "<div class='col-md-6'>";
                echo "<input type='text' name='prenom' class='form-control' value='{$profil['prenomClient']}'>";
                echo "</div>";
                echo "</div>";
                echo "<div class='form-group row'>";
                echo "<div class='col-md-6'>";
                echo "<input type='email' name='email' class='form-control' value='{$profil['emailClient']}'>";
                echo "</div>";
                echo "<div class='col-md-6'>";
                echo "<input id='phone' type='tel' name='tel' class='form-control' value='{$profil['telClient']}'>";
                echo "</div>";
                echo "</div>";
                echo "<div class='form-group row'>";
                echo "<div class='col-md-12'>";
                echo "<select class='form-control " . ($profil['roleClient'] == 'desable' ? 'bg-danger' : '') . "' name='role'>";
                if ($profil['roleClient'] == 'admin') {
                    echo "<option value='admin' selected>Admin</option>";
                    echo "<option value='user'>User</option>";
                } elseif ($profil['roleClient'] == 'client') {
                    echo "<option value='admin'>Admin</option>";
                    echo "<option value='client' selected>Client</option>";
                }elseif ($profil['roleClient'] == 'desable') {
                    echo "<option value='desable' selected>Desable</option>";
                    echo "<option value='admin'>Admin</option>";
                    echo "<option value='client'>Client</option>";
                }
                echo "</select>";
                echo "</div>";
                echo "</div>";
                echo "<div class='form-group row d-flex justify-content-center mb-1'>";
                echo "<div class='col-md-4'>";
                echo "<button type='submit' name='enregisrer' class='btn btn-block btn-success'><i class='fa fa-save'></i> Enregistrer</button>";
                echo "<p class='text-center'><i style='color:red' id='error-message'></i></p>";
                echo "</div>";
                echo "<div class='col-md-4'>";
                echo "<button type='reset' class='btn btn-block btn-danger' onclick=\"window.location.href = 'client.php'\"><i class='fas fa-sync-alt'></i> Annuler</button>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

            }
        }
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var phoneInputField = document.querySelector("#phone");
                var phoneInput = window.intlTelInput(phoneInputField, {
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                    separateDialCode: true,
                    nationalMode: false,
                    autoPlaceholder: "aggressive",
                });

                phoneInputField.addEventListener('input', function () {
                    if (phoneInputField.value.length > phoneInput.getSelectedCountryData().maxLength) {
                        phoneInputField.value = phoneInputField.value.slice(0, phoneInput.getSelectedCountryData().maxLength);
                    }
                });

                phoneInputField.addEventListener('countrychange', function () {
                    var currentNumber = phoneInput.getNumber();
                    phoneInput.setNumber(currentNumber);
                });
            });

            function validateForm() {
                var nom = document.forms[0]["nom"].value;
                var prenom = document.forms[0]["prenom"].value;
                var tel = document.forms[0]["tel"].value;
                var email = document.forms[0]["email"].value;

                var errorMessage = "";

                if (nom === "" || prenom === "" || tel === "" || email === "") {
                    errorMessage = "Veuillez remplir tous les champs.";
                } else if (!isValidEmail(email)) {
                    errorMessage = "Veuillez saisir une adresse e-mail valide.";
                } else if (!isValidPhoneNumber(tel)) {
                    errorMessage = "Veuillez saisir un numéro de téléphone valide.";
                }

                if (errorMessage !== "") {
                    document.getElementById("error-message").innerText = errorMessage;
                    return false;
                }

                return true;
            }

            function isValidEmail(email) {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function isValidPhoneNumber(phoneNumber) {
                var country = getSelectedCountry();
                return isValidNumberForCountry(phoneNumber, country);
            }
        </script>
</body>

</html>