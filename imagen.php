<?php
	include("Connections/procs_bbdd.php");
	include("functions.php");
	mysql_select_db($database_procs_bbdd, $procs_bbdd);
	$imagen = $_FILES['imagen'];
	$nombre =  generateRandomString($length = 30);
	$id = mysql_real_escape_string($_POST['id_articulo']);
	$nom=$nombre.".jpg";
	$eliminar = "SELECT imagen FROM tbl_articulos WHERE id_articulo = ".$id;
	$eliminarRS = mysql_query($eliminar,$procs_bbdd);
	$row_eliminar = mysql_fetch_assoc($eliminarRS);
	unlink("images/".$row_eliminar['imagen']);
	copy($_FILES['imagen']['tmp_name'],"images/".$nom);
	$insertSQL = "UPDATE tbl_articulos SET imagen ='".$nom."' WHERE id_articulo =".$id;
	echo $insertSQL;
	$insertRS = mysql_query($insertSQL,$procs_bbdd) or die(mysql_error());
	mysql_close($procs_bbdd);		
?>