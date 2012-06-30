-- --------------------------------------------------------

-- 
-- Table structure for table `korisnici`
-- 

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime_i_prezime` varchar(255) NOT NULL DEFAULT '',
  `telefon` varchar(255) NOT NULL DEFAULT '',
  `tretman` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `korisnici`
-- 

INSERT INTO `korisnici` VALUES (14, 'Nebojsa Ilijoski 4', '6788976967979', 5);
INSERT INTO `korisnici` VALUES (13, 'Nebojsa Ilijoski 15', '4324324324', 2);
INSERT INTO `korisnici` VALUES (12, 'Nebojsa Ilijoski 1', '454353455346453', 4);
INSERT INTO `korisnici` VALUES (11, 'Nebojsa Ilijoski', '453543543543', 3);
INSERT INTO `korisnici` VALUES (15, 'TEST TEST', '1232434', 1);
INSERT INTO `korisnici` VALUES (16, 'FDHGFH', '243', 1);
INSERT INTO `korisnici` VALUES (17, '2334344', '32', 1);
INSERT INTO `korisnici` VALUES (18, 'test', '34534543535', 1);
INSERT INTO `korisnici` VALUES (19, 'sdfasdfa', '34535', 1);
INSERT INTO `korisnici` VALUES (20, 'sadfasdf34345', '3454353', 1);
INSERT INTO `korisnici` VALUES (21, 'dgasdgsd', '345345', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tretmani`
-- 

DROP TABLE IF EXISTS `tretmani`;
CREATE TABLE `tretmani` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik_id` int(11) NOT NULL DEFAULT '0',
  `datum` date DEFAULT NULL,
  `termin` int(11) DEFAULT NULL,
  `krevet` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `korisnik_id` (`korisnik_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

-- 
-- Dumping data for table `tretmani`
-- 

INSERT INTO `tretmani` VALUES (20, 14, '2009-07-17', 0, 1);
INSERT INTO `tretmani` VALUES (19, 11, '2009-07-25', 3, 2);
INSERT INTO `tretmani` VALUES (18, 12, '2009-07-18', 6, 1);
INSERT INTO `tretmani` VALUES (17, 11, '2009-07-18', 0, 1);
INSERT INTO `tretmani` VALUES (16, 13, '2009-07-17', 11, 2);
INSERT INTO `tretmani` VALUES (15, 12, '2009-07-17', 5, 1);
INSERT INTO `tretmani` VALUES (14, 11, '2009-07-17', 1, 1);
INSERT INTO `tretmani` VALUES (21, 14, '2009-07-18', 3, 1);
INSERT INTO `tretmani` VALUES (22, 15, '2009-07-18', 1, 1);
INSERT INTO `tretmani` VALUES (23, 16, '2009-07-19', 0, 2);
INSERT INTO `tretmani` VALUES (24, 17, '2009-07-18', 2, 1);
INSERT INTO `tretmani` VALUES (25, 18, '2009-11-06', 0, 2);
INSERT INTO `tretmani` VALUES (26, 19, '2009-07-20', 0, 2);
INSERT INTO `tretmani` VALUES (27, 20, '2009-07-20', 9, 2);
INSERT INTO `tretmani` VALUES (28, 21, '2009-07-20', 4, 2);
INSERT INTO `tretmani` VALUES (29, 14, '2010-04-09', 0, 3);
INSERT INTO `tretmani` VALUES (30, 13, '2010-04-09', 3, 1);
INSERT INTO `tretmani` VALUES (31, 14, '2010-04-09', 2, 1);
INSERT INTO `tretmani` VALUES (32, 14, '2010-04-09', 1, 1);
INSERT INTO `tretmani` VALUES (33, 12, '2010-07-15', 0, 1);
INSERT INTO `tretmani` VALUES (34, 12, '2010-06-30', 4, 2);
