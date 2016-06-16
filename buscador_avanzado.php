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
		$tabla[0] = "autor,".$_POST['autor_av'].",".$_POST['yoautor'];
		$tabla[1] = "titulo,".$_POST['titulo_av'].",".$_POST['yotitulo'];
		$tabla[2] = "id_materia,".$_POST['materia_av'].",".$_POST['yomateria'];
		$tabla[3] = "marca,".$_POST['marca_av'].",".$_POST['yomarca'];
		$tabla[4] = "modelo,".$_POST['modelo_av'].",".$_POST['yomodelo'];
		$eliminar = array();
		$k = 0;
		for($i = 0; $i < count($tabla);$i++)
		{
			$centinela = explode(",,", $tabla[$i]);
			if(count($centinela) == 2)
			{
				$eliminar[$k] = $i;
				$k = $k + 1;
			}
		}
		for($i = 0; $i < count($eliminar);$i++)
		{
			unset($tabla[$eliminar[$i]]);
		}
		$tabla = array_values($tabla);
		for($i = 0; $i < count($tabla);$i++)
		{
			$tabla[$i] = explode(",",$tabla[$i]);
		}
		$condiciones = "";
		for($i = 0;$i < count($tabla);$i++)
		{
			$condiciones .= "(".$tabla[$i][0]." like '%".$tabla[$i][1]."%')";
			if($i != (count($tabla) - 1))
			{
				$condiciones .= " ".$tabla[$i][2]." ";
			}
		}
		$select = "SELECT * FROM tbl_articulos WHERE ".$condiciones;
		$selectRS = mysql_query($select,$procs_bbdd) or die(mysql_error());
		$row_selectRS = mysql_fetch_assoc($selectRS);
		do{
			echo "<h2><a href='mostrar_articulo.php?articulo=".$row_selectRS['id_articulo']."'>".$row_selectRS['titulo']."</a></h2><br/>";
			echo $row_selectRS['autor']."<br/>";
			//echo "Edici&oacute;n: ".$row_selectRS['edicion']."<br/>"; NO HAY NINGUN CAMPO CON ESTE NOMBRE
			echo $row_selectRS['localizacion']."<br/>";
			echo $row_selectRS['id_articulo']."<br/>";

		}
		while($row_selectRS = mysql_fetch_assoc($selectRS));
	?>
</body>
</html>