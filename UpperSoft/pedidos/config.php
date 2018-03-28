<?php

	$host = 'mysql01.euricorep.com.br';
	$login = 'euricorep';
	$senha = 'eur3007';
	$dbname = 'euricorep';

/*
	$host = 'localhost';
	$login = 'root';
	$senha = '';
	$dbname = 'pedidos';
	*/
	
	
	$mysql_link = mysql_connect($host,$login,$senha) or die("Não foi possível conectar-se com o banco de dados.");
	mysql_select_db($dbname) or die("Não foi possível conectar-se com o banco de dados.");
	
	mysql_query("SET NAMES 'utf8'");
?>
