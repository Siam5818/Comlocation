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
    header("Location: connexion.php");
    exit();
}
//Message d'ajout
if (isset($messageAjoutPropriete)) {
    echo "<script>";
    echo "alert('" . $messageAjoutPropriete . "');";
    echo "</script>";
}
?>
<!DOCTYPE html>
<html lang="en" class="hydrated">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeverse -
        <?= $admin['nomClient'] . ' ' . $admin['prenomClient'] ?>
    </title>
    <link rel="stylesheet" href="css/style.css">
    <!--  ces balises sont utilisées pour optimiser le chargement des polices Google en établissant des connexions préalables et en récupérant les styles de police nécessaires.-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        .scrollpar {
            height: 30%;
            overflow-y: auto;
        }

        .indicateur {
            display: inline-block;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin-left: 5px;
            background-color: red;
        }

        .indicateur.active {
            background-color: green;
        }
    </style>
</head>

<body>

    <!-- #HEADER-->
    <header class="header" data-header>

        <div class="overlay" data-overlay></div>

        <div class="header-top">
            <div class="container">

                <ul class="header-top-list">

                    <li>
                        <a href="#" class="header-top-link">
                            <span class="indicateur <?= ($admin['nomClient']) ? 'active' : '' ?>"></span>
                            <ion-icon name="person-outline"></ion-icon>
                            <span>
                                <?= strtoupper($admin['nomClient']) . ' ' . strtoupper($admin['prenomClient']) ?>
                            </span>
                        </a>
                    </li>

                </ul>

                <div class="wrapper">
                    <ul class="header-top-social-list">

                        <li>
                            <a href="#" class="header-top-social-link">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="header-top-social-link">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="header-top-social-link">
                                <ion-icon name="logo-instagram"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="header-top-social-link">
                                <ion-icon name="logo-pinterest"></ion-icon>
                            </a>
                        </li>

                    </ul>

                    <form method="POST" action="../index.php">
                        <button type="submit" class="header-top-btn" name="deconnexion">Deconnexion</button>
                    </form>

                </div>

            </div>
        </div>

        <div class="header-bottom">
            <div class="container">

                <a href="#" class="logo">
                    <img src="../Asset/logo.png" alt="Homeverse logo">
                </a>

                <nav class="navbar" data-navbar>

                    <div class="navbar-top">

                        <a href="#" class="logo">
                            <img src="../Asset/logo.png" alt="Homeverse logo">
                        </a>
                        <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
                            <ion-icon name="close-outline"></ion-icon>
                        </button>

                    </div>

                    <div class="navbar-bottom">
                        <ul class="navbar-list">

                            <li>
                                <a href="#home" class="navbar-link" data-nav-link>Home</a>
                            </li>

                            <li>
                                <a href="propriete.php" class="navbar-link" data-nav-link>Propriete</a>
                            </li>

                            <li>
                                <a href="admin/client.php" class="navbar-link" data-nav-link>User</a>
                            </li>

                            <li>
                                <form method="POST" action="../index.php">
                                    <button type="submit" class="navbar-link" name="deconnexion">Deconnexion</button>
                                </form>
                            </li>

                        </ul>
                    </div>

                </nav>

                <div class="header-bottom-actions">

                    <button class="header-bottom-actions-btn" aria-label="Search">
                        <ion-icon name="search-outline"></ion-icon>
                        <span>Search</span>
                    </button>

                    <button class="header-bottom-actions-btn" aria-label="Profile"
                        onclick="window.location.href = 'admin/profile.php' ">
                        <ion-icon name="person"></ion-icon>
                        <span>Profile</span>
                    </button>

                    <button class="header-bottom-actions-btn" data-nav-open-btn aria-label="Open Menu">
                        <ion-icon name="menu-outline"></ion-icon>
                        <span>Menu</span>
                    </button>

                </div>

            </div>
        </div>

    </header>

    <main>
        <article>

            <!-- #SERVICE -->
            <section class="service" id="service">
                <div class="container">

                    <p class="section-subtitle">Gestion Des Services</p>

                    <ul class="service-list">

                        <li>
                            <div class="service-card">

                                <div class="card-icon">
                                    <img src="../Asset/service-1.png" alt="Service icon">
                                </div>

                                <h3 class="h3 card-title">
                                    <a href="#">Achats</a>
                                </h3>

                                <p class="card-text">
                                    Gestion des achats.
                                </p>

                                <a href="#" class="card-link">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </a>

                            </div>
                        </li>

                        <li>
                            <div class="service-card">

                                <div class="card-icon">
                                    <img src="../Asset/service-2.png" alt="Service icon">
                                </div>

                                <h3 class="h3 card-title">
                                    <a href="admin/mesReservation.php">Location</a>
                                </h3>

                                <p class="card-text">
                                    Gestion de reservation.
                                </p>

                                <a href="admin/mesReservation.php" class="card-link">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </a>

                            </div>
                        </li>

                        <li>
                            <div class="service-card">

                                <div class="card-icon">
                                    <img src="../Asset/service-3.png" alt="Service icon">
                                </div>

                                <h3 class="h3 card-title">
                                    <a href="#">Investissement</a>
                                </h3>

                                <p class="card-text">
                                    Gestion des Investissement.
                                </p>

                                <a href="#" class="card-link">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </a>

                            </div>
                        </li>

                    </ul>

                </div>
            </section>

            <!--OPTION -->
            <section class="features">
                <div class="container">

                    <p class="section-subtitle">Les Options</p>

                    <ul class="features-list">

                        <li>
                            <a href="admin/ajoutProp.php" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Ajouter une Propriete</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="admin/modifProp.php" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="settings-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Mise à jour d'une Propriete</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="admin/contrat.php" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="contract-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Contrats</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="admin/client.php" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="fitness-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Clients</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="admin/d_demande.php" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="library-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Demandes</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="#" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="bed-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Agents</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="#" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Notations</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="#" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="cash-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Paiements</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                    </ul>

                </div>
            </section>

        </article>
    </main>

    <!-- #FOOTER -->
    <footer class="footer">

        <div class="footer-bottom">
            <div class="container">

                <p class="copyright">
                    &copy; 2024 <a href="#">Mohamed Anzize</a>. All Rights Reserved
                </p>

            </div>
        </div>

    </footer>

    <script src="js/scripte.js"></script>

    <!-- ionicon lien -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>