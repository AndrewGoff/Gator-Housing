CREATE TABLE `Preferences` (
  `id` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `maxPrice` float DEFAULT NULL,
  `numBath` int(11) DEFAULT NULL,
  `numBed` int(11) DEFAULT NULL,
  `numTenants` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
