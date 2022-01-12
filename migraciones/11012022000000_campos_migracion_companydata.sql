START TRANSACTION;
--
-- Actualizacion de las tabla company_data
--
ALTER TABLE `company_data`
    ADD `razon_soc` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL AFTER `id`;
    ADD `moneda_id` INT(11) NOT NULL AFTER `zip_code`,
    ADD `cod_fiscal` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL AFTER `moneda_id`,
    ADD `leyenda` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL AFTER `cod_fiscal`,
    ADD `logo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL AFTER `leyenda`;

COMMIT;
--
-- Poniendo las monedas en EUR
--
UPDATE `company_data` SET `moneda_id` = '3' WHERE `company_data`.`id` = 0;