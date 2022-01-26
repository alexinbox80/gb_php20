-- Adminer 4.8.1 MySQL 5.7.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `CountryCode` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `city` (`id`, `name`, `CountryCode`) VALUES
(1,	'Washington',	100),
(2,	'Moscow',	150),
(3,	'London',	175),
(4,	'New Delhi',	135);

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` int(10) unsigned DEFAULT NULL,
  `Name` char(128) COLLATE utf8_bin DEFAULT NULL,
  `Region` char(128) COLLATE utf8_bin DEFAULT NULL,
  `Population` int(10) unsigned DEFAULT NULL,
  `Capital` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `country` (`id`, `Code`, `Name`, `Region`, `Population`, `Capital`) VALUES
(1,	100,	'USA',	'North America',	329,	1),
(2,	150,	'Russia',	'Europe',	144,	2),
(3,	175,	'GB',	'Europe',	56,	3),
(4,	135,	'India',	'South Asia',	1380,	4);

DROP TABLE IF EXISTS `countrylanguage`;
CREATE TABLE `countrylanguage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Language` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `CountryCode` int(10) unsigned DEFAULT NULL,
  `IsOfficial` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `countrylanguage` (`id`, `Language`, `CountryCode`, `IsOfficial`) VALUES
(1,	'Eng',	100,	'T'),
(2,	'Rus',	150,	'T'),
(3,	'Eng',	175,	'T'),
(4,	'Hindi',	135,	'T');

-- 2022-01-25 21:31:28
