<?
 echo ' <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>';
 echo '						    <tr>';
 echo '							    <td width="16%">Codigo del rol </td>';
 echo '							    <td width="68%"><input id="codcliente" type="text" class="cajaPequena" NAME="codcliente" maxlength="10" value="<? echo $codcliente?>"> <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" title="Buscar cliente" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.svg" width="16" height="16" onClick="validarcliente()" title="Validar cliente" onMouseOver="style.cursor=cursor"></td>';
 echo '							    <td width="5%">&nbsp;</td>';
 echo '							    <td width="5%">&nbsp;</td>';
 echo '							    <td width="6%" align="right"></td>';
 echo '						    </tr>';
 echo '						    <tr>';
 echo '							    <td>Nombre</td>';
 echo '							    <td><input id="nombre" name="nombre" type="text" class="cajaGrande" maxlength="45" value="<? echo $nombre?>"></td>';
 echo '							    <td>&nbsp;</td>';
 echo '							    <td>&nbsp;</td>';
 echo '						    </tr>';					
 echo '					    </table>';
 ?>