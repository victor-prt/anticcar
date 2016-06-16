<?php
if(!isset($_SESSION))
{
	session_start();	
}

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_procs_bbdd = "localhost";
$database_procs_bbdd = "db_ac_biblioteca";
$username_procs_bbdd = "root";
$password_procs_bbdd = "";
$procs_bbdd = mysql_pconnect($hostname_procs_bbdd, $username_procs_bbdd, $password_procs_bbdd) or trigger_error(mysql_error(),E_USER_ERROR); 
?>