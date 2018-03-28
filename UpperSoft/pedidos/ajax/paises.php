<?php
	include "../config.php";
	
	$where = $_GET['q'];
	$query = mysql_query("SELECT pais_id, descricao FROM pais WHERE descricao like '{$where}%'");
	while ($result = mysql_fetch_assoc($query)) {
		echo $result['descricao']."|".$result['pais_id']."\n";
	}
?>
