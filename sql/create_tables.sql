CREATE TABLE `barview`.`bars_users` (
  `bar_id` INT NOT NULL,
  `user_id` varchar(20) NOT NULL
)
CHARACTER SET utf8
COMMENT = 'Associate bars with user accounts that are for bar owners.';




/*CREATE TABLE `barview`.`bar_images` (
	`bar_id` INT NOT NULL,
	`image` BLOB,
	`last_updated` DATETIME
)
CHARACTER SET utf8
COMMENT = 'Records the most recent broadcast image from each bar.';*/


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8
COMMENT='Contains data about each bar registered with Barview.';


--
-- Definition of table `barview`.`bars_users`
--

DROP TABLE IF EXISTS `barview`.`bars_users`;
CREATE TABLE  `barview`.`bars_users` (
  `bar_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Associate bars with user accounts that are for bar owners.';


--
-- Definition of table `barview`.`favorites`
--

DROP TABLE IF EXISTS `barview`.`favorites`;
CREATE TABLE  `barview`.`favorites` (
  `user_id` int(11) NOT NULL,
  `bar_id` int(11) NOT NULL,
  KEY `user_bar_idx` (`user_id`,`bar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
COMMENT='Holds the bars that each user has flagged as a favorite.';



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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='The users of the system.';