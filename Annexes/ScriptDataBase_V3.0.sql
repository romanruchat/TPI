-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema reveries_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema reveries_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `reveries_db` DEFAULT CHARACTER SET utf8 ;
USE `reveries_db` ;

-- -----------------------------------------------------
-- Table `reveries_db`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reveries_db`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(255) NULL,
  `First_Name` VARCHAR(255) NULL,
  `Password` VARCHAR(255) NULL,
  `Email` VARCHAR(254) NULL,
  `Street` VARCHAR(255) NULL,
  `Postcode` SMALLINT(4) NULL,
  `City` VARCHAR(255) NULL,
  `Floor_Number` TINYINT(2) NULL,
  `Street_Number` TINYINT(2) NULL,
  `User_Type` TINYINT(1) NULL,
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reveries_db`.`Dishes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reveries_db`.`Dishes` (
  `idDishes` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(255) NULL,
  `Prize` TINYINT(255) NULL,
  `Description` VARCHAR(255) NULL,
  `Status` BINARY(1) NULL,
  PRIMARY KEY (`idDishes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reveries_db`.`Particularities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reveries_db`.`Particularities` (
  `idParticularities` INT NOT NULL AUTO_INCREMENT,
  `Type` VARCHAR(11) NULL,
  `Name` VARCHAR(255) NULL,
  PRIMARY KEY (`idParticularities`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reveries_db`.`Order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reveries_db`.`Order` (
  `idOrder` INT NOT NULL AUTO_INCREMENT,
  `Date` DATETIME NULL,
  `User_idUsers` INT NOT NULL,
  PRIMARY KEY (`idOrder`),
  CONSTRAINT `fk_Order_User1`
    FOREIGN KEY (`User_idUsers`)
    REFERENCES `reveries_db`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reveries_db`.`Images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reveries_db`.`Images` (
  `idImages` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(255) NULL,
  `Dishes_idDishes` INT NOT NULL,
  PRIMARY KEY (`idImages`),
  CONSTRAINT `fk_Images_Dishes1`
    FOREIGN KEY (`Dishes_idDishes`)
    REFERENCES `reveries_db`.`Dishes` (`idDishes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reveries_db`.`Order_has_Dishes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reveries_db`.`Order_has_Dishes` (
  `Order_idOrder` INT NOT NULL,
  `Dishes_idDishes` INT NOT NULL,
  `Dish_Number` INT NULL,
  PRIMARY KEY (`Order_idOrder`, `Dishes_idDishes`),
  CONSTRAINT `fk_Order_has_Dishes_Order1`
    FOREIGN KEY (`Order_idOrder`)
    REFERENCES `reveries_db`.`Order` (`idOrder`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_has_Dishes_Dishes1`
    FOREIGN KEY (`Dishes_idDishes`)
    REFERENCES `reveries_db`.`Dishes` (`idDishes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reveries_db`.`User_has_Particularities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reveries_db`.`User_has_Particularities` (
  `User_idUsers` INT NOT NULL,
  `Particularities_idParticularities` INT NOT NULL,
  PRIMARY KEY (`User_idUsers`, `Particularities_idParticularities`),
  CONSTRAINT `fk_User_has_Particularities_User1`
    FOREIGN KEY (`User_idUsers`)
    REFERENCES `reveries_db`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Particularities_Particularities1`
    FOREIGN KEY (`Particularities_idParticularities`)
    REFERENCES `reveries_db`.`Particularities` (`idParticularities`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reveries_db`.`Particularities_has_Dishes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reveries_db`.`Particularities_has_Dishes` (
  `Particularities_idParticularities` INT NOT NULL,
  `Dishes_idDishes` INT NOT NULL,
  PRIMARY KEY (`Particularities_idParticularities`, `Dishes_idDishes`),
  CONSTRAINT `fk_Particularities_has_Dishes_Particularities1`
    FOREIGN KEY (`Particularities_idParticularities`)
    REFERENCES `reveries_db`.`Particularities` (`idParticularities`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Particularities_has_Dishes_Dishes1`
    FOREIGN KEY (`Dishes_idDishes`)
    REFERENCES `reveries_db`.`Dishes` (`idDishes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
