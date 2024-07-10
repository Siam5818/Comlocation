<?php
include_once 'connexion.php';
//var_dump($nameserver);

//selection d'une propriete
function unProp($id)
{
    global $connexion;
    $sql = "SELECT * FROM propriete 
    JOIN bailleur ON propriete.fk_idBailleur = bailleur.idBailleur 
    JOIN typePropriete ON propriete.fk_idTypePropriete = typepropriete.idTypePropriete 
    JOIN services ON propriete.fk_Service = services.numService
    WHERE idPropriete = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
}
function uneClient($id)
{
    global $connexion;
    $sql = "SELECT * FROM `client` WHERE matricule = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
}
function enStocke()
{
    global $connexion;
    $stock = "SELECT * FROM propriete JOIN typepropriete ON propriete.fk_idTypePropriete = typepropriete.idTypePropriete JOIN services ON propriete.fk_Service = services.numService JOIN agent ON propriete.fk_idBailleur = agent.idBailleur ORDER BY propriete.idPropriete ASC";
    $result = $connexion->query($stock)->fetchAll();
    return $result;
}
$proprietes[] = enStocke();
function louer()
{
    global $connexion;
    $rqP = "SELECT * FROM propriete JOIN agent ON propriete.fk_idBailleur = agent.idBailleur JOIN typepropriete ON propriete.fk_idTypePropriete = typepropriete.idTypePropriete JOIN services ON propriete.fk_Service = services.numService WHERE fk_Service = 1";
    $result = $connexion->query($rqP)->fetchAll();
    return $result;
}
$appartement[] = louer();
function vedete()
{
    global $connexion;
    $sql = "SELECT * FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY fk_idTypePropriete ORDER BY RAND()) as row_num FROM propriete) AS ranked JOIN agent ON ranked.fk_idBailleur = agent.idBailleur JOIN services ON services.numService = ranked.fk_Service WHERE ranked.row_num = 1 LIMIT 6";
    $result = $connexion->query($sql)->fetchAll();
    return $result;
}
$vedetes[] = vedete();
function luxe()
{
    global $connexion;
    $sql = "SELECT * FROM propriete JOIN typepropriete ON propriete.fk_idTypePropriete = typepropriete.idTypePropriete JOIN services ON services.numService = propriete.fk_Service JOIN agent ON agent.idBailleur = propriete.fk_idBailleur WHERE typepropriete.idTypePropriete = 6";
    $result = $connexion->query($sql)->fetchAll();
    return $result;
}
$appLuxe[] = luxe();
function aVendre()
{
    global $connexion;
    $vente = "SELECT * FROM propriete JOIN agent ON propriete.fk_idBailleur = agent.idBailleur JOIN typepropriete ON propriete.fk_idTypePropriete = typepropriete.idTypePropriete JOIN services ON propriete.fk_Service = services.numService WHERE fk_Service = 2";
    $result = $connexion->query($vente)->fetchAll();
    return $result;
}
$avendre[] = aVendre();
function listTyProp()
{
    global $connexion;

    $sql = "SELECT * FROM typepropriete";
    $result = $connexion->query($sql)->fetchAll();
    return $result;
}
$tyProps[] = listTyProp();
function listBail()
{
    global $connexion;
    $sql = "SELECT * FROM `agent`";
    $result = $connexion->query($sql)->fetchAll();
    return $result;
}
$bailleurs[] = listBail();
function listClient()
{
    global $connexion;
    $sql = "SELECT * FROM client";
    $result = $connexion->query($sql)->fetchAll();
    return $result;
}
$clients[] = listClient();
function historique($id)
{
    global $connexion;

    $sql = "SELECT * FROM `reservation` 
    JOIN client ON client.matricule = reservation.fk_matricule
    JOIN propriete ON propriete.idPropriete = reservation.fk_idPropriete
    WHERE fk_matricule = ?";

    $stmt = $connexion->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll();
    return $result;
}
function listServices()
{
    global $connexion;

    $sql = "SELECT * FROM `services`";
    $result = $connexion->query($sql)->fetchAll();
    return $result;
}
$services[] = listServices();
function listdemande()
{
    global $connexion;
    $sql = "SELECT * FROM `demande`";
    $result = $connexion->query($sql)->fetchAll();
    return $result;
}
$demande[] = listdemande();
function listContrat()
{
    global $connexion;
    $sql = "SELECT * FROM `contrat`";
    $result = $connexion->query($sql)->fetchAll();
    return $result;
}
$contrat[] = listContrat();
function addfavorie($mat, $id)
{
    global $connexion;

    $rech = "SELECT * FROM `favorie` WHERE fk_idPropriete_favorie = :searchId AND fk_matricul_user = :searchMat";
    $stmt = $connexion->prepare($rech);
    $stmt->bindParam(':searchId', $id);
    $stmt->bindParam(':searchMat', $mat);
    $stmt->execute();


    $result = $stmt->fetchAll();

    if ($result) {
        header("Location: ../propriete.php");
        die();
    }

    $sql = "INSERT INTO `favorie`(`fk_matricul_user`, `fk_idPropriete_favorie`) VALUES (:m, :id)";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':m', $mat);
    $stmt->bindParam(':id', $id);

    $result = $stmt->execute();
    return $result;
}
function delfavorie($id)
{
    global $connexion;

    $sql_last_id = "SELECT MAX(numeroFavorie) AS max_id FROM favorie";
    $stmt_last_id = $connexion->prepare($sql_last_id);
    $stmt_last_id->execute();
    $dernier_id_ligne = $stmt_last_id->fetch();
    $dernier_id = $dernier_id_ligne['max_id'];

    $sql_delete = "DELETE FROM favorie WHERE numeroFavorie = :id";
    $stmt_delete = $connexion->prepare($sql_delete);

    $id_a_supprimer = $id;
    $stmt_delete->bindParam(':id', $id_a_supprimer);

    $stmt_delete->execute();

    if ($dernier_id !== null) {
        $sql_reset = "ALTER TABLE favorie AUTO_INCREMENT = :dernier_id_plus_un";
        $stmt_reset = $connexion->prepare($sql_reset);

        $dernier_id_plus_un = $dernier_id + 1;
        $stmt_reset->bindParam(':dernier_id_plus_un', $dernier_id_plus_un, PDO::PARAM_INT);

        $stmt_reset->execute();
    }

    return true;
}
function mesFavorie($matricule)
{
    global $connexion;

    $sql = "SELECT * FROM favorie
        JOIN client ON favorie.fk_matricul_user = client.matricule
        JOIN propriete ON favorie.fk_idPropriete_favorie = propriete.idPropriete
        WHERE favorie.fk_matricul_user = ?";

    $stmt = $connexion->prepare($sql);
    $stmt->execute([$matricule]);
    $result = $stmt->fetchAll();

    return $result;
}
function typeContrat()
{
    global $connexion;

    $sql = "SELECT * FROM `typecontrat`";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
$typecontrat[] = typeContrat();
function contratSigner($id)
{
    global $connexion;
    $sql = "SELECT * FROM `contrat` WHERE fk_idReservation = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}
function mesContrat()
{
    global $connexion;
    $sql = "SELECT * FROM `contrat`
    JOIN typecontrat ON typecontrat.idTypeContrat = contrat.fk_idTypeContrat
    JOIN reservation ON reservation.idReservation = contrat.fk_idReservation
    JOIN client ON client.matricule = reservation.fk_matricule
    JOIN propriete ON reservation.fk_idPropriete = propriete.idPropriete
    JOIN agent ON agent.idBailleur = propriete.fk_idBailleur
    ORDER BY idContrat ASC";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
$mesContratSigne[] = mesContrat();
function unContrat($id){
    global $connexion;

    $sql = "SELECT * FROM `contrat`
    JOIN typecontrat ON typecontrat.idTypeContrat = contrat.fk_idTypeContrat
    JOIN reservation ON reservation.idReservation = contrat.fk_idReservation
    JOIN propriete ON reservation.fk_idPropriete = propriete.idPropriete
    JOIN client ON client.matricule = reservation.fk_matricule
    WHERE client.matricule = :id
    ORDER BY idContrat ASC";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
function desableClient($id){
    global $connexion;
    $sql = "UPDATE `client` SET `roleClient` = 'desable'
    WHERE `client`.`matricule` = :matric";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam('matric', $id);
    $result = $stmt->execute();
    return $result;
}

function mesReservation(){
    global $connexion;

    $sql = "SELECT * FROM `reservation` 
    JOIN client ON client.matricule = reservation.fk_matricule
    JOIN propriete ON propriete.idPropriete = reservation.fk_idPropriete
    ";

    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
