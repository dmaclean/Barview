/******************************************
   Definition of table `barview`.`bars`
******************************************/

DROP TABLE IF EXISTS `bars`;
CREATE TABLE `bars` (
  bar_id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  address varchar(40) NOT NULL,
  city varchar(20) NOT NULL,
  state varchar(2) NOT NULL,
  zip varchar(10) NOT NULL,
  lat float(10) NULL,
  lng float(10) NULL,
    username varchar(30) NOT NULL,
  password varchar(100) NOT NULL,
  email varchar(30) NOT NULL,
  reference varchar(200) NOT NULL,
  verified tinyint(1) NOT NULL,
  PRIMARY KEY (`bar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
COMMENT='Contains data about each bar registered with Barview.';


/***********************************************
   Definition of table `barview`.`favorites`
***********************************************/

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `user_id` varchar(20) NOT NULL,
  `bar_id` int(11) NOT NULL,
  KEY `user_bar_idx` (`user_id`,`bar_id`),
  FOREIGN KEY (bar_id) references bars(bar_id) on delete cascade
) ENGINE=MyISAM DEFAULT CHARSET=utf8
COMMENT='Holds the bars that each user has flagged as a favorite.';


/********************************
   Logging for REST interface
********************************/
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text NOT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `time` int(11) NOT NULL,
  `authorized` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* Barview users table */
DROP TABLE IF EXISTS `users`;
create table `users` (
	first_name varchar(20) not null,
	last_name varchar(30) not null,
	email varchar(30) not null primary key,
	password varchar(100) not null,
	dob date not null,
	city varchar(20) not null,
	state varchar(2) not null
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


/* Bar events and deals table */
drop table if exists `barevents`;
create table `barevents` (
	id int not null auto_increment,
	bar_id int(11) not null,
	detail varchar(1000) not null,
	primary key (id),
	foreign key (bar_id) references bars(bar_id) on delete cascade
) engine=MyISAM default charset=utf8;


/* Tokens for mobile Bar-view users */
drop table if exists `mobile_tokens`;
create table `mobile_tokens` (
	token char(64) not null primary key,
	user_id varchar(30) not null,
	ts timestamp default current_timestamp on update current_timestamp
) engine=MyISAM default charset=utf8;


/* CodeIgniter sessions */
CREATE TABLE IF NOT EXISTS  `ci_sessions` (
session_id varchar(40) DEFAULT '0' NOT NULL,
ip_address varchar(16) DEFAULT '0' NOT NULL,
user_agent varchar(50) NOT NULL,
last_activity int(10) unsigned DEFAULT 0 NOT NULL,
user_data text DEFAULT '' NOT NULL,
bar_name varchar(20) DEFAULT '' NOT NULL,
PRIMARY KEY (session_id)
);
CREATE INDEX last_activity_idx ON ci_sessions(last_activity); 
ALTER TABLE ci_sessions MODIFY user_agent VARCHAR(120); /* CI 2.0.3 update */

/**************************************
   Account security question tables
**************************************/
drop table if exists `bar_account_security`;
create table `bar_account_security` (
	id int not null auto_increment,
	bar_id int(11) not null,
	security_id int not null,
	security_answer varchar(30),
	primary key (id),
	foreign key (bar_id) references bars(bar_id) on delete cascade,
	foreign key (security_id) references security_question(id)
) engine=MyISAM default charset=utf8;

drop table if exists `user_account_security`;
create table `user_account_security` (
	id int not null auto_increment,
	email varchar(30) not null,
	security_id int not null,
	security_answer varchar(30),
	primary key (id),
	foreign key (email) references users(email) on delete cascade,
	foreign key (security_id) references security_question(id)
) engine=MyISAM default charset=utf8;

drop table if exists `security_question`;
create table `security_question` (
	id int not null auto_increment,
	question varchar(50) not null,
	primary key (id)
) engine=MyISAM default charset=utf8;

insert into security_question(question) values('What is the name of your favorite pet?');
insert into security_question(question) values('What was your first car?');
insert into security_question(question) values('What was your first job?');


/**********************
	User Reporting
**********************/
drop table if exists `bar_image_requests`;
create table `bar_image_requests` (
	user_id		varchar(20) not null,
	bar_id 		int(11) not null,
	ts timestamp default current_timestamp,
	KEY user_bar_ts_idx (user_id, bar_id, ts),
	key ts_idx (ts),
	foreign key (user_id) references users(email) on delete cascade,
	foreign key (bar_id) references bars(bar_id) on delete cascade
	
) engine=MyISAM default charset=utf8;