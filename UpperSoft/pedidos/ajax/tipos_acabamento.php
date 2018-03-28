<?php
	include "../config.php";
	
	$where = $_GET['q'];
	
	$query = mysql_query("SELECT tipo_acabamento_id, descricao FROM tipo_acabamento WHERE descricao like '{$where}%'");
	while ($result = mysql_fetch_assoc($query)) {
		echo $result['descricao']."|".$result['tipo_acabamento_id']."\n";
	}
?>
