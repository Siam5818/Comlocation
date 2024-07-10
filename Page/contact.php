
<?php
/*
$confirmation = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Adresse e-mail de destination
    $entreprise = "sihamoudineanzize@gmail.com";

    $objet = "Nouveau message de la part de $name";

    $corp = "Vous avez reçu un nouveau message de la part de $name ($email):\n\n$message";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Configuration des paramètres SMTP
    ini_set("SMTP", "smtp.gmail.com");
    ini_set("smtp_port", "587");

    // Envoi de l'e-mail
    if (mail($entreprise, $objet, $corp, $headers)) {
        $confirmation = true;
    } else {
        echo "Une erreur s'est produite. Veuillez réessayer plus tard.";
    }
}

if ($confirmation) {
    echo "<p>Votre message a été envoyé avec succès, Merci.</p>";
}
*/
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5% 10%;
            background-color: hsla(0, 6%, 90%, 0.755);
        }

        .container {
            margin-top: 50px;
        }

        .card-header {
            background-color: hsl(200, 69%, 14%);
            color: #fff;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            background-color: #f9f9f9;
            padding: 20px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: none;
            height: 150px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mb-0 text-uppercase">Contactez-nous</h2>
                    </div>
                    <div class="card-body">
                        <form action="contact.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Nom" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Message" rows="5"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
