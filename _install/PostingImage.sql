CREATE TABLE `PostingImage` (
  `id` int(11) NOT NULL,
  `postingID` int(11) NOT NULL,
  `image` blob NOT NULL,
  `isThumbnail` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `postingIDFK5_idx` (`postingID`),
  CONSTRAINT `postingIDFK5` FOREIGN KEY (`postingID`) REFERENCES `Posting` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
