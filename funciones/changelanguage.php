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
    private $_palabras = array(
        'factura' => array('Invoice', 'Factura', 'Faktura', 'Fattura', 'Fatura', 'Facture', 'Rechnung'),
        'nif' => array('nif', 'nif', 'nif', 'nif', 'nif', 'nif', 'nif'),
        'codigo_proveedor' => array('Supplier´s Code', 'Código del Proveedor', 'Kodeks dostawcy', 'Codice del fornitore', 'Código do Fornecedor', 'Code du fournisseur', 'Lieferantenkodex'),
        'fecha' => array('Date', 'Fecha', 'Data', 'Data', 'Data', 'Date', 'Datum'),
        'codigo_factura' => array('Invoice Code', 'Código de Factura', 'Kod Faktury', 'Codice della Fattura', 'Código de Fatura', 'Code de Facture', 'Rechnungscode'),
        'referencia' => array('Reference', 'Referencia', 'Referencyjny', 'Riferimento', 'Referência', 'Référence', 'Bezug'),
        'descripcion' => array('Description', 'Descripción', 'Opis', 'Descrizione', 'Descrição', 'Description', 'Beschreibung'),
        'cantidad' => array('Amount', 'Cantidad', 'Kwota', 'Quantità', 'Quantidade', 'Quantité', 'Betrag'),
        'precio' => array('Price', 'Precio', 'Cena', 'Prezzo', 'Preço', 'Prix', 'Preis'),
        'p_desc' => array('Discount', 'Descuento', 'Zniżka', 'Sconto', 'Desconto', 'Discount', 'Skonto'),
        'importe' => array('Amount', 'Importe', 'Ilość', 'Quantità', 'Quantia', 'Quantité', 'Betrag'),
        'euro' => array('Euro', 'Euro', 'Euro', 'Euro', 'Euro', 'Euro', 'Euro'),
        'euros' => array('Euros', 'Euros', 'Euros', 'Euros', 'Euros', 'Euros', 'Euros'),
        'base_imponible' => array('Taxable', 'Base Imponible', 'Opodatkowania', 'Imponibile', 'Tributábel', 'Imposable', 'Steuerpflichtig'),
        'couta_iva' => array('VAT fee', 'Cuota IVA', 'Opłata VAT', 'IVA', 'Taxa de IVA', 'Taxe de TVA', 'MwSt.-Gebühr'),
        'iva' => array('VAT', 'IVA', 'VAT', 'IVA', 'IVA', 'TVA', 'VAT'),
        'total' => array('Total', 'Total', 'Całkowity', 'Totale', 'Total', 'Total', 'Gesamt'),
        'albaran' => array('Delivery Note', 'Remito', 'Dowód Dostawy', 'Bolla d\'accompagnamento', 'Nota de Entrega', 'Bon de livraison', 'Lieferschein'),
        'cif_nif' => array('CIF/NIF', 'CIF/NIF', 'CIF/NIF', 'CIF/NIF', 'CIF/NIF', 'CIF/NIF', 'CIF/NIF'),
        'cod_cliente' => array('Customer Code', 'Código de Cliente', 'Kod Klienta', 'Codice Cliente', 'Código do Cliente', 'Code Client', 'Kundennummer'),
        'cod_albaran' => array('Delivery Note Code', 'Código de Remito', 'Kod Przekazu', 'Codice di Rimessa', 'Código de Nota de Entrega', 'Code de Remise', 'Überweisungscode'),
        'listado_de_articulos' => array('List of Items', 'Lista de Artículos', 'Lista Rzeczy', 'Elenco degli Articoli', 'Lista de Artigos', 'Liste d\'objets', 'Liste von Gegenständen'),
        'item' => array('Item', 'Item', 'Przedmiot', 'Articolo', 'Item', 'Article', 'Artikel'),
        'familia' => array('Family', 'Familia', 'Rodzina', 'Famiglia', 'Família', 'Famille', 'Familie'),
        'cod_articulo' => array('Item Code', 'Código de Item', 'Kod Produktu', 'Codice Articolo', 'Código do Item', 'Code de l\'article', 'Produktcode'),
        'p_tienda' => array('Store Price', 'Precio en Tienda', 'Cena w Sklepie', 'Prezzo in Negozio', 'Preço da Loja', 'Prix du Magasin', 'Ladenpreis'),
        'p_compra' => array('Purchase Price', 'Precio de Compra', 'Cena Zakupu', 'Prezzo d\'Acquisto', 'Preço de Aquisição', 'Prix d\'Achat', 'Kaufpreis'),
        'stock' => array('Stock', 'Stock', 'Zbiory', 'Stock', 'Estoque', 'Stocker', 'Vorrat'),
        'total_costo_almacen' => array('Total Warehouse Cost', 'Total Costo Almacen', 'Całkowity Koszt Magazynu', 'Costo Totale di Magazzino', 'Custo Total de Armazém', 'Coût Total de l\'Entrepôt', 'Gesamtlagerkosten'),
        'p_almacen' => array('Warehouse Price', 'Precio de Almacén', 'Cena Magazynowa', 'Prezzo di Magazzino', 'Preço de Armazém', 'Prix ​​d\'entrepôt', 'Lagerpreis'),
        'total_almacen' => array('Total Warehouse', 'Total Almacén', 'Całkowity Magazyn', 'Magazzino Totale', 'Armazém Total', 'Entrepôt Total', 'Gesamtlager'),
        'listado_articulos_por_familia' => array('List of Items by Family', 'Listado de Artículos por Familia', 'Lista Przedmiotów Według Rodziny', 'Elenco di Articoli per Famiglia', 'Lista de Itens por Família', 'Liste des Articles par Famille', 'Liste der Artikel nach Familie'),
        'listado_articulos_proveedores' => array('List of Items by Supplier', 'Lista de Artículos por Proveedor', 'Lista Pozycji Według Dostawcy', 'Elenco degli Articoli per Fornitore', 'Lista de Itens por Fornecedor', 'Liste des Articles par Fournisseur', 'Liste der Artikel nach Lieferanten'),
        'listado_articulo_ubicacion' => array('List of Items by Location', 'Listado de Artículos por Ubicación', 'Lista Przedmiotów Według Lokalizacji', 'Elenco di Articoli per Posizione', 'Lista de Itens por Localização', 'Liste des Articles par Emplacement', 'Liste der Artikel nach Standort'),
        'listado_articulos_tienda' => array('Store Item List', 'Lista de Artículos de la Tienda', 'Lista Przedmiotów w Sklepie', 'Elenco Articoli del Negozio', 'Lista de Itens da Loja', 'Liste des Articles du Magasin', 'Artikelliste Speichern'),
        'listado_articulos_bajo_minimos' => array('List of Items under Minimun Stock', 'Lista de Artículos bajo stock Mínimo', 'Lista Pozycji Poniżej Minimalnego Zapasu', 'Elenco degli Articoli in Scorte Minime', 'Lista de Itens com Stoque Mínimo', 'Liste des Articles sous Stock Minimum', 'Liste der Artikel unter Mindestbestand'),
        'bajo_minimos' => array('Low Minimum', 'Bajo Mínimo', 'Niskie Minimum', 'Basso Minimo', 'Mínimo Baixo', 'Minimum Bas', 'Niedriges Minimum'),
        'costo' => array('Cost', 'Costo', 'Koszt', 'Costo', 'Custo', 'Coût', 'Kosten'),
        'cod_artculo' => array('Item Code', 'Código de Item', 'Kod Produktu', 'Codice Articolo', 'Código do Iten', 'Code de l\'article', 'Produktcode'),
        'cod_factura' => array('Invoice Code', 'Código de Factura', 'Kod Faktury', 'Codice Fattura', 'Código de Fatura', 'Code de Facture', 'Rechnungscode'),
        'lista_articulos_tienda' => array('Store Item List', 'Lista de Artículos Tienda', 'Lista Przedmiotów w Sklepie', 'Elenco Articoli del Negozio', 'Lista de Items da Loja', 'Liste des Articles du Magasin', 'Artikelliste Speichern'),
        'p_compra_tienda' => array('Store Purchase Price', 'Precio de Compra en Tienda', 'Cena Zakupu w Sklepie', 'Prezzo di Acquisto in Negozio', 'Preço de Compra na Loja', 'Prix d\'Achat en Magasin', 'Shop-Einkaufspreis'),
        'precio_pvp' => array('Retail Price', 'Precio PVP', 'Cena Detaliczna', 'Prezzo al Dettaglio', 'Preço de Varejo', 'Prix en Détail', 'Endverbraucherpreis'),
        'codeka' => array('CODEKA', 'CODEKA', 'CODEKA', 'CODEKA', 'CODEKA', 'CODEKA', 'CODEKA'),
        'c_nro_ticket' => array('Ticket N°', 'Ticket N°', 'Biletu N°', 'Biglietto N°', 'Ingresso N°', 'N° de billet', 'Ticket-Nr.'),
        'tel' => array('Phone', 'Tel', 'Telefon', 'Telefono', 'Telefone', 'Téléphone', 'Telefon'),
        'ticket_nro' => array('Ticket N°', 'Ticket N°', 'Biletu N°', 'Biglietto N°', 'Ingresso N°', 'N° de billet', 'Ticket-Nr.'),
        'forma_pago' => array('Payment Method', 'Forma de Pago', 'Metoda Płatności', 'Metodo di Pagamento', 'Forma de Pagamento', 'Mode de Paiement', 'Bezahlverfahren'),
        'precio_unitario' => array('Price by Unit', 'Precio por Unidad', 'Cena za Sztukę', 'Prezzo per Unità', 'Preço por Unidade', 'Prix par Unité', 'Preis pro Einheit'),
        'articulo' => array('Item', 'Artículo', 'Artykuł', 'Articolo', 'Artigo', 'Article', 'Artikel'),
        'cant' => array('Quantity', 'Cantidad', 'Ilość', 'Quantità', 'Quantidade', 'Quantité', 'Menge'),
        'gracias_visita' => array('Thanks for your visit', 'Gracias por su visita', 'Dziękuję za Twoją wizytę', 'Grazie per la tua visita', 'Obrigado por sua visita', 'Merci pour votre visite', 'Danke für deinen Besuch'),
        'total_impuestos' => array('Total Taxes', 'Total de impuestos', 'polski', 'italian', 'Total de Impuestos', 'frances', 'Aleman'),
        'total_pagar' => array('Total to pay', 'Total a pagar', 'Łącznie do zapłaty', 'Totale da pagare', 'Total a Pagar', 'Total a payer', 'Gesamtbetrag'),
        'pagado' => array('Paid Out', 'Pagado', 'Wypłacone', 'Pagato', 'Pago', 'Payé', 'Ausbezahlt'),
        'a_devolver' => array('To return', 'A devolver', 'Wracać', 'Ritornare', 'Para Retornar', 'Rendre', 'Zurückgeben'),
        'listado_tipos_impuestos' => array('List of Tax Types', 'Lista de Tipos de Impuestos', 'Lista rodzajów podatków', 'Elenco dei tipi di imposta', 'Lista de Tipos de Imposto', 'Liste des types de taxes', 'Liste der Steuerarten'),
        'listado_proveedores' => array('List of Suppliers', 'Listado de Proveedores', 'Lista dostawców', 'Elenco dei fornitori', 'Lista de Fornecedores', 'Liste des fournisseurs', 'Liste der Lieferanten'),
        'nombre' => array('Name', 'Nombre', 'Nazwa', 'Nome', 'Nome', 'Nom', 'Name'),
        'localidad' => array('Location', 'Localidad', 'Lokalizacja', 'Posizione', 'Localização', 'Localité', 'Standort'),
        'direccion' => array('Address', 'Dirección', 'Adres', 'Indirizzo', 'Endereço', 'Adresse', 'Anschrift'),
        'listado_ubicaciones' => array('List of Locations', 'Listado de Ubicaciones', 'Lista lokalizacji', 'Elenco delle località', 'Lista de Locais', 'Liste des emplacements', 'Liste der Standorte'),
        'cod_ubicacion' => array('Location Code', 'Código de Ubicación', 'Kod lokalizacji', 'Codice posizione', 'Código de localização', 'Code de localisation', 'Standortcode'),
    );

    public function __construct()
    {
        $this->_lang_code =  ( isset($_GET[ChangeLanguage::REQUEST_VAR]) && in_array(trim($_GET[ChangeLanguage::REQUEST_VAR]), $this->_codigos_validos) ) ? trim($_GET[self::REQUEST_VAR]) : self::DEFAULT_LANG;
        $this->_lang_indice = intval(array_search($this->_lang_code,$this->_codigos_validos));
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
