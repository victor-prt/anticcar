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
   $id = mysql_real_escape_string($_POST['valor']);
  ?>
   <form action="modificar_articulo.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <?php
      $actuales = "SELECT * FROM tbl_articulos WHERE id_articulo = ".$id;
      $actualesRS = mysql_query($actuales,$procs_bbdd) or die(mysql_error());
      $row_actuales = mysql_fetch_assoc($actualesRS);
    ?>
    <input type='hidden' value ='<?php echo $id; ?>' name='id_articulo'/>
   <div class="izda"> 
    <?php
      $sql_tipodoc = "SELECT * from tbl_tipo_documentos";
      $tipodocRS = mysql_query($sql_tipodoc,$procs_bbdd);
      $row_tipodoc = mysql_fetch_assoc($tipodocRS);
  ?>
    <label>Tipolog&iacute;a documento</label>
    <select name="tipodoc" id="tipodoc">
      <?php
        do{
          if($row_actuales['tipo_documento'] == $row_tipodoc['id_documento'])
          {
            echo "<option value='".$row_tipodoc['id_documento']."' selected>".$row_tipodoc['tipo_documento']."</option>";
          }
          else
          {
            echo "<option value='".$row_tipodoc['id_documento']."'>".$row_tipodoc['tipo_documento']."</option>";
          }
        }
        while($row_tipodoc = mysql_fetch_assoc($tipodocRS));
      ?>
    </select><br/>
    
    <label>T&iacute;tulo</label><br/>
    <textarea name="titulo" cols="250" id="titulo2"><?php echo $row_actuales['titulo']; ?></textarea>
    <label>Subt&iacute;tulo</label><br/>
    <textarea name="subtitulo" cols="250" id="subtitulo"><?php echo $row_actuales['subtitulo'];?></textarea>    
    
   
    <label>Autor</label>
    <input name="autor" type="text" id="autor" size="50" value='<?php echo $row_actuales['autor']; ?>'/><br/>
     
    <label>Publicaci&oacute;n</label>
    <textarea name="publicacion" cols="250" id="publicacion"><?php echo $row_actuales['publicacion'];?></textarea>
    
    <label>Colecci&oacute;n</label>
    <label for="coleccion"></label>
    <input name="coleccion" type="text" id="coleccion" value='<?php echo $row_actuales['coleccion'];?>'/>
    
    <br /><label>ISBN</label>
    <input name="isbn" type="text" id="isbn" value='<?php echo $row_actuales['isbn'];?>'/>
   
    <br />
    <label>Dep&oacute;sito legal</label>
    <label for="deposito"></label>
    <input name="deposito" type="text" id="deposito" value='<?php echo $row_actuales['deposito_legal']?>'/>
    
    <br />
  <?php
    $sql_idioma = "SELECT * from tbl_idiomas";
    $idiomaRS = mysql_query($sql_idioma,$procs_bbdd)or die(mysql_error());
    $row_idioma = mysql_fetch_assoc($idiomaRS);
  ?>
    <label>Idioma</label>
    <select name="idioma" id="idioma">
      <option value='0'>--Seleccione una opci&oacute;n--</option>
      <?php
      do{
        if($row_actuales['id_idioma'] == $row_idioma['id_idioma'])
        {
          echo "<option value='".$row_idioma['id_idioma']."' selected>".$row_idioma['nombre_idioma']."</option>"; 
        }
        else{
          echo "<option value='".$row_idioma['id_idioma']."'>".$row_idioma['nombre_idioma']."</option>";          
        }
      }
      while($row_idioma = mysql_fetch_assoc($idiomaRS));
    ?>
    </select>
    
    <br />
    <label>Materia</label>
    <input name="materia" type="text" id="materia" size="90" value='<?php echo $row_actuales['id_materia']; ?>'/>
    
    <br />
    <label>Marca de coche</label>
    <label for="marca"></label>
    <input name="marca" type="text" id="marca" value='<?php echo $row_actuales['marca']; ?>'/>
    
    <br />
    <label>Modelo</label>
    <input name="modelo" type="text" id="modelo" value='<?php echo $row_actuales['modelo']; ?>'/><br/>
     
  <label>Descripci&oacute;n</label>
  del contenido
  <textarea name="descripcion" id="descripcion" rows="5"><?php echo $row_actuales['descripcion']; ?></textarea>
  
  <label>Localizaci&oacute;n</label>
  <input name="localizacion" type="text" id="localizacion" size="30" value='<?php echo $row_actuales['localizacion']; ?>' /><br/>
</div> 

<div class="dcha"> 
  <?php 
    $sql_periodicidad = "SELECT * from tbl_periodicidad";
    $periodicidadRS = mysql_query($sql_periodicidad,$procs_bbdd) or die(mysql_error());
    $row_periodicidad = mysql_fetch_assoc($periodicidadRS);
  ?>
    <label>Periodicidad</label>
    <select name="periodicidad" id="periodicidad">
      <option value='0'>--Seleccione una opci&oacute;n--</option>
      <?php
    do{
      if($row_actuales['id_periodicidad'] == $row_periodicidad['id_periodicidad'])
      {
        echo "<option value='".$row_periodicidad['id_periodicidad']."' selected>".$row_periodicidad['des_periodicidad']."</option>";
      }
      else{
        echo "<option value='".$row_periodicidad['id_periodicidad']."'>".$row_periodicidad['des_periodicidad']."</option>";
      }
    }
    while($row_periodicidad = mysql_fetch_assoc($periodicidadRS));
  ?>
    </select>
    
    <label><br /><br />
      N&uacute;mero</label>
    <label for="numero"></label>
    <input name="numero" type="text" id="numero" value='<?php echo $row_actuales['numero'];?>' />
    
    <label> A&ntilde;o</label>
    <input name="ano" type="text" id="ano" value='<?php echo $row_actuales['ano']; ?>'/>
    
    <label><br /><br />
      ISSN</label>
    <input name="issn" type="text" id="issn" value='<?php echo $row_actuales['issn']; ?>'/>
    
    <label><br /><br />
      Contenido</label>
    <textarea name="contenido" id="contenido" rows="5"><?php echo $row_actuales['contenido']; ?></textarea>
    
    <label><br /><br />
      Referencia</label>
    <input type="text" disabled="disabled" value=" <?php echo $id;?> " size="8" />
    

  <button id='guardar'>Guardar</button>
  </form>
  <div class="imagen">
  <?php
    if(!empty($row_actuales['imagen']))
    {
      echo "<img src='images/".$row_actuales['imagen']."'>";
    }
  ?>
  </div>
  <form id="ima" action="imagen.php" enctype="multipart/form-data">
    <label for="imagen"></label>
    <label>Imagen</label>
    <input type="file" name="imagen" id="imagen" />
    <input name="id_articulo" type="hidden" id="id_articulo" Value= '<?php echo $id; ?>' />
  </form>

<div id="ack">
  
</div>
</div>
<script type="text/Javascript" src="Javascripts/javascripts.js"></script>
</body>
</html>
<?php 
  mysql_free_result($actualesRS);
  mysql_free_result($tipodocRS);
  mysql_free_result($idiomaRS);
   mysql_free_result($periodicidadRS);
  mysql_close($procs_bbdd);
?>
