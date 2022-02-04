-- Adminer 4.8.1 MySQL 5.7.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `size` int(10) unsigned DEFAULT NULL,
  `count` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `images` (`id`, `photo`, `size`, `count`) VALUES
(1,	'pics01.jpg',	165888,	4),
(2,	'pics02.jpg',	235520,	3),
(3,	'pics03.jpg',	158720,	3),
(4,	'pics04.jpg',	195375,	3),
(5,	'pics05.jpg',	127451,	5),
(6,	'pics06.jpg',	222455,	8);

-- 2022-01-26 21:30:37
