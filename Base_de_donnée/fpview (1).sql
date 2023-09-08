-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 08 sep. 2023 à 06:47
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fpview`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `map_id` int NOT NULL,
  `action` varchar(10) NOT NULL,
  `item_id` int NOT NULL,
  `requis` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`id`, `map_id`, `action`, `item_id`, `requis`, `status`) VALUES
(1, 3, 'use', 1, 1, 0),
(2, 14, 'take', 1, 0, 1),
(3, 12, 'porter', 2, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `map_id` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `path` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status_action` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `map_id`, `path`, `status_action`) VALUES
(3, '1', '01-0', 0),
(4, '2', '01-90', 0),
(5, '3', '01-180', 0),
(6, '4', '01-270', 0),
(7, '5', '11-0', 0),
(8, '6', '11-90', 0),
(9, '7', '11-180', 0),
(10, '8', '11-270', 0),
(11, '9', '10-0', 0),
(12, '10', '10-90', 0),
(13, '11', '10-180', 0),
(14, '12', '10-270', 0),
(15, '13', '12-0', 0),
(16, '14', '12-90', 0),
(17, '15', '12-180', 0),
(18, '16', '12-270', 0),
(19, '14', '12-90-1', 1),
(20, '3', '01-180', 1),
(33, '5', 'avec/11-0', 2),
(32, '4', 'avec/01-270', 2),
(31, '3', 'avec/01-180', 2),
(30, '2', 'avec/01-90', 2),
(29, '1', 'avec/01-0', 2),
(34, '6', 'avec/11-90', 2),
(35, '7', 'avec/11-180', 2),
(36, '8', 'avec/11-270', 2),
(37, '9', 'avec/10-0', 2),
(38, '10', 'avec/11-90', 2),
(39, '11', 'avec/11-180', 2),
(40, '12', 'avec/11-270', 2),
(41, '13', 'avec/12-0', 2),
(42, '14', 'avec/12-90', 2),
(43, '15', 'avec/12-180', 2),
(44, '16', 'avec/12-270', 2);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `description`, `image`) VALUES
(1, 'une clé dorée', 'cle-dore.jpg'),
(2, 'chapeau', '');

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

DROP TABLE IF EXISTS `map`;
CREATE TABLE IF NOT EXISTS `map` (
  `id` int NOT NULL AUTO_INCREMENT,
  `coordx` int NOT NULL,
  `coordy` int NOT NULL,
  `direction` int NOT NULL,
  `status_action` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `map`
--

INSERT INTO `map` (`id`, `coordx`, `coordy`, `direction`, `status_action`) VALUES
(1, 0, 1, 0, 0),
(2, 0, 1, 90, 0),
(3, 0, 1, 180, 1),
(4, 0, 1, 270, 0),
(5, 1, 1, 0, 0),
(6, 1, 1, 90, 0),
(7, 1, 1, 180, 0),
(8, 1, 1, 270, 0),
(9, 1, 0, 0, 0),
(10, 1, 0, 90, 0),
(11, 1, 0, 180, 0),
(12, 1, 0, 270, 2),
(13, 1, 2, 0, 0),
(14, 1, 2, 90, 1),
(15, 1, 2, 180, 0),
(16, 1, 2, 270, 0);

-- --------------------------------------------------------

--
-- Structure de la table `text`
--

DROP TABLE IF EXISTS `text`;
CREATE TABLE IF NOT EXISTS `text` (
  `id` int NOT NULL AUTO_INCREMENT,
  `map_id` int NOT NULL,
  `text` varchar(255) NOT NULL,
  `status_action` int NOT NULL,
  `dossiers` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `text`
--

INSERT INTO `text` (`id`, `map_id`, `text`, `status_action`, `dossiers`) VALUES
(1, 1, 'Je dois trouver une cl� pour sortir d\'ici...', 0, 'default_pic'),
(2, 2, 'Un mur m\'emp�che de passer...', 0, 'default_pic'),
(3, 3, 'Je dois trouver une cl� pour sortir d\'ici...', 0, 'default_pic'),
(7, 9, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta', 0, 'default_pic'),
(6, 4, 'Rien par ici', 0, 'default_pic'),
(11, 14, 'Voici un bien joli vase !', 0, 'default_pic'),
(8, 10, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta', 0, 'default_pic'),
(9, 11, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta', 0, 'default_pic'),
(10, 12, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta', 0, 'default_pic'),
(12, 14, 'Tu r�cup�res le vase et la cl� dor�e qui se trouve � l\'int�rieur !', 1, 'default_pic'),
(13, 3, 'Gagné !!', 1, 'default_pic'),
(14, 1, 'Que s’est-il passé ?! Cette\r\nscène est vraiment étrange.\r\n\r\nJe devrais regarder ça de\r\nplus près.', 0, 'Aurelien'),
(15, 2, 'Mais qu’est-ce que ?!\r\nPourquoi Chambéry et Lyon\r\nont leur anciens nom latin ?\r\n\r\nCette tombe est en fait une\r\nborne kilométrique. Il y a\r\nune sorte d’inscription mais\r\nje ne peux pas la déchiffrer.', 0, 'Aurelien'),
(18, 5, 'Qu’est-il arrivé au\r\nconducteur ?\r\nSont-ils plusieurs ?\r\n\r\nLe choc a dû être violent.\r\nLe brouillard et la pluie est\r\npeut-être la cause de\r\nl’accident.', 0, 'Aurelien'),
(16, 3, 'La route est dangereuse\r\navec ce brouillard.\r\nJe n’ai pas d’autres choix\r\nque d’enquêter sur ce que\r\nj’ai trouvé...', 0, 'Aurelien'),
(17, 4, 'Aucun signal radio, pas de\r\ncontact. Moi, la pluie, et un\r\nCD de Beethoven...Vive\r\nl’ambiance.', 0, 'Aurelien'),
(19, 6, 'Aucune information à\r\npropos de ce portail et il est\r\nouvert...c’est intriguant.', 0, 'Aurelien'),
(20, 7, 'D’habitude sans le\r\nbrouillard,\r\non peut voir de très loin si\r\nquelqu’un arrive.', 0, 'Aurelien'),
(21, 8, 'Tiens. La station est\r\nallumée mais il n’y a\r\npersonne dans les parages.', 0, 'Aurelien'),
(22, 9, 'Une carte postale du\r\nCambodge. Bien sûr je ne\r\nsuis pas capable de la lire\r\npour l’instant.', 0, 'Aurelien'),
(23, 10, 'Ce poteau téléphonique\r\npeut tomber à tout moment,\r\nje devrais faire attention.', 0, 'Aurelien'),
(24, 11, 'Oh! Une souris.\r\n\r\nAu moins elle se régale avec\r\nson bout de fromage...\r\n*gargouillement*', 0, 'Aurelien'),
(25, 12, 'La porte est verrouillée, les\r\nfenêtres aussi et...les vitres\r\nsont biens épaisses.', 0, 'Aurelien'),
(26, 13, 'Avec tout ce bois, il y a de\r\nquoi faire de belles\r\ncharpentes.', 0, 'Aurelien'),
(27, 14, 'Des clés ! Qui peut bien\r\nlaisser ça ?', 0, 'Aurelien'),
(28, 15, '16 en chiffres romains.\r\nUn simple passe-temps ou\r\ncela signifie quelque chose\r\n? D’ailleurs où est la hache ?', 0, 'Aurelien'),
(29, 16, 'L’entrée est en face de la\r\nstation. L’employé doit\r\nprobablement savoir\r\nbeaucoup de chose à\r\npropos de ce bois.', 0, 'Aurelien'),
(30, 14, 'Des traces de pas mènent\r\nvers la forêt sombre.\r\nIl me faudrait une lampe\r\ntorche avant de m’y\r\naventurer.\r\n\r\nJe devrais vérifier l’entrée\r\nde la station essence.', 1, 'Aurelien'),
(31, 3, 'Gagné !!', 1, 'Aurelien'),
(32, 1, 'Bienvenue dans la cuisine ! \r\nC’est parti pour La Chasse au fromage ! ', 0, 'SvetlanaEstelle'),
(33, 2, 'Oh non la porte est trop lourde pour l’ouvrir', 0, 'SvetlanaEstelle'),
(34, 3, 'Ah non, ce n’est pas l’heure du bain, c’est l’heure de manger !', 0, 'SvetlanaEstelle'),
(35, 4, 'Paris, sa tour Eiffel est IMMENSE !!', 0, 'SvetlanaEstelle'),
(36, 5, 'Il y a tout ce qu’il faut pour faire un bon gâteau mais ça manque de fromage…', 0, 'SvetlanaEstelle'),
(37, 6, 'Je ne suis pas loin du fromage, encore un pas et ça sera bon !', 0, 'SvetlanaEstelle'),
(38, 8, 'Oh le joli chapeau ! ', 0, 'SvetlanaEstelle'),
(39, 9, 'Mmmmh, il n’y a rien par ici', 0, 'SvetlanaEstelle'),
(40, 10, 'Ah ! Voilà le fromage !  \r\nAttends moi mon petit camembert je suis bientôt là ! ', 0, 'SvetlanaEstelle'),
(41, 11, 'Mmmmh, il n’y a rien par ici', 0, 'SvetlanaEstelle'),
(42, 12, '[Appuie sur la touche X pour récupérer le chapeau]', 0, 'SvetlanaEstelle'),
(43, 13, 'Mmmmh, il n’y a rien par ici', 0, 'SvetlanaEstelle'),
(44, 14, 'Enfin te voilà ! A table !!!', 0, 'SvetlanaEstelle'),
(45, 15, 'Mmmmh, il n’y a rien par ici', 0, 'SvetlanaEstelle'),
(46, 16, 'Ca a la même couleur que le fromage mais ça n’a pas le même goût…', 0, 'SvetlanaEstelle'),
(47, 2, 'Oh non la porte est trop lourde pour l’ouvrir', 2, 'SvetlanaEstelle'),
(48, 3, 'Ah non, ce n’est pas l’heure du bain, c’est l’heure de manger !', 2, 'SvetlanaEstelle'),
(49, 4, 'Paris, sa tour Eiffel est IMMENSE !!', 2, 'SvetlanaEstelle'),
(50, 5, 'Il y a tout ce qu’il faut pour faire un bon gâteau mais ça manque de fromage…', 2, 'SvetlanaEstelle'),
(51, 6, 'Je ne suis pas loin du fromage, encore un pas et ça sera bon !', 2, 'SvetlanaEstelle'),
(52, 9, 'Mmmmh, il n’y a rien par ici', 2, 'SvetlanaEstelle'),
(53, 10, 'Ah ! Voilà le fromage !  \r\nAttends moi mon petit camembert je suis bientôt là ! ', 2, 'SvetlanaEstelle'),
(54, 11, 'Mmmmh, il n’y a rien par ici', 2, 'SvetlanaEstelle'),
(55, 12, 'Hop ! Me voilà un vrai chef de cuisine', 2, 'SvetlanaEstelle'),
(56, 13, 'Mmmmh, il n’y a rien par ici', 2, 'SvetlanaEstelle'),
(57, 14, 'Enfin te voilà ! A table !!!', 2, 'SvetlanaEstelle'),
(58, 15, 'Mmmmh, il n’y a rien par ici', 2, 'SvetlanaEstelle'),
(59, 16, 'Ca a la même couleur que le fromage mais ça n’a pas le même goût…', 2, 'SvetlanaEstelle');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
