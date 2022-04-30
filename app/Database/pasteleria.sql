
CREATE SCHEMA IF NOT EXISTS `pasteleria` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `pasteleria` ;

 
CREATE TABLE IF NOT EXISTS `pasteleria`.`Roles` (
  `id_rol` INT NOT NULL AUTO_INCREMENT,
  `nombre_rol` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `pasteleria`.`Usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellidoP` VARCHAR(100) NOT NULL,
  `apellidoM` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(100) NOT NULL,
  `direccion` VARCHAR(250) NOT NULL,
  `id_rol` INT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_Usuario_Roles`
    FOREIGN KEY (`id_rol`)
    REFERENCES `pasteleria`.`Roles` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `pasteleria`.`Adorno` (
  `id_adorno` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `imagen_adorno` VARCHAR(255) NOT NULL,
  `precio` DOUBLE NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `estado` ENUM('agotado', 'disponible') NOT NULL,
  PRIMARY KEY (`id_adorno`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `pasteleria`.`Pastel` (
  `id_pastel` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `imagen_pastel` VARCHAR(255) NOT NULL,
  `precio` DOUBLE NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `estado` ENUM('agotado', 'disponible') NOT NULL,
  `id_adorno` INT NULL,
  PRIMARY KEY (`id_pastel`),
  CONSTRAINT `fk_Pastel_Adorno1`
    FOREIGN KEY (`id_adorno`)
    REFERENCES `pasteleria`.`Adorno` (`id_adorno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `pasteleria`.`Pedido` (
  `id_pedido` INT NOT NULL AUTO_INCREMENT,
  `fecha_pedido` DATE NOT NULL,
  `total` INT NOT NULL,
  `estado` ENUM('aprobado', 'denegado') NOT NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_pedido`),
  CONSTRAINT `fk_Pedido_Usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `pasteleria`.`Usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `pasteleria`.`Detalle_pedido` (
  `id_detalle_pedido` VARCHAR(45) NOT NULL,
  `id_pastel` INT NOT NULL,
  `precio` DECIMAL NOT NULL,
  `cantidad` INT NOT NULL,
  `estado` ENUM('aceptado', 'denegado') NOT NULL,
  `id_pedido` INT NOT NULL,
  PRIMARY KEY (`id_detalle_pedido`, `id_pastel`),
  CONSTRAINT `fk_Usuario_has_Pastel_Pastel1`
    FOREIGN KEY (`id_pastel`)
    REFERENCES `pasteleria`.`Pastel` (`id_pastel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Detalle_pedido_Pedido1`
    FOREIGN KEY (`id_pedido`)
    REFERENCES `pasteleria`.`Pedido` (`id_pedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;