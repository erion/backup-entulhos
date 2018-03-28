<?php
	include "../config.php";
	
	$where = $_GET['q'];
	$query = mysql_query("SELECT artigo_id, descricao from artigo WHERE descricao like '{$where}%' ");
	
	while ($result = mysql_fetch_assoc($query)) {
		echo $result['descricao']."|".$result['artigo_id']."\n";
	}	
?>
