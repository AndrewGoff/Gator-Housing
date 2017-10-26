CREATE TABLE `Posting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `landlordID` int(11) NOT NULL,
  `title` text NOT NULL,
  `price` float(8,2) NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numViews` int(11) NOT NULL,
  `numTenants` int(11) NOT NULL,
  `description` text,
  `numBed` int(11) NOT NULL,
  `numBath` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `landlordID_idx` (`landlordID`),
  KEY `landlordIDFK_idx` (`landlordID`),
  KEY `landlordIDFK` (`landlordID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
