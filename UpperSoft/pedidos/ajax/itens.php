<?php
	include "../config.php";
	
	$where = $_GET['q'];
	
	$query = mysql_query("SELECT item_id, descricao from item WHERE descricao like '{$where}%'");
	while ($result = mysql_fetch_assoc($query)) {
		echo $result['descricao']."|".$result['item_id']."\n"; 
	}
?>
