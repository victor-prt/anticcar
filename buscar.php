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
    	$palabra = mysql_real_escape_string($_POST['palabra']);
    	$campo = mysql_real_escape_string($_POST['campo_busqueda']);
    	$tipo = mysql_real_escape_string($_POST['tipo_busqueda']);
    	$cuantos = explode(" ",$palabra);
    	$condiciones = " ";
    	switch($campo)
    	{
    		case "todos":
    			switch($tipo)
    			{
    				case "clave":
    					for($i = 0; $i < count($cuantos); $i++)
    					{
    						$condiciones .= "(titulo like  '%".$cuantos[$i]."%' OR subtitulo like '%".$cuantos[$i]."%' OR contenido like '%".$cuantos[$i]
    						."%' OR numero like '%".$cuantos[$i]."%' OR ano like '%".$cuantos[$i]."%' OR publicacion like '%".$cuantos[$i]."%' OR coleccion like '%".$cuantos[$i]."%' OR isbn 
    						like '%".$cuantos[$i]."%' OR issn like '%".$cuantos[$i]."%' OR marca like '%".$cuantos[$i]."%' OR modelo like '%".$cuantos[$i]."%' OR id_materia like '%".$cuantos[$i]."%' OR localizacion like '%".$cuantos[$i]."%' OR descripcion like '%".$cuantos[$i]."%' OR marca like '%".$cuantos[$i]."%')";
    						if($i != (count($cuantos) - 1))
    						{
    							$condiciones .= " AND ";
    						}
    					}
    				break;
    				case "exacta":
    					$condiciones = "titulo like  '%".$palabra."%' OR subtitulo like '%".$palabra."%' OR contenido like '%".$palabra
    					."%' OR numero like '%".$palabra."%' OR ano like '%".$palabra."%' OR publicacion like '%".$palabra."%' OR coleccion like '%".$palabra."%' OR isbn 
    					like '%".$palabra."%' OR issn like OR id_materia like '%".$palabra."%' OR marca like '%".$palabra."%' OR modelo like '%".$palabra."%' OR localizacion like '%".$palabra."%' OR descripcion like '%".$palabra."%' OR marca like '%".$palabra."%'";
    				break;
    				/*case "alfabetica":
    				break;*/
    			}
    		break;
    		case "autor":
    			switch($tipo)
    			{
    				case "clave":
    					for($i = 0; $i < count($cuantos); $i++)
    					{
    						$condiciones .= "(autor like '%".$cuantos[$i]."%' )";
    						if($i != (count($cuantos) - 1))
    						{
    							$condiciones .= " AND ";
    						}
    					}
    				break;
    				case "exacta":
    					$condiciones = "autor like '%".$palabra."%'";
    				break;
    				/*case "alfabetica":
    				break;*/
    			}
    		break;
    		case "titulo":
    			switch($tipo)
    			{
    				case "clave":
    					for($i = 0; $i < count($cuantos); $i++)
    					{
    						$condiciones .= "(titulo like '%".$cuantos[$i]."%' OR subtitulo like '%".$cuantos[$i]."%')";
    						if($i != (count($cuantos) - 1))
    						{
    							$condiciones .= " AND ";
    						}
    					}
    				break;
    				case "exacta":
    					$condiciones = "titulo like '%".$palabra."%' OR subtitulo like '%".$palabra."%'";
    				break;
    				/*case "alfabetica":
    				break;*/
    			}
    		break;
    		case "materia":
    			switch($tipo)
    			{
    				case "clave":
    					for($i = 0; $i < count($cuantos); $i++)
    					{
    						$condiciones .= "(id_materia like '%".$cuantos[$i]."%' )";
    						if($i != (count($cuantos) - 1))
    						{
    							$condiciones .= " AND ";
    						}
    					}
    				break;
    				case "exacta":
    					$condiciones = "id_materia like '%".$palabra."%'";
    				break;
    				/*case "alfabetica":
    				break;*/
    			}
    		break;
    		case "marca":
    			switch($tipo)
    			{
    				case "clave":
    					for($i = 0; $i < count($cuantos); $i++)
    					{
    						$condiciones .= "(marca like '%".$cuantos[$i]."%' )";
    						if($i != (count($cuantos) - 1))
    						{
    							$condiciones .= " AND ";
    						}
    					}
    				break;
    				case "exacta":
    					$condiciones = "marca like '%".$palabra."%'";
    				break;
    				/*case "alfabetica":
    				break;*/
    			}
    		break;
    	}
    	$select = "SELECT * FROM tbl_articulos WHERE ".$condiciones;
    	$selectRS = mysql_query($select,$procs_bbdd) or die(mysql_error());
    	$row_selectRS = mysql_fetch_assoc($selectRS);
      if(count($row_selectRS) > 1)
    	{
        echo "<button id='return'>Volver a p&aacute;gina principal</button>";
    		do{
                    echo "<h2><a href='mostrar_articulo.php?articulo=".$row_selectRS['id_articulo']."'>".$row_selectRS['titulo']."</a></h2><br/>";
                    echo $row_selectRS['autor']."<br/>";
                    //echo $row_selectRS['edicion']."<br/>";  NO EXISTE NINGUN CAMPO CON EL NOMBRE EDICION
                    echo $row_selectRS['localizacion']."<br/>";
                    echo $row_selectRS['id_articulo']."<br/>";
	    			/*echo "<div class='row'>".$row_selectRS['titulo']."</div><div class='row'>".$row_selectRS['subtitulo']."</div><div class='row'>".
	    			$row_selectRS['isbn']."</div><div class='row'>".$row_selectRS['issn']."</div><div class='row'>".$row_selectRS['localizacion'].
	    			"</div><div class='row'>".$row_selectRS['marca']."</div><div class='row'>".$row_selectRS['modelo']."</div>";
	    			echo "<div class='row'>
		    			<form action='eliminar.php' method='POST' class='articulo' id='art".$row_selectRS['id_articulo']."'>
		    				<input type='hidden' value='".$row_selectRS['id_articulo']."' name='valor'/>
		    				<button class='eliminar' id='delete".$row_selectRS['id_articulo']."'>Eliminar</button>
		    			</form>
		    			<form action='modificar.php' method='POST'>
		    				<input type='hidden' value='".$row_selectRS['id_articulo']."' name='valor'>
		    				<button class='modificar'>Modificar</button></div>
		    			</form>
	    			</div>";*/
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
    	}
      else{
        echo "<h1>No se han encontrado valores que coincidan</h1>";
        echo "<button id='return'>Volver a p&aacute;gina principal</button>";
      }
  ?>
<script type="text/Javascript" src="Javascripts/javascripts.js"></script>
</body>
</html>