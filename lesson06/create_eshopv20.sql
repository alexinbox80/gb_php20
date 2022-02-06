-- Adminer 4.8.1 MySQL 5.7.34 dump

create database eshopv20 default character set utf8;

GRANT ALL PRIVILEGES ON eshopv20.* TO 'eshopv20'@'localhost';

CREATE USER 'eshopv20'@'localhost' IDENTIFIED BY 'eshop';

FLUSH PRIVILEGES;


SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `role` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `roles` (`id`, `role_id`, `role`) VALUES
(1,	'f0ea0e5f-a835-46e7-89c3-545a0a62c355',	'Administrator'),
(2,	'7d303e73-f1e2-4b02-a0c5-813f3892e172',	'User');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `role_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `passwd` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `status` smallint(5) unsigned DEFAULT NULL,
  `dateCreate` bigint(20) unsigned DEFAULT NULL,
  `lastActive` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `user_id`, `role_id`, `lastName`, `firstName`, `address`, `email`, `phone`, `sex`, `login`, `passwd`, `status`, `dateCreate`, `lastActive`) VALUES
(1,	'05fbfc3d-4e9e-48c2-89d2-1e9091fc34fa',	'f0ea0e5f-a835-46e7-89c3-545a0a62c355',	'Ivanov',	'Ivan',	NULL,	'email@mail.ru',	'+79211234567',	'male',	'admin',	'3cf108a4e0a498347a5a75a792f232123cf108a4e0a498347a5a75a792f232122f41e93663bfd5016bd453da04bc100d',	1,	1641233642,	NULL),
(2,	'c08b32be-1677-443c-bf00-877291354c93',	'7d303e73-f1e2-4b02-a0c5-813f3892e172',	'Petrov',	'Petr',	'address',	'mail@mail.ru',	'+79211234590',	'male',	'user',	'ee32c060ac0caa70b04e25091bbc11eeee32c060ac0caa70b04e25091bbc11ee2f41e93663bfd5016bd453da04bc100d',	1,	1641233710,	NULL),
(3,	'499ea281-2b04-4124-adc3-6e5ccf59d39f',	'7d303e73-f1e2-4b02-a0c5-813f3892e172',	'Lenina',	'Lena',	'address2',	'mail.mail@mail.ru',	'+79211234576',	'femail',	'user1',	'd9f1eeb7e757b522c74cfa25e51e9c42ee32c060ac0caa70b04e25091bbc11ee2f41e93663bfd5016bd453da04bc100d',	1,	1641325585,	NULL);

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `role_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES
(1,	'05fbfc3d-4e9e-48c2-89d2-1e9091fc34fa',	'f0ea0e5f-a835-46e7-89c3-545a0a62c355'),
(2,	'c08b32be-1677-443c-bf00-877291354c93',	'7d303e73-f1e2-4b02-a0c5-813f3892e172'),
(3,	'499ea281-2b04-4124-adc3-6e5ccf59d39f',	'7d303e73-f1e2-4b02-a0c5-813f3892e172');


//categories(id, category_id, name, parent_id, dateCreate, dateUpdate, status)

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(222) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `dateCreate` bigint(20) unsigned DEFAULT NULL,
  `dateUpdate` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `categories` (`id`,`category_id`, `name`, `parent_id`, `dateCreate`, `dateUpdate`, `status`) VALUES
(1,	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'Category 1',	0, 1641325585, 1641325585, 1),
(2,	'0a99561f-0936-4897-85d0-e90b3a9fcb8e',	'Category 2',	1, 1641325585, 1641325585, 1),
(3,	'1d980a43-f350-437c-8f01-36188e8fd379',	'Category 3',	1, 1641325585, 1641325585, 1),
(4,	'faa2805c-ee45-4180-9e9e-642d4abe235d',	'Category 4',	0, 1641325585, 1641325585, 1),
(5,	'2fb9d7ee-9ef1-401e-a30b-02040f28e3ee',	'Category 5',	2, 1641325585, 1641325585, 1),
(6,	'724a1e07-7dcb-4b7b-8540-2591d794fb1b',	'Category 6',	5, 1641325585, 1641325585, 1);

//goods(id, good_id, category_id, title, description, image, color, size, price, discount, dateCreate, dateUpdate, status)

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `category_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(254) NOT NULL,
  `description` varchar(254) NOT NULL,
  `image` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `color` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `size` char(8) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `price` float unsigned DEFAULT NULL,
  `discount` float unsigned DEFAULT NULL,
  `dateCreate` bigint(20) unsigned DEFAULT NULL,
  `dateUpdate` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `goods` (`id`, `good_id`, `category_id`, `title`, `description`, `image`, `color`, `size`, `price`, `discount`, `dateCreate`, `dateUpdate`, `status`) VALUES
(1,	'81245312-a273-0c97-04e8-f99b5b199795',	'ef720659-d7c1-4405-9fb1-ac1b36c00444', 'NEW ELLERY X MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-1.jpg',	'black',	'XL',	45,	15, 1641325585, 1641325585, 1),
(2,	'81207332-a273-0c57-04e8-f99b5b199795', 'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY X MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-2.jpg',	'black',	'XL',	45,	23, 1641325585, 1641325585, 1),
(3,	'81296312-a273-0c97-04e8-f99b5b199795',	'ef720659-d7c1-4405-9fb1-ac1b36c00444', 'NEW ELLERY X MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian<br> arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-3.jpg',	'black',	'XXL',	65,	15, 1641325585, 1641325585, 1),
(4,	'b53e01e9-baf4-6fe2-09e4-5cd132d59a79',	'ef720659-d7c1-4405-9fb1-ac1b36c00444', 'NEW ELLERY CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian\r\narbiter of cool Kym Ellery teams up with Operandi',	'prod-item-6.jpg',	'red',	'XXX',	75,	15, 1641325585, 1641325585, 1),
(5,	'7e606fd5-678c-7669-b972-fe3fa3179867',	'ef720659-d7c1-4405-9fb1-ac1b36c00444', 'NEW ELLERY CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-5.jpg',	'black',	'XM',	35,	5, 1641325585, 1641325585, 1),
(6,	'7d8b04dd-c403-2c1d-7a22-ff1d671341be',	'ef720659-d7c1-4405-9fb1-ac1b36c00444', 'NEW ELLERY MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-4.jpg',	'green',	'XXXL',	52,	18, 1641325585, 1641325585, 1),
(7,	'7d8b08dd-c403-2c1d-7a22-ff1d671341bc',	'ef720659-d7c1-4405-9fb1-ac1b36c00444', 'NEW ELLERY MO CAPSULE ZHOPA',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-3.jpg',	'green',	'XXXL',	45,	10, 1641325585, 1641325585, 1);

// orders(id, order_id, user_id, amount, dateCreate, dateUpdate, status)

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `dateCreate` bigint(20) unsigned DEFAULT NULL,
  `dateUpdate` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


//carts(id, cart_id, order_id, user_id, price, quantity, dateCreate, dateUpdate, status)

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `order_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `price` float unsigned DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `dateCreate` bigint(20) unsigned DEFAULT NULL,
  `dateUpdate` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 2022-02-03 14:52:48
