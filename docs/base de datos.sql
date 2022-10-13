- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: dbo
-- Source Schemata: dbo
-- Created: Tue Oct 11 02:30:19 2022
-- Workbench Version: 8.0.29
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema dbo
-- ----------------------------------------------------------------------------

-- ----------------------------------------------------------------------------
-- Table dbo.acceso
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`acceso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NULL,
  `id_art` INT NULL,
  `direccion` VARCHAR(50) NOT NULL,
  `direccion2` VARCHAR(50) NULL,
  `conteo` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_acceso_articulo`
    FOREIGN KEY (`id_art`)
    REFERENCES `chacongt_DBWeb`.`articulo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_acceso_usuario`
    FOREIGN KEY (`id_user`)
    REFERENCES `chacongt_DBWeb`.`usuario` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table dbo.articulo
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`articulo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom_articulo` VARCHAR(250) NOT NULL,
  `sub_categoria` VARCHAR(50) NOT NULL,
  `descripcion` LONGTEXT NOT NULL,
  `estado` VARCHAR(50) NOT NULL,
  `autor` INT NOT NULL,
  `fechayhora` DATETIME(6) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_articulo_subcategoria1`
    FOREIGN KEY (`sub_categoria`)
    REFERENCES `chacongt_DBWeb`.`subcategoria` (`nombre_sub`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_articulo_usuario`
    FOREIGN KEY (`autor`)
    REFERENCES `chacongt_DBWeb`.`usuario` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table dbo.bitacora
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`bitacora` (
  `id_bit` INT NOT NULL AUTO_INCREMENT,
  `id_art` INT NOT NULL,
  `id_user` INT NOT NULL,
  `cambios` LONGTEXT NULL,
  `fecha_mod` DATETIME(6) NOT NULL,
  PRIMARY KEY (`id_bit`),
  CONSTRAINT `FK_bitacora_articulo`
    FOREIGN KEY (`id_art`)
    REFERENCES `chacongt_DBWeb`.`articulo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_bitacora_usuario`
    FOREIGN KEY (`id_user`)
    REFERENCES `chacongt_DBWeb`.`usuario` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table dbo.categoria
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id`));

-- ----------------------------------------------------------------------------
-- Table dbo.img
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`img` (
  `id_img` INT NOT NULL AUTO_INCREMENT,
  `id_art` INT NOT NULL,
  `enlace` VARCHAR(100) NOT NULL,
  `fecha` DATE NOT NULL,
  `hora` TIME(6) NOT NULL,
  PRIMARY KEY (`id_img`),
  CONSTRAINT `FK_img_articulo`
    FOREIGN KEY (`id_art`)
    REFERENCES `chacongt_DBWeb`.`articulo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table dbo.met_pago
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`met_pago` (
  `id_metP` INT NOT NULL,
  `id_user` INT NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(12) NOT NULL,
  `correo` VARCHAR(50) NOT NULL,
  `pais` VARCHAR(20) NOT NULL,
  `direccion` VARCHAR(100) NOT NULL,
  `nit` VARCHAR(10) NULL,
  PRIMARY KEY (`id_metP`));

-- ----------------------------------------------------------------------------
-- Table dbo.pago
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`pago` (
  `id_metP` INT NOT NULL AUTO_INCREMENT,
  `nombtarjeta` VARCHAR(100) NOT NULL,
  `numtarjeta` VARCHAR(50) NOT NULL,
  `vencimiento` DATE NOT NULL,
  `cvv` VARCHAR(5) NOT NULL,
  CONSTRAINT `FK_pago_met_pago`
    FOREIGN KEY (`id_metP`)
    REFERENCES `chacongt_DBWeb`.`met_pago` (`id_metP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table dbo.subcategoria
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`subcategoria` (
  `nombre_sub` VARCHAR(50) NOT NULL,
  `id_categoria` INT NOT NULL,
  `descripcion` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`nombre_sub`),
  CONSTRAINT `FK_subcategoria_categoria`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `chacongt_DBWeb`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table dbo.suscripcion
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`suscripcion` (
  `id_sus` INT NOT NULL AUTO_INCREMENT,
  `fecha_sus` DATETIME(6) NOT NULL,
  PRIMARY KEY (`id_sus`),
  CONSTRAINT `FK_suscripcion_usuario`
    FOREIGN KEY (`id_sus`)
    REFERENCES `chacongt_DBWeb`.`usuario` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table dbo.tipo_usuario
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`tipo_usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(50) NOT NULL,
  `fecha_sus` DATETIME(6) NOT NULL,
  PRIMARY KEY (`id`));

-- ----------------------------------------------------------------------------
-- Table dbo.usuario
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chacongt_DBWeb`.`usuario` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `correo` VARCHAR(100) NOT NULL,
  `pass` VARCHAR(100) NOT NULL,
  `tip_user` INT NOT NULL,
  `estado` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`id_user`),
  CONSTRAINT `FK_usuario_tipo_usuario`
    FOREIGN KEY (`tip_user`)
    REFERENCES `chacongt_DBWeb`.`tipo_usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
SET FOREIGN_KEY_CHECKS = 1;
