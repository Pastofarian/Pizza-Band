CREATE DATABASE IF NOT EXISTS Pizzas;
USE Pizzas;

DROP TABLE IF EXISTS `City`;
CREATE TABLE IF NOT EXISTS `City` (
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    cp VARCHAR(10) NOT NULL,
    PRIMARY KEY (id)
);
DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
    id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
 	email VARCHAR(100) NOT NULL,
    pass VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,
    cityId INT NOT NULL,
    PRIMARY KEY (id)
);
DROP TABLE IF EXISTS `User_Order`;
CREATE TABLE IF NOT EXISTS `User_Order` (
	id INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    orderId INT NOT NULL,
    PRIMARY KEY(id)
);
DROP TABLE IF EXISTS `Order`;
CREATE TABLE IF NOT EXISTS `Order` (
	id INT NOT NULL AUTO_INCREMENT,
    `date` DATE NOT NULL,
    stateId INT NOT NULL,
    PRIMARY KEY(id)
);
DROP TABLE IF EXISTS `State`;
CREATE TABLE IF NOT EXISTS `State` (
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
);
DROP TABLE IF EXISTS `OrderLine`;
CREATE TABLE IF NOT EXISTS `OrderLine` (
	id INT NOT NULL AUTO_INCREMENT,
    orderId INT NOT NULL,
    quantity INT NOT NULL,
    pizzaId INT NOT NULL,
    sizeId INT NOT NULL,
    PRIMARY KEY(id)
);
DROP TABLE IF EXISTS `Pizza`;
CREATE TABLE IF NOT EXISTS `Pizza` (
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price FLOAT NOT NULL,
    PRIMARY KEY(id)
);
DROP TABLE IF EXISTS `Size`;
CREATE TABLE IF NOT EXISTS `Size` (
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price FLOAT NOT NULL,
    PRIMARY KEY(id)
);
DROP TABLE IF EXISTS `Pizza_Ingredient`;
CREATE TABLE IF NOT EXISTS `Pizza_Ingredient` (
	id INT NOT NULL AUTO_INCREMENT,
    ingredientId INT NOT NULL,
    pizzaId INT NOT NULL,
    PRIMARY KEY(id)
);
DROP TABLE IF EXISTS `Ingredient`;
CREATE TABLE IF NOT EXISTS `Ingredient` (
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price FLOAT NOT NULL,
    isVege TINYINT NOT NULL,
    isGlutenFree TINYINT NOT NULL,
    PRIMARY KEY(id)
);
DROP TABLE IF EXISTS `Supplement`;
CREATE TABLE IF NOT EXISTS `Supplement` (
	id INT NOT NULL AUTO_INCREMENT,
    ingredientId INT NOT NULL,
    OrderLineId INT NOT NULL,
    PRIMARY KEY(id)
);
ALTER TABLE `User`
	ADD CONSTRAINT `fk_User_City`
	FOREIGN KEY (`cityId`) REFERENCES `City` (`id`);
ALTER TABLE `User_Order`
	ADD CONSTRAINT `fk_User_Order_User`
	FOREIGN KEY (`userId`) REFERENCES `User` (`id`);
ALTER TABLE `User_Order`
	ADD CONSTRAINT `fk_User_Order_Order`
	FOREIGN KEY (`orderId`) REFERENCES `Order` (`id`);
ALTER TABLE `Order`
	ADD CONSTRAINT `fk_Order_State`
	FOREIGN KEY (`stateId`) REFERENCES `State` (`id`);
ALTER TABLE `OrderLine`
	ADD CONSTRAINT `fk_OrderLine_Order`
	FOREIGN KEY (`orderId`) REFERENCES `Order`(`id`);
ALTER TABLE `OrderLine`
	ADD CONSTRAINT `fk_OrderLine_Pizza` 
	FOREIGN KEY (`pizzaId`) REFERENCES `Pizza` (`id`);
ALTER TABLE `OrderLine`
	ADD CONSTRAINT `fk_OrderLine_Size`
	FOREIGN KEY (`sizeId`) REFERENCES `Size` (`id`);
ALTER TABLE `Pizza_Ingredient`
	ADD CONSTRAINT `fk_Pizza_Ingredient_Ingredient`
	FOREIGN KEY (`ingredientId`) REFERENCES `Ingredient` (`id`);
ALTER TABLE `Pizza_Ingredient`
	ADD UNIQUE `Unicity_Pizza_Ingredient` (`ingredientId`, `pizzaId`);
ALTER TABLE `Pizza_Ingredient`
	ADD CONSTRAINT `fk_Pizza_Ingredient_Pizza`
	FOREIGN KEY (`pizzaId`) REFERENCES `Pizza` (`id`);
ALTER TABLE `Supplement`
	ADD CONSTRAINT `fk_Supplement_Ingredient`
	FOREIGN KEY (`ingredientId`) REFERENCES `Ingredient` (`id`);
ALTER TABLE `Supplement`
	ADD CONSTRAINT `fk_Supplement_OrderLine`
	FOREIGN KEY (`orderLineId`) REFERENCES `OrderLine` (`id`);
