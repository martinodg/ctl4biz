START TRANSACTION;
--
--  Estructura  la vista  `listado_articulos_alias`
--

CREATE VIEW  listado_articulos_alias AS
SELECT
    articulos.codarticulo ,
    articulos.codfamilia,
    articulos.referencia,
    articulos.descripcion,
    articulos.impuesto,
    articulos.codproveedor1,
    articulos.codproveedor2,
    articulos.codproveedor3,
    articulos.codproveedor4,
    articulos.descripcion_corta,
    articulos.codubicacion,
    articulos.stock,
    articulos.codunidadmedida,
    articulos.stock_minimo,
    articulos.codumstock_minimo,
    articulos.aviso_minimo,
    articulos.datos_producto,
    articulos.fecha_alta,
    articulos.codembalaje,
    articulos.unidades_caja,
    articulos.codumunidades_caja,
    articulos.precio_ticket,
    articulos.modificar_ticket,
    articulos.observaciones,
    articulos.precio_compra,
    articulos.precio_almacen,
    articulos.precio_tienda,
    articulos.precio_pvp,
    articulos.precio_iva,
    articulos.codigobarras,
    articulos.imagen,
    articulos.borrado,
    familias.nombre AS nombrefamilia
FROM articulos
JOIN familias ON  articulos.codfamilia = familias.codfamilia 
UNION 
    SELECT
    articulos.codarticulo ,
    articulos.codfamilia,
    articulos.referencia,
    alias_articulos.alias AS descripcion,
    articulos.impuesto,
    articulos.codproveedor1,
    articulos.codproveedor2,
    articulos.codproveedor3,
    articulos.codproveedor4,
    articulos.descripcion_corta,
    articulos.codubicacion,
    articulos.stock,
    articulos.codunidadmedida,
    articulos.stock_minimo,
    articulos.codumstock_minimo,
    articulos.aviso_minimo,
    articulos.datos_producto,
    articulos.fecha_alta,
    articulos.codembalaje,
    articulos.unidades_caja,
    articulos.codumunidades_caja,
    articulos.precio_ticket,
    articulos.modificar_ticket,
    articulos.observaciones,
    articulos.precio_compra,
    articulos.precio_almacen,
    articulos.precio_tienda,
    articulos.precio_pvp,
    articulos.precio_iva,
    articulos.codigobarras,
    articulos.imagen,
    articulos.borrado,
    familias.nombre AS nombrefamilia
FROM articulos   
JOIN familias ON  articulos.codfamilia = familias.codfamilia 
JOIN alias_articulos ON  alias_articulos.codarticulo = articulos.codarticulo;

--
-- Estructura  la vista `listado_articulos_precios_alias`
--

CREATE VIEW  listado_articulos_precios_alias AS 
SELECT
    artpro.codproveedor,
    artpro.precio AS pcosto,
    articulos.codarticulo ,
    articulos.codfamilia,
    articulos.referencia,
    articulos.descripcion,
    articulos.impuesto,
    articulos.codproveedor1,
    articulos.codproveedor2,
    articulos.codproveedor3,
    articulos.codproveedor4,
    articulos.descripcion_corta,
    articulos.codubicacion,
    articulos.stock,
    articulos.codunidadmedida,
    articulos.stock_minimo,
    articulos.codumstock_minimo,
    articulos.aviso_minimo,
    articulos.datos_producto,
    articulos.fecha_alta,
    articulos.codembalaje,
    articulos.unidades_caja,
    articulos.codumunidades_caja,
    articulos.precio_ticket,
    articulos.modificar_ticket,
    articulos.observaciones,
    articulos.precio_compra,
    articulos.precio_almacen,
    articulos.precio_tienda,
    articulos.precio_pvp,
    articulos.precio_iva,
    articulos.codigobarras,
    articulos.imagen,
    articulos.borrado,
    familias.nombre AS nombrefamilia
FROM articulos
JOIN familias ON  articulos.codfamilia = familias.codfamilia 
JOIN artpro ON  articulos.codarticulo =  articulos.codarticulo 
WHERE articulos.borrado = 0        
AND artpro.codfamilia = articulos.codfamilia 
UNION     
    SELECT
    artpro.codproveedor,
    artpro.precio AS pcosto,
    articulos.codarticulo ,
    articulos.codfamilia,
    articulos.referencia,
    alias_articulos.alias AS descripcion,
    articulos.impuesto,
    articulos.codproveedor1,
    articulos.codproveedor2,
    articulos.codproveedor3,
    articulos.codproveedor4,
    articulos.descripcion_corta,
    articulos.codubicacion,
    articulos.stock,
    articulos.codunidadmedida,
    articulos.stock_minimo,
    articulos.codumstock_minimo,
    articulos.aviso_minimo,
    articulos.datos_producto,
    articulos.fecha_alta,
    articulos.codembalaje,
    articulos.unidades_caja,
    articulos.codumunidades_caja,
    articulos.precio_ticket,
    articulos.modificar_ticket,
    articulos.observaciones,
    articulos.precio_compra,
    articulos.precio_almacen,
    articulos.precio_tienda,
    articulos.precio_pvp,
    articulos.precio_iva,
    articulos.codigobarras,
    articulos.imagen,
    articulos.borrado,
    familias.nombre AS nombrefamilia
FROM articulos   
JOIN familias ON  articulos.codfamilia = familias.codfamilia 
JOIN artpro ON  articulos.codarticulo =  articulos.codarticulo 
JOIN alias_articulos ON  alias_articulos.codarticulo = articulos.codarticulo
WHERE articulos.borrado = 0        
AND artpro.codfamilia = articulos.codfamilia ;

COMMIT;