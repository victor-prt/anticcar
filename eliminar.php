<?php
	include("Connections/procs_bbdd.php");
	mysql_select_db($database_procs_bbdd, $procs_bbdd);
	$id = mysql_real_escape_string($_POST['valor']);
	$delete = "DELETE from tbl_articulos WHERE id_articulo = ".$id;
	$deleteRS = mysql_query($delete, $procs_bbdd);
?>