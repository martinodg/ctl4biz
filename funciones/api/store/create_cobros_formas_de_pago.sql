#Vista para tomar los datos para el cobro
CREATE VIEW cobros_formapago AS
SELECT cobros.fechacobro , UNIX_TIMESTAMP(cobros.fechacobro) as UNIX, formapago.nombrefp AS nombre, SUM(cobros.importe) AS importe
FROM  cobros
          JOIN formapago ON formapago.codformapago = cobros.codformapago
GROUP BY formapago.codformapago, cobros.fechacobro
ORDER BY cobros.fechacobro;