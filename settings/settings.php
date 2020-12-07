
<html>
	<head>
		<title>Settings</title>
		<link href="../estilos/login.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
		<script type="text/javascript" src="../funciones/paginar.js"></script>
		<script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>

		<script language="javascript">
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		
		</script>
	</head>
	<body >
		<div id="pagina">
			<div id="zonaContenido">
				
				<nav id="language">
            <ul>
                <li>
                    <a href="#"> <img id="bandera_lengua" class="language" src="../img/english-language.svg" height="24px" width="24px"></a>
                    <ul>
                        <li><a class="lang" id="english" href="#">English</a></li>
                        <li><a class="lang" id="espanol" href="#">Espanol</a></li>
                        <li><a class="lang" id="polish" href="#">Polski</a></li>
                    </ul>

                </li>
            </ul>
	</nav>
	<div align="center">
				    <div id="copiasRespaldo" class="header">Copias de Respaldo </div>
				    
				
					    			
						  
							   
								<button type="button" class="fullwidth" id="hacerrespaldo" onClick="window.location.href = '../backup/hacerbak.php';" onMouseOver="style.cursor=cursor"> <img src="../img/upload.svg" alt="limpiar" /> <span>Hacer copia de respaldo</span> </button>
								
							  
								<br>						   
								
								<button type="button" class="fullwidth" id="restaurarrespaldo" onClick="window.location.href = '../backup/restaurarbak.php';" onMouseOver="style.cursor=cursor"> <img src="../img/download.svg" alt="limpiar" /> <span>Restaurar copia</span> </button> 
						   
                    
				
                   
                    
                    
                    
                    
					<div id="AdminSeguridad" class="header">Administracion de Seguridad </div>
					
               				<button type="button" class="fullwidth" id="usuarios" onClick="window.location.href = '../racf/intUsers/index.php';" onMouseOver="style.cursor=cursor"> <img src="../img/usuarios.svg" alt="limpiar" /> <span>Usuarios</span> </button>
							<br>  
							<button type="button" class="fullwidth" id="roles" onClick="window.location.href = '../racf/roles/index.php';" onMouseOver="style.cursor=cursor"> <img src="../img/roles.svg" alt="nuevo" /> <span>Roles</span> </button>
							<br>
							<button type="button" class="fullwidth" id="recursos" onClick="window.location.href = '../racf/recursos/index.php';" onMouseOver="style.cursor=cursor"> <img src="../img/resources.svg" alt="nuevo" /> <span>Recursos</span> </button>

				</div>
				
            </div>
		</div>		  			
	</body>
</html>
