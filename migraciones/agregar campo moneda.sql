
/*este query agrega el campo "moneda" a la tabla "company_data".*/

ALTER TABLE company_data ADD moneda ENUM('ARS', 'EUR', 'USD') NULL DEFAULT 'EUR' AFTER zip_code;