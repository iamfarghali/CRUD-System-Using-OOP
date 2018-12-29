-- Table Structure for table `categories`
CREATE TABLE IF NOT EXISTS `categories` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(200) NOT NULL,
	`created` datetime NOT NULL,
	`modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
);