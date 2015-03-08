SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `wedding` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `wedding`;

-- -----------------------------------------------------
-- Table `wedding`.`rsvp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wedding`.`rsvp` ;

CREATE  TABLE IF NOT EXISTS `wedding`.`rsvp` (
  `id` VARCHAR(45) NOT NULL ,
  `greeting` VARCHAR(45) NULL ,
  `accommodation` VARCHAR(300) NULL ,
  `accom_fee` VARCHAR(45) NULL ,
  `want_to_book` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wedding`.`rsvp_items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wedding`.`rsvp_items` ;

CREATE  TABLE IF NOT EXISTS `wedding`.`rsvp_items` (
  `name` VARCHAR(45) NOT NULL ,
  `id` VARCHAR(45) NOT NULL ,
  `rsvp` VARCHAR(45) NULL ,
  PRIMARY KEY (`name`, `id`) ,
  INDEX `id` (`id` ASC) ,
  CONSTRAINT `id`
    FOREIGN KEY (`id` )
    REFERENCES `wedding`.`rsvp` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
