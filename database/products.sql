-- Table Structure for table `products`

CREATE TABLE IF NOT EXISTS `products` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(40) NOT NULL,
	`description` text NOT NULL,
	`price` decimal(7,2) NOT NULL,
	`category_id` int(11) NOT NULL,
	`created` datetime NOT NULL,
	`modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
);