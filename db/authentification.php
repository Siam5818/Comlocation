<?php
include_once 'connexion.php';

//Inscription client
function inscrir($nom, $prenom, $tel, $email, $pass)
{
    global $connexion;

    $sql = "INSERT INTO `client`(`nomClient`, `prenomClient`, `emailClient`, `telClient`, `motdePassClient`) VALUES (:n, :p, :e, :t, :m)";

    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':n', $nom);
    $stmt->bindParam(':p', $prenom);
    $stmt->bindParam(':e', $email);
    $stmt->bindParam(':t', $tel);
    $stmt->bindParam(':m', $pass);

    $result = $stmt->execute();
    return $result;
}

//Connexion client
function connecter($nomUser, $passUser)
{
    global $connexion;

    $sql = "SELECT * FROM `client` WHERE `nomClient` = :user AND `motdePassClient` = :pass";

    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':user', $nomUser);
    $stmt->bindParam(':pass', $passUser);

    $stmt->execute();

    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur) {
        return $utilisateur;
    } else {
        return false;
    }
}
//Mettre  à jour le profile d'un client
function modifProfil($mat, $nom, $prenom, $email, $tel, $role){
    global $connexion;

    $sql = "UPDATE `client` 
    SET `nomClient` = :nom, `prenomClient` = :prenom, `emailClient` = :email, `telClient` = :tel,`roleClient` = :rol
    WHERE matricule = :matric";

    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':rol', $role);
    $stmt->bindParam(':matric', $mat);

    $result = $stmt->execute();
    return $result;
}
//Mettre à jour de mon profile client
function updateProfile($id, $newNom, $newPrenom, $newEmail, $newTel)
{
    global $connexion;

    $sql = "UPDATE `client` 
    SET `nomClient` = :nom, `prenomClient` = :prenom, `emailClient` = :email, `telClient` = :tel WHERE matricule = :id";

    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':nom', $newNom);
    $stmt->bindParam(':prenom', $newPrenom);
    $stmt->bindParam(':email', $newEmail);
    $stmt->bindParam(':tel', $newTel);
    $stmt->bindParam(':id', $id);

    $result = $stmt->execute();
    return $result;
}

//Ajout d'une Propriete
function ajout($nom, $adresse, $image, $piece, $dimension, $detail, $cout, $equipement, $idTypP, $idBaill, $services)
{
    global $connexion;

    $sql = "INSERT INTO `propriete`(`nomPropriete`, `adressePropriete`, `imagePropriete`, `descriptionPropriete`, `nombrePiece`, `coutPropriete`, `Equipement`, `fk_idTypePropriete`, `fk_idBailleur`, `fk_Service`)
    VALUES (:n, :a, :i, :d, :p, :c, :m, :e, :t, :b, :s)";

    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':n', $nom);
    $stmt->bindParam(':a', $adresse);
    $stmt->bindParam(':i', $image);
    $stmt->bindParam(':d', $detail);
    $stmt->bindParam(':p', $piece);
    $stmt->bindParam(':c', $cout);
    $stmt->bindParam(':m', $dimension);
    $stmt->bindParam(':e', $equipement);
    $stmt->bindParam(':t', $idTypP);
    $stmt->bindParam(':b', $idBaill);
    $stmt->bindParam(':s', $services);

    $result = $stmt->execute();
    return $result;
}
//Modifier une propriete
function modifProp($idPropriete, $nomPropriete, $adressePropriete, $imagePropriete, $nombrePiece, $dimension, $descriptionPropriete, $coutPropriete, $equipement, $typePropriete, $bailleur, $services)
{
    global $connexion;

    $sql = "UPDATE `propriete` 
    SET 
        `nomPropriete`= :nomProp,
        `adressePropriete`= :adresseProp,
        `imagePropriete`= :imageProp,
        `descriptionPropriete`= :descriptionProp,
        `nombrePiece`= :nombrePiece,
        `dimension`= :dimension,
        `coutPropriete`= :coutProp,
        `Equipement`= :equipement,
        `fk_idTypePropriete`= :typeProp,
        `fk_idBailleur`= :bailleur,
        `fk_Service`= :services
    WHERE idPropriete = :idPropriete";

    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':idPropriete', $idPropriete);
    $stmt->bindParam(':nomProp', $nomPropriete);
    $stmt->bindParam(':adresseProp', $adressePropriete);
    $stmt->bindParam(':imageProp', $imagePropriete);
    $stmt->bindParam(':nombrePiece', $nombrePiece);
    $stmt->bindParam(':dimension', $dimension);
    $stmt->bindParam(':descriptionProp', $descriptionPropriete);
    $stmt->bindParam(':coutProp', $coutPropriete);
    $stmt->bindParam(':equipement', $equipement);
    $stmt->bindParam(':typeProp', $typePropriete);
    $stmt->bindParam(':bailleur', $bailleur);
    $stmt->bindParam(':services', $services);

    $result = $stmt->execute();
    var_dump($result);
    return $result;
}

//Soumettre une demande
function demande($nom, $email, $phone, $objet, $detail)
{
    global $connexion;

    $sql = "INSERT INTO `demande`(`nomLocatiare`, `emailLocataire`, `telLocataire`, `ObjetDemande`, `descriptionDemande`)
    VALUES  (:nomLoc, :emailLoc, :phone, :objet, :detail)";

    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':nomLoc', $nom);
    $stmt->bindParam(':emailLoc', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':objet', $objet);
    $stmt->bindParam(':detail', $detail);

    $result = $stmt->execute();
    return $result;
}

//Faire une reservation
function reservation($mat, $idprop, $date, $stat){
    global $connexion;

    $sql = "INSERT INTO `reservation`(`statReservation`, `fk_matricule`, `fk_idPropriete`, `dateSoumission`)
    VALUES (:statR, :matrR, :idPropR, :dateR)";

    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':statR', $stat);
    $stmt->bindParam(':matrR', $mat);
    $stmt->bindParam(':idPropR', $idprop);
    $stmt->bindParam(':dateR', $date);
    $result = $stmt->execute();
    return $result;
}

//Signer un contrat
function signContrat($idRes, $idtypCont, $debut, $fin){
    global $connexion;

    $sql = "INSERT INTO `contrat`(`fk_idReservation`, `fk_idTypeContrat`, `date_debut`, `date_fin`)
    VALUES (:idreservation, :idtypecontrat, :debut, :fin)";

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':idreservation', $idRes);
    $stmt->bindParam(':idtypecontrat', $idtypCont);
    $stmt->bindParam(':debut', $debut);
    $stmt->bindParam(':fin', $fin);
    $result = $stmt->execute();
    return $result;
}
//Mettre à jour l'etat de la reservation soumise
function updateEtatReservation($idR){
    global $connexion;
    $sql = "UPDATE `reservation` SET `etatReservation` = 'Confirmé' WHERE `reservation`.`idReservation` = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id',$idR);
    $result = $stmt->execute();
    return $result;
}