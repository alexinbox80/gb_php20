-- Adminer 4.8.1 MySQL 5.7.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `order_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `good_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `price` float unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `carts` (`id`, `cart_id`, `order_id`, `user_id`, `good_id`, `price`, `quantity`, `dateCreate`, `dateUpdate`, `status`) VALUES
(63,	'b1b518ca-322c-48df-af58-bac0368e4170',	'bad302e6-125d-47c1-96b3-7502a0ca12a6',	'c08b32be-1677-443c-bf00-877291354c93',	'81245312-a273-0c97-04e8-f99b5b199795',	0,	1,	'2022-02-20 22:36:43',	'2022-02-20 22:36:43',	1),
(64,	'b1b518ca-322c-48df-af58-bac0368e4170',	'bad302e6-125d-47c1-96b3-7502a0ca12a6',	'c08b32be-1677-443c-bf00-877291354c93',	'81207332-a273-0c57-04e8-f99b5b199795',	0,	2,	'2022-02-20 22:36:43',	'2022-02-20 22:36:43',	1),
(67,	'b1b518ca-322c-48df-af58-bac0368e4170',	'bad302e6-125d-47c1-96b3-7502a0ca12a6',	'c08b32be-1677-443c-bf00-877291354c93',	'7d8b04dd-c403-2c1d-7a22-ff1d671341be',	0,	1,	'2022-02-20 22:36:43',	'2022-02-20 22:36:43',	1);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(222) COLLATE utf8_bin NOT NULL,
  `url` varchar(222) COLLATE utf8_bin NOT NULL,
  `parent_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `categories` (`id`, `category_id`, `name`, `url`, `parent_id`, `dateCreate`, `dateUpdate`, `status`) VALUES
(1,	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'MAN',	'#',	'root',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(2,	'0a99561f-0936-4897-85d0-e90b3a9fcb8e',	'Accessories',	'#',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(3,	'1d980a43-f350-437c-8f01-36188e8fd379',	'Bags',	'#',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(4,	'faa2805c-ee45-4180-9e9e-642d4abe235d',	'Denim',	'#',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(5,	'2fb9d7ee-9ef1-401e-a30b-02040f28e3ee',	'T-Shirts',	'#',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(6,	'f0ac04f4-b72b-46d8-93f2-578ee2260755',	'WOMAN',	'#',	'root',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(7,	'2a2f3a55-80d4-475d-a2d8-358a3e813d38',	'Accessories',	'#',	'f0ac04f4-b72b-46d8-93f2-578ee2260755',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(8,	'f9d24c27-cf96-4700-86ed-935fd002df01',	'Jackets & Coats',	'#',	'f0ac04f4-b72b-46d8-93f2-578ee2260755',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(9,	'8a25a7e8-5b4d-44fa-8df5-71c67b2fae66',	'Polos',	'#',	'f0ac04f4-b72b-46d8-93f2-578ee2260755',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(10,	'597e1fb9-ad77-4b41-ab4b-5f20bbd6f487',	'T-Shirts',	'#',	'f0ac04f4-b72b-46d8-93f2-578ee2260755',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(11,	'a5a86552-d6ca-49f9-9e6c-f2e040ce6a60',	'Shirts',	'#',	'f0ac04f4-b72b-46d8-93f2-578ee2260755',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(12,	'e68611d9-16c3-43ee-840b-a369a4efee4b',	'KIDS',	'#',	'root',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(13,	'181c3f0a-5fb2-4c71-9760-1ac3a88159e0',	'Accessories',	'#',	'e68611d9-16c3-43ee-840b-a369a4efee4b',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(14,	'8015d3cd-d9f9-4611-a238-d9c642e1f3d0',	'Jackets & Coats',	'#',	'e68611d9-16c3-43ee-840b-a369a4efee4b',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(15,	'b2d84539-ca29-467a-b94b-04e6852aa13c',	'Polos',	'#',	'e68611d9-16c3-43ee-840b-a369a4efee4b',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(16,	'7c581e2e-88ff-4f55-b9e7-2f2a3036a481',	'T-Shirts',	'#',	'e68611d9-16c3-43ee-840b-a369a4efee4b',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(17,	'176100f4-e67c-40ec-ab6f-271a12e590ee',	'Shirts',	'#',	'e68611d9-16c3-43ee-840b-a369a4efee4b',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1),
(18,	'1f2d99d1-f59b-42d3-ba60-700f3e66d175',	'Bags',	'#',	'e68611d9-16c3-43ee-840b-a369a4efee4b',	'2022-01-04 13:46:25',	'2022-01-04 13:46:25',	1);

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `category_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(254) COLLATE utf8_bin NOT NULL,
  `description` varchar(254) COLLATE utf8_bin NOT NULL,
  `image` char(32) COLLATE utf8_bin NOT NULL,
  `color` char(32) COLLATE utf8_bin NOT NULL,
  `size` char(8) COLLATE utf8_bin NOT NULL,
  `price` float unsigned DEFAULT NULL,
  `discount` float unsigned DEFAULT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `goods` (`id`, `good_id`, `category_id`, `title`, `description`, `image`, `color`, `size`, `price`, `discount`, `dateCreate`, `dateUpdate`, `status`) VALUES
(1,	'81245312-a273-0c97-04e8-f99b5b199795',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY X MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-1.jpg',	'black',	'XL',	45,	15,	'2022-01-04 19:46:25',	'2022-02-07 16:56:34',	1),
(2,	'81207332-a273-0c57-04e8-f99b5b199795',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY X MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-2.jpg',	'black',	'XL',	45,	23,	'2022-01-04 19:46:25',	'2022-02-07 16:56:34',	1),
(3,	'81296312-a273-0c97-04e8-f99b5b199795',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY X MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian<br> arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-3.jpg',	'black',	'XXL',	65,	15,	'2022-01-04 19:46:25',	'2022-02-07 16:56:34',	1),
(4,	'b53e01e9-baf4-6fe2-09e4-5cd132d59a79',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian\r\narbiter of cool Kym Ellery teams up with Operandi',	'prod-item-6.jpg',	'red',	'XXX',	75,	15,	'2022-01-04 19:46:25',	'2022-02-07 16:56:34',	1),
(5,	'7e606fd5-678c-7669-b972-fe3fa3179867',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-5.jpg',	'black',	'XM',	35,	5,	'2022-01-04 19:46:25',	'2022-02-07 16:56:34',	1),
(6,	'7d8b04dd-c403-2c1d-7a22-ff1d671341be',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-4.jpg',	'green',	'XXXL',	52,	18,	'2022-01-04 19:46:25',	'2022-02-07 16:56:34',	1),
(7,	'7d8b08dd-c403-2c1d-7a22-ff1d671341bc',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY MO CAPSULE ZHOPA',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-3.jpg',	'green',	'XXXL',	45,	10,	'2022-01-04 19:46:25',	'2022-02-07 16:56:34',	1),
(8,	'81245312-a273-1c87-04e8-f99b5b199795',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY X MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-1.jpg',	'black',	'XL',	45,	15,	'2022-02-09 21:13:40',	'2022-02-09 21:13:40',	1),
(9,	'81207332-a273-0c57-04e7-f99b5b199796',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY X MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-2.jpg',	'black',	'XL',	45,	23,	'2022-02-09 21:13:48',	'2022-02-09 21:13:48',	1),
(10,	'81296312-a373-0c97-04e8-f99b5b199797',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY X MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian<br> arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-3.jpg',	'black',	'XXL',	65,	15,	'2022-02-09 21:13:56',	'2022-02-09 21:13:56',	1),
(11,	'b53e11e9-baf4-6fe2-09e4-5cd132d59a78',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian\r\narbiter of cool Kym Ellery teams up with Operandi',	'prod-item-6.jpg',	'red',	'XXX',	75,	15,	'2022-02-09 21:14:07',	'2022-02-09 21:14:07',	1),
(12,	'7e606fd5-678c-7869-b972-fe3fa3179869',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-5.jpg',	'black',	'XM',	35,	5,	'2022-02-09 21:14:18',	'2022-02-09 21:14:18',	1),
(13,	'7d8b04dd-c403-2c1d-7a22-ff4d671341ba',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY MO CAPSULE',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-4.jpg',	'green',	'XXXL',	52,	18,	'2022-02-09 21:14:26',	'2022-02-09 21:14:26',	1),
(14,	'7d8b08dd-c403-2c1d-7b22-ff1d671341bb',	'ef720659-d7c1-4405-9fb1-ac1b36c00444',	'NEW ELLERY MO CAPSULE ZHOPA',	'Known for her sculptural takes on traditional tailoring, Australian arbiter of cool Kym Ellery teams up with Operandi',	'prod-item-3.jpg',	'green',	'XXXL',	45,	10,	'2022-02-09 21:14:36',	'2022-02-09 21:14:36',	1);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `price` float NOT NULL,
  `dateCreate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `amount`, `price`, `dateCreate`, `dateUpdate`, `status`) VALUES
(11,	'bad302e6-125d-47c1-96b3-7502a0ca12a6',	'c08b32be-1677-443c-bf00-877291354c93',	5,	25,	'2022-02-20 09:18:18',	'2022-02-20 22:36:56',	1);

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `pages` (`id`, `name`) VALUES
(1,	'Главная'),
(2,	'О Магазине'),
(3,	'Каталог');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `role` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `roles` (`id`, `role_id`, `role`) VALUES
(1,	'f0ea0e5f-a835-46e7-89c3-545a0a62c355',	'administrator'),
(2,	'7d303e73-f1e2-4b02-a0c5-813f3892e172',	'user');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) COLLATE utf8_bin DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `gender` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `passwd` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `status` smallint(5) unsigned DEFAULT NULL,
  `dateCreate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastActive` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `user_id`, `lastName`, `firstName`, `address`, `email`, `phone`, `gender`, `login`, `passwd`, `status`, `dateCreate`, `lastActive`) VALUES
(1,	'05fbfc3d-4e9e-48c2-89d2-1e9091fc34fa',	'Ivanov',	'Ivan',	NULL,	'email@mail.ru',	'+79211234567',	'male',	'admin',	'3cf108a4e0a498347a5a75a792f232123cf108a4e0a498347a5a75a792f232122f41e93663bfd5016bd453da04bc100d',	1,	'2022-02-20 07:56:50',	'2022-02-20 09:39:33'),
(2,	'c08b32be-1677-443c-bf00-877291354c93',	'Petrov',	'Petr',	'12 12 21',	'mail@mail.ru',	'12',	'male',	'user',	'ee32c060ac0caa70b04e25091bbc11eeee32c060ac0caa70b04e25091bbc11ee2f41e93663bfd5016bd453da04bc100d',	1,	'2022-02-20 08:25:59',	'2022-02-20 22:36:28'),
(3,	'499ea281-2b04-4124-adc3-6e5ccf59d39f',	'Lenina',	'Lena',	'address2',	'mail.mail@mail.ru',	'+79211234576',	'femail',	'user1',	'd9f1eeb7e757b522c74cfa25e51e9c42ee32c060ac0caa70b04e25091bbc11ee2f41e93663bfd5016bd453da04bc100d',	1,	'2022-01-04 13:46:25',	NULL),
(7,	'7adca00d-dda2-4b83-bd07-6a7305a90c8c',	'qwe',	'qwe',	NULL,	'qwe@mail.ru',	NULL,	'female',	'qwe',	'644abf9ff0f45d5a919cf11642208d67644abf9ff0f45d5a919cf11642208d672f41e93663bfd5016bd453da04bc100d',	1,	'2022-02-20 08:02:07',	'2022-02-20 08:02:07');

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
(3,	'499ea281-2b04-4124-adc3-6e5ccf59d39f',	'7d303e73-f1e2-4b02-a0c5-813f3892e172'),
(7,	'7adca00d-dda2-4b83-bd07-6a7305a90c8c',	'7d303e73-f1e2-4b02-a0c5-813f3892e172');

-- 2022-02-20 22:37:38
