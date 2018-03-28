<?php
	include "../config.php";
	
	$where = $_GET['q'];
	$query = mysql_query("SELECT mat_prima_id, descricao FROM mat_prima WHERE descricao like '{$where}%'");
	while ($result = mysql_fetch_assoc($query)) {
		echo $result['descricao']."|".$result['mat_prima_id']."\n";
	}
?>
