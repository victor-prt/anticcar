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
    	$id_articulo = $_GET['articulo'];
    	$select = "SELECT * FROM tbl_articulos WHERE id_articulo = ".$id_articulo;
    	$selectRS = mysql_query($select,$procs_bbdd);
    	$row_selectRS = mysql_fetch_assoc($selectRS);
    	do{
    		echo "<h3>T&iacute;tulo</h3> ".$row_selectRS['titulo']."<br/>";
    		if(!empty($row_selectRS['subtitulo']))
    		{
    			echo "<h3>Subt&iacute;tulo</h3> ".$row_selectRS['subtitulo']."</br>";
    		}
    		echo "<h3>Autor</h3> ".$row_selectRS['autor']."<br/>";
    		echo "<h3>Publicación</h3> ".$row_selectRS['publicacion']."<br/>";
    		echo "<h3>ISBN</h3> ".$row_selectRS['isbn']."<br/>";
    		echo "<h3>Dep&oacute;sito legal</h3> ".$row_selectRS['deposito_legal']."<br/>";
    		$idioma = "SELECT nombre_idioma FROM tbl_idiomas WHERE id_idioma = ".$row_selectRS['id_idioma'];
    		$idiomaRS = mysql_query($idioma,$procs_bbdd);
    		$row_idiomaRS = mysql_fetch_assoc($idiomaRS);
			do{
				echo "<h3>idioma</h3> ".$row_idiomaRS['nombre_idioma']."<br/>";
			}   
			while($row_idiomaRS = mysql_fetch_assoc($idiomaRS)); 		
    		echo "<h3>Materia</h3> ".$row_selectRS['id_materia']."<br/>";
    		echo "<h3>Marca</h3> ".$row_selectRS['marca']."<br/>";
    		echo "<h3>Modelo</h3> ".$row_selectRS['modelo']."<br/>";
    		echo "<h3>Localizaci&oacute;n</h3> ".$row_selectRS['localizacion']."<br/>";
    		echo "<h3>Num. de registro</h3> ".$row_selectRS['id_articulo']."<br/>";
    		echo" <form action='eliminar.php' method='POST' class='articulo' id='art".$row_selectRS['id_articulo']."'>
		    				<input type='hidden' value='".$row_selectRS['id_articulo']."' name='valor'/>
		    				<button class='eliminar' id='delete".$row_selectRS['id_articulo']."'>Eliminar</button>
		    			</form>
		    			<form action='modificar.php' method='POST'>
		    				<input type='hidden' value='".$row_selectRS['id_articulo']."' name='valor'>
		    				<button class='modificar'>Modificar</button></div>
		    			</form>";
	?>
		<script type="text/javascript">
	    		$('#delete<?php echo $row_selectRS['id_articulo'];?>').click(function(){
	    			$.post( $('#art<?php echo $row_selectRS['id_articulo'];?>').attr('action'),
	    				$('#art<?php echo $row_selectRS['id_articulo'];?> :input').serializeArray(),
	    				function(data){
	    				});
	    			$(this).parent().parent().parent().fadeOut();
	    			$('#art<?php echo $row_selectRS['id_articulo'];?>').submit(function(){
	    				return false;
	    			});
	    		});
	    </script>
	<?php
    	}
    	while($row_selectRS = mysql_fetch_assoc($selectRS));
	?>
</body>
</html>
