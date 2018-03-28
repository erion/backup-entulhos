<?php
	include "../config.php";
	
	$where = $_GET['q'];
	$query = mysql_query("SELECT finalidade_id, descricao FROM finalidade WHERE descricao like '{$where}%'");
	
	while ($result = mysql_fetch_assoc($query)) {
		echo $result['descricao']."|".$result['finalidade_id']."\n";
	}
?>
