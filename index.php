<? 
include("conectar7.php");
?>
<html>
<head>
  <title>e-moon a Cloud ERP System</title>
  <script language="JavaScript" src="menu/JSCookMenu.js"></script>
  <link rel="stylesheet" href="menu/theme.css" type="text/css">
  <script language="JavaScript" src="menu/theme.js"></script>
  <script language="JavaScript">
<!--
var MenuPrincipal = [
	[null,'Inizio','central2.php','principal','Inicio'],
	[null,'Inter. Comerciales',null,null,'Ventas clientes',
		[null,'Proveedores','./proveedores/index.php','principal','Proveedores'],
		[null,'Clientes','./clientes/index.php','principal','Clientes']
	],
	[null,'Produccion',null,null,'Produccion',
		[null,'Articulos','./articulos/index.php','principal','Articulos',
			[null,'Tipos de Articulos','./familias/index.php','principal','Tipos de Articulos'],
		],
        [null,'Lotes de Produccion','./lotes/index.php','principal','Lotes de Produccion'],
        [null,'Batch de Produccion','./batch/index.php','principal','Lotes de Produccion'],
		[null,'Procesos de Produccion','./procesos/index.php','principal','Procesos de Produccion',
			[null,'Meta-Procesos','./meta_procesos/index.php','principal','Meta-Procesos'],	
		],
        [null,'Estaciones de Trabajo','./estaciones/index.php','principal','Estaciones de trabajo'],	
	],
	[null,'Ventas',null,null,'Ventas',
		[null,'Ventas Mostrador','./ventas_mostrador/index.php','principal','Ventas Mostrador'],
        [null,'Presupuestos','./presupuestos_clientes/index.php','principal','Presupuestos'],
		[null,'Facturas','./facturas_clientes/index.php','principal','Facturas'],
		[null,'Remitos','./albaranes_clientes/index.php','principal','Albaranes'],
		[null,'Facturar remitos','./lote_albaranes_clientes/index.php','principal','Facturar albaranes']
	],
	[null,'Compras proveedores',null,null,'Compras proveedores',
		[null,'Facturas','./facturas_proveedores/index.php','principal','Proveedores'],
		[null,'Remitos','./albaranes_proveedores/index.php','principal','Albaranes'],
		[null,'Facturar remitos','./lote_albaranes_proveedores/index.php','principal','Facturar albaranes'],
	],
	[null,'Administracion',null,null,'Administracion',
		[null,'Cobros','./cobros/index.php','principal','Cobros'],
		[null,'Pagos','./pagos/index.php','principal','Pagos'],
		[null,'Caja Diaria','./cerrarcaja/index.php','principal','Caja Diaria'],
		[null,'Libro Diario','./librodiario/index.php','principal','Libro Diario'],
        [null,'Recursos Humanos','./partes_trabajo/index.php','principal','Recursos Humanos'],
	],
	[null,'Configuracion',null,null,'Configuracion',
		[null,'Empleados','./trabajadores/index.php','principal','Empleados'],
        [null,'Etiquetas','./etiquetas/index.php','principal','Etiquetas'],
		[null,'Impuestos','./impuestos/index.php','principal','Impuestos'],
		[null,'Entidades bancarias','./entidades/index.php','principal','Entidades bancarias'],
		[null,'Ubicaciones','./ubicaciones/index.php','principal','Ubicaciones'],
		[null,'Embalajes','./embalajes/index.php','principal','Embalajes'],
		[null,'Formas de pago','./formaspago/index.php','principal','Formas de pago'],
	],
	[null,'Seguridad',null,null,'Seguridad',
		[null,'Hacer copia','./backup/hacerbak.php','principal','Hacer copia'],
		[null,'Restaurar copia','./backup/restaurarbak.php','principal','Restaurar copia'],
        [null,'Administrar Usuarios','./backup/restaurarbak.php','principal','Administrar Usuarios'],
	],
	[null,'Ayuda','creditos.php','principal','Creditos']
];

--></script>
  <style type="text/css">
  body { background-image: linear-gradient(to bottom right, #1eae65, #75c8fd);
}
    background-image: url(images/superior.png);
    background-repeat: no-repeat;
	margin: 0px;
    }

  #MenuAplicacion { margin-left: 10px;
    margin-top: 0px;
    }


  </style>
</head>
<body>
<div id="MenuAplicacion" align="center"></div>
<script language="JavaScript">
<!--
	cmDraw ('MenuAplicacion', MenuPrincipal, 'hbr', cmThemeGray, 'ThemeGray');
-->
</script>
<iframe src="central2.php" name="principal" title="principal" width="100%" height="1050px" frameborder=0 scrolling="no" style="margin-left: 0px; margin-right: 0px; margin-top: 2px; margin-bottom: 0px;"></iframe>
</body>
</html>
