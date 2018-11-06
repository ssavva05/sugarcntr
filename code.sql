DROP DATABASE mybase;

CREATE DATABASE `mybase` ;

USE `mybase` ;

CREATE TABLE `members` (
`id` INT NOT NULL auto_increment,
`username` varchar(65) NOT NULL default '',
`password` varchar(65) NOT NULL default '',
`email` varchar(65) NOT NULL default '',
`st` varchar (1) NOT NULL default '',
`uid` VARCHAR(50) NOT NULL default '',
`icd` varchar(7) NOT NULL default ' ',
`hid` varchar(25) NOT NULL default '',
PRIMARY KEY (`id`),
unique key (`hid`),
unique key (`uid`)

) ENGINE=InnoDB ;

CREATE TABLE `events` (
`id` INT NOT NULL auto_increment PRIMARY KEY,
`title` VARCHAR(30) NOT NULL, 
`start` DATETIME NOT NULL,
`end` DATETIME NOT NULL,
`uid` VARCHAR(50),
`icdlh` varchar(7) NOT NULL default ' ',
FOREIGN KEY (`uid`) REFERENCES `members`(`uid`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB ;
