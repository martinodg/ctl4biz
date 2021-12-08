API  para gestion de peticiones GRAFANA 
Gestiona peticiones tomando  como parametro de la url 
c = cliente id  de la tabla general de ctrl4b
q = query que se busca ejecutar ( Ej: c => cobros , mp => medios de pago )
Ej: http://localhost/funciones/api/index.php?c=40&q=mp
Retorna una respuesta en json un error. 
La respuesta en json seria consumida por grafana e interpretada en un grafico 
