<?php
ob_start();
//Demarage d'une session
session_start();
//Message d'inscription
if (isset($messageInscription)) {
    echo "<script>";
    echo "alert('" . $messageInscription . "');";
    echo "</script>";
}
//Page de la connexion
include_once 'db/connexion.php';
//Page des requestes sql
include_once 'db/requetes.php';
//Page d'acceuille
include_once 'page/accueil.php';
//Page d'authentification
include_once 'db/authentification.php';

//Inscription d'un client||  Connexion d'un utilisateur|| Ajout d'une Propriete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Inscription d'un utilisateur
    if (isset($_POST['valide'])) {
        if (!empty($_POST['nom'] && !empty($_POST['prenom']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['pass']))) {

            $nom = substr($_POST['nom'], 0, 255);
            $prenom = substr($_POST['prenom'], 0, 255);
            $tel = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            if (strlen($_POST['pass']) < 6 || !preg_match('/[A-Za-z]/', $_POST['pass']) || !preg_match('/\d/', $_POST['pass'])) {
                echo 'Non respect des caracteres du mot de passe!';
            } else {
                $pass = hash('sha256', $_POST['pass']); //hashage avec l'algorithme SHA-256
            }

            $inscriptionResult = inscrir($nom, $prenom, $tel, $email, $pass);
            if ($inscriptionResult) {
                header('Location: index.php');
                $messageInscription = "Félicitations ! Votre inscription sur notre site a été un succès. Vous pouvez maintenant profiter de tous nos services et fonctionnalités. Bienvenue parmi nous ! 🎉🌟";
                //echo '<meta http-equiv="refresh" content="0;url=index.php">';
                exit();
            } else {
                $messageInscription = "Erreur lors de l'inscription. Veuillez réessayer.";
            }
        }
        unset($_POST); //Nettoyer de la methode
        //Connexion d'un utilisateur
    } else if (isset($_POST['valideCon'])) {
        if (!empty($_POST['nomlog']) && !empty($_POST['passlog'])) {

            $nom = $_POST['nomlog'];
            $pass = hash('sha256', $_POST['passlog']);

            $user = connecter($nom, $pass);

            if ($user) {

                $_SESSION['user'] = $user;

                if ($user['roleClient'] == 'admin') {
                    $_SESSION['administrateur'] = $_SESSION['user'];
                    header("Location: Page/admin.php");
                    //echo '<meta http-equiv="refresh" content="0;url=Page/admin.php">';
                } else if ($user['roleClient'] == 'client') {
                    $_SESSION['utilisateur'] = $_SESSION['user'];
                    header("Location: Page/user.php");
                    //echo '<meta http-equiv="refresh" content="0;url=Page/user.php">';
                }
            } else {
                header("Location: error.php");
                //echo '<meta http-equiv="refresh" content="0;url=error.php">';
                exit();
            }
        }
    } else if (isset($_POST['deconnexion'])) {
        session_unset(); // Supprime toutes les variables de session
        session_destroy(); // Destruction de la session

        header("Location: index.php");
        //echo '<meta http-equiv="refresh" content="3;url=index.php">';
        exit();
    } else if (isset($_POST['ajouter'])) {
        if (!empty($_POST['nomProp']) && !empty($_POST['adresseProp']) && !empty($_FILES['imageProp']['name']) && !empty($_POST['nombrePiece']) && !empty($_POST['dimension']) && !empty($_POST['descrProp']) && !empty($_POST['coutProp']) && !empty($_POST['Equipement']) && !empty($_POST['typeProp']) && !empty($_POST['bailleur'])) {
            $nprop = $_POST['nomProp'];
            $adressprop = $_POST['adresseProp'];
            $imgprop = $_FILES['imageProp']['name'];
            $nbprop = $_POST['nombrePiece'];
            $dscprop = $_POST['descrProp'];
            $ctprop = $_POST['coutProp'];
            $dimension = $_POST['dimension'];
            $eqpprop = $_POST['Equipement'];
            $typrop = $_POST['typeProp'];
            $bailprop = $_POST['bailleur'];
            $bailprop = $_POST['service'];

            $propriete = ajout($nprop, $adressprop, $imgprop, $nbprop, $dimension, $dscprop, $ctprop, $eqpprop, $typrop, $bailprop, $service);
            if ($propriete) {
                header("Location: Page/admin/admin.php");
                $messageAjoutPropriete = "Une propriete vient d'être Ajouter!";
                //echo '<meta http-equiv="refresh" content="3;url=Page/admin/admin.php">';
                exit();
            }
        }
        unset($_POST);
    } else if (isset($_POST['modifier'])) {
        if (
            !empty($_POST['idProp']) && !empty($_POST['nomProp']) && !empty($_POST['adresseProp'])
            && !empty($_FILES['imageProp']['name']) && !empty($_POST['nombrePiece'])
            && !empty($_POST['dimension']) && !empty($_POST['descrProp'])
            && !empty($_POST['coutProp']) && !empty($_POST['Equipement'])
            && !empty($_POST['typeProp']) && !empty($_POST['bailleur'])
            && !empty($_POST['services'])
        ) {
            $idPropriete = $_POST['idProp'];
            $nomPropriete = $_POST['nomProp'];
            $adressePropriete = $_POST['adresseProp'];
            $imageProp = $_FILES['imageProp']['name'];
            $nombrePiece = $_POST['nombrePiece'];
            $dimension = $_POST['dimension'];
            $descriptionPropriete = $_POST['descrProp'];
            $coutPropriete = $_POST['coutProp'];
            $equipement = $_POST['Equipement'];
            $typePropriete = $_POST['typeProp'];
            $bailleur = $_POST['bailleur'];
            $services = $_POST['services'];

            $result = modifProp($idPropriete, $nomPropriete, $adressePropriete, $imageProp, $nombrePiece, $dimension, $descriptionPropriete, $coutPropriete, $equipement, $typePropriete, $bailleur, $services);

            if ($result) {
                header("Location: Page/admin/modifProp.php");
                //echo '<meta http-equiv="refresh" content="0;url=Page/admin/modifProp.php">';
            } else {
                header("Location: Page/admin/modifProp.php?id=" . $_GET['id']);
                //echo '<meta http-equiv="refresh" content="3;url=error.php">';
                exit();
            }
        }
    } else if (isset($_POST['demander'])) {
        if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['objet']) && !empty($_POST['description'])) {
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $objet = $_POST['objet'];
            $detail = $_POST['description'];

            $mondemande = demande($nom, $email, $phone, $objet, $detail);
            if ($mondemande) {
                header("Location: Page/user/user.php");
                //echo '<meta http-equiv="refresh" content="0;url=Page/user/user.php">';
            } else {
                header("Location: error.php");
                //echo '<meta http-equiv="refresh" content="1;url=error.php">';
            }
        }
    } else if (isset($_POST['sauvegarder'])) {
        if (
            !empty($_POST['matricule']) && !empty($_POST['newNom']) && !empty($_POST['newPrenom'])
            && !empty($_POST['newEmail']) && !empty($_POST['newTel'])
        ) {
            $id = $_POST['matricule'];
            $nom = $_POST['newNom'];
            $prenom = $_POST['newPrenom'];
            $email = $_POST['newEmail'];
            $tel = $_POST['newTel'];

            $profil = updateProfile($id, $nom, $prenom, $email, $tel);
            if ($profil) {
                header("Location: index.php");
                //echo '<meta http-equiv="refresh" content="0;url=index.php">';
                exit();
            } else {
                header("Location: error.php");
                //echo '<meta http-equiv="refresh" content="0;url=error.php">';
                exit();
            }
        }
    } else if (isset($_POST['reserver'])) {
        if (!empty($_POST['matricule']) && !empty($_POST['idProp']) && !empty($_POST['Dreservation']) && !empty($_POST['stat'])) {

            $mat = $_POST['matricule'];
            $idpro = $_POST['idProp'];
            $date = $_POST['Dreservation'];
            $stat = $_POST['stat'];

            $reservation = reservation($mat, $idpro, $date, $stat);
            if ($reservation) {
                header("Location: Page/user.php");
                //echo '<meta http-equiv="refresh" content="0;url=Page/user.php">';
                exit();
            } else {
                header("Location: error.php");
                //echo '<meta http-equiv="refresh" content="3;url=error.php">';
                exit();
            }
        }
    } else if (isset($_POST['signer'])) {
        if (!empty($_POST['idReservation']) && !empty($_POST['idTypCont']) && !empty($_POST['debutContrat']) && !empty($_POST['finContrat'])) {

            $idR = $_POST['idReservation'];
            $idT = $_POST['idTypCont'];
            $debut = $_POST['debutContrat'];
            $fin = $_POST['finContrat'];
            $signature = signContrat($idR, $idT, $debut, $fin);
            if ($signature && updateEtatReservation($idR)) {
                header("Location: Page/admin.php");
                //echo '<meta http-equiv="refresh" content="1;url=Page/admin.php">';
                exit();
            } else {
                header("Location: error.php");
                //echo '<meta http-equiv="refresh" content="1;url=error.php">';
                exit();
            }
        }
    } else if (isset($_POST['enregisrer'])) {
        if (!empty($_POST['matricule']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['tel']) && !empty($_POST['role'])) {
            $mat = $_POST['matricule'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $role = $_POST['role'];

            $misAj = modifProfil($mat, $nom, $prenom, $email, $tel, $role);
            if ($misAj) {
                header("Location: Page/admin.php");
                //echo '<meta http-equiv="refresh" content="1;url=Page/admin.php">';
                exit();
            } else {
                header("Location: error.php");
                //echo '<meta http-equiv="refresh" content="1;url=error.php">';
                exit();
            }
        }
    }
}