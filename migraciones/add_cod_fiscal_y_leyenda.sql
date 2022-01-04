/*
query que agrega los campos "cod_fiscal" y "leyenda"
*/
ALTER TABLE company_data ADD `cod_fiscal` INT NOT NULL AFTER moneda, ADD leyenda TEXT NOT NULL AFTER cod_fiscal;