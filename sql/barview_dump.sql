-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.38


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema barview
--

CREATE DATABASE IF NOT EXISTS barview;
USE barview;



--
-- Definition of table `barview`.`bars`
--

DROP TABLE IF EXISTS `barview`.`bars`;
CREATE TABLE  `barview`.`bars` (
  `bar_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  PRIMARY KEY (`bar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barview`.`bars`
--

/*!40000 ALTER TABLE `bars` DISABLE KEYS */;
LOCK TABLES `bars` WRITE;
INSERT INTO `barview`.`bars` VALUES  (1,'Pour Farm','11 Purchase St','New Bedford','MA','02074'),
 (2,'Noon Hill Grill','100 Main St','Medfield','MA','02052'),
 (3,'Brew City','104 Shrewsbury St','Worcester','MA','01605');
UNLOCK TABLES;
/*!40000 ALTER TABLE `bars` ENABLE KEYS */;


--
-- Definition of table `barview`.`bars_users`
--

DROP TABLE IF EXISTS `barview`.`bars_users`;
CREATE TABLE  `barview`.`bars_users` (
  `bar_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Associate bars with user accounts that are for bar owners.';

--
-- Dumping data for table `barview`.`bars_users`
--

/*!40000 ALTER TABLE `bars_users` DISABLE KEYS */;
LOCK TABLES `bars_users` WRITE;
INSERT INTO `barview`.`bars_users` VALUES  (3,'testbar');
UNLOCK TABLES;
/*!40000 ALTER TABLE `bars_users` ENABLE KEYS */;


--
-- Definition of table `barview`.`favorites`
--

DROP TABLE IF EXISTS `barview`.`favorites`;
CREATE TABLE  `barview`.`favorites` (
  `user_id` int(11) NOT NULL,
  `bar_id` int(11) NOT NULL,
  KEY `user_bar_idx` (`user_id`,`bar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barview`.`favorites`
--

/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
LOCK TABLES `favorites` WRITE;
INSERT INTO `barview`.`favorites` VALUES  (668512494,1),
 (668512494,2),
 (668512494,3);
UNLOCK TABLES;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;


--
-- Definition of table `barview`.`users`
--

DROP TABLE IF EXISTS `barview`.`users`;
CREATE TABLE  `barview`.`users` (
  `id` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='The users of the system';

--
-- Dumping data for table `barview`.`users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
LOCK TABLES `users` WRITE;
INSERT INTO `barview`.`users` VALUES  ('dmaclean','dan','user','Dan MacLean','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL),
 ('mmaclean','mike','user','Mike MacLean','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL),
 ('testbar','testbar','bar','Test Bar','2011-01-22 21:11:22','2011-01-22 21:11:22',NULL,NULL);
UNLOCK TABLES;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
