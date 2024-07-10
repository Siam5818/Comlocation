<?php
session_start();
include_once '../db/requetes.php';
//Vérifier si la session est toujours active
function isSessionActive($maxInactiveTime = 180)
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

if (isset($_SESSION['utilisateur']) && isSessionActive()) {
    $utilisateur = $_SESSION['utilisateur'];
} else {
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proprietes</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        .red {
            color: white;
            background-color: hsl(9, 100%, 62%);
            border-radius: 3px;
        }

        .scrollpar {
            height: 30%;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <!--A LOUER-->
    <section class="property" id="propertyL">
        <div class="container">
            <p class="section-subtitle">À Louer</p>
            <h2 class="h2 section-title">Properietes</h2>

            <ul class="property-list has-scrollbar">
                <?php

                if ($appartement) {
                    foreach ($appartement as $propriete) {
                        foreach ($propriete as $value) {
                            echo "<li>";

                            echo "<div class='property-card'>";

                            echo "<figure class='card-banner'>";

                            echo "<a href='reservation.php'>";
                            echo "<img src='../Asset/propriete/{$value['imagePropriete']}' alt='New Apartment Nice View' class='w-100'>";
                            echo "</a>";

                            echo "<div class='card-badge green'>À {$value['nomService']}</div>";

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
                            echo "<a href='#'>{$value['nomPropriete']}</a>";
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

                            echo "<p class='author-title'>Fournisseur immobiliers</p>";
                            echo "</div>";

                            echo "</div>";

                            echo "<div class='card-footer-actions'>";

                            echo "<button class='card-footer-actions-btn'>";
                            echo "<ion-icon name='resize-outline'></ion-icon>";
                            echo "</button>";

                            echo "<button class='card-footer-actions-btn' onclick=\"window.location.href='user/favorie.php?ID={$value['idPropriete']}'\">";
                            echo "<ion-icon name='cart-outline'></ion-icon>";
                            echo "</button>";

                            echo "<button class='card-footer-actions-btn'>";
                            echo "<a href='user/reservation.php?id={$value['idPropriete']}''><ion-icon name='add-circle-outline'></ion-icon></a>";
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
    <!--A VENDRE-->
    <section class="property" id="propertyV">
        <div class="container">
            <p class="section-subtitle">À Vendre</p>
            <h2 class="h2 section-title">Properietes</h2>

            <ul class="property-list has-scrollbar">
                <?php
                include_once '../db/requetes.php';
                if ($avendre) {
                    foreach ($avendre as $propriete) {
                        foreach ($propriete as $value) {
                            echo "<li>";

                            echo "<div class='property-card'>";

                            echo "<figure class='card-banner'>";

                            echo "<a href='#'>";
                            echo "<img src='../Asset/propriete/{$value['imagePropriete']}' alt='New Apartment Nice View' class='w-100'>";
                            echo "</a>";

                            echo "<div class='card-badge red'>À {$value['nomService']}</div>";

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
                            echo "<strong> {$value['coutPropriete']} €</strong>";
                            echo "</div>";

                            echo "<h3 class='h3 card-title'>";
                            echo "<a href='#'>{$value['nomPropriete']}</a>";
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

                            echo "<button class='card-footer-actions-btn'>";
                            echo "<ion-icon name='add-circle-outline'></ion-icon>";
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
    <!--DISPONIBLE EN STOCK-->
    <section class="property" id="propertyD">
        <div class="container">
            <p class="section-subtitle">À Disposition</p>
            <h2 class="h2 section-title">Properietes</h2>

            <ul class="property-list has-scrollbar">
                <?php
                include_once '../db/requetes.php';
                if ($proprietes) {
                    foreach ($proprietes as $propriete) {
                        foreach ($propriete as $value) {
                            echo "<li>";

                            echo "<div class='property-card'>";

                            echo "<figure class='card-banner'>";

                            echo "<a href='#'>";
                            echo "<img src='../Asset/propriete/{$value['imagePropriete']}' alt='New Apartment Nice View' class='w-100'>";
                            echo "</a>";

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
                            echo "<strong>{$value['coutPropriete']} €</strong>";
                            echo "</div>";

                            echo "<h3 class='h3 card-title'>";
                            echo "<a href='#'>{$value['nomPropriete']}</a>";
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

                            echo "<p class='author-title'>Fournisseur immobiliers</p>";
                            echo "</div>";

                            echo "</div>";

                            echo "<div class='card-footer-actions'>";

                            echo "<button class='card-footer-actions-btn'>";
                            echo "<ion-icon name='resize-outline'></ion-icon>";
                            echo "</button>";

                            echo "<button class='card-footer-actions-btn' onclick=\"window.location.href='user/favorie.php?ID={$value['idPropriete']}'\">";
                            echo "<ion-icon name='cart-outline'></ion-icon>";
                            echo "</button>";

                            echo "<button class='card-footer-actions-btn'>";
                            echo "<a href='#'><ion-icon name='add-circle-outline'></ion-icon></a>";
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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>