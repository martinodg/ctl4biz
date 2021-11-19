<?php

class ChangeLanguage
{
    const DEFAULT_LANG = 'es';
    const REQUEST_VAR = 'lang';

    /** @var string $_lang_code */
    private $_lang_code ;

    /** @var string $_lang_indice */
    private $_lang_indice ;

    /** @var string[] Codigos de idioma  */
    private $_codigos_validos = array('en','es','pl','it','pt','fr','de') ;

    /** @var array  palabras */
    private  $_palabras = array(
        'factura' => array('ingles','factura', "polski", "italian", "portugues", "frances", "Aleman"),
        'nif' => array('ingles','nif', "polski", "italian", "portugues", "frances", "Aleman"),
        'codigo_proveedor' => array('ingles','Cod. Proveedor', "polski", "italian", "portugues", "frances", "Aleman"),
        'fecha' => array('ingles','Fecha', "polski", "italian", "portugues", "frances", "Aleman"),
        'codigo_factura' => array('ingles','Cod. Factura', "polski", "italian", "portugues", "frances", "Aleman"),
        'referencia' => array('ingles','Referencia', "polski", "italian", "portugues", "frances", "Aleman"),
        'descripcion' => array('ingles','Descripcion', "polski", "italian", "portugues", "frances", "Aleman"),
        'cantidad' => array('ingles','Cantidad', "polski", "italian", "portugues", "frances", "Aleman"),
        'precio' => array('ingles','Precio', "polski", "italian", "portugues", "frances", "Aleman"),
        'p_desc' => array('ingles','% Desc.', "polski", "italian", "portugues", "frances", "Aleman"),
        'importe' => array('ingles','Importe', "polski", "italian", "portugues", "frances", "Aleman"),
        'euro' => array('ingles','Euro', "polski", "italian", "portugues", "frances", "Aleman"),
        'euros' => array('ingles','Euros', "polski", "italian", "portugues", "frances", "Aleman"),
        'base_imponible' => array('ingles','Base imponible', "polski", "italian", "portugues", "frances", "Aleman"),
        'couta_iva' => array('ingles','Cuota IVA', "polski", "italian", "portugues", "frances", "Aleman"),
        'iva' => array('ingles','iva', "polski", "italian", "portugues", "frances", "Aleman"),
        'total' => array('ingles','total', "polski", "italian", "portugues", "frances", "Aleman"),
        'albaran' => array('ingles','Albaran', "polski", "italian", "portugues", "frances", "Aleman"),
        'cif_nif' => array('ingles','CIF/NIF', "polski", "italian", "portugues", "frances", "Aleman"),
        'cod_cliente' => array('ingles','Cod. Cliente', "polski", "italian", "portugues", "frances", "Aleman"),
        'cod_albaran' => array('ingles','Cod. Albaran', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_de_articulos' => array('ingles','Listado de Articulos', "polski", "italian", "portugues", "frances", "Aleman"),
        'item' => array('ingles','Item', "polski", "italian", "portugues", "frances", "Aleman"),
        'familia' => array('ingles','Familia', "polski", "italian", "portugues", "frances", "Aleman"),
        'cod_articulo' => array('ingles','Cod. Articulo', "polski", "italian", "portugues", "frances", "Aleman"),
        'p_tienda' => array('ingles','P. Tienda', "polski", "italian", "portugues", "frances", "Aleman"),
        'p_compra' => array('ingles','P. Compra', "polski", "italian", "portugues", "frances", "Aleman"),
        'stock' => array('ingles','Stock', "polski", "italian", "portugues", "frances", "Aleman"),
        'total_costo_almacen' => array('ingles','Total Costo Almacen', "polski", "italian", "portugues", "frances", "Aleman"),
        'p_almacen' => array('ingles','P. Almacen', "polski", "italian", "portugues", "frances", "Aleman"),
        'total_almacen' => array('ingles','"Total Almacen"', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_articulos_por_familia' => array('ingles','Listado de Articulos por Familia', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_articulos_proveedores' => array('ingles','Listado de Articulos por Proveedor', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_articulo_ubicacion' => array('ingles','Listado de Articulos por Ubicacion', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_articulos_tienda' => array('ingles','Lista de Articulos Tienda', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_articulos_bajo_minimos' => array('ingles','Listado de Articulos bajo minimos', "polski", "italian", "portugues", "frances", "Aleman"),
        'bajo_minimos' => array('ingles','Bajo minimos', "polski", "italian", "portugues", "frances", "Aleman"),
        'costo' => array('ingles','Costo', "polski", "italian", "portugues", "frances", "Aleman"),
        'cod_artculo' => array('ingles','Cod. Articulo', "polski", "italian", "portugues", "frances", "Aleman"),
        'cod_factura' => array('ingles','Cod. Factura', "polski", "italian", "portugues", "frances", "Aleman"),
        'lista_articulos_tienda' => array('ingles','Lista de Articulos Tienda', "polski", "italian", "portugues", "frances", "Aleman"),
        'p_compra_tienda' => array('ingles','P. Compra Tienda', "polski", "italian", "portugues", "frances", "Aleman"),
        'precio_pvp' => array('ingles','Precio PVP', "polski", "italian", "portugues", "frances", "Aleman"),
        'codeka' => array('ingles','CODEKA', "polski", "italian", "portugues", "frances", "Aleman"),
        'c_nro_ticket' => array('ingles','C/. XXXXXX', "polski", "italian", "portugues", "frances", "Aleman"),
        'tel' => array('ingles','Tel', "polski", "italian", "portugues", "frances", "Aleman"),
        'ticket_nro' => array('ingles','TICKET N', "polski", "italian", "portugues", "frances", "Aleman"),
        'forma_pago' => array('ingles','Forma Pago', "polski", "italian", "portugues", "frances", "Aleman"),
        'precio_unitario' => array('ingles','Precio Unitario', "polski", "italian", "portugues", "frances", "Aleman"),
        'articulo' => array('ingles','Articulo', "polski", "italian", "portugues", "frances", "Aleman"),
        'cant' => array('ingles','cant', "polski", "italian", "portugues", "frances", "Aleman"),
        'gracias_visita' => array('ingles','Gracias por su visita', "polski", "italian", "portugues", "frances", "Aleman"),
        'total_impuestos' => array('ingles','Total impuestos', "polski", "italian", "portugues", "frances", "Aleman"),
        'total_pagar' => array('ingles','Total a pagar', "polski", "italian", "portugues", "frances", "Aleman"),
        'pagado' => array('ingles','Pagado', "polski", "italian", "portugues", "frances", "Aleman"),
        'a_devolver' => array('ingles','A devolver', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_tipos_impuestos' => array('ingles','Listado de Tipos de Impuestos', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_proveedores' => array('ingles','Listado de Proveedores', "polski", "italian", "portugues", "frances", "Aleman"),
        'nombre' => array('ingles','Nombre', "polski", "italian", "portugues", "frances", "Aleman"),
        'localidad' => array('ingles','Localidad', "polski", "italian", "portugues", "frances", "Aleman"),
        'direccion' => array('ingles','Direccion', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_ubicaciones' => array('ingles','Listado de Ubicaciones', "polski", "italian", "portugues", "frances", "Aleman"),
        'cod_ubicacion' => array('ingles','Cod. Ubicacion', "polski", "italian", "portugues", "frances", "Aleman"),
        'fecha' => array('ingles','Fecha', "polski", "italian", "portugues", "frances", "Aleman"),
        'fecha' => array('ingles','Fecha', "polski", "italian", "portugues", "frances", "Aleman"),
    );


    public function __construct()
    {
        $this->_lang_code =  ( isset($_GET[self::REQUEST_VAR]) && in_array(trim($_GET[self::REQUEST_VAR]), $this->_codigos_validos) ) ? trim($_GET[self::REQUEST_VAR]) : self::DEFAULT_LANG;
        $this->_lang_indice = intval(array_search($this->_lang_code,$this->_palabras));
    }

    /**
     * Retorna una traducción
     * @param string $key Palabra que se busca
     * @return string
     */
    function t($key)
    {
        return (isset($this->_palabras[$key][$this->_lang_indice])) ? $this->_palabras[$key][$this->_lang_indice] : $this->_lang_code;
    }

    /**
     * Retorna una traducción en mayuscula
     * @param string $key Palabra que se busca
     * @return string
     */
    function tu($key)
    {
        return strtoupper($this->t($key));
    }

    /**
     * Retorna una traducción en mayuscula
     * @param string $key Palabra que se busca
     * @return string
     */
    function tc($key)
    {
        return ucfirst($this->t($key));
    }
}
