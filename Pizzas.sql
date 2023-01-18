-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 07, 2023 at 04:05 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Pizzas`
--

-- --------------------------------------------------------

--
-- Table structure for table `City`
--

CREATE TABLE `City` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `City`
--

INSERT INTO `City` (`id`, `name`, `cp`) VALUES
(1, 'Ottignies', '1340');

-- --------------------------------------------------------

--
-- Table structure for table `Dough`
--

CREATE TABLE `Dough` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `isVege` tinyint(4) NOT NULL,
  `isGlutenFree` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Dough`
--

INSERT INTO `Dough` (`id`, `name`, `price`, `isVege`, `isGlutenFree`) VALUES
(1, 'Sarrasin', 2, 1, 0),
(2, 'Classique', 2, 1, 0),
(3, 'Poix chiche', 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Ingredient`
--

CREATE TABLE `Ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `isVege` tinyint(4) NOT NULL,
  `isGlutenFree` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Ingredient`
--

INSERT INTO `Ingredient` (`id`, `name`, `price`, `isVege`, `isGlutenFree`) VALUES
(1, 'Emmental', 0.5, 1, 1),
(2, 'Base tomatée', 0.5, 1, 1),
(3, 'Origan', 0, 1, 1),
(4, 'Mozzarella', 0.5, 1, 1),
(5, 'Jambon', 1.5, 0, 1),
(6, 'Gorgonzola', 1.5, 1, 1),
(7, 'Fontina', 1, 1, 1),
(8, 'Provolone', 1, 1, 1),
(9, 'Câpre', 0.5, 1, 1),
(10, 'Oeuf', 1, 1, 1),
(11, 'Champignons', 1, 1, 1),
(12, 'Salami piquant', 1, 0, 1),
(13, 'Jambon de Parme', 1.5, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Order`
--

CREATE TABLE `Order` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `stateId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `OrderLine`
--

CREATE TABLE `OrderLine` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `pizzaId` int(11) NOT NULL,
  `sizeId` int(11) NOT NULL,
  `doughId` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Pizza`
--

CREATE TABLE `Pizza` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Pizza`
--

INSERT INTO `Pizza` (`id`, `name`, `price`) VALUES
(1, 'Margarita', 4),
(2, 'Proscuitto', 4),
(3, '4 Fromages', 4),
(4, 'Capricciosa', 4),
(5, 'Diavola', 4);

-- --------------------------------------------------------

--
-- Table structure for table `Pizza_Ingredient`
--

CREATE TABLE `Pizza_Ingredient` (
  `id` int(11) NOT NULL,
  `ingredientId` int(11) NOT NULL,
  `pizzaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Pizza_Ingredient`
--

INSERT INTO `Pizza_Ingredient` (`id`, `ingredientId`, `pizzaId`) VALUES
(1, 1, 1),
(4, 1, 2),
(21, 1, 5),
(2, 2, 1),
(5, 2, 2),
(8, 2, 3),
(15, 2, 4),
(22, 2, 5),
(3, 3, 1),
(6, 3, 2),
(14, 3, 3),
(9, 4, 3),
(16, 4, 4),
(7, 5, 2),
(17, 5, 4),
(11, 6, 3),
(10, 7, 3),
(13, 8, 3),
(19, 9, 4),
(18, 10, 4),
(20, 11, 4),
(23, 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Size`
--

CREATE TABLE `Size` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Size`
--

INSERT INTO `Size` (`id`, `name`, `price`) VALUES
(1, 'Small', 3),
(2, 'Medium', 4);

-- --------------------------------------------------------

--
-- Table structure for table `State`
--

CREATE TABLE `State` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Supplement`
--

CREATE TABLE `Supplement` (
  `id` int(11) NOT NULL,
  `ingredientId` int(11) NOT NULL,
  `orderLineId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `cityId` int(11) NOT NULL,
  `isAdmin` TINYINT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `firstname`, `name`, `email`, `pass`, `address`, `cityId`, `isAdmin`) VALUES
(1, 'Louis', 'De Spiegelaere', 'louis.despiegelaere@gmail.com', '$2y$10$hPP.n722hlALc.zMYTQQweTN/18ZjyQw/Q4mZliTZITYD1rz6/nlK', 'Rue Lucas 14', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `User_Order`
--

CREATE TABLE `User_Order` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `City`
--
ALTER TABLE `City`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Dough`
--
ALTER TABLE `Dough`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Ingredient`
--
ALTER TABLE `Ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Order`
--
ALTER TABLE `Order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Order_State` (`stateId`);

--
-- Indexes for table `OrderLine`
--
ALTER TABLE `OrderLine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_OrderLine_Order` (`orderId`),
  ADD KEY `fk_OrderLine_Pizza` (`pizzaId`),
  ADD KEY `fk_OrderLine_Dough` (`doughId`),
  ADD KEY `fk_OrderLine_Size` (`sizeId`);

--
-- Indexes for table `Pizza`
--
ALTER TABLE `Pizza`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Pizza_Ingredient`
--
ALTER TABLE `Pizza_Ingredient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unicity_Pizza_Ingredient` (`ingredientId`,`pizzaId`),
  ADD KEY `fk_Pizza_Ingredient_Pizza` (`pizzaId`);

--
-- Indexes for table `Size`
--
ALTER TABLE `Size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `State`
--
ALTER TABLE `State`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Supplement`
--
ALTER TABLE `Supplement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unicity_Supplement` (`ingredientId`,`orderLineId`),
  ADD KEY `fk_Supplement_OrderLine` (`orderLineId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unicity_Email` (`email`),
  ADD KEY `fk_User_City` (`cityId`);

--
-- Indexes for table `User_Order`
--
ALTER TABLE `User_Order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_User_Order_User` (`userId`),
  ADD KEY `fk_User_Order_Order` (`orderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `City`
--
ALTER TABLE `City`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Dough`
--
ALTER TABLE `Dough`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Ingredient`
--
ALTER TABLE `Ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Order`
--
ALTER TABLE `Order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `OrderLine`
--
ALTER TABLE `OrderLine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pizza`
--
ALTER TABLE `Pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Pizza_Ingredient`
--
ALTER TABLE `Pizza_Ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `Size`
--
ALTER TABLE `Size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `State`
--
ALTER TABLE `State`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Supplement`
--
ALTER TABLE `Supplement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `User_Order`
--
ALTER TABLE `User_Order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Order`
--
ALTER TABLE `Order`
  ADD CONSTRAINT `fk_Order_State` FOREIGN KEY (`stateId`) REFERENCES `State` (`id`);

--
-- Constraints for table `OrderLine`
--
ALTER TABLE `OrderLine`
  ADD CONSTRAINT `fk_OrderLine_Dough` FOREIGN KEY (`doughId`) REFERENCES `Dough` (`id`),
  ADD CONSTRAINT `fk_OrderLine_Order` FOREIGN KEY (`orderId`) REFERENCES `Order` (`id`),
  ADD CONSTRAINT `fk_OrderLine_Pizza` FOREIGN KEY (`pizzaId`) REFERENCES `Pizza` (`id`),
  ADD CONSTRAINT `fk_OrderLine_Size` FOREIGN KEY (`sizeId`) REFERENCES `Size` (`id`);

--
-- Constraints for table `Pizza_Ingredient`
--
ALTER TABLE `Pizza_Ingredient`
  ADD CONSTRAINT `fk_Pizza_Ingredient_Ingredient` FOREIGN KEY (`ingredientId`) REFERENCES `Ingredient` (`id`),
  ADD CONSTRAINT `fk_Pizza_Ingredient_Pizza` FOREIGN KEY (`pizzaId`) REFERENCES `Pizza` (`id`);

--
-- Constraints for table `Supplement`
--
ALTER TABLE `Supplement`
  ADD CONSTRAINT `fk_Supplement_Ingredient` FOREIGN KEY (`ingredientId`) REFERENCES `Ingredient` (`id`),
  ADD CONSTRAINT `fk_Supplement_OrderLine` FOREIGN KEY (`orderLineId`) REFERENCES `OrderLine` (`id`);

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `fk_User_City` FOREIGN KEY (`cityId`) REFERENCES `City` (`id`);

--
-- Constraints for table `User_Order`
--
ALTER TABLE `User_Order`
  ADD CONSTRAINT `fk_User_Order_Order` FOREIGN KEY (`orderId`) REFERENCES `Order` (`id`),
  ADD CONSTRAINT `fk_User_Order_User` FOREIGN KEY (`userId`) REFERENCES `User` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
