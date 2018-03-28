<?php

	include "../config.php";
	
	$where = $_GET['q'];
	
	$query = mysql_query("select companhia_id, nome from companhia WHERE nome like '{$where}%'");
	
	while ($result = mysql_fetch_assoc($query)) {
		echo $result['nome']."|".$result['companhia_id']."\n";	
	}

?>
