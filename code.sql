DROP DATABASE mybase;

CREATE DATABASE `mybase` ;

USE `mybase` ;

CREATE TABLE `members` (
`id` INT NOT NULL auto_increment,
`username` varchar(65) NOT NULL default '',
`password` varchar(65) NOT NULL default '',
`email` varchar(65) NOT NULL default '',
`uid` VARCHAR(50),
PRIMARY KEY (`id`),
unique key (`uid`)

) ENGINE=InnoDB ;

CREATE TABLE `events` (
`id` INT NOT NULL auto_increment PRIMARY KEY,
`title` VARCHAR(30) NOT NULL, 
`start` DATETIME NOT NULL,
`end` DATETIME NOT NULL,
`uid` VARCHAR(50),
FOREIGN KEY (`uid`) REFERENCES `members`(`uid`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB ;


