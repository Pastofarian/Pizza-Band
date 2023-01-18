-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 18 jan. 2023 à 21:20
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pizzas`
--

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cp` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `name`, `cp`) VALUES
(1, 'Ottignies', '1340');

-- --------------------------------------------------------

--
-- Structure de la table `dough`
--

DROP TABLE IF EXISTS `dough`;
CREATE TABLE IF NOT EXISTS `dough` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `isVege` tinyint NOT NULL,
  `isGlutenFree` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `dough`
--

INSERT INTO `dough` (`id`, `name`, `price`, `isVege`, `isGlutenFree`) VALUES
(1, 'Sarrasin', 2, 1, 0),
(2, 'Classique', 2, 1, 0),
(3, 'Poix chiche', 4, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `isVege` tinyint NOT NULL,
  `isGlutenFree` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`, `price`, `isVege`, `isGlutenFree`) VALUES
(2, 'Base tomatée', 0.5, 1, 1),
(3, 'Origan', 0, 1, 1),
(4, 'Mozzarella', 0.5, 1, 1),
(5, 'Jambon', 1.5, 0, 1),
(6, 'Gorgonzola', 1.5, 1, 1),
(7, 'Fontina', 1, 1, 1),
(8, 'Provolone', 1, 1, 1),
(11, 'Champignons', 1, 1, 1),
(13, 'Jambon de Parme', 2.5, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `stateId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Order_State` (`stateId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `date`, `stateId`) VALUES
(3, '2023-01-18', 1),
(4, '2023-01-18', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orderline`
--

DROP TABLE IF EXISTS `orderline`;
CREATE TABLE IF NOT EXISTS `orderline` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orderId` int NOT NULL,
  `quantity` int NOT NULL,
  `pizzaId` int NOT NULL,
  `sizeId` int NOT NULL,
  `doughId` int NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_OrderLine_Order` (`orderId`),
  KEY `fk_OrderLine_Pizza` (`pizzaId`),
  KEY `fk_OrderLine_Dough` (`doughId`),
  KEY `fk_OrderLine_Size` (`sizeId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `orderline`
--

INSERT INTO `orderline` (`id`, `orderId`, `quantity`, `pizzaId`, `sizeId`, `doughId`, `price`) VALUES
(1, 3, 1, 25, 1, 1, 13.5),
(2, 4, 1, 31, 1, 1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `pizza`
--

DROP TABLE IF EXISTS `pizza`;
CREATE TABLE IF NOT EXISTS `pizza` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `pizza`
--

INSERT INTO `pizza` (`id`, `name`, `price`) VALUES
(24, 'Margarita', 4),
(25, 'Proscuitto', 4),
(31, 'Funghi', 4),
(32, 'Maison', 4);

-- --------------------------------------------------------

--
-- Structure de la table `pizza_ingredient`
--

DROP TABLE IF EXISTS `pizza_ingredient`;
CREATE TABLE IF NOT EXISTS `pizza_ingredient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ingredientId` int NOT NULL,
  `pizzaId` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unicity_Pizza_Ingredient` (`ingredientId`,`pizzaId`),
  KEY `fk_Pizza_Ingredient_Pizza` (`pizzaId`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `pizza_ingredient`
--

INSERT INTO `pizza_ingredient` (`id`, `ingredientId`, `pizzaId`) VALUES
(79, 2, 24),
(87, 2, 25),
(131, 2, 31),
(134, 2, 32),
(80, 3, 24),
(89, 3, 25),
(132, 3, 31),
(135, 3, 32),
(81, 4, 24),
(88, 4, 25),
(133, 4, 31),
(91, 5, 25),
(137, 6, 32),
(130, 8, 25),
(138, 11, 31),
(136, 13, 32);

-- --------------------------------------------------------

--
-- Structure de la table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `size`
--

INSERT INTO `size` (`id`, `name`, `price`) VALUES
(1, 'Small', 3),
(2, 'Medium', 4);

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `state`
--

INSERT INTO `state` (`id`, `name`) VALUES
(1, 'ready');

-- --------------------------------------------------------

--
-- Structure de la table `supplement`
--

DROP TABLE IF EXISTS `supplement`;
CREATE TABLE IF NOT EXISTS `supplement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ingredientId` int NOT NULL,
  `orderLineId` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unicity_Supplement` (`ingredientId`,`orderLineId`),
  KEY `fk_Supplement_OrderLine` (`orderLineId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `cityId` int NOT NULL,
  `isAdmin` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unicity_Email` (`email`),
  KEY `fk_User_City` (`cityId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `name`, `email`, `pass`, `address`, `cityId`, `isAdmin`) VALUES
(1, 'Louis', 'De Spiegelaere', 'louis.despiegelaere@gmail.com', '$2y$10$hPP.n722hlALc.zMYTQQweTN/18ZjyQw/Q4mZliTZITYD1rz6/nlK', 'Rue Lucas 14', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_order`
--

DROP TABLE IF EXISTS `user_order`;
CREATE TABLE IF NOT EXISTS `user_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `orderId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_User_Order_User` (`userId`),
  KEY `fk_User_Order_Order` (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_Order_State` FOREIGN KEY (`stateId`) REFERENCES `state` (`id`);

--
-- Contraintes pour la table `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `fk_OrderLine_Dough` FOREIGN KEY (`doughId`) REFERENCES `dough` (`id`),
  ADD CONSTRAINT `fk_OrderLine_Order` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `fk_OrderLine_Pizza` FOREIGN KEY (`pizzaId`) REFERENCES `pizza` (`id`),
  ADD CONSTRAINT `fk_OrderLine_Size` FOREIGN KEY (`sizeId`) REFERENCES `size` (`id`);

--
-- Contraintes pour la table `pizza_ingredient`
--
ALTER TABLE `pizza_ingredient`
  ADD CONSTRAINT `fk_Pizza_Ingredient_Ingredient` FOREIGN KEY (`ingredientId`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Pizza_Ingredient_Pizza` FOREIGN KEY (`pizzaId`) REFERENCES `pizza` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `supplement`
--
ALTER TABLE `supplement`
  ADD CONSTRAINT `fk_Supplement_Ingredient` FOREIGN KEY (`ingredientId`) REFERENCES `ingredient` (`id`),
  ADD CONSTRAINT `fk_Supplement_OrderLine` FOREIGN KEY (`orderLineId`) REFERENCES `orderline` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_City` FOREIGN KEY (`cityId`) REFERENCES `city` (`id`);

--
-- Contraintes pour la table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `fk_User_Order_Order` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `fk_User_Order_User` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
