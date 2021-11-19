<?php

class ChangeLanguage
{
    const DEFAULT_LANG = 'es';
    const REQUEST_VAR = 'lang';

    /** @var string $_lang_code */
    private $_lang_code;

    /** @var string $_lang_indice */
    private $_lang_indice;

    /** @var string[] Codigos de idioma */
    private $_codigos_validos = array('en', 'es', 'pl', 'it', 'pt', 'fr', 'de');

    /** @var array  palabras */
    private $_palabras = array(
        'factura' => array('Invoice', 'Factura', "polski", "italian", "Fatura", "frances", "Aleman"),
        'nif' => array('ingles', 'nif', "polski", "italian", "portugues", "frances", "Aleman"),
        'codigo_proveedor' => array('Supplier´s Code', 'Cod Proveedor', "polski", "italian", "Código de Fornecedor", "frances", "Aleman"),
        'fecha' => array('Date', 'Fecha', "polski", "italian", "Data", "frances", "Aleman"),
        'codigo_factura' => array('Invoice Code', 'Cod. Factura', "polski", "italian", "Código de Fatura", "frances", "Aleman"),
        'referencia' => array('Reference', 'Referencia', "polski", "italian", "Referência", "frances", "Aleman"),
        'descripcion' => array('Description', 'Descripción', "polski", "italian", "Descrição", "frances", "Aleman"),
        'cantidad' => array('Amount', 'Cantidad', "polski", "italian", "Quantidade", "frances", "Aleman"),
        'precio' => array('Price', 'Precio', "polski", "italian", " Preço", "frances", "Aleman"),
        'p_desc' => array('Discount', 'Descuento', "polski", "italian", "Desconto", "frances", "Aleman"),
        'importe' => array('Amount', 'Importe', "polski", "italian", "Quantia", "frances", "Aleman"),
        'euro' => array('ingles', 'Euro', "polski", "italian", "portugues", "frances", "Aleman"),
        'euros' => array('ingles', 'Euros', "polski", "italian", "portugues", "frances", "Aleman"),
        'base_imponible' => array('Taxable', 'Base Imponible', "polski", "italian", "Tributábel", "frances", "Aleman"),
        'couta_iva' => array('ingles', 'Cuota IVA', "polski", "italian", "portugues", "frances", "Aleman"),
        'iva' => array('ingles', 'iva', "polski", "italian", "portugues", "frances", "Aleman"),
        'total' => array('Total', 'Total', "polski", "italian", "Total", "frances", "Aleman"),
        'albaran' => array('Delivery Note', 'Remito', "polski", "italian", "Nota de Entrega", "frances", "Aleman"),
        'cif_nif' => array('ingles', 'CIF/NIF', "polski", "italian", "portugues", "frances", "Aleman"),
        'cod_cliente' => array('Customer Code', 'Código de Cliente', "polski", "italian", "Código do Cliente", "frances", "Aleman"),
        'cod_albaran' => array('Delivery note Code', 'Código de Remito', "polski", "italian", "Código de Nota de Entrega", "frances", "Aleman"),
        'listado_de_articulos' => array('List of Items', 'Lista de Artículos', "polski", "italian", "Lista de Artigos", "frances", "Aleman"),
        'item' => array('Item', 'Item', "polski", "italian", "Item", "frances", "Aleman"),
        'familia' => array('Family', 'Família', "polski", "italian", "Família", "frances", "Aleman"),
        'cod_articulo' => array('Item Code', 'Código de Item', "polski", "italian", "Código do Item", "frances", "Aleman"),
        'p_tienda' => array('Store Price', 'Precio Tienda', "polski", "italian", "Preço da Loja", "frances", "Aleman"),
        'p_compra' => array('Purchase Price', 'Precio de Compra', "polski", "italian", "preço de aquisição", "frances", "Aleman"),
        'stock' => array('Stock', 'Stock', "polski", "italian", "Estoque", "frances", "Aleman"),
        'total_costo_almacen' => array('ingles', 'Total Costo Almacen', "polski", "italian", "portugues", "frances", "Aleman"),
        'p_almacen' => array('ingles', 'P. Almacén', "polski", "italian", "portugues", "frances", "Aleman"),
        'total_almacen' => array('ingles', '"Total Almacen"', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_articulos_por_familia' => array('List of Items by Family', 'Listado de Artículos por Familia', "polski", "italian", "Lista de Itens por Família", "frances", "Aleman"),
        'listado_articulos_proveedores' => array('List of Items by Supplier', 'Lista de Artículos por Proveedor', "polski", "italian", "Lista de Itens por Fornecedor", "frances", "Aleman"),
        'listado_articulo_ubicacion' => array('List of Items by Location', 'Listado de Artículos por Ubicación', "polski", "italian", "Lista de itens por localização", "frances", "Aleman"),
        'listado_articulos_tienda' => array('ingles', 'Lista de Articulos Tienda', "polski", "italian", "portugues", "frances", "Aleman"),
        'listado_articulos_bajo_minimos' => array('List of Items under Minimun Stock', 'Lista de Artículos bajo stock Mínimo', "polski", "italian", "Lista de Itens com Stoque MInimo", "frances", "Aleman"),
        'bajo_minimos' => array('ingles', 'Bajo mínimos', "polski", "italian", "portugues", "frances", "Aleman"),
        'costo' => array('Cost', 'Costo', "polski", "italian", "Custo", "frances", "Aleman"),
        'cod_artculo' => array('Item Code', 'Código de Item', "polski", "italian", "Código do Iten", "frances", "Aleman"),
        'cod_factura' => array('Invoice Code', 'Código de Factura', "polski", "italian", "Código de Fatura", "frances", "Aleman"),
        'lista_articulos_tienda' => array('Store Item List', 'Lista de Artículos Tienda', "polski", "italian", "Lista de Items da Loja", "frances", "Aleman"),
        'p_compra_tienda' => array('ingles', 'P. Compra Tienda', "polski", "italian", "portugues", "frances", "Aleman"),
        'precio_pvp' => array('ingles', 'Precio PVP', "polski", "italian", "portugues", "frances", "Aleman"),
        'codeka' => array('ingles', 'CODEKA', "polski", "italian", "portugues", "frances", "Aleman"),
        'c_nro_ticket' => array('ingles', 'C/. XXXXXX', "polski", "italian", "portugues", "frances", "Aleman"),
        'tel' => array('ingles', 'Tel', "polski", "italian", "portugues", "frances", "Aleman"),
        'ticket_nro' => array('ingles', 'TICKET N', "polski", "italian", "portugues", "frances", "Aleman"),
        'forma_pago' => array('Payment Method', 'Forma de Pago', "polski", "italian", "Forma de Pagamento", "frances", "Aleman"),
        'precio_unitario' => array('ingles', 'Precio', "polski", "italian", "portugues", "frances", "Aleman"),
        'articulo' => array('Item', 'Artículo', "polski", "italian", "Item", "frances", "Aleman"),
        'cant' => array('Quantity', 'Cantidad', "polski", "italian", "Quantia", "frances", "Aleman"),
        'gracias_visita' => array('ingles', 'Gracias por su visita', "polski", "italian", "portugues", "frances", "Aleman"),
        'total_impuestos' => array('Total Taxes', 'Total de impuestos', "polski", "italian", "Total de Impuestos", "frances", "Aleman"),
        'total_pagar' => array('Total to pay', 'Total a pagar', "polski", "italian", "Total a Pagar", "frances", "Aleman"),
        'pagado' => array('Paid Out', 'Pagado', "polski", "italian", "Pago", "frances", "Aleman"),
        'a_devolver' => array('To return', 'A devolver', "polski", "italian", "Para Retornar", "frances", "Aleman"),
        'listado_tipos_impuestos' => array('List of Tax Types', 'Lista de Tipos de Impuestos', "polski", "italian", "Lista de Tipos de Imposto", "frances", "Aleman"),
        'listado_proveedores' => array('List of Suppliers', 'Listado de Proveedores', "polski", "italian", "Lista de Fornecedores", "frances", "Aleman"),
        'nombre' => array('Name', 'Nombre', "polski", "italian", "Nome", "frances", "Aleman"),
        'localidad' => array('ingles', 'Localidad', "polski", "italian", "portugues", "frances", "Aleman"),
        'direccion' => array('Address', 'Dirección', "polski", "italian", "Endereço", "frances", "Aleman"),
        'listado_ubicaciones' => array('List of Locations', 'Listado de Ubicaciones', "polski", "italian", "Lista de Locais", "frances", "Aleman"),
        'cod_ubicacion' => array('Location Code', 'Código de Ubicación', "polski", "italian", "Código de localização", "frances", "Aleman")

    );

    public function __construct()
    {
        $this->_lang_code =  ( isset($_GET[ChangeLanguage::REQUEST_VAR]) && in_array(trim($_GET[ChangeLanguage::REQUEST_VAR]), $this->_codigos_validos) ) ? trim($_GET[self::REQUEST_VAR]) : self::DEFAULT_LANG;
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
