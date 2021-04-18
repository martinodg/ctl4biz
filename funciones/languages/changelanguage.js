//evitar el mensaje de error
var cursor='hand';
function getTranslationText(name)
{
    var traductions = {
        //"variable_name":["english","espanol","polski","italian","portugues","frances","Aleman"],
        "company_name":["Company name:", "Compañia:","Nazwa Firma:"],
        "nombre":["your name:", "nombre del usuario:","Nazwa Uzytkownika"],
        "nombcliente":["Customer Name", "Nombre Cliente","Nazwa klienta","Nome del cliente","nome do cliente","Nom du client","Kundenname"],
        //@todo revisar que esta esta repetida pero usada
        "nomb":["Name","nombre","Nazwa","Nome","Nome","Nom","Name"],
        "emailValidation":["e-mail validation:", "validación del email:","Weryficacja adresu"],
        "password":["password:", "clave:", "haslo"],
        "passwordValidation":["password validation:", "validación de la clave:","Weryficacja Hasla"],
        "member":["Already a member?", "Ya eres miembro?","Jestes juz czlonkiem"],
        "golo":["Go to Login", "Ir a página de acceso","przejdz do logowania"],
        "sub":["Submit", "Enviar","Zatwierdz"],
        "details":["Enter Login Details", "Complete los datos de Acceso","Wprrowadz dane logowania"],
        "companyCode":["Company code:", "Código de la compañia:","kod frimowy"],
        "signin":["Sign in Now!", "Inscribete ahora!","Spewam teraz"],
        "noMember":["Not a member yet?", "Aún no eres miembro?","nie jestes jeszcze chlonkiem"],
        "copiasRespaldo":["Backups management", "Gestionar Backup","zarzadzanie kolpiami"],
        "hacerrespaldo":["Create Backup Copy", "Hacer Backup","Tworzenie kopii"],
        "restaurarrespaldo":["Restore Backup", "Restaurar Backup","przywracanie kopii"],
        "AdminSeguridad":["Security Administration", "Configuración de Seguridad","administrowanie bezpieczeństwem"],
        "usuarios":["Users", "Usuarios","użytkowników"],
    //    "roles":["Roles", "Roles","role"],
        "recursos":["Resources", "recursos","zasoby"],
        "ventas_plus":["Sales +", "ventas +","sprzedaż +"],
        "ventas":["Sales", "ventas","sprzedaż"],
        "venta_a_mostrador":["Point of Sales", "venta en mostrador","Punkt sprzedaży"],
    //    "factura":["Invoice", "Factura","faktura"],
        "remitos":["Delivery Notes", "Remitos","Dowód dostawy"],
        "facturar_remitos":["Convert DN to Invoice", "Facturar remitos","konwertować dowód dostawy na fakturę"],
        "presupuestos":["Budget", "Presupuestos","budżet"],
        "contabilidad_plus":["Book Keeping +", "Contabilidad +","księgowość +"],
        "contabilidad":["Book keeping", "Contabilidad","księgowość"],
        "codremito":["delivery note code","código de remito","kod listu przewozowego","codice nota d invio","código da nota de envio","code du bon de livraison","Versandscheincode"],
        "fecha":["date","fecha","data"],
        "aceptar":["Agree","Aceptar","Zgodzić się"],
        "buscarremito":["Search derivery note","buscar remito","Szukaj odnoszą","Cerca riferimento","Busca referem","Recherche reportez-vous","Suchen beziehen"],
        "cod_cliente":["client code","codigo de cliente","kod klienta","codice client","Código do cliente","code client","Client-Code"],
       // "estado":["condition","estado ","stan: schorzenie","condizione","doença","état","Bedingung"],
        "facturados":["invoiced","facturados","zafakturowanymi","fatturate","facturado","facturé","fakturieren"],
        "limp":["clean up","limpiar","sprzątać","pulire","limpar","nettoyer","Aufräumen"],
        "busc":["search","buscar","Szukaj","ricerca","procurar","chercher","Suche"],
        "eliminarRto":["Delete Delivery Note","Eliminar Remito","usuń dowód dostawy","eliminare la bolla di consegna","deletar nota de entrega","supprimer le bon de livraison","Lieferschein löschen"],
        "direccion":["address","dirección","adres","indirizzo","endereço","Adresse","adresse"],
        "iva":["TAX","IVA","VAT","IVA","IVA","TVA","Mehrwertsteuer"],
        "dto_pc":["discount %","descuento %","zniżka %","sconto %","desconto %","Réduction %","Rabatt %"],
        "baseImpo":["Tax base","Base imponible","Podstawa opodatkowania","Tassa base","Tributável","Base d'imposition","Steuerbemessungsgrundlage"],
        // To replace with correction from this point
        "inicio":["beginning","inicio","początek","inizio","começo","début","Anfang"],
        "intercom":["commercial intermediaries","intermediarios comerciales","pośredników handlowych","intermediari commerciali","intermediários comerciais","intermédiaires commerciaux","gewerbliche Mittler"],
        "provs":["	suppliers","proveedores","dostawców","fornitori","provedores","fournisseurs","Anbieter"],
        "bprov":["search supplier","buscar proveedor","dostawcy wyszukiwania","provider di ricerca","provedor de pesquisa","moteur de recherche","Suchanbieter"],
        "codprov":["supplier’s code","código de proveedor","Kod sprzedawca","codice venditore","Código do vendedor","code de fournisseur","Herstellerkürzel"],
        "pais":["country","país","kraj","nazione","país","de campagne","Land"],
        "todpais":["all the countries","todos los paises","wszystkie kraje","tutti i paesi","todos os países","tous les pays","alle Länder"],
        "NIP":["NIF / CIF","NIF/ CIF","NIF / CIF","NIF / CIF","NIF / CIF","NIF / CIF","NIF / CIF"],
        "pcia":["State","Província","Województwo","Provincia","Província","Province","Provinz"],
        "selpcia":["Select a State","Seleccionar una provincia","Wybierz prowincje","Seleziona una provincia","Selecione uma província","Sélectionnez une province","Wählen Sie eine Provinz"],
        "local":["location","localidad","Lokalizacja","Posizione","localização","lieu","Standort"],
        "telef":["phone","teléfono","telefon","Telefono","telefone","téléphone","Telefon"],
        "nueprov":["New supplier","nuevo proveedor","Nowy dostawca","nuovo fornitore","Novo fornecedor","Nouveau fournisseur","Neuer Lieferant"],
        "impr":["print","imprimir","drukować","a stampa","imprimir","imprimer","zu drucken"],
        "nroproven":["Number of suppliers founded","N. de proveedores encontrados","Znaleziono firmy N.","aziende N. trovati","N. empresa encontrada","sociétés N. trouvé","N. Unternehmen gefunden"],
        "mostra":["shown","mostrados","pokazane","mostrato","mostrando","montré","gezeigt"],
        "relacprov":["Supplier’s list","Lista de proveedores","relacjami z dostawcami","relazioni con i fornitori","relacionamento com fornecedores","la relation fournisseur","Lieferanten-Beziehung"],
        "item":["item","item","pozycja","articolo","item","Objet","Artikel"],
        "selepais":["select a country","seleccione un pais","Wybierz kraj","seleziona un Paese","selecione um pais","choisissez un pays","wähle ein Land"],
        "cod":["code","código","kod","codice","código","code","Code"],
        "entiban":["banking entity","entidad bancaria","podmiot bankowy","entità bancaria","entidade bancária","entité bancaire","Bankgesellschaft mit"],
        "cliente":["customers","clientes","klienci","clienti","clientes","clients","Kunden"],
        "selntiban":["choose a bank","seleccione una entidad bancaria","wybrać bank","scegliere una banca","escolher um banco","choisir une banque","Wähle eine Bank"],
        "bcliente":["Search customer","Buscar cliente","Szukaj klient","Ricerca cliente","pesquisa cliente","Recherche client","Suchen Kunden"],
        //@todo revisar repetido "nuevo":["new","nuevo","Nowy","nuovo","novo","Nouveau","Neu"],
        "nroclien":["number of clients found","número de clientes encontrados","liczba klientów znalezionych","numero di clienti ha trovato","número de clientes encontrados","nombre de clients trouvés","Anzahl der Clients gefunden"], 
        "produccion_plus":["production +","produccion +","produkcja +","produzione +","Produção +","production +","Produktion +"],
        "produccion":["production","producción","produkcja","produzione","Produção","production","Produktion"],
        "articu":["Items","artículos","artykuły","articoli","artigos","des Items","Artikel"],
        "tipodart":["Item Type","tipo de artículo","Typ przedmiotu","Tipo di elemento","Tipo de item","Type délément","Gegenstandsart"],
        "lotdprod":["production Lots","lotes de producción","partie produkcyjne","lotti di produzione","lotes de produção","lots de production","Produktionschargen"],
        "batchprod":[" production batches","batch de producción","produkcja partii","lotto di produzione","produção em lotes","production par lots","Serienfertigung"],
        "btipoar":["Type of article","buscar tipo de artículo","Rodzaj artykułu","Tipo di articolo","Tipo de artigo","Type de larticle","Artikeltyp"],
        "codtpar":["article type code","código de tipo de artículo","Kod typu artykuł","articolo codice tipo","artigo código de tipo","article type de code","Typencode Artikel"],
        "nvotpo":["new kind","nuevo tipo","nowy rodzaj","nuovo tipo","novo tipo","nouveau type","neue Art"],
        "tnvorto":["New delivery note","nuevo remito","nowy dowód dostawy","nuova bolla di consegna","nova nota de entrega","nouveau bon de livraison","neuer Lieferschein"],
        "nrotipen":["Number of types founded","N. de tipos encontrados","Znaleziono rodzaje N.","Tipi N. trovati","N. tipos encontrados","N. types trouvés","N. Typen gefunden"],
        "reltipar":["List of types of ítems ","listado de tipo de artículos","szt Typ związku","elementi di tipo rapporto","itens de tipo de relacionamento","des éléments de type de relation","Beziehungstyp Artikel"],
        "codart":["Item code","código de artículo","kod produktu","codice articolo","Código do item","code de larticle","Produktcode"],
        //@todo revisar repetida "flia":["family","familia","rodzina","famiglia","família","famille","Familie"],
        "todflia":["all families","todas las familias","Każda rodzina","ogni famiglia","cada família","chaque famille","Jede Familie"],
        "descri":["description","descripción","opis","descrizione","Descrição","la description","Beschreibung"],
        //@todo revisar repetida "descrip":["description","descripcion","opis","descrizione","Descrição","la description","Beschreibung"],
        "prov":["supplier","proveedor","dostawca","fornitore","fornecedor","fournisseur","Lieferant"],
        "todprov":["all suppliers","todos los proveedores","wszyscy dostawcy","tutti i fornitori","todos os fornecedores","tous les fournisseurs","Alle Lieferanten"],
        "todubic":["All locations","todas las ubicaciones","Wszystkie lokacje","tutti i posti","Todos os locais","toutes les zones géographiques","alle Orte"],
        "preciot":["Price T.","precio T.","Cena T.","Prezzo T.","Preço T.","Prix ​​T.","Preis T."],
        "stock":["stock","stock","Zbiory","azione","estoque","Stock","Lager"],
        "unidad":["unit of measurement","unidad de medida","/ jednostka pomiarowa","Unità / misurazione","/ unidade de medição","unité / mesure","Einheit / Mess"],
        "metproc":["Meta processes","meta procesos","procesy docelowe","processi di destinazione","processos alvo","processus cibles","Soll-Prozesse"],
        "bmetproc":["meta process search ","búsqueda de meta procesos","meta Proces wyszukiwania","processo di ricerca di meta","meta processo de pesquisa","processus de recherche méta", "Meta-Suchprozess"],
        "estados":["status","estados","stan","stato","Estado","Etat","Zustand"],
        "todestad":["all states","todos los estados","Wszystkie kraje","tutti gli stati","todos os estados","tous les états","alle Staaten"],
        "cribu_2":["Search criterion No. 2","criterio de búsqueda #2","kryterium wyszukiwania nr 2","criterio di ricerca n ° 2","critério de pesquisa No. 2","critère de recherche n ° 2","Suchkriterium No. 2"],
        "nomproc":["name of process","nombre del proceso","Nazwa procesu","nome del processo","nome do processo","nom du processus","Name des Prozesses"],
        "cribu_3":["Search criterion No. 3","criterio de búsqueda _3","kryterium wyszukiwania nr 3","criterio di ricerca n ° 3","critério de pesquisa No. 3","critère de recherche n ° 3","Suchkriterium No. 3"],
        "codproce":[" process code ","código de proceso","proces kod","processo di codice","processo de código","procédé de code","Code Prozess"],
        "nroprocen":["Number of process found","N. de procesos encontrados","N. proces znalezionych","N. TROVATO processo","N. processo que foi verificado","processus N. Trouvées","N. Verfahren gefunden"],
        "imprim":["Print","imprimir","drukować","a stampa","imprimir","imprimer","zu drucken"],
        "relprocdef":["List of processes defined ","Lista de procesos definidos","Procesy współczynnik określony","processi rapporto definito","processos relação definida","Ratio processus défini","Verhältnis definierte Prozesse"],
        "tipproc":["Process type","tipo de proceso","typ procesu","tipo di processo","tipo de processo","Type de processus","Prozesstyp"],
        "propru":["production processes","procesos de producción","procesy produkcji","processi di produzione","processos de produção","processus de production","Herstellungsprozesse"],
        "bupro":[" process search ","búsqueda de procesos","proces wyszukiwania","processo di ricerca","processo de pesquisa","processus de recherche","Suchprozess"],
        "cant":["quantity","cantidad","ilość","quantità","quantia","quantité","Menge"],
        "fechin":["start date","fecha de inicio","Data rozpoczęcia","data dinizio","data de início","date de début","Anfangsdatum"],
        "hinic":["start time","hora de inicio","czas rozpoczęcia","Ora di inizio","hora de início","Heure de début","Startzeit"],
        "estacion":["station","estación ","stacja","stazione","estação","gare","Bahnhof"],
       // "trabaj":["employee","trabajador","pracownik","dipendente","empregado","employé","Mitarbeiter"],
        "fechfin":["finish date","fecha de finalización","Data zakończenia","data di fine","data de término","date de fin","Endtermin"],
        "horafin":["ending time","hora de finalización ","czas kończąc","tempo finale","terminando tempo","heure de fin","Endzeit"],
        "nroloten":["Number of batches founded","N. de lotes encontrados","N. Znaleziony partii","N. parita ritenuta","N. lote considerado","N. Trouvé lot","N. Batch GEFUNDEN"],
        "lotprod":["production batches","lotes de produccion","partie produkcyjne","lotti di produzione","lotes de produção","lots de production","Produktionschargen"],
        "relalot":["Batches list","Lista de lotes","relacja wsadowe","rapporto Batch","relacionamento lote","lot relation","Batch Beziehung"],
        "estactra":["work stations","estaciones de trabajo","Stacje robocze","postazioni di lavoro","estações de trabalho","postes de travail","Arbeitsplätze"],
        "nroesten":["Number of stations found","N. de estaciones encontradas","Znaleziono stacje N.","Stazioni N. trovati","estações N. encontrado","N. stations trouvées","N. Stationen gefunden"],
        "relestatr":["Workstations list","Lista de estaciones de trabajo","stacje robocze relacje","postazioni di lavoro di relazione","estações de trabalho de relacionamento","postes de travail de relation","Beziehung Arbeitsplätze"],
        "vtas":["sales","ventas","sprzedaż","i saldi","vendas","Ventes","Der Umsatz"],
        "vtasmost":["counter sales","ventas en mostrador","sprzedaży licznik","banco di vendita","balcão de vendas","comptoir de vente","Thekenverkauf"],
        "nvavta":["new sale","nueva venta","nowa sprzedaż","nuova vendita","nova venda","nouvelle vente","neuer Verkauf"],
        "codcli":["Client’s code","Código de cliente","kod klienta","codice client","Código do cliente","code client","Client-Code"],
        "codbarr":["Barcode","código de barras","kod kreskowy","Codice a barre","Barcode","code à barre","Strichcode"],
        //@todo repetido "descr":["description","descripcion","opis","descrizione","Descrição","la description","Beschreibung"],
        "precio":["price","precio","Cena £","prezzo","preço","le prix","Preis"],
        "dto":["discount (Extra)","descuento (Dto)","zniżka (Extra)","sconto (Extra)","desconto (Extra)","Réduction (Extra)","Rabatt (Extra)"],
        "importe":["amount","importe","ilość","quantità","quantia","quantité","Menge"],
        "subtotal":["Subtotal","subtotal ","Razem","totale parziale","Subtotal","Total","Zwischensumme"],
        "pciototal":["total price","precio total","cena całkowita","prezzo totale","preço total","prix total","Gesamtpreis"],
        "factura":["invoice","factura","rachunki","fatture","contas","factures","Banknoten"],
        "buscafc":["Search invoices","buscar facturas","Wyszukiwanie faktur","ricerca fatture","Pesquisa faturas","Rechercher factures","Suchen Rechnungen"],
        "nrofc":["invoice number","número de factura ","numer rachunku","disegno di legge numero","número da conta","numéro de facture","Rechnungsnummer"],
        "estado":["Condition","estado","stan: schorzenie","condizione","doença","état","Bedingung"],
        "todosest":["all states","todos los estados","Wszystkie kraje","tutti gli stati","todos os estados","tous les états","alle Staaten"],
        "pendpago":["outstanding","pendiente de pago","wybitny","eccezionale","excepcional","exceptionnel","hervorragend"],
        "pagada":["paid","pagada","płatny","pagato","pago","payé","bezahlt"],
        "fchaini":["start date","fecha de inicio","Data rozpoczęcia","data dinizio","data de início","date de début","Anfangsdatum"],
        "fchafin":["ending date","fecha de fin","Data końcowa","chiusura","data de término","fin","Ende"],
        "nrofcenco":["No. Of invoices found","No. de facturas encontradas","Ilość znalezionych faktur","No. delle fatture trovato","No. de facturas encontrado","Nombre de factures trouvées","Anzahl der Rechnungen gefunden"],
        "nvafact":["new invoice","nueva factura","nowa ustawa","nuovo disegno di legge","nova lei","nouveau projet de loi","neue Rechnung"],
       // "item":["item","item","pozycja","articolo","item","Objet","Artikel"],
        "nrorto":["Number of delivery notes","No. de remito","Ilość odnoszą","No. Di riferimento","No. da REFER","Nombre de consulter","Anzahl verweisen"],
        "sinfact":["unbilled","sin facturar ","Nierozliczona","non ancora fatturate","unbilled","non facturés","unfertige"],
        "facturado":["invoiced","facturado","zafakturowanymi","fatturata","facturado","facturé","fakturieren"],
        "nvoprov":["new supplier","nuevo provedor","nowy dostawca","nuovo fornitore","novo provedor","nouveau fournisseur","neue Anbieter"],
        "facrtos":["bill delivery notes","facturar remitos","remitos banknoty","remitos fattura","remitos conta","facture bordereaux demballage","Rechnung remitos"],
        "nrortoini":["Number of first delivery note","No. remito inicial","Nie Incial odnoszą","No. Incial riferiscono","No. Incial referem","Non Incial se réfèrent","Nr Incial beziehen"],
        "ntortofin":["Number of final delivery note","No. remito final","Liczba końcowa patrz","No. finale riferiscono","No. final referem-se","Non final se réfèrent","Nr Schluss beziehen"],
        "nrortoenc":["Number of delivery notes founded","Nro. de remitos encontrados","Ilość znalezionych remitos","No. Di remitos trovato","Nº de remitos encontrado","Nombre de bordereaux demballage trouvé","Anzahl remitos gefunden"],
        "factrto":["Bill delivery notes","Facturar remitos","I odnoszą się do rachunku","Mi riferisco al disegno di legge","Refiro-me ao projeto de lei","Je me réfère à la facture","Ich beziehe mich auf Rechnung"],
        "presup":["budget","presupuesto","budżet","bilancio","orçamento","budget","Budget"],
        "buscpresu":["Search budget","buscar presupuesto","Szukaj budżet","Cerca budget","pesquisa orçamento","Rechercher le budget","Suche nach Budget"],
        "nropresup":["No. Budget","Nro. de presupuesto","Nie Budget","No. Budget","Sem orçamento","Pas de budget","Kein Budget"],
        "pendient":["pending","pendiente","kolczyk","orecchino","brinco","boucle doreille","Ohrring"],
        "aceptado":["accepted","aceptado","przyjęty","accettato","aceitaram","accepté","akzeptiert"],
        "nropresenc":["Number of budgets founded","Nro. de presupuestos encontrados","Ilość znalezionych budżetów","No. Di budget trovato","Nº de orçamentos encontrados","Nombre de budgets trouvés","Anzahl der Haushalte gefunden"],
        "compras_plus":["purchases +","compras +","zakupy +","acquisti +","compras +","achats +","Einkäufe +"],
        "compras":["purchases","compras","zakupy","acquisti","compras","achats","Einkäufe"],
        "codprove":["vendor code","código de proveedor","Kod sprzedawca","codice venditore","Código do vendedor","code de fournisseur","Herstellerkürzel"],
        "albaran":["delivery note","remito","zrazy opakowania","scivola imballaggio","guias de remessa","bordereaux demballage","Beipackzetteln"],
        "relacrtos":["List of packing slips","listado de remitos","Lista opakowań zrazy","Elenco dei documenti di trasporto","Lista de deslizamentos de embalagem","Liste des bordereaux demballage","Liste der Packzettel"],
        "factremi":["bill delivery note","facturar remitos","rachunek dowodu dostawy","disegno di legge bolla di consegna","Nota entrega de contas","de livraison facture","Rechnung Lieferschein"],
        "nroalbaranini":["No. Of initial delivery note","Nro. de remito inicial","Ilość początkowej kwicie","No. Da segnalare consegna iniziale","Número de nota de entrega inicial","Nombre de bordereau de livraison initiale","Anzahl der ursprünglichen Lieferscheins"],
        "nroalbaranfin":["No. Final delivery note","Nro. de remito final","Nie. Ostatnia uwaga dostawy","No. bolla di consegna finale","No. nota de entrega final","Non de livraison finale","Nr Schluss Lieferschein"],
        "adminst":["management","administracion","zarządzanie","gestione","gestão","la gestion","Management"],
        "cobros":["collection","cobros","opłaty","oneri","cobranças","des charges","Gebühren"],
        "buscmov":["Search movements","buscar movimientos","ruchy wyszukiwania","movimenti di ricerca","movimentos de busca","mouvements de recherche","Suchbewegungen"],
        "fchavto":["expiration date","fecha de vencimiento","termin ważności","data di scadenza","data de validade","date dexpiration","Haltbarkeitsdatum"],
        "pagos":["Payments","pagos","Płatności","pagamenti","pagamentos","Paiements","Zahlungen"],
        "fchapago":["Payment date","fecha de pago","Termin płatności","Data di pagamento","Data de pagamento","Date de paiement","Zahlungsdatum"],
        "cjadiaria":["cash flow","caja diaria","codziennie pieniężnych","cassa giornaliera","caixa diário","en espèces par jour","Tagesgeld"],
        "buscfcha":["Search date","buscar fecha","data Szukaj","data Search","pesquisa data","Date de recherche","Suche nach Datum"],
        "fchaciere":["deadline","fecha de cierre","ostateczny termin","Scadenza","prazo final","date limite","Frist"],
        "detallecc":["closing cash detail","detalle cierre de caja","zamykanie gotówka detal","Chiusura dettagli contanti","detalhe fecho de caixa","fermeture détails de trésorerie","Schließen Bargeld Detail"],
        "fchacja":["cash date ","caja fecha","data box","casella della data","caixa de data","boîte à jour","Datumsfeld"],
        "delnrotickt":["of the no. of Ticket","del Nro. de Ticket","o nr. Biletu","del no. di biglietteria","do no. de Bilheteira","du non. de billets","die Nr. von Ticket"],
        "neto":["net","neto","netto","netto","internet","rapporter","Netz"],
        "total":["total","total","całkowity","totale","total","total","gesamt"],
        "totalcdo":["Total cash","total contado","Całkowita wartość środków pieniężnych","totale cassa","total de caixa","total de la trésorerie","Totalsumme"],
        "totaltj":["Total cards","total tarjetas","Wszystkich kart","carte totali","total de cartões","total des cartes","Gesamt Karten"],
        "altktnro":["Ticket number.","Nro de ticket","do biletu nie.","al biglietto n.","para o bilhete não.","au billet pas.","zum Ticket-Nr."],
        "librodrio":["Diary book","libro diario ","Pamiętnik","libro del diario","livro do diário","livre Diary","Tagebuch"],
        "relacmov":["movements list","lista de movimientos","ruchy związek","movimenti di relazione","movimentos de relacionamento","mouvements de relation","Beziehung Bewegungen"],
        "nromovenc":["Number of movements found","Nro. de movimientos encontrados","Ilość ruchów znaleziono","No. Di movimenti trovato","Número de movimentos encontrado","Nombre de mouvements trouvés","Anzahl der Bewegungen gefunden"],
        "compvta":["buys and sells","compra / venta","Kup i sprzedaj","comprare e vendere","comprar e vender","acheter et vendre","kaufen und verkaufen"],
        "comerc":["commercial","comercial","Reklama w telewizji","commerciale","comercial","commercial","kommerziell"],
        "forpago":["payment method","forma de pago","sposób zapłaty","modo per pagare","forma de pagamento","façon de payer","Weg zur Bezahlung"],
        "nrodocum":["Document’s number","No. de documento","Ilość dokumentów","N. DEL DOCUMENTO","Nº de documento","Nombre de documents","Anzahl Dokument"],
        "rrhh_plus":["Human Resources +","recursos humanos +","zasoby ludzkie +","risorse umane +","recursos humanos +","ressources humaines +","Humanressourcen +"],
        "rrhh":["Human Resources","recursos humanos","zasoby ludzkie","risorse umane","recursos humanos","ressources humaines","Humanressourcen"],
        "buscparttb":["search a work order","buscar parte de trabajo","Poszukiwanie pracy","cerca di lavoro","busca de trabalho","la recherche de travail","Suche nach Arbeit"],
        "ordentrabajo":["work order","orden de trabajo","porządek pracy","ordine di lavoro","ordem de trabalho","demande de service","Arbeitsauftrag"],
        "codtjador":[" worker´s code ","Codigo de trabajador","pracownik kod","Codice operaio","trabalhador código","travailleur code","Code Arbeiter"],
        "nroparte":["No. From","Nro. de parte","Nie. Od","No. Da","Não. De","Non. De","Nein. Aus"],
        "trabaj":["job","trabajo","praca","lavoro","trabalho","travail","Job"],
        "fchacom":["Start date","fecha de comienzo ","Data rozpoczęcia","Data dinizio","Data de início","Date de début","Anfangsdatum"],
        "nropartenc":["Number of parts found","Nro. de partes encontrados","Ilość części znaleziono","No. di parti trovate","Número de peças encontrado","Nombre de pièces trouvées","Anzahl der Teile gefunden"],
        "nropart":["Part number","Nro. de parte ","Nie. Od","No. Da","Não. De","Non. De","Nein. Aus"],
        "trabajad":["employee","trabajador","pracownik","dipendente","empregado","employé","Mitarbeiter"],
        "hsprev":["planned number of hours","horas previstas","Widoki wstępnie godzin","Vista al orari prestabiliti","vê pré hora","views heures pré","Ansichten vor Stunden"],
        "pciohs":["Price per hour","precio/hora","Cena godziny","ora Prezzo","preço hora","Prix ​​heure","Preis Stunde"],
        "config_plus":["setting +","configuracion +","oprawa +","ambientazione +","contexto +","réglage +","Rahmen +"],
        "config":["setting","configuracion","oprawa","ambientazione","contexto","réglage","Rahmen"],
        "empleado":["employees","empleados","pracowników","dipendenti","funcionários","des employés","Angestellte"],
        "busctrabj":["Search worker","buscar trabajador","Szukaj pracownika","Cerca operaio","pesquisa trabalhador","Recherche travailleur","Suche Arbeiter"],
        "codtrabj":["Employee´s code","código de trabajador ","Kod pracownik","codice operaio","código de trabalhador","Code de travail","Arbeiter Code"],
        "nrotraben":["Number of workers found","Nro.de trabajadores encontrados","Znaleziono pracownicy Nro.de","lavoratori Nro.de trovati","trabalhadores Nro.de encontrado","travailleurs Nro.de trouvé","Nro.de Arbeiter gefunden"],
        "reltrabj":[" Employee´s list ","lista de trabajadores","Stosunek pracowników","rapporto tra lavoratori","proporção de trabalhadores","ratio des travailleurs","Verhältnis von Arbeitnehmern"],
        "etiquet":["labels","etiquetas","etykiety","etichette","etiquetas","Étiquettes","Etiketten"],
        "buscaart":["Search Product","buscar articulo","Wyszukiwarka produktów","Product Search","pesquisa de produto","Recherche de produits","Suchen Produkt"],
        "codbarra":["Barcode","código de barras","kod kreskowy","Codice a barre","Barcode","code à barre","Strichcode"],
        "impuestos":["taxes","impuestos","podatki","le tasse","impostos","taxes","Steuern"],
        "busimp":["Search tax","buscar impuesto","Podatek wyszukiwania","tassa di Ricerca","imposto de pesquisa","taxe de recherche","Suchen Steuer"],
        "codimp":["tax code","código de impuesto","kod podatkowy","codice fiscale","Código de Imposto","code fiscal","Steuer-Code"],
        "nroimpenc":["No. Of taxes found","Nro. de impuestos encontrados","Ilość znalezionych podatków","No. Di tasse trovato","No. de impostos declarados","Nombre dimpôts trouvé","Anzahl der Steuern gefunden"],
        "reimp":["List of taxes","Listado de impuestos","stosunek podatkowy","pressione fiscale","rácio fiscal","taux dimposition","Steuerquote"],
        "valor":["value","valor","wartość","valore","valor","évaluer","Wert"],
        "entbcaria":["Banks","entidades bancarias","podmioty bankowe","entità bancarie","entidades bancárias","entités bancaires","Bank-Unternehmen"],
        "codentida":["entity code","código de entidad","Kod podmiot","codice entità","código de entidade","Code de lentité","Einheit Code"],
        "nroenbcen":["No. Of banks found","Nro. de entidades bancarias encontradas","Ilość znalezionych banków","No. Di banche trovato","Número de bancos encontrados","Nombre de banques trouvé","Anzahl der Banken gefunden"],
        "relentbc":["Banks List","Listado de entidades bancarias","banki związek","le banche di relazione","bancos de relacionamento","banques de relations","Banken"],
        "ubica":["Locations","ubicaciones","Lokalizacje","sedi","Localizações","Emplacements","Standorte"],
        "buscubic":["find location","buscar ubicación","znajdź lokalizację","trova posizione","encontrar Localização","trouver lemplacement","finden Ort"],
        "codubic":["location code","código de ubicación","kod lokalizacji","codice di posizione","Código de localização","code de localisation","Ortscode"],
        "nroubenc":["Number of locations found","Nro. de ubicaciones encontradas","Nie znaleziono lokalizacji","No. di posizioni trovato","Número de locais encontrados","Nombre de lieux trouvé","Anzahl der Stellen gefunden"],
        "nvaubuc":["new location","nueva ubicacion","Nowa lokalizacja","nuova sede","nova localização","nouvel emplacement","neuen Ort"],
        "relacubic":["locations list","lista de ubicaciones","związek lokalizacje","rapporto posizioni","relação de locais","relation de lieux","Standorte Beziehung"],
        "inserubic":["insert location","insertar ubicación ","wkładka lokalizacja","punto di inserimento","local de inserção","emplacement insert","Einsatzpass"],
        "cancelar":["cancel","cancelar","Anuluj","Annulla","cancelar","Annuler","stornieren"],
        "embala":["packaging","embalaje","opakowania","confezione","embalagem","emballage","Verpackung"],
        "busembj":["Search packaging","buscar embalaje","opakowanie wyszukiwania","Ricerca imballaggio","pesquisa embalagem","emballage de recherche","Suchen Verpackung"],
        "codembal":["packaging code","código de embalaje","Kod opakowania","codice di imballaggio","código da embalagem","Code demballage","Verpackungscode"],
        "nroemben":["Number of packages found","No.de embalajes encontrados","Znaleziono pakiety Nro.de","Pacchetti Nro.de trovati","pacotes Nro.de encontrado","Nro.de paquets trouvés","Nro.de Pakete gefunden"],
        "relacenb":["packaging list","listado de embalajes","związek opakowanie","rapporto imballaggi","relação embalagens","relation demballage","Verpackungs Beziehung"],
        "nuevo":["new","nuevo ","Nowy","nuovo","novo","Nouveau","Neu"],
        "inseremb":[" insert packaging ","insertar embalaje","wkładka opakowanie","inserto di imballaggio","inserção de embalagens","insert demballage","Beipackzettel"],
        "nhneqcclc":["There is no packaging that meets the search criteria","no hay ningún embalaje que cumpla con los criterios de búsqueda","Obecnie nie ma opakowania, które spełniają kryteria wyszukiwania","Ci sono attualmente nessun imballaggio che soddisfa i criteri di ricerca","Atualmente não há embalagem que cumpra os critérios de pesquisa","Il ny a actuellement pas demballages répondant aux critères de recherche","Es liegen noch keine Verpackung, die die Suchkriterien erfüllt"],
        "ctabcaria":["Bank account","cuenta bancaria","konto bankowe","conto bancario","conta bancária","compte bancaire","Bankkonto"],
        "correlec":["email","correo electrónico","e-mail","e-mail","o email","e-mail","Email"],
        "dirrcweb":["Web address","dirección de web","adres internetowy","indirizzo Web","endereço da web","Adresse web","Webadresse"],
        "referenc":["reference","referencia","odniesienie","riferimento","referência","référence","Referenz"],
        "flia":["family","Tipo de articulo","rodzina","famiglia","família","famille","Familie"],
        "selecflia":["Select a family","selecciona una familia","Wybierz rodzinę","Selezionare una famiglia","Selecione uma família","Sélectionnez une famille","Wählen Sie eine Familie"],
        "prodfinal":["Final product","producto final","Produkt finalny","Prodotto finale","Produto final","Produit final","Endprodukt"],
        "prodiner":["intermediate product","producto intermedio","Produkt pośredni","prodotto intermedio","Produto intermediário","produit intermédiaire","Zwischenprodukt"],
        "mateprima":["raw material","materia prima","surowiec","materia prima","matéria-prima","matière première","Rohstoffe"],
        "selecimp":["Select a tax%","seleccione un impuesto %","Wybierz% podatku","Selezionare una tassa%","Escolha um imposto%","Sélectionnez une taxe%","Wählen Sie eine Steuer%"],
        "gmos":["grams","gramos","gramy","grammi","gramas","grammes","Gramm"],
        "libras":["pounds","libras","funtów","sterline","libras","livres sterling","Pfund"],
        "unidades":["units","unidades","jednostki","unità","unidades","unités","Einheiten"],
        "kgmos":["kg","kilogramos","kg","kg","kg","kg","kg"],
        "datroduc":["product data","datos del producto","terminy produktów","date di prodotto","datas produtos","dates de produits","Produktdaten"],
        "desccorta":["short description","breve descripción","krótki opis","breve descrizione","Pequena descrição","brève description","kurze Beschreibung"],
        "stkmin":["minimum stock","stock mínimo","minimalna Zdjęcie","scorta minima","estoque mínimo","stock minimum","Mindestbestand"],
        "avisostock":["stock alert","aviso stock","zawiadomienie Zdjęcie","avviso di magazzino","estoque aviso","avis stock","Bekanntmachung Lager"],
        "fchaalta":["discharge date","fecha de alta","Data rozładowania","data di scarico","data de quitação","Date de sortie","Entlassungsdatum"],
        "unidcaja":["units per box","unidades por caja","Jednostki oknie","unità per scatola","unidades por caixa","unités par boîte","Einheiten pro Karton"],
        "pregpciotk":["ask for ticket price ","preguntar precio ticket","prosząc Cena biletów","chiedendo prezzo del biglietto","pedindo bilhete de preço","demander un billet de prix","Preisvorstellung Ticket"],
        "moddesctk":["edit ticket description","modificar descripcion en el ticket","Opis Edytuj na bilecie","edit description sul biglietto","editar inscrição no bilhete","modifier la description sur le billet","Beschreibung bearbeiten auf dem Ticket"],
        "obsev":["observations","observaciones","obserwacje","osservazioni","observações","observations","Beobachtungen"],
        "pciocomp":["purchase price","precio de compra","Cena zakupu","prezzo dacquisto","preço de compra","prix dachat","Kaufpreis"],
        "pcioalma":["stock price","precio almacen","Cena akcji","prezzo delle azioni","preço das ações","prix de laction","standard Preis"],
        "pciotdaiva":["shop price tax included","precio tienda con iva","sklep VAT Cena","Negozio Prezzo IVA Prezzo","Loja de preço IVA Preço","Boutique Prix Prix TVA","Ladenpreis MwSt Preis"],
        "igenfmjpg":["jpg image format","imagen formato jpg","Format obrazu jpg","formato immagine jpg","formato de imagem jpg","jpg format dimage","jpg-Bildformat"],
        "busqusua":["Search for users","busqueda de usuarios","Szukaj użytkowników","Ricerca per gli utenti","Procurar por usuários","Rechercher des utilisateurs","Suche nach Benutzer"],
        "mailusua":[" user´s mail ","mail de usuario ","email użytkownik","utente di posta","usuário de correio","mail dun utilisateur","Mail-Benutzer"],
        "nbreusua":["Username","nombre de usuario","Nazwa Użytkownika","Nome utente","Nome de usuário","Nom dutilisateur","Nutzername"],
        "usuario":["users","usuarios","użytkowników","utenti","Comercial","utilisateurs","Benutzer"],
        "roles":["roles","roles","role","ruoli","papéis","rôles","Rollen"],
        "admseguri":["Security management","administracion de seguridad","zarządzanie bezpieczeństwem","Gestione della sicurezza","Gerenciamento de segurança","Gestion de la sécurité","Sicherheitsmanagement"],
        "cpiasresp":["backups","copias de respaldo","utworzyć kopię zapasową","di riserva","cópia de segurança","sauvegarde","Sicherungskopie"],
        "hcercopresp":["new backup","hacer copia de respaldo ","wycofać się","per il backup","para fazer backup","pour sauvegarder","sichern"],
        "restcpresp":["restore backup","restaurar copia de respaldo","przywracania kopii zapasowej","ripristinare il backup","restaurar backup","restaurer la sauvegarde","Backup wiederherstellen"],
        "enero":["January","enero","styczeń","gennaio","Janeiro","janvier","Januar"],
        "febrero":["February","febrero","luty","febbraio","fevereiro","février","Februar"],
        "marzo":["March","marzo","Marsz","marzo","Março","mars","März"],
        "abril":["April","abril","kwiecień","aprile","abril","avril","April"],
        "mayo":["May","mayo","Może","Maggio","Maio","Peut","Kann"],
        "junio":["June","junio","czerwiec","giugno","Junho","juin","Juni"],
        "julio":["July","julio","lipiec","luglio","julho","juillet","Juli"],
        "agosto":["August","agosto","sierpień","agosto","agosto","août","August"],
        "sept":["September","septiembre","wrzesień","settembre","setembro","septembre","September"],
        "octubre":["October","octubre","październik","ottobre","Outubro","octobre","Oktober"],
        "noviem":["November","noviembre","listopad","novembre","novembro","novembre","November"],
        "diciem":["December","diciembre","grudzień","dicembre","dezembro","décembre","Dezember"],
        "lunes":["Monday","lunes","poniedziałek","Lunedi","Segunda-feira","Lundi","Montag"],
        "martes":["Tuesday","martes","wtorek","martedì","terça-feira","mardi","Dienstag"],
        "miercoles":["Wednesday","miércoles","środa","mercoledì","quarta-feira","Mercredi","Mittwoch"],
        "jueves":["Thursday","jueves","czwartek","giovedi","quinta-feira","jeudi","Donnerstag"],
        "viernes":["Friday","viernes","piątek","Venerdì","sexta-feira","vendredi","Freitag"],
        "sabado":["Saturday","sábado","sobota","Sabato","sábado","samedi","Samstag"],
        "domgo":["Sunday","domingo","niedziela","Domenica","domingo","dimanche","Sonntag"],
        "hoy":["today","hoy","dzisiaj","oggi","hoje","aujourdhui","heute"],
        "nhnfqccbu":["there is no bill that meets the search criteria","no hay ninguna factura que cumpla con los criterios de búsqueda","nie ma ustawy, który spełnia kryteria wyszukiwania","non vè alcuna legge che soddisfa i criteri di ricerca","não há nenhuma lei que atenda aos critérios de pesquisa","il ny a aucun projet de loi qui répond aux critères de recherche","es gibt keine Rechnung, die die Suchkriterien erfüllt"],
        "nhnrqccbu":["There are currently no delivery notes that meets the search criteria","no hay ningún remito que cumpla con los criterios de búsqueda","Obecnie nie ma odnosić się, że spełnia kryteria wyszukiwania","Momento non ci sono riferiscono che soddisfa i criteri di ricerca","Atualmente não há referir que atenda aos critérios de pesquisa","Il ny a actuellement aucune réfèrent répondant aux critères de recherche","Es gibt keine Zeit verweisen, dass die Suchkriterien erfüllt"],
        "nhnmqccbu":["There are no movements that meet the search criteria","no hay ningún movimiendo que cumpla con los criterios de busqueda","Obecnie nie ma movimiendo że spełnia kryteria wyszukiwania","Momento non ci sono movimiendo che soddisfa i criteri di ricerca","Atualmente não há movimiendo que atenda aos critérios de pesquisa","Il y a movimiendo actuellement aucun répondant aux critères de recherche","Es liegen noch keine movimiendo, dass die Suchkriterien erfüllt"],
        "nspeeebptpa":["You can not delete this bank because it has associated suppliers.","No se puede eliminar esta entidad bancaria porque tiene proveedores asociados.","Nie można usunąć tego banku, ponieważ ma powiązanych dostawców.","Non è possibile eliminare questa banca perché ha i fornitori associati.","Você não pode excluir este banco porque tem fornecedores associados.","Vous ne pouvez pas supprimer cette banque parce quelle a des fournisseurs associés.","Sie können diese Bank nicht löschen, da es damit verbundenen Lieferanten hat."],
        //agregados
        //"variable_name":["english","espanol","polski","italian","portugues","frances","Aleman"],
        //@todo revisar si la traduccion en algun punto se usa en plural , pareciera ser siempre cliente en vez de clientes
       // "cliente":["customer","cliente","klienci","clienti","cliente","clients","Kunden"],
        "clientes":["customers","clientes","klienci","clienti","clientes","clients","Kunden"],
        "sinproveedor":[" There is no supplier with this code","No existe ningún proveedor con ese código","polski No existe ningun proveedor con ese codigo","italian No existe ningun proveedor con ese codigo","portugues No existe ningun proveedor con ese codigo","frances No existe ningun proveedor con ese codigo","AlemanNo existe ningun proveedor con ese codigo"],
        "elmalbaran":["remove delivery note","eliminar remito","polski","italian","portugues","frances","Aleman"],
       // "direccion":["Address","Dirección","polski","italian","portugues","frances","Aleman"],
        "codalbaran":["Delivery note´s code","Código de albarán","polski","italian","portugues","frances","Aleman"],
        "dctop":["discount %","dcto %","polski","italian","portugues","frances","Aleman"],
        "baseimp":["tax base","Base imponible","polski","italian","portugues","frances","Aleman"],
        "codigo":["Code","Código","polski","italian","portugues","frances","Aleman"],
        "artbajomin":["Following articles are under minimun","Los siguientes artículos están bajo mínimo","polski","italian","portugues","frances","Aleman"],
        "codfactura":["Invoice Code","Código de factura","polski","italian","portugues","frances","Aleman"],
        "balbaran":["Search delivery note","Buscar Remito","polski","italian","portugues","frances","Aleman"],
        "balbaranes":[" Search delivery notes","Buscar Remitos","polski","italian","portugues","frances","Aleman"],
     //   "nrorto":["Delivery Note number","No. de Remito","polski","italian","portugues","frances","Aleman"],
        "relalbaranes":["List of delivery notes","Listado de Remitos", "polski","italian","portugues","frances","Aleman"],
        "insalbaran":["Insert Delivery Note","Insertar remito","polski","italian","portugues","frances","Aleman"],      
        "dcto":[" Discount","Dcto.","polski","italian","portugues","frances","Aleman"],
        "agregar":["insert","agregar","polskico","italian","portugues","frances","Aleman"],
        "calbaran":["Create a delivery note","crear remito","polskico","italian","portugues","frances","Aleman"],
        "msgsinresultado":[" There are no movements that meet the search criteria ","No hay ningún remito que cumpla con los criterios de búsqueda","polskico","italian","portugues","frances","Aleman"],
        "msgsc":["There are no clients with this code","No hay ningún cliente con ese código","polskico","italian","portugues","frances","Aleman"],
        "cerrar":["Close","Cerrar","polskico","italian","portugues","frances","Aleman"],
        "valbaran":["See delivery note","ver remito","polskico","italian","portugues","frances","Aleman"],
        "tdart":["All articles","Todos los artículos","polskico","italian","portugues","frances","Aleman"],
        "msgscliente":["There are no clients with this code","No hay ningún cliente con ese código","polskico","italian","portugues","frances","Aleman"],
        "tsel":["Select","Seleccionar","polski","italian","portugues","frances","Aleman"],
        "tbscart":["Search article","Buscar artículo","italian","portugues","frances","Aleman"],
        "tvalclt":["Validate customer","Validar cliente","polski","italian","portugues","frances","Aleman"],
        "msgvgn":["Attention, we detected following mistakes","Atención, se han detectado las siguientes incorrecciones","polski","italian","portugues","frances","Aleman"],
        "vfprec":["Price missing","Falta el precio","polski","italian","portugues","frances","Aleman"],
        "vprnm":["Price must be numeric","El precio debe ser numérico","polski","italian","portugues","frances","Aleman"],
        "vfc":["amount missing","Falta la cantidad","polski","italian","portugues","frances","Aleman"],
        "vcnm ":["amount must be numeric","La cantidad debe ser numerica","polski","italian","portugues","frances","Aleman"],
        "vdcnm":["discount must be numeric","El descuento debe ser numerico","polski","italian","portugues","frances","Aleman"],
        "msgintcl":["Enter custumer code","Debe introducir el codigo del cliente","polski","italian","portugues","frances","Aleman"],
        "msgfimp":["Amount is missing","Falta el importe","polski","italian","portugues","frances","Aleman"],
        "msgvmaf":["You can´t modfy an invoiced delivery note","No puede modificar un remito facturado","polski","italian","portugues","frances","Aleman"],
        "msgcfayf":["You can´t invoice twice the same delivery note","No se puede convertir en factura un remito ya facturado","polski","italian","portugues","frances","Aleman"],
        "modificar":["Modify","Modificar","polski","italian","portugues","frances","Aleman"],
        "convalbaran":["convert delivery note","convertir remito","polski","italian","portugues","frances","Aleman"],
        "nrofac":["Invoice number","No. Factura","polski","italian","portugues","frances","Aleman"],
        "buscar":["Find","Buscar","polski","italian","portugues","frances","Aleman"],
        "ndalbaran":["Delivery note´s number","No. Remito","polski","italian","portugues","frances","Aleman"],
        "ndalbaranese":["Number of delivery notes founded","No. de remitos encontrados","polski","italian","portugues","frances","Aleman"],
        "malbaran":["Modify delivery note","modificar Remito","polski","italian","portugues","frances","Aleman"],
        "nif":["english","NIF","polski","italian","portugues","frances","Aleman"],
        "codralbaran":["Delivery Note´s Code","Cod. Remito","polski","italian","portugues","frances","Aleman"],
        "vart":["Show all Items","Mostrar todos los artículos","polski","italian","portugues","frances","Aleman"],
        "si":["yes","si","polski","italian","portugues","frances","Aleman"],
        "no":["no","no","polski","italian","portugues","frances","Aleman"],
        "selart":["Select Items","Seleccionar Articulo","polski","italian","portugues","frances","Aleman"],
        "tipo":["Type","tipo","polski","italian","portugues","frances","Aleman"],
        "sel":["Select","Selecciona","polski","italian","portugues","frances","Aleman"],
        "elart":["remove item","eliminar articulo","polski","italian","portugues","frances","Aleman"],
        "impuesto":["Tax","Impuesto","polski","italian","portugues","frances","Aleman"],
        "prov1":["supplier 1","proveedor 1","dostawca","fornitore","fornecedor","fournisseur","Lieferant"],
        "prov2":["supplier 2","proveedor 2","dostawca","fornitore","fornecedor","fournisseur","Lieferant"],
        "ubicacion":["location","ubicación","polski","italian","portugues","frances","Aleman"],
        "avisominimo":[" Minimun stock alert","Alerta de stock mínimo","polski","italian","portugues", "frances","Aleman"],
        "sindet":["Not defined","Sin determinar","polski","italian","portugues","frances","Aleman"],
        "embalaje":["packing","embalaje","polski","italian","portugues","frances","Aleman"],
        "mdesctick":["modify bill","Modificar descrip. ticket","polski","italian","portugues","frances","Aleman"],
        "prectienda":["Shop price","Precio en tienda","polski","italian","portugues","frances","Aleman"],
        "prcciva":["Price plus tax","Precio con iva","polski","italian","portugues","frances","Aleman"],
        "tdsfam":["All families","Todas los tipos","polski","italian","portugues","frances","Aleman"],
        "tdstax":["select a tax","Seleccionar un impuesto","wybierz podatek","italian","portugues","frances","Aleman"],
        "realcionart":["list of items","listado de articulos","polski","italian","portugues","frances","Aleman"],
        "ndartenctn":["number of ítems founded","No. de articulos encontrados", "polski","italian","portugues","frances","Aleman"],
        "undmed":["Unit of meassurement","Unidad de medida", "polski","italian","portugues","frances","Aleman"],
        "modarticulo":["Modify Item","MODIFICAR ARTICULO","polski","italian","portugues","frances","Aleman"],
        "tdsembalajes":["All packaging types","Todos los embalajes","polski","italian","portugues","frances","Aleman"],
        "moddesctick":["Modify description of bills","Modificar descrip. en ticket","polski","italian","portugues","frances","Aleman"],
        "palmacen":["Stock price","Precio de almacén","polski","italian","portugues","frances","Aleman"],
        "ptienda":["Shop price","Precio de tienda","polski","italian","portugues","frances","Aleman"],
        "imgfrmjpg":[" Format jpg image ","Imagen [Formato jpg]","polski","italian","portugues", "frances","Aleman"],
        "insart":["insert item","insertar articulo","polski","italian","portugues","frances","Aleman"],
        "prcventpub":["Shop price","Precio venta al publico","polski","italian","portugues","frances","Aleman"],
        "msgsinrbus":[" There is no item that meets the search criteria ","No hay ningún artículo que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "varticulo":["See item","ver articulo","polski","italian","portugues","frances","Aleman"],
        "tart":["ITEM","ARTICULO","polski","italian","portugues","frances","Aleman"],
        "horafincrt":[" ending time","hora de finalización ","polski","italian","portugues","frances","Aleman"],
        "msgatncbatexterror":[" ATTENTION: Batch could not be modified successfully"," ATENCION: No se ha podido ser modificado con exito el batch ","polski","italian","portugues","frances","Aleman"],
        "msgatncbatext":[" ATTENTION: Batch was created successfully! ","ATENCION: El bat detcrrcaja ch ha sido modificado con exito!","polski","italian","portugues","frances","Aleman"],
        "inicializado":["Started","Inicializado","polski","italian","portugues","frances","Aleman"],
        "finalizado":["Finished","Finalizado","polski","italian","portugues","frances","Aleman"],
        "descartado":["Discarded","Descartado","polski","italian","portugues","frances","Aleman"],
        "detcrrcaja":["Daily cash closing detail","Detalle de cierre de caja","polski","italian","portugues","frances","Aleman"],
        "delticktnro":["bill number","Del ticket nº","polski","italian","portugues","frances","Aleman"],
        "codpostal":["ZIP code","código postal","polski","italian","portugues","frances","Aleman"],
        "movil":[" celular phone ","móvil","polski","italian","portugues","frances","Aleman"],
        "inscliente":["add item","insertar cliente","polski","italian","portugues","frances","Aleman"],
        "selprovincia":["Select State","Seleccione una provincia","polski","italian","portugues","frances","Aleman"],
        "selfrmpago":["Select way to pay","Seleccione una forma de pago","polski","italian","portugues","frances","Aleman"],
        "msgsincliente":[" There is no customer that meets the search criteria ","No hay ningún cliente que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "vcliente":["See customer","ver cliente","polski","italian","portugues","frances","Aleman"],
        "msgtdbprocobro":["There are no payments for this invoice yet","Todavía no se ha producido ningún cobro de esta factura","polski","italian","portugues","frances","Aleman"],
        "fcvencrt":["expiration date","FECHA VTO.","polski","italian","portugues","frances","Aleman"],
        "mostradas":["shown","mostradas","polski","italian","portugues","frances","Aleman"],
        "relfac":["List of INVOICES","Lista de FACTURAS","polski","italian","portugues","frances","Aleman"],
        "impfactura":["Invoice total amount","Importe de la factura","polski","italian","portugues","frances","Aleman"],
        "pndpagar":["Not paid","Pendiente de pago","polski","italian","portugues","frances","Aleman"],
        "etdfac":["Invoice state","Estado de la factura","polski","italian","portugues","frances","Aleman"],
        "sinpagar":["Not paid ","Sin Pagar","polski","italian","portugues","frances","Aleman"],
        "reldcob":[" PAYMENTS LIST","LISTA de COBROS","polski","italian","portugues","frances","Aleman"],
        "obv":["english","OBV","polski","italian","portugues","frances","Aleman"],
        "elemb":["erase packaging","eliminar embalaje","polski","italian","portugues","frances","Aleman"],
        "modembalaje":["modify packaging","modificar embalaje","polski","italian","portugues","frances","Aleman"],
        "msgctrbsq":[" There are no packagings that meet the search criteria","No hay ningún embalaje que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "vembalaje":["see packaging","ver embalaje","polski","italian","portugues","frances","Aleman"],
        "elmentbanc":["Delete Bank","ELIMINAR ENTIDAD BANCARIA","polski","italian","portugues","frances","Aleman"],
        "bscentbanc":["Find Bank","Buscar ENTIDADES BANCARIAS","polski","italian","portugues","frances","Aleman"],
        "modentbanc":["MODIFY BANK","MODIFICAR ENTIDAD BANCARIA","polski","italian","portugues","frances","Aleman"],
        "insentbanc":["INSERT BANK","INSERTAR ENTIDAD BANCARIA","polski","italian","portugues","frances","Aleman"],
        "msgentbncnotfound":[" There is no way to pay that meets the search criteria ","No hay ninguna entidad bancaria que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "ventbanc":["See banking entity","VER ENTIDAD BANCARIA","polski","italian","portugues","frances","Aleman"],
        "elesttrab":["Erase Workstation","ELIMINAR Estaciones de Trabajo","polski","italian","portugues","frances","Aleman"],
        "bscesttrab":["Find workstation","Buscar Estaciones de Trabajo","polski","italian","portugues","frances","Aleman"],
        "codesttrab":["Workstation Code","Codigo de Estaciones de Trabajo","polski","italian","portugues","frances","Aleman"],
        "modesttrab":["MODIFY WORKSTATION","MODIFICAR Estaciones de Trabajo","polski","italian","portugues","frances","Aleman"],
        "insesttrab":["INSERT WORKSTATION","INSERTAR Estaciones de Trabajo","polski","italian","portugues","frances","Aleman"],
        "visualizar":["Visualize","Visualizar","polski","italian","portugues","frances","Aleman"],
        "eliminar":["delete","eliminar","polski","italian","portugues","frances","Aleman"],
        "msgetcnf":[" There is no workstation that meets the search criteria ","No hay ninguna estacion que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "vesttrab":["See Workstation","VER Estaciones de Trabajo","polski","italian","portugues","frances","Aleman"],
        "msgvlselartimp":["You should select an ítem before printing barcode","Debe seleccionar un articulo antes de imprimir el codigo de barras","polski","italian","portugues","frances","Aleman"],
        "elfac":["DELETE INVOICE","ELIMINAR FACTURA","polski","italian","portugues","frances","Aleman"],
        "artimpmin":["Following ítems are bellow minimum","Los siguientes artículos están bajo mínimo","polski","italian","portugues","frances","Aleman"],
        "insfactura":["ADD INVOICE","INSERTAR FACTURA","polski","italian","portugues","frances","Aleman"],
        "vfactura":["See invoice","Ver factura","polski","italian","portugues","frances","Aleman"],
        "mdfac":["MODIFY INVOICE","MODIFICAR FACTURA","polski","italian","portugues","frances","Aleman"],
        "eltparc":["DELETE ITEM TYPE","ELIMINAR Tipo de Articulo","polski","italian","portugues","frances","Aleman"],
        "rlctyarc":["List of item’s types","Lista de TIPOS DE ARTICULOS","polski","italian","portugues","frances","Aleman"],
        "modtparc":["Modify type of item","MODIFICAR TIPO DE ARTICULO","polski","italian","portugues","frances","Aleman"],
        "instyparc":[" Insert type of item ","INSERTAR TIPO DE ARTICULO","polski","italian","portugues","frances","Aleman"],
        "msgtparcnf":[" There is no family that meets the search criteria ","No hay ninguna familia que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "vtypsart":["See type of Item","VER TIPOS DE ARTICULOS","polski","italian","portugues","frances","Aleman"],
        "elfrmpg":["ERASE WAY TO PAY","ELIMINAR FORMA DE PAGO","polski","italian","portugues","frances","Aleman"],
        "bscfdp":["Search WAY TO PAY","Buscar FORMAS DE PAGO ","polski","italian","portugues","frances","Aleman"],
        "codfrmpg":["Way to pay code","Código de forma de pago","polski","italian","portugues","frances","Aleman"],
        "insfrmpg":["INSERT WAY TO PAY","INSERTAR FORMA DE PAGO","polski","italian","portugues","frances","Aleman"],
        "msgfpnf":[" There is no way to pay that meets the search criteria ","No hay ninguna forma de pago que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "vfp":["See Way to pay","VER FORMA DE PAGO","polski","italian","portugues","frances","Aleman"],
        "elmimp ":["ERASE TAX","ELIMINAR IMPUESTO","polski","italian","portugues","frances","Aleman"],
        "mdfimp":["MODIFY TAX","MODIFICAR IMPUESTO","polski","italian","portugues","frances","Aleman"],
        "insimp":["INSERT TASK","INSERTAR IMPUESTO","polski","italian","portugues","frances","Aleman"],
        "msgimpnf":[" There is no way to pay that meets the search criteria ","No hay ningun impuesto que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "vimp":["See TAX","VER IMPUESTO","polski","italian","portugues","frances","Aleman"],
        "relmov":[" LIST OF MOVEMENTS","LISTADO DE MOVIMIENTOS ","polski","italian", "portugues","frances","Aleman"],
        "cv":["english","C/V","polski","italian","portugues","frances","Aleman"],
        "numdocabr":[" Number of documents ","NUM. DOC.","polski","italian","portugues","frances","Aleman"],
        "msgmovfn":[" There is no movement that meets the search criteria ","No hay ning&uacute;n movimiento que cumpla con los criterios de b&uacute;squeda","polski","italian","portugues","frances","Aleman"],
        "impsiva":["Price","Importe sin iva","polski","italian","portugues","frances","Aleman"],
        "impciva":["Price plus tax","Importe con iva","polski","italian","portugues","frances","Aleman"],
        "fcsiva":[" Total billing ","Total facturación sin iva","polski","italian","portugues","frances","Aleman"],
        "fcciva":[" Total billing plus tax","Total facturaci&oacute;n con iva","polski","italian","portugues","frances","Aleman"],
        "codfacabbr":["Invoice code","Cod. Factura","polski","italian","portugues","frances","Aleman"],
        "msgvnmfacrep":["This code already exists in the system","No se puede dar de alta este numero de factura con este proveedor, ya existe uno en el sistema","polski","italian","portugues","frances","Aleman"],
        "msgermodlot":["ATTENTION; Lot could not be modified succesfully","ATENCION: No ha podido ser modificado con exito el lote","polski","italian","portugues","frances","Aleman"],
        "msgokmodlot":[" ATTENTION; Lot was modified succesfully ","ATENCION: El lote ha sido modificado con exito!","polski","italian","portugues","frances","Aleman"],
        "msgcrlotok":["ATTENTION: Batch was created successfully, with code","ATENCION: El lote ha sido creado exitosamente con el codigo","polski","italian","portugues","frances","Aleman"],
        "msgcrloter":[" ATTENTION: All fields realted to the Item are Obligatory! ","ATENCION: Los Campos relativos al articulo del lote son obligatorios!","polski","italian","portugues","frances","Aleman"],
        "msgvinslot":[" You need to enter a quantity to finallize lot","Es necesario insertar una cantidad para finalizar un lote!","polski","italian","portugues","frances","Aleman"],
        "modlote":["Modify Batch","Modificar Lote","polski","italian","portugues","frances","Aleman"],
        "codlote":["Batch code","Codigo de Lote","polski","italian","portugues","frances","Aleman"],
        "nombart":["Item’s name","Nombre de articulo","polski","italian","portugues","frances","Aleman"],
        "inizializado":["Started","Inicializado","polski","italian","portugues","frances","Aleman"],
        "inicar":["Start","Inicar","polski","italian","portugues","frances","Aleman"],
        "defmtprc":["Define meta-process","Definir meta-proceso","polski","italian","portugues","frances","Aleman"],
        "msgermdproc":[" ATTENTION: Process was not modified","ATENCION: No ha podido ser modificado con exito el proceso","polski","italian","portugues","frances","Aleman"],
        "msgokmdproc":[" ATTENTION: Process was modified successfully!","ATENCION: El proceso ha sido modificado con exito!","polski","italian","portugues","frances","Aleman"],
        "activado":["activated","activado","polski","italian","portugues","frances","Aleman"],
        "desactivado":["disabled","desactivado","polski","italian","portugues","frances","Aleman"],
        "msgprccrok":[" ATTENTION: Process was modified successfully, with code","ATENCION: El proceso ha sido creado exitosamente con el codigo","polski","italian","portugues","frances","Aleman"],
        "msgprccrer":[" ATTENTION: Fieals related to the article in the proccess are mandaory!!","ATENCION: Los Campos relativos al articulo del proceso son obligatorios!","polski","italian","portugues","frances","Aleman"],
        "dtmpmod":["Meta-process data","Datos del meta-proceso modificados","polski","italian","portugues","frances","Aleman"],
        "codmetaproc":[" Meta-process code ","Codigo del meta-proceso","polski","italian","portugues","frances","Aleman"],
        "artcrdproce":[" ITEM created by the process ","Articulo creado por el proceso","polski","italian","portugues","frances","Aleman"],
        "cntestprod":[" Estimated quantity to produce ","Cantidad estimada a producir","polski","italian","portugues","frances","Aleman"],
        "agrmatprim":[" Add Raw Material ","Agregar Materia prima","polski","italian","portugues","frances","Aleman"],
        "agrartmtpr":["Add Item as Raw Material","Agregar articulo como materia prima","polski","italian","portugues","frances","Aleman"],
        "mtprmeproce":["Meta-process raw materials","Materias primas del meta-proceso","polski","italian","portugues","frances","Aleman"],
        "linea":["line","linea","polski","italian","portugues","frances","Aleman"],
        "nmbart":[" Item’s name","Nombre del Articulo","polski","italian","portugues","frances","Aleman"],
        "umdmod":[" Modified Unit of Measurement ","Unidad de medida modificada","polski","italian","portugues","frances","Aleman"],
        "msgvmtmtproc":["You should first create a meta-process before adding raw materials","Se debe crear primero un metaproceso antes de agregar alguna materia prima al mismo","polski","italian","portugues","frances","Aleman"],
        "artresmeproce":["Article result of the process","Articulo resultado del proceso","polski","italian","portugues","frances","Aleman"],
        "msgvlcrbfact":["There are no payments for this invoice yet","Todavía no se ha producido ningún pago en esta factura","polski","italian","portugues","frances","Aleman"],
        "fchpago":["Payment date","Fecha de pago","polski","italian","portugues","frances","Aleman"],
        "fchdlpago":["Fecha de pago","Fecha del pago","polski","italian","portugues","frances","Aleman"],
        "grdfecha":["Save date","Guardar fecha","polski","italian","portugues","frances","Aleman"],
        "fcpago":["PAYMENT DATE","FECHA PAGO","polski","italian","portugues","frances","Aleman"],
        "hrsprv":["Amount of expected hours","Horas previstas","polski","italian","portugues","frances","Aleman"],
        "ttalprev":["Total expected","Total previsto","polski","italian","portugues","frances","Aleman"],
        "fccom":["Start date","Fecha Comienzo","polski","italian","portugues","frances","Aleman"],
        "flect":[" Reading Date ","Fecha Lectura","polski","italian","portugues","frances","Aleman"],
        "hinvertidas":[" Hours invested ","Horas invertidas","polski","italian","portugues","frances","Aleman"],
        "tinvertido":[" Total invested ","Total invertido","polski","italian","portugues","frances","Aleman"],
        "ndpenc":["Number of parts founded","N de partes encontrados","polski","italian","portugues","frances","Aleman"],
        "relprts":["List of Parts","LISTA de PARTES","polski","italian","portugues","frances","Aleman"],
        "trabajadores":[" employees ","trabajadores","polski","italian","portugues","frances","Aleman"],
        "cod_pres":["Budget code","código presupuesto","polski","italian","portugues","frances","Aleman"],
        "ttrabajo":[" Work´s Title ","Titulo Trabajo","polski","italian","portugues","frances","Aleman"],
        "rglspunt":[" Separate with decimal point ","(Separador decimal con . -punto-)","polski","italian","portugues","frances","Aleman"],
        "crprttrab":[" Create work order ","CREAR PARTE DE TRABAJO","polski","italian", "portugues","frances","Aleman"],
        "msgprtnf":[" There are no parts that meet the search criteria","No hay ning&uacute;n parte que cumpla con los criterios de","polski","italian","portugues","frances","Aleman"],
        "inspres":["Insert budget","INSERTAR presupuesto","polski","italian","portugues","frances","Aleman"],
        "crtpres":["CREATE BUDGET","CREAR PRESUPUESTO","polski","italian","portugues","frances","Aleman"],
        "msgpresnf":[" There is no budget that meets the search criteria ","No hay ningún presupuesto que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "vpres":["see Budget","VER PRESUPUESTO","polski","italian","portugues","frances","Aleman"],
        "regel":["register erased","record borrado","polski","italian","portugues","frances","Aleman"],
        "artdllote":["Lot item","Artículo del lote","polski","italian","portugues","frances","Aleman"],
        "finalizar":["End","Finalizar","polski","italian","portugues","frances","Aleman"],
        "msgerproc_1":[" Closing process could not be completed ","La finalizacion no ha podido ser realizada!!!!","polski","italian","portugues","frances","Aleman"],
        "msgerproc_2":["All Items have to be validated before ending the process","Todos los articulos deben ser validados antes de finalizar el proceso.","polski","italian","portugues","frances","Aleman"],
        "msgerproc_3":[" the total amount of process outcome must be input ","Y la cantidad total del resultado del proceso debe ser ingresada.","polski","italian","portugues","frances","Aleman"],
        "msgokfinproc":["Process ended on date ","El proceso ha sido finalizado con fecha","polski","italian","portugues","frances","Aleman"],
        "yhora":["at","y hora","polski","italian","portugues","frances","Aleman"],
        "porcantd":[" For an amount of ","Por una cantidad de","polski","italian","portugues","frances","Aleman"],
        "esttrab":["Workstation","Estacion de Trabajo","polski","italian","portugues","frances","Aleman"],
        "nombempl":["Worker´s name","Nombre del empleado","polski","italian","portugues","frances","Aleman"],
        "artdproce":["Process ITEM","articulo del proceso","polski","italian","portugues","frances","Aleman"],
        "selelun_1":["Select a","Seleccionar un","polski","italian","portugues","frances","Aleman"],
        "selelun_2":["from the list","de la lista","polski","italian","portugues","frances","Aleman"],
        "msgprcinit":["Process started succefully with its code","El proceso ha sido inicializado exitosamente con el codigo","polski","italian","portugues","frances","Aleman"],
        "mdfproce":["Modify process","Modificar proceso","polski","italian","portugues","frances","Aleman"],
        "nmbmtrprm":["Name of raw material","Nombre de la Materia Prima","polski","italian","portugues","frances","Aleman"],
        "msglnadd_1":["The line has been validated and inserted with the number:","La línea ha sido validada e insertada con el número:","La linea ha sido validada e insertada en la base de datos con el numero de linea ","polski","italian","portugues","frances","Aleman"],
        "msglnadd_2":["In the process:","En el proceso: ","polski","italian","portugues", "frances","Aleman"],
        "elmprov":["DELETE SUPLIER","ELIMINAR PROVEEDOR","polski","italian","portugues","frances","Aleman"],
        "modprove":["MODIFY SUPLIER","MODIFICAR PROVEEDOR","polski","italian","portugues","frances","Aleman"],
        "insprvdr":["INSERT  SUPLIER","INSERTAR PROVEEDOR","polski","italian","portugues","frances","Aleman"],
        "msgprvnf":[" There are not supliers that meet the search criteria ","No hay ningún proveedor que cumpla con los criterios ","polski","italian","portugues","frances","Aleman"],
        "vprodr":["See supplier","ver proveedor","polski","italian","portugues","frances","Aleman"],
        "lngyloc":["Lenguage and Localization","Lenguaje y localizacion","jezyk i lokalizacja","lingua e localizzazione","portugues","frances","Aleman"],
        "elgidi":["Chose a Languaje","Elija un idioma","polski","italian","portugues","frances","Aleman"],
        "msgtrbnf":["There is no worker with that code","No existe ningun trabajador con ese codigo","polski","italian","portugues","frances","Aleman"],
        "elmtrab":["Erase worker","ELIMINAR TRABAJADOR","polski","italian","portugues","frances","Aleman"],
       "movavi":["Contact phone number","Celular de contacto","Telefoniczny numer kontaktowy","Numero di  contatto telefonico","Telefone para contato","Numéro de téléphone de contact","Kontakt Telefonnummer","móvil avisos"],
        "correlecavs":["emails notices","correo electrónico   CORREGIR   avisos","polski","italian","portugues","frances","Aleman"],
        "modtrab":["MODIFY EMPLOYEE","MODIFICAR TRABAJADOR","polski","italian","portugues","frances","Aleman"],
        "instrab":["Insert worker","INSERTAR TRABAJADOR","polski","italian","portugues","frances","Aleman"],
        "vtrb":["See worker","VER TRABAJADOR","polski","italian","portugues","frances","Aleman"],
        "elmubc":["ERASE LOCATION","ELIMINAR UBICACI&Oacute;N","polski","italian","portugues","frances","Aleman"],
        "modubc":["MODIFY LOCATION","MODIFICAR UBICACI&Oacute;N","polski","italian","portugues","frances","Aleman"],
        "insubc":["INSERT LOCATION","INSERTAR UBICACI&Oacute;N","polski","italian","portugues","frances","Aleman"],
        "msgubcnf":[" There not a location that meets the search criteria ","No hay ninguna ubicación que cumpla con los criterios de búsqueda","polski","italian","portugues","frances","Aleman"],
        "vubc":["Find location","VER UBICACI&Oacute;N","polski","italian","portugues","frances","Aleman"],
        "vntmst":["Point of Sales","Venta Mostrador","polski","italian","portugues","frances","Aleman"],
        "mdgartnfcb":["There is no ítem with this barcode","No existe ningun artículo con ese código de barras","polski","italian","portugues","frances","Aleman"],
        "cobro":["payment","cobro","polski","italian","portugues","frances","Aleman"],
       //codigo muerto "impvl":["english","Importe vale","polski","italian","portugues","frances","Aleman"],
        "apgr":["To be paid","A pagar","polski","italian","portugues","frances","Aleman"],
        "pagado":["Paid","Pagado","polski","italian","portugues","frances","Aleman"],
        "adevolver":["Refund ","A devolver","polski","italian","portugues","frances","Aleman"],
        "msgfacyacbr":["This invoice was allready paid","Esta factura ya se cobro con anterioridad","polski","italian","portugues","frances","Aleman"],
        "msgcbrok":["Payment has been made correctly","El cobro se ha efectuado correctamente","polski","italian","portugues","frances","Aleman"],
        "efcpag":["Pay","Efectuar pago","polski","italian","portugues","frances","Aleman"],
        "msgfbd":["You Shall Not Pass!!!!","¡¡¡¡No debe pasar!!!!","polski","italian","portugues","frances","Aleman"],
        "tfbd":["403 Forbidden Page","403 Página prohibida","polski","italian","portugues","frances","Aleman"],
        "relcli":["Customers list","LISTADO de CLIENTES","polski","italian","portugues","frances","Aleman"],
        "nroclifnd":["Number of customers founded","N de clientes encontrados","polski","italian","portugues","frances","Aleman"],
        "valcodbar":["Validate barcode","Validar codigo de barras","polski","italian","portugues","frances","Aleman"],
        "calinft":["Calendar Information","Información del Calendario","polski","italian","portugues","frances","Aleman"],
        "calselfch":["Select Date","Seleccione fecha","polski","italian","portugues","frances","Aleman"],
        "cal":["Calendar","calendario","polski","italian","portugues","frances","Aleman"],
        "reldprec":["List of budgets","Lista de presupuestos","polski","italian","portugues","frances","Aleman"],
        "bscprec":["Find budget","Buscar presupuesto","polski","italian","portugues","frances","Aleman"],
        "relproc":["List of processes","Lista de procesos ","polski","italian","portugues","frances","Aleman"],
        "bscdbch":["Batch search","búsqueda de batch","polski","italian","portugues","frances","Aleman"],
        "reldbch":["List of batches","listado de batchs", "polski","italian","portugues","frances","Aleman"],
        //@todo revisar si no refiere a lo mismo que bscdbch o son distintos
        "bscdlts":["Find batches","busqueda de lotes","polski","italian","portugues","frances","Aleman"],
        "relfrmpag":["LIST OF WAYS TO PAY","LISTADO DE FORMAS DE PAGO","polski","italian","portugues","frances","Aleman"],
        //"varidable_name":["english","espanol","polski","italian","portugues","frances","Aleman"],
        //"varidable_name":["english","espanol","polski","italian","portugues","frances","Aleman"],
    };


    var trans ='traduccion no definida'
    var lang = getLanguajeIndex();
    if(typeof traductions[name]!== 'undefined' && typeof traductions[name][lang] !== 'undefined')
    {
        trans = traductions[name][lang];
    }
    return trans;
}

//language change function
function langchange() {
    $("#companyName").text(getTranslationText('company_name'));
    $("#password,#tpassword").text(getTranslationText('password'));
    $("#passwordValidation").text(getTranslationText('passwordValidation'));
    $("#emailValidation").text(getTranslationText('emailValidation'));
    $("#nombre, #nombre2, #tnombre").text(getTranslationText('nombre'));
    $("#member").text(getTranslationText('member'));
    $("#golo").text(getTranslationText('golo'));
    $("#sub").text(getTranslationText('sub'));
    $("#details").text(getTranslationText('details'));
    $("#signin").text(getTranslationText('signin'));
    $("#companyCode").text(getTranslationText('companyCode'));
    $("#noMember").text(getTranslationText('noMember'));
    $("#copiasRespaldo,#tcopiasRespaldo").text(getTranslationText('copiasRespaldo'));
    $("#hacerrespaldo,#thacerrespaldo").text(getTranslationText('hacerrespaldo'));
    $("#restaurarrespaldo,#trestaurarrespaldo").text(getTranslationText('restaurarrespaldo'));
    $("#AdminSeguridad").text(getTranslationText('AdminSeguridad'));
    $("#usuarios,#tusuarios").text(getTranslationText('usuarios'));
    $("#roles,#troles").text(getTranslationText('roles'));
    $("#recursos,#trecursos").text(getTranslationText('recursos'));
    $("#ventas_plus").text(getTranslationText('ventas_plus'));
    $("#ventas").text(getTranslationText('ventas'));
    $("#venta_a_mostrador").text(getTranslationText('venta_a_mostrador'));
    $("#cliente,#tcliente").text(getTranslationText('cliente'));
    $("#clientes").text(getTranslationText('clientes'));
    $("#factura,#factura_c").text(getTranslationText('factura'));
    $("#remitos,#remitos_c").text(getTranslationText('remitos'));
    $("#facturar_remitos,#facturar_remitos_c").text(getTranslationText('facturar_remitos'));
    $("#presupuestos").text(getTranslationText('presupuestos'));
    $("#produccion_plus").text(getTranslationText('produccion_plus'));
    $("#produccion").text(getTranslationText('produccion'));
    $("#tipodart").text(getTranslationText('tipodart'));
    $("#articu").text(getTranslationText('articu'));
    $("#metproc").text(getTranslationText('metproc'));
    $("#propru").text(getTranslationText('propru'));
    $("#batchprod").text(getTranslationText('batchprod'));
    $("#lotdprod").text(getTranslationText('lotdprod'));
    $("#estactra").text(getTranslationText('estactra'));
    $("#compras_plus").text(getTranslationText('compras_plus'));
    $("#compras").text(getTranslationText('compras'));
    $("#prov,#tprov").text(getTranslationText('prov'));
    $("#tprov1").text(getTranslationText('prov1'));
    $("#tprov2").text(getTranslationText('prov2'));
    $("#contabilidad_plus").text(getTranslationText('contabilidad_plus'));
    $("#contabilidad").text(getTranslationText('contabilidad'));
    $("#cobros").text(getTranslationText('cobros'));
    $("#pagos,#tpagos").text(getTranslationText('pagos'));
    $("#cjadiaria").text(getTranslationText('cjadiaria'));
    $("#librodrio").text(getTranslationText('librodrio'));
    $("#forpago,#tforpago").text(getTranslationText('forpago'));
    $("#impuestos").text(getTranslationText('impuestos'));
    $("#entbcaria").text(getTranslationText('entbcaria'));
    $("#rrhh_plus").text(getTranslationText('rrhh_plus'));
    $("#rrhh").text(getTranslationText('rrhh'));
    $("#ordentrabajo").text(getTranslationText('ordentrabajo'));
    $("#empleado").text(getTranslationText('empleado'));
    $("#config_plus").text(getTranslationText('config_plus'));
    $("#config").text(getTranslationText('config'));
    $("#etiquet").text(getTranslationText('etiquet'));
    $("#ubica").text(getTranslationText('ubica'));
    $("#embala").text(getTranslationText('embala'));
    $("#factremi").text(getTranslationText('factremi'));
    $("#codremito").text(getTranslationText('codremito'));
    $("#fecha,#fecha2,#tfecha").text(getTranslationText('fecha'));
    $("#aceptar,#taceptar").text(getTranslationText('aceptar'));
    $("#cancelar,#tcancelar").text(getTranslationText('cancelar'));
    $("#buscarremito").text(getTranslationText('buscarremito'));
    $("#cod_cliente,#tcod_cliente").text(getTranslationText('cod_cliente'));
    $("#nomb,#tnomb").text(getTranslationText('nomb'));
    $("#nrorto,#nrorto_2,#tnrorto").text(getTranslationText('nrorto'));
    $("#estado,#estado_2,#testado").text(getTranslationText('estado'));
    $("#todestad").text(getTranslationText('todestad'));
    $("#sinfact").text(getTranslationText('sinfact'));
    $("#facturados").text(getTranslationText('facturados'));
    $("#fechin,#tfechin").text(getTranslationText('fechin'));
    $("#fchafin,#tfchafin").text(getTranslationText('fchafin'));
    $("#nueprov,#tnueprov").text(getTranslationText('nueprov'));
    $("#nrortoenc").text(getTranslationText('nrortoenc'));
    $("#mostra,#tmostra").text(getTranslationText('mostra'));
    $("#relacrtos").text(getTranslationText('relacrtos'));
    $("#item,#titem").text(getTranslationText('item'));
    $("#importe,#importe2,#timporte").text(getTranslationText('importe'));
    $("#limp,#tlimp,#tlimpiar").text(getTranslationText('limp'));
    $("#busc,#tbusc").text(getTranslationText('busc'));
    $("#elmalbaran,#telmalbaran").text(getTranslationText('elmalbaran'));
    $("#direccion,#tdireccion").text(getTranslationText('direccion'));
    $("#codalbaran,#tcodalbaran").text(getTranslationText('codalbaran'));
    $("#iva, #iva2,#tiva").text(getTranslationText('iva'));
    $("#flia,#tflia").text(getTranslationText('flia'));
    $("#cant,#cant2,#tcant").text(getTranslationText('cant'));
    $("#precio,#precio2,#tprecio").text(getTranslationText('precio'));
    $("#dctop,#tdctop").text(getTranslationText('dctop'));
    $("#baseimp,#tbaseimp").text(getTranslationText('baseimp'));
    $("#total,#ttotal").text(getTranslationText('total'));
    $("#refren,#trefren").text(getTranslationText('referenc'));
    $("#descri,#tdescri").text(getTranslationText('descri'));
    $("#codigo,#tcodigo").text(getTranslationText('codigo'));
    $("#nip,#tnip").text(getTranslationText('NIP'));
    $("#artbajomin").text(getTranslationText('artbajomin'));
    $("#codfactura,#tcodfactura").text(getTranslationText('codfactura'));
    $("#referenc,#treferenc").text(getTranslationText('referenc'));
    $("#impr,#timpr").text(getTranslationText('impr'));
    $("#balbaran").text(getTranslationText('balbaran'));
    $("#tbalbaranes").text(getTranslationText('balbaranes'));
    $("#relalbaranes,#trelalbaranes").text(getTranslationText('relalbaranes'));
    $("#insalbaran,#tinsalbaran").text(getTranslationText('insalbaran'));
    $("#dcto,#tdcto").text(getTranslationText('dcto'));
    $("#agregar,#tagregar").text(getTranslationText('agregar'));
    $("#subtotal").text(getTranslationText('subtotal'));
    $("#pciototal,#tpciototal").text(getTranslationText('pciototal'));
    $("#calbaran").text(getTranslationText('calbaran'));
    $("#msgsinresultado").text(getTranslationText('msgsinresultado'));
    $("#tmsgsc").text(getTranslationText('msgsc'));
    $("#tcerrar").text(getTranslationText('cerrar'));
    $("#ttdart").text(getTranslationText('tdart'));
    $("#tvalbaran").text(getTranslationText('valbaran'));
    $("#tconvalbaran").text(getTranslationText('convalbaran'));
    $("#tnrofac,#nrofac").text(getTranslationText('nrofac'));
    $("#tcodprov").text(getTranslationText('codprov'));
    $("#testados").text(getTranslationText('estados'));
    $("#tbuscar").text(getTranslationText('buscar'));
    $("#tndalbaranese").text(getTranslationText('ndalbaranese'));
    $("#tndalbaran").text(getTranslationText('ndalbaran'));
    $("#tmalbaran").text(getTranslationText('malbaran'));
    $("#tcod").text(getTranslationText('cod'));
    $("#tcodralbaran").text(getTranslationText('codralbaran'));
    $("#tvart").text(getTranslationText('vart'));
    $("#tselart").text(getTranslationText('selart'));
    $("#ttipo").text(getTranslationText('tipo'));
    $("#tsel").text(getTranslationText('sel'));
    $("#telart").text(getTranslationText('elart'));
    $("#timpuesto").text(getTranslationText('impuesto'));
    $("#tdesccorta").text(getTranslationText('desccorta'));
    $("#tubicacion").text(getTranslationText('ubicacion'));
    $("#tunidades").text(getTranslationText('unidades'));
    $("#tstock").text(getTranslationText('stock'));
    $("#tstkmin").text(getTranslationText('stkmin'));
    $("#tavisominimo").text(getTranslationText('avisominimo'));
    $("#tdatroduc").text(getTranslationText('datroduc'));
    $("#tfchaalta").text(getTranslationText('fchaalta'));
    $("#tsindet").text(getTranslationText('sindet'));
    $("#tunidcaja").text(getTranslationText('unidcaja'));
    $("#tpregpciotk").text(getTranslationText('pregpciotk'));
    $("#tembalaje").text(getTranslationText('embalaje'));
    $("#tmdesctick").text(getTranslationText('mdesctick'));
    $("#tobsev").text(getTranslationText('obsev'));
    $("#tpciocomp").text(getTranslationText('pciocomp'));
    $("#tpcioalma").text(getTranslationText('pcioalma'));
    $("#tprectienda").text(getTranslationText('prectienda'));
    $("#tprcciva").text(getTranslationText('prcciva'));
    $("#tcodbarr").text(getTranslationText('codbarr'));
    $("#tbuscaart").text(getTranslationText('buscaart'));
    $("#tcodart").text(getTranslationText('codart'));
    $("#tnuevo").text(getTranslationText('nuevo'));
    $("#ttrealcionart").text(getTranslationText('realcionart'));
    $("#tndartenctn").text(getTranslationText('ndartenctn'));
    $("#tpreciot").text(getTranslationText('preciot'));
    $("#tundmed").text(getTranslationText('undmed'));
    $("#tmodarticulo").text(getTranslationText('modarticulo'));
    $("#tmoddesctick").text(getTranslationText('moddesctick'));
    $("#tpalmacen").text(getTranslationText('palmacen'));
    $("#tptienda").text(getTranslationText('ptienda'));
    $("#timgfrmjpg").text(getTranslationText('imgfrmjpg'));
    $("#tinsart").text(getTranslationText('insart'));
    $("#tprcventpub").text(getTranslationText('prcventpub'));
    $("#tmsgsinrbus").text(getTranslationText('msgsinrbus'));
    $("#tvarticulo").text(getTranslationText('varticulo'));
    $("#item").text(getTranslationText('item'));
    $("#importe").text(getTranslationText('importe'));
    //$("#limp").text(getTranslationText('limp'));
    $("#busc").text(getTranslationText('busc'));
    $("#eliminarRto,#teliminarRto").text(getTranslationText('eliminarRto'));
    $("#direccion").text(getTranslationText('direccion'));
    $("#iva,#iva2").text(getTranslationText('iva'));
    $("#cant").text(getTranslationText('cant'));
    $("#precio").text(getTranslationText('precio'));
    $("#dto_pc").text(getTranslationText('dto_pc'));
    $("#baseImpo").text(getTranslationText('baseImpo'));
    $("#total").text(getTranslationText('total'));
    $("#thinic").text(getTranslationText('hinic'));
    $("#thorafincrt").text(getTranslationText('horafincrt'));
    $("#tart").text(getTranslationText('tart'));
    $("#tmsgatncbatexterror").text(getTranslationText('msgatncbatexterror'));
    $("#tmsgatncbatext").text(getTranslationText('msgatncbatext'));
    $("#tcribu_2").text(getTranslationText('cribu_2'));
    $("#tcribu_3").text(getTranslationText('cribu_3'));
    $("#tnroloten").text(getTranslationText('nroloten'));
    $("#tbuscfcha").text(getTranslationText('buscfcha'));
    $("#tfcierre").text(getTranslationText('fchaciere'));
    $("#tdetcrrcaja").text(getTranslationText('detcrrcaja'));
    $("#tfchacja").text(getTranslationText('fchacja'));
    $("#tdelticktnro").text(getTranslationText('delticktnro'));
    $("#taltktnro").text(getTranslationText('altktnro'));
    $("#tneto").text(getTranslationText('neto'));
    $("#ttotalcdo").text(getTranslationText('totalcdo'));
    $("#ttotaltj").text(getTranslationText('totaltj'));
    $("#tlocal").text(getTranslationText('local'));
    $("#tpcia").text(getTranslationText('pcia'));
    $("#tentiban").text(getTranslationText('entiban'));
    $("#tctabcaria").text(getTranslationText('ctabcaria'));
    $("#tcodpostal").text(getTranslationText('codpostal'));
    $("#ttelef").text(getTranslationText('telef'));
    $("#tmovil").text(getTranslationText('movil'));
    $("#tcorrelec").text(getTranslationText('correlec'));
    $("#tdirrcweb").text(getTranslationText('dirrcweb'));
    $("#tbcliente").text(getTranslationText('bcliente'));
    $("#tcodcli").text(getTranslationText('codcli'));
    $("#tinscliente").text(getTranslationText('inscliente'));
    $("#tmsgsincliente").text(getTranslationText('msgsincliente'));
    $("#tvcliente").text(getTranslationText('vcliente'));
    $("#tmsgtdbprocobro").text(getTranslationText('msgtdbprocobro'));
    $("#tpendient").text(getTranslationText('pendient'));
    $("#tfcvencrt").text(getTranslationText('fcvencrt'));
    $("#tnrofcenco").text(getTranslationText('nrofcenco'));
    $("#tmostradas").text(getTranslationText('mostradas'));
    $("#trelfac").text(getTranslationText('relfac'));
    $("#tnvafact").text(getTranslationText('nvafact'));
    $("#tnhnfqccbu").text(getTranslationText('nhnfqccbu'));
    $("#timpfactura").text(getTranslationText('impfactura'));
    $("#tpndpagar").text(getTranslationText('pndpagar'));
    $("#tetdfac").text(getTranslationText('etdfac'));
    $("#tfchavto").text(getTranslationText('fchavto'));
    $("#tnrodocum").text(getTranslationText('nrodocum'));
    $("#treldcob").text(getTranslationText('reldcob'));
    $("#tobv").text(getTranslationText('obv'));
    $("#telemb").text(getTranslationText('elemb'));
    $("#tbusembj").text(getTranslationText('busembj'));
    $("#tcodembal").text(getTranslationText('codembal'));
    $("#tnroemben").text(getTranslationText('nroemben'));
    $("#tmodembalaje").text(getTranslationText('modembalaje'));
    $("#tinseremb").text(getTranslationText('inseremb'));
    $("#tmsgctrbsq").text(getTranslationText('msgctrbsq'));
    $("#tvembalaje").text(getTranslationText('vembalaje'));
    $("#telmentbanc").text(getTranslationText('elmentbanc'));
    $("#tbscentbanc").text(getTranslationText('bscentbanc'));
    $("#tcodentida").text(getTranslationText('codentida'));
    $("#tnroenbcen").text(getTranslationText('nroenbcen'));
    $("#tmodentbanc").text(getTranslationText('modentbanc'));
    $("#tinsentbanc").text(getTranslationText('insentbanc'));
    $("#tmsgentbncnotfound").text(getTranslationText('msgentbncnotfound'));
    $("#tventbanc").text(getTranslationText('ventbanc'));
    $("#telesttrab").text(getTranslationText('elesttrab'));
    $("#tbscesttrab").text(getTranslationText('bscesttrab'));
    $("#tnroesten").text(getTranslationText('nroesten'));
    $("#trelestatr").text(getTranslationText('relestatr'));
    $("#tcodesttrab").text(getTranslationText('codesttrab'));
    $("#tmodesttrab").text(getTranslationText('modesttrab'));
    $("#tinsesttrab").text(getTranslationText('insesttrab'));
    $("#tmsgetcnf").text(getTranslationText('msgetcnf'));
    $("#tvesttrab").text(getTranslationText('vesttrab'));
    $("#telfac").text(getTranslationText('elfac'));
    $("#tartimpmin").text(getTranslationText('artimpmin'));
    $("#tbuscafc").text(getTranslationText('buscafc'));
    $("#tinsfactura").text(getTranslationText('insfactura'));
    $("#tvfactura").text(getTranslationText('vfactura'));
    $("#tmdfac").text(getTranslationText('mdfac'));
    $("#tbtipoar").text(getTranslationText('btipoar'));
    $("#tinstyparc").text(getTranslationText('instyparc'));
    $("#tmodtparc").text(getTranslationText('modtparc'));
    $("#tmsgtparcnf").text(getTranslationText('msgtparcnf'));
    $("#tvtypsart").text(getTranslationText('vtypsart'));
    $("#telfrmpg").text(getTranslationText('elfrmpg'));
    $("#tbscfdp").text(getTranslationText('bscfdp'));
    $("#tcodfrmpg").text(getTranslationText('codfrmpg'));
    $("#tinsfrmpg").text(getTranslationText('insfrmpg'));
    $("#tmsgfpnf").text(getTranslationText('msgfpnf'));
    $("#tvfp").text(getTranslationText('vfp'));
    $("#telmimp").text(getTranslationText('elmimp'));
    $("#tvalor").text(getTranslationText('valor'));
    $("#tbusimp").text(getTranslationText('busimp'));
    $("#tcodimp").text(getTranslationText('codimp'));
    $("#treimp").text(getTranslationText('reimp'));
    $("#tmdfimp").text(getTranslationText('mdfimp'));
    $("#tinsimp").text(getTranslationText('insimp'));
    $("#tmsgimpnf").text(getTranslationText('msgimpnf'));
    $("#tvimp").text(getTranslationText('vimp'));
    $("#tbuscmov").text(getTranslationText('buscmov'));
    $("#trelmov").text(getTranslationText('relmov'));
    $("#tcv").text(getTranslationText('cv'));
    $("#tfactura").text(getTranslationText('factura'));
    $("#comerc").text(getTranslationText('comerc'));
    $("#tnumdocabr").text(getTranslationText('numdocabr'));
    $("#tfacturar_remitos").text(getTranslationText('facturar_remitos'));
    $("#tmsgmovfn").text(getTranslationText('msgmovfn'));
    $("#tnrortoini").text(getTranslationText('nrortoini'));
    $("#timpsiva").text(getTranslationText('impsiva'));
    $("#timpciva").text(getTranslationText('impciva'));
    $("#tfcsiva").text(getTranslationText('fcsiva'));
    $("#tfcciva").text(getTranslationText('fcciva'));
    $("#tcodfacabbr").text(getTranslationText('codfacabbr'));
    $("#trelalot").text(getTranslationText('relalot'));
    $("#tmsgermodlot").text(getTranslationText('msgermodlot'));
    $("#tmsgokmodlot").text(getTranslationText('msgokmodlot'));
    $("#tmsgcrlotok").text(getTranslationText('msgcrlotok'));
    $("#tmsgcrloter").text(getTranslationText('msgcrloter'));
    $("#tmodlote").text(getTranslationText('modlote'));
    $("#tcodlot").text(getTranslationText('codlote'));
    $("#tnombart").text(getTranslationText('nombart'));
    $("#tinicar").text(getTranslationText('inicar'));
    $("#tdefmtprc").text(getTranslationText('defmtprc'));
    $("#ttipproc").text(getTranslationText('tipproc'));
    $("#tmsgermdproc").text(getTranslationText('msgermdproc'));
    $("#tmsgokmdproc").text(getTranslationText('msgokmdproc'));
    $("#tmsgprccrok").text(getTranslationText('msgprccrok'));
    $("#tmsgprccrer").text(getTranslationText('msgprccrer'));
    $("#tdtmpmod").text(getTranslationText('dtmpmod'));
    $("#tcodmetaproc").text(getTranslationText('codmetaproc'));
    $("#tartcrdproce").text(getTranslationText('artcrdproce'));
    $("#tcntestprod").text(getTranslationText('cntestprod'));
    $("#tagrmatprim").text(getTranslationText('agrmatprim'));
    $("#tagrartmtpr").text(getTranslationText('agrartmtpr'));
    $("#tmtprmeproce").text(getTranslationText('mtprmeproce'));
    $("#tlinea").text(getTranslationText('linea'));
    $("#tnmbart").text(getTranslationText('nmbart'));
    $("#tumdmod").text(getTranslationText('umdmod'));
    $("#tartresmeproce").text(getTranslationText('artresmeproce'));
    $("#tmsgvlcrbfact").text(getTranslationText('msgvlcrbfact'));
    $("#tfchpago").text(getTranslationText('fchpago'));
    $("#tfchdlpago").text(getTranslationText('fchdlpago'));
    $("#tfcpago").text(getTranslationText('fcpago'));
    $("#thrsprv").text(getTranslationText('hrsprv'));
    $("#tpciohs").text(getTranslationText('pciohs'));
    $("#tttalprev").text(getTranslationText('ttalprev'));
    $("#tfccom,#tfccom2").text(getTranslationText('fccom'));
    $("#tflect").text(getTranslationText('flect'));
    $("#tfechfin").text(getTranslationText('fechfin'));
    $("#thinvertidas").text(getTranslationText('hinvertidas'));
    $("#ttinvertido").text(getTranslationText('tinvertido'));
    $("#tndpenc").text(getTranslationText('ndpenc'));
    $("#trelprts").text(getTranslationText('relprts'));
    $("#tnroparte").text(getTranslationText('nroparte'));
    $("#ttrabajad,#ttrabajad2").text(getTranslationText('trabajad'));
    $("#ttrabajadores").text(getTranslationText('trabajadores'));
    $("#ttrabaj,#ttrabaj2").text(getTranslationText('trabaj'));
    $("#tcod_pres").text(getTranslationText('cod_pres'));
    $("#tttrabajo").text(getTranslationText('ttrabajo'));
    $("#trglspunt").text(getTranslationText('rglspunt'));
    $("#tcrprttrab").text(getTranslationText('crprttrab'));
    $("#tcodtjador").text(getTranslationText('codtjador'));
    $("#tmsgprtnf").text(getTranslationText('msgprtnf'));
    $("#tprov").text(getTranslationText('prov'));
    $("#tprovs").text(getTranslationText('provs'));
    $("#tinspres").text(getTranslationText('inspres'));
    $("#tcrtpres").text(getTranslationText('crtpres'));
    $("#tmsgpresnf").text(getTranslationText('msgpresnf'));
    $("#tvpres").text(getTranslationText('vpres'));
    $("#tregel").text(getTranslationText('regel'));
    $("#tnomproc").text(getTranslationText('nomproc'));
    $("#testacion").text(getTranslationText('estacion'));
    $("#tmodificar").text(getTranslationText('modificar'));
    $("#tartdllote").text(getTranslationText('artdllote'));
    $("#tfinalizar").text(getTranslationText('finalizar'));
    $("#tmsgerproc_1").text(getTranslationText('msgerproc_1'));
    $("#tmsgerproc_2").text(getTranslationText('msgerproc_2'));
    $("#tmsgerproc_3").text(getTranslationText('msgerproc_3'));
    $("#tmsgokfinproc").text(getTranslationText('msgokfinproc'));
    $("#tyhora").text(getTranslationText('yhora'));
    $("#tporcantd").text(getTranslationText('porcantd'));
    $("#tnroprocen").text(getTranslationText('nroprocen'));
    $("#tselelun_1").text(getTranslationText('selelun_1'));
    $("#tselelun_2").text(getTranslationText('selelun_2'));
    $("#tcodproce").text(getTranslationText('codproce'));
    $("#tmsgprcinit").text(getTranslationText('msgprcinit'));
    $("#tmdfproce").text(getTranslationText('mdfproce'));
    $("#tmateprima").text(getTranslationText('mateprima'));
    $("#tnmbmtrprm").text(getTranslationText('nmbmtrprm'));
    $("#tmsglnadd_1").text(getTranslationText('msglnadd_1'));
    $("#tmsglnadd_2").text(getTranslationText('msglnadd_2'));
    $("#telmprov").text(getTranslationText('elmprov'));
    $("#tbprov").text(getTranslationText('bprov'));
    $("#tnroproven").text(getTranslationText('nroproven'));
    $("#tmodprove").text(getTranslationText('modprove'));
    $("#tinsprvdr").text(getTranslationText('insprvdr'));
    $("#tmsgprvnf").text(getTranslationText('msgprvnf'));
    $("#tvprodr").text(getTranslationText('vprodr'));
    $("#tlngyloc").text(getTranslationText('lngyloc'));
    $("#telgidi").text(getTranslationText('elgidi'));
    $("#telmtrab").text(getTranslationText('elmtrab'));
    $("#tmovavi").text(getTranslationText('movavi'));
    $("#tcorrelecavs").text(getTranslationText('correlecavs'));
    $("#tbusctrabj").text(getTranslationText('busctrabj'));
    $("#tnrotraben").text(getTranslationText('nrotraben'));
    $("#treltrabj").text(getTranslationText('reltrabj'));
    $("#tmodtrab").text(getTranslationText('modtrab'));
    $("#tinstrab").text(getTranslationText('instrab'));
    $("#tmsgtrbnf").text(getTranslationText('msgtrbnf'));
    $("#tvtrb").text(getTranslationText('vtrb'));
    $("#telmubc").text(getTranslationText('elmubc'));
    $("#tbuscubic").text(getTranslationText('buscubic'));
    $("#tcodubic").text(getTranslationText('codubic'));
    $("#trelacubic").text(getTranslationText('relacubic'));
    $("#tmodubc").text(getTranslationText('modubc'));
    $("#tinsubc").text(getTranslationText('insubc'));
    $("#tmsgubcnf").text(getTranslationText('msgubcnf'));
    $("#tvubc").text(getTranslationText('vubc'));
    $("#tvntmst").text(getTranslationText('vntmst'));
    $("#tcobro").text(getTranslationText('cobro'));
    $("#timpvl").text(getTranslationText('impvl'));
    $("#tapgr").text(getTranslationText('apgr'));
    $("#tpagado").text(getTranslationText('pagado'));
    $("#tadevolver").text(getTranslationText('adevolver'));
    $("#tnvavta").text(getTranslationText('nvavta'));
    $("#ttfbd").text(getTranslationText('tfbd'));
    $("#tmsgfbd").text(getTranslationText('msgfbd'));
    $("#trelcli").text(getTranslationText('relcli'));
    $("#tnroclifnd").text(getTranslationText('nroclifnd'));
    $("#tagregar").text(getTranslationText('agregar'));
    $("#treldprec").text(getTranslationText('reldprec'));
    $("#tbscprec").text(getTranslationText('bscprec'));
    $("#tnropresup,#tnropresupt").text(getTranslationText('nropresup'));
    $("#tnropresenc").text(getTranslationText('nropresenc'));
    $("#trlctyarc").text(getTranslationText('reltipar'));
    $("#tnrotipen").text(getTranslationText('nrotipen'));
    $("#tcodtpar").text(getTranslationText('codtpar'));
    $("#tbmetproc").text(getTranslationText('bmetproc'));
    $("#trelprocdef").text(getTranslationText('relprocdef'));
    $("#trelproc").text(getTranslationText('relproc'));
    $("#tbscdbch").text(getTranslationText('bscdbch'));
    $("#treldbch").text(getTranslationText('reldbch'));
    $("#trelacprov").text(getTranslationText('relacprov'));
    $("#tbscdlts").text(getTranslationText('bscdlts'));
    $("#trelfrmpag").text(getTranslationText('relfrmpag'));
    $("#trelentbc").text(getTranslationText('relentbc'));
    $("#tnombcliente").text(getTranslationText('nombcliente'));
    $("#tnvorto").text(getTranslationText('tnvorto'));
    $("#trelacenb").text(getTranslationText('relacenb'));
    $("#tnvaubuc").text(getTranslationText('nvaubuc'));
    //@todo revisar si no es conveniente utilizar span#[id] asumiendo que todos sean span por si se repite el id en algun lado
    //@todo contemplar la capitalizacion de los textos por css para poner todo en minuscula
    //@todo revisar si se traduce ayuda
    //@todo asumo que backup/ no se traduce.
    //@todo la carpeta fpdf parece tener impresiones de pdfs , el problema es que con javascript no se llega hasta ese lugar , se podria analizar guardar el idioma en sesion o pasarlo por url
    //@todo la carpeta fpdf152 similar a fpdf pero parece una copia , confimar
    traducirTitle();
    traducirOptions();
}

function traducirVista()
{
    traducirCalendario();
    //Set languages on load
    $(document).ready(function() {
        var lang = getLanguajeIndex();
        langchange();
    });
}

function traducirOptions()
{
    $('option[data-opttrad]').each(function(el){
        var trad = $(this).data('opttrad');
        $(this).html(getTranslationText(trad));
    });
}
function traducirTitle()
{
    $('[data-ttitle]').each(function(el){
        var trad = $(this).data('ttitle');
        $(this).attr('title', getTranslationText(trad));
    });
}
function getLanguajeIndex(){
    return localStorage.getItem('language');
}

function setTranslation(lang){
    localStorage.setItem('language', lang);
}

function talert(trad)
{
    alert (getTranslationText(trad));
}

function traducirCalendario ()
{
    if(typeof  Calendar === 'undefined'){
        return;
    }
    // ** I18N
    Calendar._DN = new Array
    (
        getTranslationText("domgo"),
        getTranslationText("lunes"),
        getTranslationText("martes"),
        getTranslationText("miercoles"),
        getTranslationText("jueves"),
        getTranslationText("viernes"),
        getTranslationText("sabado"),
        getTranslationText("domgo")
    );
    Calendar._MN = new Array
    (
        getTranslationText("enero"),
        getTranslationText("febrero"),
        getTranslationText("marzo"),
        getTranslationText("abril"),
        getTranslationText("mayo"),
        getTranslationText("junio"),
        getTranslationText("julio"),
        getTranslationText("agosto"),
        getTranslationText("sept"),
        getTranslationText("octubre"),
        getTranslationText("noviem"),
        getTranslationText("diciem")
    );

// tooltips
    Calendar._TT = {};
    Calendar._TT["INFO"] =  getTranslationText("calinft");
    Calendar._TT["ABOUT"] =
        getTranslationText("cal")+
        "\n\n" +
        getTranslationText("calslfc")+":\n" +
        "- "+getTranslationText("caluslea")+"\n" +
        "- "+getTranslationText('caluse')+ " " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " "+getTranslationText('calpsem')+" \n" +
        "- "+getTranslationText('calmpebdrec')+" .";
    Calendar._TT["ABOUT_TIME"] = "\n\n" +
        getTranslationText('calsdr')+":\n" +
        "- "+getTranslationText('calslhpcer')+"\n" +
        "- "+getTranslationText('calopscpd')+"\n" +
        "- "+getTranslationText('calopcyadrpus');

    Calendar._TT["TOGGLE"] = getTranslationText("pddsmn");
    Calendar._TT["PREV_YEAR"] = getTranslationText("aappm");
    Calendar._TT["PREV_MONTH"] = getTranslationText("mappm");
    Calendar._TT["GO_TODAY"] = getTranslationText("iah");
    Calendar._TT["NEXT_MONTH"] = getTranslationText("msppm");
    Calendar._TT["NEXT_YEAR"] = getTranslationText("asppm");
    Calendar._TT["SEL_DATE"] = getTranslationText("calselfch");
    Calendar._TT["DRAG_TO_MOVE"] = getTranslationText("arrmev");
    Calendar._TT["PART_TODAY"] = " ("+getTranslationText("hoy")+")";
    Calendar._TT["MON_FIRST"] = getTranslationText("lunprm");
    Calendar._TT["SUN_FIRST"] =  getTranslationText("domprm");
    Calendar._TT["CLOSE"] = getTranslationText("cerrar");
    Calendar._TT["TODAY"] = getTranslationText("hoy");

    Calendar._TT["WEEKEND"] = "0,6";

    Calendar._TT["DAY_FIRST"] = getTranslationText('calpppddls');
    // date formats
    Calendar._TT["DEF_DATE_FORMAT"] = "dd-mm-yy";
    Calendar._TT["TT_DATE_FORMAT"] = "%A, %e de %B de %Y";

    Calendar._TT["WK"] = "Smn";

}


traducirVista();