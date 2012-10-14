DROP TABLE IF EXISTS `#__hiorgcal`;
 
CREATE TABLE `#__hiorgcal` (
  `id` int(11) NOT NULL auto_increment,
  `url` text NOT NULL,
  `ov` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `#__hiorgcal` (`url`, `ov`) VALUES
('http://www.hiorg-server.de/termine.php?json=1', 'xxx');