
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
			<div align="center">
                <div id="lenguaje" class="header"><span id="lngyloc">Lenguaje y localizacion</span></div>
				<nav id="language">
            <ul>
                <li>
                    <span id="telgidi">Elija un idioma</span> > <a href="#"> <img id="bandera_lengua" class="language" src="../img/english-language.svg" height="24px" width="24px"></a>
                    <ul>
                        <li><a class="lang" id="english" href="#">English</a></li>
                        <li><a class="lang" id="espanol" href="#">Espanol</a></li>
                        <li><a class="lang" id="polish" href="#">Polski</a></li>
                    </ul>

                </li>
            </ul>
	</nav>
	<div align="center">
        <!--@todo revisar si el copiasRespaldo es solo por al traduccion en ese caso utilizar el del spam -->
        <div id="copiasRespaldo" class="header"><span id="tcopiasRespaldo">Copias de Respaldo</span></div>
		<!--@todo revisar si el hacerrespaldo es solo por al traduccion en ese caso utilizar el del spam -->
        <button type="button" class="fullwidth" id="hacerrespaldo" onClick="window.location.href = '../backup/hacerbak.php';" onMouseOver="style.cursor=cursor"> <img src="../img/upload.svg" alt="limpiar" /> <span id="thacerrespaldo">Hacer copia de respaldo</span> </button>
        <!--@todo revisar si el restaurarrespaldo es solo por al traduccion en ese caso utilizar el del spam -->
        <button type="button" class="fullwidth" id="restaurarrespaldo" onClick="window.location.href = '../backup/restaurarbak.php';" onMouseOver="style.cursor=cursor"> <img src="../img/download.svg" alt="limpiar" /> <span id="trestaurarrespaldo">Restaurar copia</span> </button>
        <div id="AdminSeguridad" class="header">Administracion de Seguridad </div>
        <button type="button" class="fullwidth" id="usuarios" onClick="window.location.href = '../racf/intUsers/index.php';" onMouseOver="style.cursor=cursor"> <img src="../img/usuarios.svg" alt="limpiar" /> <span id="tusuarios">Usuarios</span> </button>
        <br>
        <button type="button" class="fullwidth" id="roles" onClick="window.location.href = '../racf/roles/index.php';" onMouseOver="style.cursor=cursor"> <img src="../img/roles.svg" alt="nuevo" /> <span id="troles">Roles</span> </button>
        <br>
        <button type="button" class="fullwidth" id="recursos" onClick="window.location.href = '../racf/recursos/index.php';" onMouseOver="style.cursor=cursor"> <img src="../img/resources.svg" alt="nuevo" /> <span id="trecursos">Recursos</span> </button>
    </div>
            </div>
		</div>		  			
	</body>
</html>
