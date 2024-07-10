<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <link rel="stylesheet" href="css/css/bootstrap.css">
    <title>Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5% 10%;
            background-color: hsla(0, 6%, 90%, 0.755);
        }

        .container {
            width: 87%;
        }

        .card {
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
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
        <div class="card shadow">
            <div class="card-header">
                <h1 class="text-center text-uppercase">Inscription</h1>
            </div>
            <div class="card-body mt-3">
                <form method="POST" action="../index.php" onsubmit="return validateForm()">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label><i class="fa fa-user"></i> Nom user:</label>
                            <input type="text" name="nom" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label><i class="fa fa-user"></i> Prenom:</label>
                            <input type="text" name="prenom" class="form-control">
                        </div>

                        <div class="col-md-6 mt-2">
                            <label><i class="fa fa-phone"></i> Téléphone:</label>
                            <input id="phone" type="tel" name="tel" class="form-control">
                            <small id="phoneHelp" class="form-text text-muted">Veuillez saisir un numéro de téléphone
                                valide.</small>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label><i class="fa fa-envelope"></i> Email:</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label><i class="fa fa-unlock-alt" aria-hidden="true"></i> Password:</label>
                            <input type="password" name="pass" class="form-control">
                        </div>

                        <div class="col-md-6 mt-5">
                            <button type="submit" name="valide" class="btn btn-block btn-primary">
                                <i class="fa fa-sign-in" aria-hidden="true"></i> S’inscrire
                            </button>

                            <p class="text-center">
                                <i style="color:red" id="error-message"></i>
                                Avez-vous déjà un compte ?<a href="connexion.php"> Connexion </a>
                            </p>
                        </div>

                        <div class="col-10">
                            <div class="form-check text-primary text-center">
                                <input class="form-check-input" type="checkbox" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Accepter les conditions générales
                                </label>
                                <div class="invalid-feedback">
                                    Vous devez accepter avant de soumettre
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var phoneInputField = document.querySelector("#phone");
            var phoneInput = window.intlTelInput(phoneInputField, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                separateDialCode: true,
                nationalMode: false,
                preferredCountries: ["km", "sn"],
                autoPlaceholder: "aggressive",
                initialCountry: "",
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
            var pass = document.forms[0]["pass"].value;

            var errorMessage = "";

            if (nom === "" || prenom === "" || tel === "" || email === "" || pass === "") {
                errorMessage = "Veuillez remplir tous les champs.";
            } else if (pass.length < 6) {
                errorMessage = "Le mot de passe doit contenir au moins 6 caractères.";
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