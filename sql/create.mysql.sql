CREATE TABLE `prefs` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  PRIMARY KEY (`name`,`username`),
  KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
