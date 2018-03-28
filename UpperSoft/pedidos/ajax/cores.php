<?php
	include "../config.php";
	
	$where = $_GET['q'];
	$query = mysql_query("SELECT cor_id, descricao FROM cor WHERE descricao like '{$where}%'");
	while ($result = mysql_fetch_assoc($query)) {
		echo $result['descricao']."|".$result['cor_id']."\n";
	}
?>
