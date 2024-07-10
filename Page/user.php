<?php
session_start();
//Vérifier si la session est toujours active
function userActive($maxInactiveTime = 180)
{
    if (isset($_SESSION['derniere_activite']) && time() - $_SESSION['derniere_activite'] > $maxInactiveTime) {
        //Déconnection de user une fois la dernière activité dépasse le temps d'inactivité maximal
        session_unset();
        session_destroy();
        return false;
    }

    // Mise à jour du timestamp de la dernière activité
    $_SESSION['derniere_activite'] = time();

    return true;
}
if (isset($_SESSION['utilisateur']) && userActive()) {
    $utilisateur = $_SESSION['utilisateur'];
}else{
    header("Location: connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="hydrated">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeverse -
        <?= $utilisateur['nomClient'] . ' ' . $utilisateur['prenomClient'] ?>
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
                            <span class="indicateur <?= ($utilisateur['nomClient']) ? 'active' : '' ?>"></span>
                            <ion-icon name="person-outline"></ion-icon>

                            <span>
                                <?= strtoupper($utilisateur['nomClient']) . ' ' . strtoupper($utilisateur['prenomClient']) ?>
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
                                <a href="propriete.php" target="_blank" class="navbar-link"
                                    data-nav-link>Proprietes</a>
                            </li>

                            <li>
                                <a href="#service" class="navbar-link" data-nav-link>Service</a>
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
                        onclick="window.location.href = 'user/profile.php' ">
                        <ion-icon name="person-outline"></ion-icon>
                        <span>Profile</span>
                    </button>

                    <button title="Mes Favorites" class="header-bottom-actions-btn" aria-label="Cart"
                        onclick="window.location.href = 'user/favorie.php' ">
                        <ion-icon name="cart-outline"></ion-icon>
                        <span>favorie</span>
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

            <!-- #HERO -->

            <section class="hero" id="home">
                <div class="container">

                    <div class="hero-content">

                        <p class="hero-subtitle">
                            <ion-icon name="home"></ion-icon>

                            <span>Agence Immobilier</span>
                        </p>

                        <h2 class="h1 hero-title">Bienvenue chez Homeverse - où vos rêves immobiliers prennent vie !
                        </h2>

                        <p class="hero-text">
                            Trouver votre maison de rêve chez nous...
                        </p>

                        <button class="btn" onclick="window.location.href = 'user/demande.php'">Effectuer une
                            demande</button>

                    </div>

                </div>
            </section>

            <!-- #ABOUT -->

            <section class="about" id="about">
                <div class="container">

                    <figure class="about-banner">
                        <img src="../Asset/hero-bannier1.png" alt="House interior">

                        <img src="../Asset/image4.png" alt="House interior" class="abs-img">
                    </figure>

                    <div class="about-content">

                        <p class="section-subtitle">À propos de nous</p>

                        <h2 class="h2 section-title">La principale place de marché immobilière.</h2>

                        <p class="about-text">
                            Plus de 39 000 personnes travaillent pour nous dans plus de 70 pays à travers le monde.
                            Cette large couverture mondiale, combinée à des services spécialisés...
                        </p>

                        <ul class="about-list">

                            <li class="about-item">
                                <div class="about-item-icon">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>

                                <p class="about-item-text">Conception de maison intelligente</p>
                            </li>

                            <li class="about-item">
                                <div class="about-item-icon">
                                    <ion-icon name="leaf-outline"></ion-icon>
                                </div>

                                <p class="about-item-text">Beau paysage environnant</p>
                            </li>

                            <li class="about-item">
                                <div class="about-item-icon">
                                    <ion-icon name="wine-outline"></ion-icon>
                                </div>

                                <p class="about-item-text">Style de vie exceptionnel</p>
                            </li>

                            <li class="about-item">
                                <div class="about-item-icon">
                                    <ion-icon name="shield-checkmark-outline"></ion-icon>
                                </div>

                                <p class="about-item-text">Sécurité complète 24h/24, 7j/7</p>
                            </li>

                        </ul>

                        <p class="callout">
                            "Bienvenue sur Homeverse - votre destination pour trouver la maison de vos rêves !
                            Notre agence immobilière propose une large gamme de propriétés soigneusement sélectionnées."
                        </p>

                        <a href="#service" class="btn">Nos Services</a>

                    </div>

                </div>
            </section>

            <!-- #SERVICE -->

            <section class="service" id="service">
                <div class="container">

                    <p class="section-subtitle">Nos Services</p>

                    <h2 class="h2 section-title">L'objectif principal</h2>

                    <ul class="service-list">

                        <li>
                            <div class="service-card">

                                <div class="card-icon">
                                    <img src="../Asset/service-1.png" alt="Service icon">
                                </div>

                                <h3 class="h3 card-title">
                                    <a href="propriete.php#propertyV">Acheter une maison</a>
                                </h3>

                                <p class="card-text">
                                    Avec +1 million de maisons à vendre disponibles dans le site,
                                    vous trouverez une maison que vous voudrez appeler chez vous.
                                </p>

                                <a href="propriete.php#propertyV" class="card-link">
                                    <span>Acheter une maison</span>

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
                                    <a href="propriete.php#propertyL">Louer une maison</a>
                                </h3>

                                <p class="card-text">
                                    Avec 200k maisons disponibles sur le site, nous pouvons vous
                                    trouver une maison de confortable selon votre goût, ne ratez pas.
                                </p>

                                <a href="propriete.php#propertyL" class="card-link">
                                    <span>Trouver une maison</span>

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
                                    <a href="propriete.php#propertyD">Investisser</a>
                                </h3>

                                <p class="card-text">
                                    Avec Nous, investisser en toute confiance dans un avenir immobilier prospère.
                                    Debuter une parcours vers le succès financier.
                                </p>

                                <a href="propriete.php#propertyD" class="card-link">
                                    <span>Investisser</span>

                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </a>

                            </div>
                        </li>

                    </ul>

                </div>
            </section>


            <!-- #PROPERTY -->

            <section class="property" id="property">
                <div class="container">

                    <p class="section-subtitle">Properietes</p>

                    <h2 class="h2 section-title">Annonces en vedette</h2>

                    <ul class="property-list has-scrollbar">
                        <?php
                        include_once '../db/requetes.php';
                        if ($vedetes) {
                            foreach ($vedetes as $appartement) {
                                foreach ($appartement as $value) {
                                    echo "<li>";

                                    echo "<div class='property-card'>";

                                    echo "<figure class='card-banner'>";

                                    echo "<a href='#'>";
                                    echo "<img src='../Asset/propriete/{$value['imagePropriete']}' alt='New Apartment Nice View' class='w-100'>";
                                    echo "</a>";

                                    echo "<div class='card-badge green'>{$value['nomService']}</div>";

                                    echo "<div class='banner-actions'>";

                                    echo "<button class='banner-actions-btn'>";
                                    echo "<ion-icon name='location'></ion-icon>";
                                    echo "<address>{$value['adressePropriete']}</address>";
                                    echo "</button>";

                                    echo "<button class='banner-actions-btn'>";
                                    echo "<ion-icon name='camera'></ion-icon>";
                                    echo "<span>4</span>";
                                    echo "</button>";

                                    echo "<button class='banner-actions-btn'>";
                                    echo "<ion-icon name='film'></ion-icon>";
                                    echo "<span>2</span>";
                                    echo "</button>";

                                    echo "</div>";

                                    echo "</figure>";

                                    echo "<div class='card-content'>";

                                    echo "<div class='card-price'>";
                                    echo "<strong> {$value['coutPropriete']} €</strong>/Mois";
                                    echo "</div>";

                                    echo "<h3 class='h3 card-title'>";
                                    echo "<a href='propriete.php'>{$value['nomPropriete']}</a>";
                                    echo "</h3>";

                                    echo "<p class='card-text scrollpar'>{$value['descriptionPropriete']}</p>";

                                    echo "<ul class='card-list'>";

                                    echo "<li class='card-item'>";
                                    echo "<strong>{$value['nombrePiece']}</strong>";

                                    echo "<ion-icon name='bed-outline'></ion-icon>";

                                    echo "<span>Chambre</span>";
                                    echo "</li>";

                                    echo "<li class='card-item'>";
                                    echo "<strong>+2</strong>";

                                    echo "<ion-icon name='man-outline'></ion-icon>";

                                    echo "<span>Salles de bains</span>";
                                    echo "</li>";

                                    echo "<li class='card-item'>";
                                    echo "<strong>{$value['dimension']}</strong>";

                                    echo "<ion-icon name='square-outline'></ion-icon>";

                                    echo "<span>Pieds carrés</span>";
                                    echo "</li>";

                                    echo "</ul>";

                                    echo "</div>";

                                    echo "<div class='card-footer'>";

                                    echo "<div class='card-author'>";

                                    echo "<figure class='author-avatar'>";
                                    echo "<img src='../Asset/agent.jpg' class='w-100'>";
                                    echo "</figure>";

                                    echo "<div>";
                                    echo "<p class='author-name'>";
                                    echo "<a href='#'>{$value['nomBailleur']}</a>";
                                    echo "</p>";

                                    echo "<p class='author-title'>Fournisseur immobilier</p>";
                                    echo "</div>";

                                    echo "</div>";

                                    echo "<div class='card-footer-actions'>";

                                    echo "<button class='card-footer-actions-btn'>";
                                    echo "<ion-icon name='resize-outline'></ion-icon>";
                                    echo "</button>";

                                    echo "<button class='card-footer-actions-btn' onclick=\"window.location.href='user/favorie.php?ID={$value['idPropriete']}'\">";
                                    echo "<ion-icon name='cart-outline'></ion-icon>";
                                    echo "</button>";

                                    echo "</div>";

                                    echo "</div>";

                                    echo "</div>";

                                    echo "</li>";
                                }
                            }
                        }
                        ?>
                    </ul>

                </div>
            </section>


            <!--FEATURES -->

            <section class="features">
                <div class="container">

                    <p class="section-subtitle">Nos commodités</p>

                    <h2 class="h2 section-title">Commodités du bâtiment</h2>

                    <ul class="features-list">

                        <li>
                            <a href="#" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="car-sport-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Place de stationnement</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="#" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="water-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Piscine</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="#" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="shield-checkmark-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Sécurité privée</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="#" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="fitness-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Centre Medicale</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="#" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="library-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Espace bibliothèque</h3>

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

                                <h3 class="card-title">Lits King Size</h3>

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

                                <h3 class="card-title">Maisons intelligentes</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="#" class="features-card">

                                <div class="card-icon">
                                    <ion-icon name="football-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Espace de jeux pour enfants</h3>

                                <div class="card-btn">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>

                            </a>
                        </li>

                    </ul>

                </div>
            </section>

            <!-- #BLOG -->

            <section class="blog" id="blog">
                <div class="container">

                    <p class="section-subtitle">Actualités et Blogs</p>

                    <h2 class="h2 section-title">Flux d'actualités les plus récentes et Luxueux</h2>

                    <ul class="blog-list has-scrollbar">
                        <?php
                        if ($appLuxe) {
                            foreach ($appLuxe as $app) {
                                foreach ($app as $value) {
                                    echo "<li>";
                                    echo "<div class='blog-card'>";

                                    echo "<figure class='card-banner'>";
                                    echo "<img src='../Asset/propriete/{$value['imagePropriete']}' alt='The Most Inspiring Interior Design Of 2024' class='w-100'>";
                                    echo "</figure>";

                                    echo "<div class='blog-content'>";

                                    echo "<div class='blog-content-top'>";

                                    echo "<ul class='card-meta-list'>";

                                    echo "<li>";
                                    echo "<a href='#' class='card-meta-link'>";
                                    echo "<ion-icon name='person'></ion-icon>";
                                    echo "<span>Par: {$value['nomBailleur']}</span>";
                                    echo "</a>";
                                    echo "</li>";

                                    echo "<li>";
                                    echo "<a href='#' class='card-meta-link'>";
                                    echo "<ion-icon name='pricetags'></ion-icon>";

                                    echo "<span>Intérieur</span>";
                                    echo "</a>";
                                    echo "</li>";

                                    echo "</ul>";

                                    echo "<h4 class='h3 blog-title'>";
                                    echo "<a href='#'>{$value['nomPropriete']}</a>";
                                    echo "</h4>";

                                    echo "</div>";

                                    echo "<div class='blog-content-bottom'>";
                                    echo "<div class='publish-date'>";
                                    echo "<ion-icon name='calendar'></ion-icon>";
                                    $dateDuJour = date('Y-m-d');
                                    $dateFormatee = date('M d, Y', strtotime($dateDuJour));
                                    echo "<time datetime='{$dateDuJour}'>{$dateFormatee}</time>";
                                    echo "</div>";

                                    echo "<a href='propriete.php' class='read-more-btn'>Plus ...</a>";
                                    echo "</div>";

                                    echo "</div>";

                                    echo "</div>";
                                    echo "</li>";
                                }
                            }
                        }
                        ?>

                    </ul>

                </div>
            </section>

            <!-- #CTA -->

            <section class="cta">
                <div class="container">

                    <div class="cta-card">
                        <div class="card-content">
                            <h2 class="h2 card-title">À la recherche de la maison de vos rêves ?</h2>

                            <p class="card-text">Nous pouvons vous aider à concrétiser votre rêve d'une nouvelle maison
                            </p>
                        </div>

                        <button class="btn cta-btn">
                            <a href="propriete.php">
                                <span>Explore Properietés</span>
                            </a>

                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </button>
                    </div>

                </div>
            </section>

        </article>
    </main>

    <!-- #FOOTER -->

    <footer class="footer">

        <div class="footer-top">
            <div class="container">

                <div class="footer-brand">

                    <a href="#" class="logo">
                        <img src="../Asset/logo-light.png" alt="Homeverse logo">
                    </a>

                    <ul class="contact-list">

                        <li>
                            <a href="#" class="contact-link">
                                <ion-icon name="location-outline"></ion-icon>

                                <address>Medina, Dakar, Senegal</address>
                            </a>
                        </li>

                        <li>
                            <a href="tel:+221783800668" class="contact-link">
                                <ion-icon name="call-outline"></ion-icon>

                                <span>+221-78-380-06-68</span>
                            </a>
                        </li>

                        <li>
                            <a href="mailto:sihamoudineanzize@gmail.com" class="contact-link">
                                <ion-icon name="mail-outline"></ion-icon>
                                <span>sihamoudineanzize@gmail.com</span>
                            </a>
                        </li>

                    </ul>

                    <ul class="social-list">

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-linkedin"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-youtube"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-whatsapp"></ion-icon>
                            </a>
                        </li>

                    </ul>

                </div>

                <div class="footer-link-box">

                    <ul class="footer-list">

                        <li>
                            <p class="footer-list-title">Services</p>
                        </li>


                        <li>
                            <a href="#" class="footer-link">Location</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Achats</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Investissement</a>
                        </li>

                    </ul>

                    <ul class="footer-list">

                        <li>
                            <p class="footer-list-title">Service client</p>
                        </li>

                        <li>
                            <a href="#" class="footer-link">suivi de demande</a>
                        </li>


                        <li>
                            <a href="#" class="footer-link">Contacter nous</a>
                        </li>

                        
                        <li>
                            <a href="#" class="footer-link">Promotion Offers</a>
                        </li>

                    </ul>

                    <ul class="footer-list">

                        <li>
                            <p class="footer-list-title">Disponibilite</p>
                        </li>

                        <table>
                            <tbody>

                                <tr>
                                    <th>Lun</th>
                                    <td>09:30 à 17:30</td>
                                </tr>
                                <tr>
                                    <th>Mar</th>
                                    <td>09:30 à 17:30</td>
                                </tr>
                                <tr>
                                    <th>Mer</th>
                                    <td>09:30 à 17:30</td>
                                </tr>
                                <tr>
                                    <th>Jeu</th>
                                    <td>09:30 à 17:30</td>
                                </tr>
                                <tr>
                                    <th>Ven</th>
                                    <td>09:30 à 18:30</td>
                                </tr>
                                <tr>
                                    <th>Sam</th>
                                    <td>09:30 à 15:30</td>
                                </tr>
                            </tbody>
                        </table>
                    </ul>

                </div>

            </div>
        </div>

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