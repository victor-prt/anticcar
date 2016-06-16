<?php
	include("Connections/procs_bbdd.php");
	mysql_select_db($database_procs_bbdd, $procs_bbdd);
	$id = mysql_real_escape_string($_POST['id_articulo']);
	$titulo = mysql_real_escape_string($_POST['titulo']);
	$subtitulo = mysql_real_escape_string($_POST['subtitulo']);
	$localizacion = mysql_real_escape_string($_POST['localizacion']);
	$publicacion = mysql_real_escape_string($_POST['publicacion']);
	$coleccion = mysql_real_escape_string($_POST['coleccion']);
	$isbn = mysql_real_escape_string(strtolower($_POST['isbn']));
	$idioma = mysql_real_escape_string($_POST['idioma']);
	$materia = mysql_real_escape_string($_POST['materia']);
	$marca = mysql_real_escape_string($_POST['marca']);
	$modelo = mysql_real_escape_string($_POST['modelo']);
	$descripcion = mysql_real_escape_string($_POST['descripcion']);
	$autor = mysql_real_escape_string($_POST['autor']);
	$deposito = mysql_real_escape_string($_POST['deposito']);
	$tipodoc = mysql_real_escape_string($_POST['tipodoc']);
	$numero = mysql_real_escape_string($_POST['numero']);
	$ano = mysql_real_escape_string($_POST['ano']);
	$periodicidad = mysql_real_escape_string($_POST['periodicidad']);
	$issn = mysql_real_escape_string($_POST['issn']);
	$contenido = mysql_real_escape_string($_POST['contenido']);
	$error = 0;
	$errorISSN = false;
	$errorISBN = false;
	if(empty($numero))
	{
		$numero ="(NULL)";
	}
	if(empty($ano))
	{
		$ano ="(NULL)";
	}
	if(empty($numero))
	{
		$numero ="(NULL)";
	}
	if(empty($materia))
	{
		$materia = "(NULL)";
	}
	if(empty($issn))
	{
		$issn = "(NULL)";
	}
	if(empty($isbn))
	{
		$isbn = "(NULL)";
	}
	if(strlen($isbn) == 10)
	{
		$suma = 0;
		for($i = 0; $i <9;$i++)
		{
			$cifra = $isbn[$i] * ($i + 1);
			$suma += $cifra;
		}
		$controlISBN = $suma % 11;
		if($controlISBN == 10)
		{
			$controlISBN = "x";
		}
		if($controlISBN > 10 || !ctype_digit(substr($isbn,0,9)) || $controlISBN != $isbn[9])
		{
			$errorISBN = true;
		}
	}
	else if(strlen($isbn) == 13)
	{
		$suma = 0;
		$controlISBN = 0;
		for($i = 0; $i < 12; $i++)
		{
			if($i % 2 == 0)
			{
				$cifra = $isbn[$i] * 1;
				$suma += $cifra;
			}
			else{
				$cifra = $isbn[$i] * 3;
				$suma += $cifra;
			}
		}
		for($i = 0; $i < 10;$i++)
		{
			if(($suma % 10) == 0)
			{
				$controlISBN = $i;
				break;
			}
			else{
				$suma++;
			}
		}
		if($controlISBN != $isbn[12] || !ctype_digit($isbn))
		{
			$errorISBN = true;
		}
	}
	else if((strlen($isbn) != 13 || strlen($isbn) != 10) && $isbn != "(NULL)")
	{
		$errorISBN = true;
	}
	if(strlen($issn) == 8)
	{
		$suma = 0;
		for($i = 8; $i > 1;$i--)
		{
			$cifra = $i * $issn[abs($i-8)];
			$suma += $cifra;
		}
		$controlISSN = 11 - ($suma % 11);
		if($controlISSN != $issn[7] || !ctype_digit($issn))
		{
			$errorISSN = true;
		}
	}
	else if($issn != "(NULL)" && strlen($issn) != 8){
		$errorISSN = true;
	}
	if( $errorISSN && $errorISBN)
	{
		$error = 3;
	}
	else if($errorISBN)
	{
		$error = 1;
	}
	else if($errorISSN)
	{
		$error = 2;
	}
	switch ($error)
	{
		case 0:
			$insert = "INSERT INTO tbl_articulos (id_articulo, titulo, subtitulo, numero, ano, id_periodicidad, publicacion, coleccion, isbn, issn, contenido, id_idioma, id_materia, marca, modelo, descripcion, localizacion, autor, deposito_legal, tipo_documento) VALUES (".$id.",'".$titulo."','".$subtitulo."',".$numero.",".$ano.",".$periodicidad.",'".$publicacion."','".$coleccion."','".$isbn."',".$issn.",'".$contenido."',".$idioma.",'".$materia."','".$marca."','".$modelo."','".$descripcion."','".$localizacion."','".$autor."','".$deposito."',".$tipodoc.")";
			$insertRS = mysql_query($insert,$procs_bbdd) or die(mysql_error());
			$update = "UPDATE tbl_contadores SET contador=contador+1 WHERE id_tipo='articulos'";
			$insertRS = mysql_query($update,$procs_bbdd) or die(mysql_error());
			break;
		case 1:
			echo "ISBN incorrecto";
			break;
		case 2:
			echo "ISSN incorrecto";
			break;
		case 3:
			echo "ISBN e ISSN incorrectos";
			break;
	}
	mysql_close($procs_bbdd);
?>