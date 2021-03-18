/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mekalinks`
--
CREATE DATABASE IF NOT EXISTS `mekalinks` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mekalinks`;

-- --------------------------------------------------------

--
-- Structure de la table `etude`
--

DROP TABLE IF EXISTS `etude`;
CREATE TABLE IF NOT EXISTS `etude` (
  `etude_id` int(11) NOT NULL AUTO_INCREMENT,
  `etude_name` varchar(100) NOT NULL,
  `etude_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`etude_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `link`
--

DROP TABLE IF EXISTS `link`;
CREATE TABLE IF NOT EXISTS `link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id_objet_1` int(11) NOT NULL,
  `link_id_objet_2` int(11) NOT NULL,
  `link_id_raccordement` int(11) DEFAULT NULL,
  `link_revision_objet_1` varchar(100) DEFAULT NULL,
  `link_revision_objet_2` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;


--
-- Structure de la table `objet`
--

DROP TABLE IF EXISTS `objet`;
CREATE TABLE IF NOT EXISTS `objet` (
  `obj_id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_no_plan` varchar(100) NOT NULL,
  `obj_code_article` varchar(100) DEFAULT NULL,
  `obj_id_etude` varchar(100) DEFAULT NULL,
  `obj_revision` varchar(100) DEFAULT NULL,
  `obj_designation` varchar(100) DEFAULT NULL,
  `obj_type` int(11) DEFAULT NULL,
  `obj_date_creation` date DEFAULT NULL,
  `obj_author` varchar(100) DEFAULT NULL,
  `obj_img` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`obj_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;


--
-- Structure de la table `raccordement`
--

DROP TABLE IF EXISTS `raccordement`;
CREATE TABLE IF NOT EXISTS `raccordement` (
  `raccordement_id` int(11) NOT NULL AUTO_INCREMENT,
  `raccordement_name` varchar(100) NOT NULL,
  `raccordement_revision` varchar(100) DEFAULT NULL,
  `raccordement_justificatif` varchar(100) DEFAULT NULL,
  `raccordement_id_etude` int(11) NOT NULL,
  `raccordement_author` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`raccordement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
