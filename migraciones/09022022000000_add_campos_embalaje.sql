ALTER TABLE `embalajes` ADD `cantidad` INT NOT NULL DEFAULT '1' AFTER `nombre`, ADD `codunidadmedida` INT(2) NOT NULL DEFAULT '0' AFTER `cantidad`;