CREATE TABLE `Location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postingID` int(11) NOT NULL,
  `streetNum` int(11) NOT NULL,
  `streetName` text NOT NULL,
  `city` text NOT NULL,
  `zip` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `postingIDFK6_idx` (`postingID`),
  CONSTRAINT `postingIDFK6` FOREIGN KEY (`postingID`) REFERENCES `Posting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
