<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/style.css" />
<title>Formulario introducci&oacute;n de datos de Antic Car Club de Catalunya</title>
<script src="Javascripts/jquery-2.0.2.js" type="text/javascript"></script>
</head>

<body>

  <?php
   include("Connections/procs_bbdd.php");
   mysql_select_db($database_procs_bbdd, $procs_bbdd);
  ?>
     <div class="izda"> 
  <form id="buscador" action="buscar.php" method='POST'>
    <input type='radio' name='tipo_busqueda' value='clave' checked>Palabra Clave
    <input type='radio' name='tipo_busqueda' value='alfabetico'>Listado alfab&eacute;tico
    <input type='radio' name='tipo_busqueda' value='exacta'>Exacta<br/>
    <input type="text" id='busqueda' name='palabra'/>
    <select name="campo_busqueda">
      <option value ='todos'>Todos los campos</option>
      <option value ='autor'>Autor</option>
      <option value ='titulo'>T&iacute;tulo</option>
      <option value ='materia'>Materia</option>
      <option value ='marca'>Marca</option>
    </select>
    <button id='buscador_submit'>BUSCAR</button>
  </form>
  <form id="buscador_avanzado" action='buscador_avanzado.php' method='POST'>
    Buscador Avanzado</br>
    <label>Autor</label>
    <input type='text' name='autor_av'/>
    <select name='yoautor'>
      <option value='AND'>Y</option>
      <option value ='OR'>O</option>
    </select>
    </br>
    <label>Titulo</label>
    <input type='text' name='titulo_av'/>
    <select name='yotitulo'>
      <option value='AND'>Y</option>
      <option value ='OR'>O</option>
    </select>
    </br>
    <label>Materia</label>
    <input type='text' name='materia_av'/>
    <select name='yomateria'>
      <option value='AND'>Y</option>
      <option value ='OR'>O</option>
    </select>
    </br>
    <label>Marca</label>
    <input type='text' name='marca_av'/>
    <select name='yomarca'>
      <option value='AND'>Y</option>
      <option value ='OR'>O</option>
    </select>
    </br>
    <label>Modelo</label>
    <input type='text' name='modelo_av'/>
    <select name='yomodelo'>
      <option value='AND'>Y</option>
      <option value ='OR'>O</option>
    </select>
    </br>
    <button id="avanzado_submit">BUSCAR</button>
  </form>
  <form action="guardar_articulo.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <?php
      $sql_contador = "SELECT contador+1 AS contador FROM tbl_contadores WHERE id_tipo='articulos'";
      $contadorRS = mysql_query($sql_contador,$procs_bbdd) or die(mysql_error());
      $row_contador = mysql_fetch_assoc($contadorRS);
    ?>
    

    <?php
      $sql_tipodoc = "SELECT * from tbl_tipo_documentos";
      $tipodocRS = mysql_query($sql_tipodoc,$procs_bbdd);
      $row_tipodoc = mysql_fetch_assoc($tipodocRS);
 	?>
    <label>Tipolog&iacute;a documento</label>
    <select name="tipodoc" id="tipodoc">
      <?php
        do{
          echo "<option value='".$row_tipodoc['id_documento']."'>".$row_tipodoc['tipo_documento']."</option>";
        }
        while($row_tipodoc = mysql_fetch_assoc($tipodocRS));
      ?>
    </select><br/>
    
    <input name="id_articulo" type="hidden" id="id_articulo" Value= '<?php echo $row_contador['contador']; ?>' />
    <label>T&iacute;tulo</label><br/>
    <textarea name="titulo" cols="250" id="titulo2"></textarea>
    <label>Subt&iacute;tulo</label><br/>
    <textarea name="subtitulo" cols="250" id="subtitulo"></textarea>    
    
   
    <label>Autor</label>
    <input name="autor" type="text" id="autor" size="50"/><br/>
     
    <label>Publicaci&oacute;n</label>
    <textarea name="publicacion" cols="250" id="publicacion"></textarea>
    
    <label>Colecci&oacute;n</label>
    <label for="coleccion"></label>
    <input name="coleccion" type="text" id="coleccion" />
    
    <br /><label>ISBN</label>
    <input name="isbn" type="text" id="isbn"/>
   
    <br />
    <label>Dep&oacute;sito legal</label>
    <label for="deposito"></label>
    <input name="deposito" type="text" id="deposito" />
    
    <br />
	<?php
    $sql_idioma = "SELECT * from tbl_idiomas";
    $idiomaRS = mysql_query($sql_idioma,$procs_bbdd)or die(mysql_error());
    $row_idioma = mysql_fetch_assoc($idiomaRS);
  ?>
    <label>Idioma</label>
    <select name="idioma" id="idioma">
      <option value='0' selected>--Seleccione una opci&oacute;n--</option>
      <?php
      do{
        echo "<option value='".$row_idioma['id_idioma']."'>".$row_idioma['nombre_idioma']."</option>";
      }
      while($row_idioma = mysql_fetch_assoc($idiomaRS));
    ?>
    </select>
    
    <br />
    <label>Materia</label>
    <input name="materia" type="text" id="materia" size="90" />
    
    <br />
    <label>Marca de coche</label>
   	<label for="marca"></label>
    <input name="marca" type="text" id="marca" />
    
    <br />
    <label>Modelo</label>
    <input name="modelo" type="text" id="modelo" /><br/>
</div>
<div class="dcha">      
  <label>Descripci&oacute;n</label>
  del contenido
  <textarea name="descripcion" id="descripcion" rows="5"></textarea>
  
  <label>Localizaci&oacute;n</label>
  <input name="localizacion" type="text" id="localizacion" size="30"/><br/>



  <?php 
    $sql_periodicidad = "SELECT * from tbl_periodicidad";
    $periodicidadRS = mysql_query($sql_periodicidad,$procs_bbdd) or die(mysql_error());
    $row_periodicidad = mysql_fetch_assoc($periodicidadRS);
  ?>
    <label>Periodicidad</label>
    <select name="periodicidad" id="periodicidad">
      <?php
    do{
      echo "<option value='".$row_periodicidad['id_periodicidad']."'>".$row_periodicidad['des_periodicidad']."</option>";
    }
    while($row_periodicidad = mysql_fetch_assoc($periodicidadRS));
  ?>
    </select>
    
    <label><br /><br />
      N&uacute;mero</label>
    <label for="numero"></label>
    <input name="numero" type="text" id="numero" />
    
    <label>	A&ntilde;o</label>
    <input name="ano" type="text" id="ano" />
    
    <label><br /><br />
      ISSN</label>
    <input name="issn" type="text" id="issn" />
    
    <label><br /><br />
      Contenido</label>
    <textarea name="contenido" id="contenido" rows="5"></textarea>
    
    <label><br /><br />
      Referencia</label>
    <input type="text" disabled="disabled" value=" <?php echo $row_contador['contador'];?> " size="8" />
    

  <button id='guardar'>Guardar</button>
  </form>
  <form id="ima" action="imagen.php" enctype="multipart/form-data" method='post'>
    <label for="imagen"></label>
    <label>Imagen</label>
    <input type="file" name="imagen" id="imagen" />
    <input name="id_articulo" type="hidden" id="id_articulo" Value= '<?php echo $row_contador['contador']; ?>' />
  </form>
<div id="ack">
  
</div>
</div>
<script type="text/Javascript" src="Javascripts/javascripts.js"></script>
</body>
</html>
<?php 
  mysql_free_result($contadorRS);
  mysql_free_result($tipodocRS);
  mysql_free_result($idiomaRS);
   mysql_free_result($periodicidadRS);
  mysql_close($procs_bbdd);
?>
