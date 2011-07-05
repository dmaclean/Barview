--
-- Definition of table `barview`.`bars`
--

DROP TABLE IF EXISTS `barview`.`bars`;
CREATE TABLE  `barview`.`bars` (
  bar_id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(20) NOT NULL,
  address varchar(40) NOT NULL,
  city varchar(20) NOT NULL,
  state varchar(2) NOT NULL,
  zip varchar(10) NOT NULL,
  lat float(10) NULL,
  lng float(10) NULL,
    username varchar(30) NOT NULL,
  password varchar(30) NOT NULL,
  email varchar(30) NOT NULL,
  PRIMARY KEY (`bar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
COMMENT='Contains data about each bar registered with Barview.';


--
-- Definition of table `barview`.`favorites`
--

DROP TABLE IF EXISTS `barview`.`favorites`;
CREATE TABLE  `barview`.`favorites` (
  `user_id` varchar(20) NOT NULL,
  `bar_id` int(11) NOT NULL,
  KEY `user_bar_idx` (`user_id`,`bar_id`),
  FOREIGN KEY (bar_id) references bars(bar_id) on delete cascade
) ENGINE=MyISAM DEFAULT CHARSET=utf8
COMMENT='Holds the bars that each user has flagged as a favorite.';