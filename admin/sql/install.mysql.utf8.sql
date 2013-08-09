DROP TABLE IF EXISTS #__epay;
CREATE TABLE #__epay (
	`id` int(10) unsigned NOT NULL auto_increment,
	`tid` int(10) unsigned NOT NULL,
	`orderid` varchar(255) NOT NULL,
	`amount` bigint(20) unsigned NOT NULL,
	`cur` int(10) unsigned NOT NULL,
	`date` varchar(255) NOT NULL,
	`time` varchar(45) NOT NULL,
	`fraud` int(10) unsigned NOT NULL,
	`transfee` int(10) unsigned NOT NULL,
	`cardid` int(10) unsigned NOT NULL,
	`cardnopostfix` varchar(45) NOT NULL,
	`checked_out` varchar(45) NOT NULL,
	`status` int(10) unsigned NOT NULL,
	`email` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`address` varchar(255) NOT NULL,
	`country` varchar(255) NOT NULL,
	`phone` varchar(255) NOT NULL,
	`comment` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;