'use strict';

/**
 * Fonction de basculement d'élément
 */

const elemToggleFunc = function (elem) { elem.classList.toggle("active"); }

/**
 * Basculement de la barre de navigation
 */

const navbar = document.querySelector("[data-navbar]");
const overlay = document.querySelector("[data-overlay]");
const navCloseBtn = document.querySelector("[data-nav-close-btn]");
const navOpenBtn = document.querySelector("[data-nav-open-btn]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");

const navElemArr = [overlay, navCloseBtn, navOpenBtn];

/**
 * Fermer la barre de navigation lors du clic sur n'importe quel lien de la barre de navigation
 */

for (let i = 0; i < navbarLinks.length; i++) { navElemArr.push(navbarLinks[i]); }

/**
 * Ajouter un événement sur tous les éléments pour basculer la barre de navigation
 */

for (let i = 0; i < navElemArr.length; i++) {
  navElemArr[i].addEventListener("click", function () {
    elemToggleFunc(navbar);
    elemToggleFunc(overlay);
  });
}



/**
 * État actif de l'en-tête
 */

const header = document.querySelector("[data-header]");

window.addEventListener("scroll", function () {
  window.scrollY >= 400 ? header.classList.add("active")
    : header.classList.remove("active");
});

// Fonction pour ajouter une propriété aux favoris
function ajouterAuxFavoris(idPropriete) {
  // Utiliser AJAX pour envoyer la requête POST au serveur PHP
  var xhr = new XMLHttpRequest();

  // Ouvrir une connexion POST vers le fichier favorie.php
  xhr.open('POST', 'favorie.php', true);

  // Définir l'en-tête de la requête POST
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Fonction appelée à chaque changement d'état de la requête
  xhr.onreadystatechange = function () {
    // Vérifier si la requête est terminée (readyState == 4) et si le statut est OK (status == 200)
    if (xhr.readyState == 4 && xhr.status == 200) {
      //Message après l'ajout aux favoris
      console.log('Propriété ajoutée aux favoris');
    }
  };

  // Envoyer la requête POST avec les données (ajouterAuxFavoris=true&idPropriete={idPropriete})
  xhr.send('ajouterAuxFavoris=true&idPropriete=' + idPropriete);
}