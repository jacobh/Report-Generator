# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.5.9-log)
# Database: report_generator
# Generation Time: 2011-06-30 23:20:17 +1000
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table report
# ------------------------------------------------------------

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `contents` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` (`id`,`created_at`,`updated_at`,`street_address`,`city`,`postcode`,`client_name`,`contents`)
VALUES
	(1,13015140,1309431459,'36 Iveston Road','Lynwood','','John Citizen','2,4,5,7'),
	(2,1306855000,1307015000,'45 Pinetree Gully Road','Willetton','','Jane Doe','');

/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table report_contents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `report_contents`;

CREATE TABLE `report_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

LOCK TABLES `report_contents` WRITE;
/*!40000 ALTER TABLE `report_contents` DISABLE KEYS */;
INSERT INTO `report_contents` (`id`,`report_id`,`type`,`data`)
VALUES
	(16,1,2,'{\"introduction_opening_paragraph\":\"1\",\"introduction_about_the_survey\":\"2\",\"introduction_methodology\":\"3\",\"introduction_the_report\":\"4\",\"introduction_findings_recomendations\":\"5\"}'),
	(18,1,4,'{\"damp_inspec_opening_paragraph\":\"A visual inspection of the exterior of the property was undertaken to identify any obvious defects which could be a contributory factor to any areas requiring specific attention as detailed in the client\'s instructions, such as faulty rainwater goods, broken\\/missing roof tiles, cracked brickwork or rendering or high exterior ground levels.\\r\\n\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"damp_inspec_external_observations\":\"hi there\",\"damp_inspec_moisture_infobox\":\"Moisture profiles are the most effective non destructive method of establishing the cause of dampness in buildings, electrical resistance of the materials are measured using a conductivity meter, along with sub surface measurements, the results are recorded on a chart and the patterns analysed, and along with any other significant findings a diagnosis is reached, when the results are inconclusive we will recommend further tests, the most common being salt analysis.\\r\\n\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"damp_inspec_internal_observations\":\"\"}'),
	(19,1,5,'{\"conden_rep_opening_information\":\"opening infobox\",\"conden_rep_relative_humidity_readings_information\":\"relative umidity readings information\",\"conden_rows\":[{\"name\":\"1\",\"temp\":\"2\",\"humidity\":\"3\",\"dew_point\":\"4\"},{\"name\":\"a\",\"temp\":\"b\",\"humidity\":\"c\",\"dew_point\":\"d\"}],\"conden_rep_conclusion\":\"conclushin\"}'),
	(20,1,7,'{\"timber_surv_observations\":[{\"type\":\"hi there\",\"description\":\"sup\"},{\"type\":\"lmfao\",\"description\":\"what of it\"}]}');

/*!40000 ALTER TABLE `report_contents` ENABLE KEYS */;
UNLOCK TABLES;





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
