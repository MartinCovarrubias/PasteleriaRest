CREATE SCHEMA IF NOT EXISTS `pasteleria` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `pasteleria` ;

CREATE TABLE IF NOT EXISTS `pasteleria`.`Roles` (
  `id_rol` INT NOT NULL AUTO_INCREMENT  ,
  `nombre_rol` VARCHAR(45) NOT NULL  ,
  PRIMARY KEY (`id_rol`)   )
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `pasteleria`.`Usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT  ,
  `nombre` VARCHAR(100) NOT NULL  ,
  `apellidoP` VARCHAR(100) NOT NULL  ,
  `telefono` VARCHAR(45) NOT NULL  ,
  `correo` VARCHAR(100) NOT NULL  ,
  `password` VARCHAR(65) NOT NULL  ,
  `direccion` VARCHAR(250) NOT NULL  ,
  `id_rol` INT NOT NULL  ,
  PRIMARY KEY (`id_usuario`)   ,
  CONSTRAINT `fk_Usuario_Roles`
    FOREIGN KEY (`id_rol`)
    REFERENCES `pasteleria`.`Roles` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `pasteleria`.`Pastel` (
  `id_pastel` INT NOT NULL AUTO_INCREMENT  ,
  `nombre` VARCHAR(255) NOT NULL  ,
  `imagen_pastel` VARCHAR(255) NOT NULL  ,
  `precio` DOUBLE NOT NULL  ,
  `descripcion` VARCHAR(255) NOT NULL  ,
  `estado` ENUM('agotado', 'disponible') NOT NULL  ,
  PRIMARY KEY (`id_pastel`)   )
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `pasteleria`.`Pedido` (
  `id_pedido` INT NOT NULL AUTO_INCREMENT  ,
  `fecha_pedido` DATE NOT NULL  ,
  `cantidad` INT NOT NULL  ,
  `estado` ENUM('aprobado', 'pendiente') NOT NULL  ,
  `id_usuario` INT NOT NULL  ,
  PRIMARY KEY (`id_pedido`)   ,
  CONSTRAINT `fk_Pedido_Usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `pasteleria`.`Usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `pasteleria`.`carrito_pastel` (
  `id_pastel` INT NOT NULL  ,
  `id_pedido` INT NOT NULL  ,
  `id_carrito` INT NOT NULL AUTO_INCREMENT  ,
  PRIMARY KEY (`id_carrito`, `id_pastel`, `id_pedido`)   ,
  UNIQUE INDEX `id_carrito_UNIQUE` (`id_carrito` ASC)   ,
  CONSTRAINT `fk_Pedido_has_Pastel_Pedido1`
    FOREIGN KEY (`id_pedido`)
    REFERENCES `pasteleria`.`Pedido` (`id_pedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_has_Pastel_Pastel1`
    FOREIGN KEY (`id_pastel`)
    REFERENCES `pasteleria`.`Pastel` (`id_pastel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



 
// join para ver los pedidos de un usuario
SELECT Pedido.id_pedido, Pedido.fecha_pedido, Pedido.total, Pedido.estado, Pedido.id_usuario, Usuario.nombre, Usuario.apellidoP, Usuario.telefono, Usuario.correo, Usuario.password, Usuario.direccion, Usuario.id_rol, Roles.nombre_rol
FROM Pedido
INNER JOIN Usuario ON Pedido.id_usuario = Usuario.id_usuario
INNER JOIN Roles ON Usuario.id_rol = Roles.id_rol
WHERE Usuario.id_usuario = 1;
