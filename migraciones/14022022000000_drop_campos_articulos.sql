START TRANSACTION;
ALTER TABLE `articulos`
DROP `unidades_caja`,
DROP `codumunidades_caja`;
COMMIT;