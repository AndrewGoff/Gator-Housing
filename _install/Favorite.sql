CREATE TABLE `Favorite` (
  `id` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `postingID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `studentFK3_idx` (`studentID`),
  KEY `postingID_idx` (`postingID`),
  CONSTRAINT `postingID` FOREIGN KEY (`postingID`) REFERENCES `Posting` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `studentFK3` FOREIGN KEY (`studentID`) REFERENCES `Students` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;