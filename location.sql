-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 juil. 2024 à 11:15
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `location`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `idBailleur` int(3) NOT NULL,
  `nomBailleur` varchar(20) NOT NULL,
  `telBailleur` tinytext NOT NULL,
  `emailBailleur` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`idBailleur`, `nomBailleur`, `telBailleur`, `emailBailleur`) VALUES
(1, 'Anzize Mohamed', '002693338814', 'anzizeMohamed05@gmail.com'),
(2, 'Soifoine Isamel', '0033610934100', 'ismaelSoif@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `matricule` int(3) NOT NULL,
  `nomClient` varchar(20) NOT NULL,
  `prenomClient` varchar(20) NOT NULL,
  `emailClient` varchar(30) NOT NULL,
  `telClient` varchar(15) NOT NULL,
  `motdePassClient` tinytext NOT NULL,
  `dateInscription` date DEFAULT curdate(),
  `roleClient` enum('admin','client','desable') DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`matricule`, `nomClient`, `prenomClient`, `emailClient`, `telClient`, `motdePassClient`, `dateInscription`, `roleClient`) VALUES
(1, 'Sihamoudine', 'Mohamed Anzize', 'sihamoudineanzize@gmail.com', '00221783800668', '62a1a5600217bfc84fa5ac26faf898b366581f3b1512624444654b795b108a92', '2024-01-02', 'admin'),
(2, 'Nazra', 'Nadher', 'nazraNadher05@gmail.com', '00221783800668', '62a1a5600217bfc84fa5ac26faf898b366581f3b1512624444654b795b108a92', '2024-01-02', 'client'),
(3, 'Louna', 'Elie Yaffa', 'lounaEYaffa00@gmail.com', '00221774320875', '62a1a5600217bfc84fa5ac26faf898b366581f3b1512624444654b795b108a92', '2024-01-02', 'client'),
(4, 'Fadel', 'Zaher Alyane', 'fadelzaher@gmail.fr', '00221765347887', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', '2024-01-02', 'desable'),
(5, 'abdoulaye', 'diallo', 'abdouyediallo@gmail.com', '00241049749650', '62a1a5600217bfc84fa5ac26faf898b366581f3b1512624444654b795b108a92', '2024-01-29', 'client'),
(6, 'Anfiati', 'Djambae Ali', 'anfiatyDjambae00@gmail.com', '00861555797756', '62a1a5600217bfc84fa5ac26faf898b366581f3b1512624444654b795b108a92', '2024-01-29', 'client'),
(7, 'Demba', 'Tchoye', 'dembatchoye@gmail.com', '0021774229307', '62a1a5600217bfc84fa5ac26faf898b366581f3b1512624444654b795b108a92', '2024-01-29', 'client'),
(8, 'Aicha', 'Matchika', 'chaitou@gmail.com', '00221771487970', '62a1a5600217bfc84fa5ac26faf898b366581f3b1512624444654b795b108a92', '2024-01-29', 'client'),
(9, 'Rabouanta', 'Said Mbae', 'RabouantS@gmail.fr', '002693546377', '62a1a5600217bfc84fa5ac26faf898b366581f3b1512624444654b795b108a92', '2024-02-13', 'client'),
(10, 'Kounta', 'Astou', 'astouK05@gmail.com', '00221783059806', '62a1a5600217bfc84fa5ac26faf898b366581f3b1512624444654b795b108a92', '2024-02-13', 'client');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `idContrat` int(3) NOT NULL,
  `fk_idReservation` int(3) NOT NULL,
  `fk_idTypeContrat` int(3) NOT NULL,
  `date_debut` date DEFAULT curdate(),
  `date_fin` date DEFAULT NULL,
  `duree` int(11) GENERATED ALWAYS AS (to_days(`date_fin`) - to_days(`date_debut`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contrat`
--

INSERT INTO `contrat` (`idContrat`, `fk_idReservation`, `fk_idTypeContrat`, `date_debut`, `date_fin`) VALUES
(1, 2, 1, '2024-02-08', '2026-01-31'),
(2, 3, 1, '2024-02-12', '2026-01-28'),
(3, 4, 1, '2024-03-01', '2024-06-30');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `idDemande` int(3) NOT NULL,
  `nomLocatiare` varchar(20) NOT NULL,
  `emailLocataire` varchar(30) NOT NULL,
  `telLocataire` text NOT NULL,
  `ObjetDemande` text NOT NULL,
  `descriptionDemande` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`idDemande`, `nomLocatiare`, `emailLocataire`, `telLocataire`, `ObjetDemande`, `descriptionDemande`) VALUES
(1, 'Lionel Andres Messi', 'lionel10messi@gmail.com', '+1306788923', 'Location d\'un appartement', 'Une appartement confortable, de 4 chambres, prés de la mer.'),
(2, 'Rabouanta Said Mbae', 'RabouantS@gmail.fr', '783993993', 'Acheter une Maison', 'Une Maison de 3 chambres, 2 salles de bains, cuisine moderne, espace extérieur souhaité. Emplacement idéal dans la cornich de Dakar avec budget d\'environ 400 000 €.');

-- --------------------------------------------------------

--
-- Structure de la table `favorie`
--

CREATE TABLE `favorie` (
  `numeroFavorie` int(3) NOT NULL,
  `fk_matricul_user` int(3) DEFAULT NULL,
  `fk_idPropriete_favorie` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favorie`
--

INSERT INTO `favorie` (`numeroFavorie`, `fk_matricul_user`, `fk_idPropriete_favorie`) VALUES
(1, 3, 49),
(2, 3, 51),
(3, 5, 49),
(4, 2, 50),
(5, 5, 51),
(6, 10, 38),
(7, 10, 1),
(8, 5, 11),
(9, 5, 50);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `idNote` int(3) NOT NULL,
  `dateNote` date DEFAULT curdate(),
  `description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `propriete`
--

CREATE TABLE `propriete` (
  `idPropriete` int(3) NOT NULL,
  `nomPropriete` varchar(30) NOT NULL,
  `adressePropriete` varchar(20) NOT NULL,
  `imagePropriete` varchar(100) NOT NULL,
  `descriptionPropriete` text NOT NULL,
  `nombrePiece` int(3) NOT NULL,
  `dimension` int(6) NOT NULL,
  `coutPropriete` int(4) NOT NULL,
  `Equipement` text NOT NULL,
  `fk_idTypePropriete` int(3) DEFAULT NULL,
  `fk_idBailleur` int(3) DEFAULT NULL,
  `fk_Service` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `propriete`
--

INSERT INTO `propriete` (`idPropriete`, `nomPropriete`, `adressePropriete`, `imagePropriete`, `descriptionPropriete`, `nombrePiece`, `dimension`, `coutPropriete`, `Equipement`, `fk_idTypePropriete`, `fk_idBailleur`, `fk_Service`) VALUES
(1, 'Charme Historique', 'Dakar, Parcelles Ass', 'Le Charme Historique.png', 'Batiment avec des motifs artistique', 3, 60, 1380000, '', 1, 1, 2),
(2, 'Appartement Aquatique', 'Dakar, Corniche', 'Appartement Aquatique.png', 'Une appartement situe près de la mer avec une vue epoustouflant de l\'ocean', 4, 60, 1755000, '', 1, 1, 2),
(3, 'Penthouse Art Déco', 'Dakar, Medina rue 29', 'Le Penthouse Art Déco.png', 'Un appartement luxueux avec des influences Art Deco, un mélange de glamour rétro et de sophistication moderne', 3, 60, 3600, '', 1, 1, 3),
(4, 'Loft Cycladique', 'Thiès, Quartier Médi', 'Loft Cycladique.png', 'Une esccapade estivale quotidien, Loft inspirer de l\'architecture dakaroise', 1, 80, 1820000, '', 5, 1, 3),
(5, 'Duplex Jardin Vertical', 'Saint-Louis, Quartie', 'Duplex Jardin Vertical.png', 'Un duplex avec des murs végétaux intérieurs, des cascades d\'eau, et un jardin vertical intégré', 2, 60, 2800, 'Des panneaux solaires,  des systèmes de récupération d\'eau de pluie, systèmes pour le confort thermique.', 5, 2, 3),
(6, 'Loft Urbain Raffiné', 'Dakar, Veden', 'Le Loft Urbain Raffiné.png', ' Un loft spacieux raffinés des sols en marbre, des lustres imposants et élégants. Idéal pour ceux qui aiment recevoir avec style.', 4, 15, 1000, 'Des caméras de surveillance, des systèmes d\'alarme, des serrures intelligentes, Connexion Internet haut débit', 1, 2, 1),
(7, 'Suite Enchantée', 'Kaolack, Quartier Nd', 'La Suite Enchantée.png', 'Une maison confortable pour la famille, avec des design enorme renové recement', 4, 60, 3500, '', 1, 1, 3),
(8, 'Studio Éco-Artistique', 'Dakar, Medina rue 6', 'Studio ecoArtistique.png', 'Un refuge de sérénité en pleine ville...', 1, 25, 21000, '', 5, 1, 3),
(9, 'Nid d\'Artiste Industriel', 'Dakar, Zinguinchor', 'Nid Artiste Industriel.png', ' Une art industriel, des toiles et sculptures d\'artistes locaux.', 3, 60, 14000, '', 1, 1, 3),
(10, 'Maison confortable', 'Dakar, Liberte 6', 'Maison confortable.png', 'Une maison confortable calme avec une comodité remarquable', 2, 20, 200, 'Des nouvelles outils electriques', 5, 2, 1),
(11, 'Maison Lumière Naturelle', 'Ziguinchor, Cité Ali', 'Maison Lumière Naturelle.png', 'Une maison famillliale clôturer spacieux', 5, 15, 1000, '', 1, 2, 1),
(12, 'Résidence Panoramique', 'Dakar, Medina, Corni', 'La Résidence Panoramique.png', ' Un appartement en hauteur offrant une vue à 360 degrés sur la skyline de Dakar. Des terrasses spacieuses permettent de profiter du lever et du coucher du soleil.', 7, 18, 1200, '', 1, 2, 1),
(13, 'Appartement Vintage', 'Dakar, Wakam Memouze', 'Appartement Vintage.png', ' Un espace rétro avec des meubles des années 90, offrant une ambiance nostalgique est parfaite pour les amateurs de design rétro.', 4, 18, 1378, '', 1, 2, 1),
(14, 'Penthouse Ciel Étoilé', 'Dakar, Grd Dakar', 'Le Penthouse Ciel Étoilé.png', ' Un somptueux penthouse avec un toit en verre rétractable, offrant une vue imprenable sur le ciel étoilé la nuit.', 2, 30, 800, '', 5, 2, 1),
(15, 'Maison Bohème', 'Dakar, Corniche', 'Maison Bohème.png', 'Maison artistique, confortable et moderne avec une piscine.', 4, 15, 950, '', 1, 2, 1),
(16, 'Suite Nomade', 'Dakar, Sandaga', 'La Suite Nomade.png', 'Une comodité incroyable pour les passant.', 2, 27, 600, '', 5, 2, 1),
(17, 'Suite Sérénité Urbaine', 'Saint-Louis, Allée d', 'La Suite Sérénité Urbaine.png', 'Une maison moderne retro, adapter au fête...', 3, 15, 700, '', 1, 2, 1),
(18, 'Suite Éco-Moderne', 'Dakar, Vdene', 'La Suite Éco-Moderne.png', 'Pour la famille on choisi la comodité le calme et la plus amusant.', 5, 15, 600, '', 1, 2, 1),
(19, 'Résidence Feng Shui', 'Dakar, Fass', 'La Résidence Feng Shui.png', 'Un appartement harmonieusement, avec des couleurs apaisantes, des éléments en bois, et un équilibre énergétique parfait.', 2, 18, 700, '', 5, 2, 1),
(20, 'Sanctuaire Techno', 'Dakar, HLM 6', 'Le Sanctuaire Techno.png', ' Un appartement ultramoderne équipé des dernières avancées technologiques, Un paradis pour les passionnés de haute technologie.', 3, 18, 1500, '', 1, 2, 1),
(21, 'Oasis Boho-Chic', 'Dakar, Bene Tally', 'Oasis Boho-Chic.png', ' Un espace bohème-chic avec des couleurs vibrantes, des tapis kilim. Une invitation à la détente et à la créativité.', 3, 15, 780, '', 1, 2, 1),
(22, 'Résidence Virtuelle', 'Dakar, Plateau', 'Résidence Virtuelle.png', 'Un appartement offrrant des realités virtuelle integrés, permetant aux habitants de personnaliser leur environement selon leurs fantasmes.', 4, 37, 19500, '', 1, 1, 3),
(23, 'Résidence Maritime', 'Dakar, Fann hock', 'La Résidence Maritime.png', 'Un loft inspiré du style nautique, avec des hublots décoratifs et des éléments rappelant l\'océan. Parfait pour ceux qui rêvent d\'une vie en bord de mer.', 6, 60, 1725000, '', 1, 1, 2),
(24, 'Appartement Tropical', 'Dakar, Phare des  Ma', 'Appartement Tropical.png', 'Un espace tropical avec des couleurs vives, des motifs floraux, et des touches d\'exotisme. Des plantes luxuriantes créent une atmosphère de vacances perpétuelles.', 6, 18, 1200, '', 1, 2, 1),
(25, 'Refuge Artistique', 'Dakar, Yoff', 'Le Refuge Artistique.png', 'Un appartement sanctuaire pour les artistes avec des éclairages ajustables pour mettre en valeur les œuvres d\'art.', 7, 18, 1600, '', 1, 2, 1),
(26, 'Loft Industriel Moderne', 'Dakar, Zone achaland', 'Le Loft Industriel Moderne.png', ' Un loft fusionnant le style industriel avec une esthétique moderne, des poutres métalliques apparentes, des sols en béton poli et des touches de mobilier contemporain.', 5, 15, 800, '', 1, 2, 1),
(27, 'Luxe lumineux', 'Dakar, Guédawaye', 'Luxe lumineux.png', 'Luxe Lumineux offre des intérieurs baignés de lumière, spacieux et des vues panoramiques captivantes.', 8, 32, 2000, '', 6, 2, 1),
(28, 'Appartement oasis dore', 'Dakar, Pikin', 'appartement oasis dore.png', 'Appartement accueillant dans un sanctuaire de confort et de splendeur.', 4, 36, 1600, '', 6, 2, 1),
(29, 'Residence oppulence', 'Dakar, Rufisque', 'Residence oppulence.png', 'Residence incarnant l\'opulence et le prestige. Une adresse exclusive pour les connaisseurs du luxe', 5, 37, 1200, '', 6, 2, 1),
(30, 'Splendeur urbain', 'Dakar, Grand Yoff', 'splendeur urbain.png', 'Vivez une vie sophistiquée avec des vues à couper le souffle, des espaces modernes et une proximité incomparable aux commodités de la ville.', 6, 60, 2000, 'Des piscines modernisées, Cuisine équipée, Connexion Internet haut débit, Salle de bains moderne, Domotique', 6, 2, 1),
(31, 'joyeux du centre ville', 'Dakar, Grand yoff', 'joyeux du centre ville.png', 'Découvrez le luxe dans un cadre vibrant, entouré de boutiques, de restaurants et de divertissements.', 5, 30, 1700, '', 6, 2, 1),
(32, 'Cottage Rustique', 'Dakar, Medina, rue 6', 'Cottage Rustique en Bord de Mer.png', 'Une batiment commerciale avec design administratif et confortant.', 2, 120, 1350000, '', 2, 1, 3),
(33, 'Bureaux commercial', 'Dakar, Mermoz', 'Bureaux commercial.png', 'Centre commerciale repartie par des secteurs a occuper.', 3, 112, 1120000, '', 2, 1, 3),
(34, 'Installations de traitement', 'Dakar, sandaga', 'Installations de traitement.png', 'Une batiment de traitement pour les affaires et des foires.', 1, 20, 90000, '', 2, 1, 3),
(35, 'Centre de conférence', 'Dakar, Medina', 'Centre de conférence.png', 'Une batiment doter des nouveaux technologie pour vos conferences et vos grand evenements.', 6, 40, 89000, '', 2, 1, 3),
(36, 'Cabines forestières', 'Dakar, Gore', 'Cabines forestières.png', 'Une cabine pour vos moments chaleureux et vos vacances de luxes.', 1, 30, 6250, '', 5, 1, 3),
(37, 'Cabanes au bord du lac', 'Thies, stations', 'Cabanes au bord du lac.png', 'Une cabane technologique pour des moments inoubliable avec votre moitier.', 2, 12, 5200, '', 5, 1, 3),
(38, 'Caravane d\'été', 'Dakar, Pikin', 'Caravane.png', 'Une caravane moderne equiper des meilleures equipements auto-technologique pour les voyages d\'été.', 2, 7, 1800, '', 2, 2, 1),
(39, 'Entrepot de production', 'Dakar, sacre-coeur', 'Usines de production.png', 'Une entrepot poour vos activités ainsi pour offrir d\'espace à vos eentreprise de production pour assurer une grande quantite de production.', 1, 90, 2400000, '', 3, 1, 3),
(40, 'Centres de distribution', 'Dakar, Fass', 'Centres de distribution.png', 'Expédier des produits a vos clientsm, pour faciliter la réception et le stockage rapide des marchandises.', 1, 90, 730000, '', 3, 1, 3),
(41, 'Entrepot logistique', 'Dakar, Wakham', 'Entrepot logistique.png', 'Un entrepot spacieux pour le stockage de vos produits avec des chariots elevateurs ainsi que les equipements necessaires des mutations en disposition.', 1, 90, 789000, '', 3, 1, 3),
(42, 'Gite rurale', 'Ngor', 'Gite rurale.png', 'Une clame absolut dans une maison modeliser avec l\'introduction des technologie en pointe.', 4, 60, 2280000, '', 1, 1, 2),
(43, 'Maison contemporaine', 'Dakar, Fann', 'Maison contemporaine.png', 'Une maison renover recent avec des materiaux artistique et des design a ne pas rater.', 3, 54, 10200, '', 5, 1, 3),
(44, 'Maison Ecologique - Jardin ', 'Dakar, Place de la r', 'Maison Ecologique avec Jardin Vert.png', 'Une Model unique avec des jardin vert ecologique...', 5, 60, 1520000, '', 1, 1, 2),
(45, 'Maison Intelligente', 'Dakar, Medina', 'Maison Intelligente.png', 'Equiper de tous nouveaux technologie configurable au goût et au besoins du personnel.', 5, 30, 678000, '', 6, 1, 3),
(46, 'Maisons de campagne', 'Parcelles d\'Assenies', 'Maisons de campagne.png', 'Une maison architeecturale avec des design interne incontournable se distinguant du clame qu\'elle aporte au peuples vivant sous sont toît.', 4, 40, 78100, '', 5, 1, 3),
(47, 'Maisons de plage', 'Dakar, Ngor', 'Maisons de plage.png', 'Maison moderne de la plage avec ses piscines unique conçu avec des technologie en pointe splendide, une vue de l\'ocean ephoustouflante.', 6, 115, 17980000, '', 5, 1, 3),
(48, 'Propriete Equestre - Ranch', 'Dakar, Dieupeul-Derk', 'Propriete Equestre avec Ranch.png', 'Une appartement spacieux avec des design moderne doter des piscines hors paire, une confortabilité desirable.', 5, 110, 12978000, '', 6, 1, 3),
(49, 'TechLogiCenter', 'Dakar, Mermoz', 'TechLogiCenter.png', 'TechLogiCenter est un centre logistique high-tech doté de systèmes automatisés de pointe.  Il assure une gestion efficace des stocks, un traitement des commandes rapide et une visibilité en temps réel sur l\'inventaire. ', 1, 175, 10000, 'Chariots élévateurs,', 2, 1, 1),
(50, 'LogiFroid Distrib Center', 'Dakar, HLM6', 'LogiFroid Distribution Center.png', 'Le LogiFroid Distribution Center est un entrepôt spécialisé dans le stockage et la distribution de produits alimentaires. Situé stratégiquement dans une zone logistique centrale, cet entrepôt moderne et technologiquement avancé répond aux normes l', 38, 98, 8000, 'Des chambres Froides', 2, 1, 1),
(51, 'Cuisine Industrielle', 'Dakar, Medina 6', 'cuisineIndustrielle.png', 'Cette cuisine industrielle présente des surfaces en acier inoxydable, des appareils électroménagers de qualité professionnelle et un éclairage suspendu au style industriel', 12, 90, 3000, 'Four industriel, Fri', 3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idReservation` int(3) NOT NULL,
  `statReservation` varchar(12) DEFAULT NULL,
  `fk_matricule` int(3) NOT NULL,
  `fk_idNote` int(3) DEFAULT NULL,
  `fk_idPropriete` int(3) NOT NULL,
  `dateSoumission` date DEFAULT curdate(),
  `etatReservation` enum('En etude','Confirmé') DEFAULT 'En etude'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`idReservation`, `statReservation`, `fk_matricule`, `fk_idNote`, `fk_idPropriete`, `dateSoumission`, `etatReservation`) VALUES
(1, 'Louer', 6, NULL, 50, '2024-02-09', 'En etude'),
(2, 'Louer', 6, NULL, 20, '2024-02-09', 'Confirmé'),
(3, 'Louer', 5, NULL, 49, '2024-02-15', 'Confirmé'),
(4, 'Louer', 5, NULL, 51, '2024-02-17', 'Confirmé');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `numService` int(3) NOT NULL,
  `nomService` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`numService`, `nomService`) VALUES
(1, 'Louer'),
(2, 'Acheter'),
(3, 'Investisser');

-- --------------------------------------------------------

--
-- Structure de la table `typecontrat`
--

CREATE TABLE `typecontrat` (
  `idTypeContrat` int(3) NOT NULL,
  `nomTypeContrat` text NOT NULL,
  `detailleTypeContrat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `typecontrat`
--

INSERT INTO `typecontrat` (`idTypeContrat`, `nomTypeContrat`, `detailleTypeContrat`) VALUES
(1, 'Bail Résidentiel', 'Location d\'une résidence'),
(2, 'Bail Commercial', 'Location d\'un espace commercial'),
(3, 'Location Saisonnière', 'Location pour des périodes spécifiques de l\'année'),
(4, 'Location de Vacance', 'Contrat de location pour des vacances');

-- --------------------------------------------------------

--
-- Structure de la table `typepropriete`
--

CREATE TABLE `typepropriete` (
  `idTypePropriete` int(3) NOT NULL,
  `nomTypePropriete` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `typepropriete`
--

INSERT INTO `typepropriete` (`idTypePropriete`, `nomTypePropriete`) VALUES
(1, 'Résidentiel'),
(2, 'Commercial'),
(3, 'Industriel'),
(4, 'Terrain'),
(5, 'Location saisonnière'),
(6, 'Luxueux');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`idBailleur`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`matricule`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`idContrat`),
  ADD KEY `fk_idTypeContrat` (`fk_idTypeContrat`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`idDemande`);

--
-- Index pour la table `favorie`
--
ALTER TABLE `favorie`
  ADD PRIMARY KEY (`numeroFavorie`),
  ADD KEY `fk_matricule_user` (`fk_matricul_user`),
  ADD KEY `fk_idPropriete_favorie` (`fk_idPropriete_favorie`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`idNote`);

--
-- Index pour la table `propriete`
--
ALTER TABLE `propriete`
  ADD PRIMARY KEY (`idPropriete`),
  ADD KEY `fk_idTypePropriete` (`fk_idTypePropriete`),
  ADD KEY `fk_idBailleur` (`fk_idBailleur`),
  ADD KEY `fk_Service` (`fk_Service`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idReservation`),
  ADD KEY `fk_idPropriete` (`fk_idPropriete`),
  ADD KEY `fk_idNote` (`fk_idNote`),
  ADD KEY `fk_matricule` (`fk_matricule`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`numService`);

--
-- Index pour la table `typecontrat`
--
ALTER TABLE `typecontrat`
  ADD PRIMARY KEY (`idTypeContrat`);

--
-- Index pour la table `typepropriete`
--
ALTER TABLE `typepropriete`
  ADD PRIMARY KEY (`idTypePropriete`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `idBailleur` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `matricule` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `idContrat` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `idDemande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `favorie`
--
ALTER TABLE `favorie`
  MODIFY `numeroFavorie` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `idNote` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `propriete`
--
ALTER TABLE `propriete`
  MODIFY `idPropriete` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idReservation` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `numService` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `typecontrat`
--
ALTER TABLE `typecontrat`
  MODIFY `idTypeContrat` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `typepropriete`
--
ALTER TABLE `typepropriete`
  MODIFY `idTypePropriete` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `fk_idTypeContrat` FOREIGN KEY (`fk_idTypeContrat`) REFERENCES `typecontrat` (`idTypeContrat`);

--
-- Contraintes pour la table `favorie`
--
ALTER TABLE `favorie`
  ADD CONSTRAINT `fk_idPropriete_favorie` FOREIGN KEY (`fk_idPropriete_favorie`) REFERENCES `propriete` (`idPropriete`),
  ADD CONSTRAINT `fk_matricule_user` FOREIGN KEY (`fk_matricul_user`) REFERENCES `client` (`matricule`);

--
-- Contraintes pour la table `propriete`
--
ALTER TABLE `propriete`
  ADD CONSTRAINT `fk_Service` FOREIGN KEY (`fk_Service`) REFERENCES `services` (`numService`),
  ADD CONSTRAINT `fk_idBailleur` FOREIGN KEY (`fk_idBailleur`) REFERENCES `agent` (`idBailleur`),
  ADD CONSTRAINT `fk_idTypePropriete` FOREIGN KEY (`fk_idTypePropriete`) REFERENCES `typepropriete` (`idTypePropriete`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_idNote` FOREIGN KEY (`fk_idNote`) REFERENCES `note` (`idNote`),
  ADD CONSTRAINT `fk_matricule` FOREIGN KEY (`fk_matricule`) REFERENCES `client` (`matricule`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
