<?php

	include "cabecalho.php";
	
	function redirecionar($endereco) {
		header("Location:{$endereco}");
	}	
	
	if (isset($_GET['a'])) {
		if (file_exists("actions/{$_GET['a']}.php")) {
			include "actions/{$_GET['a']}.php";
		}
		
		if (file_exists("visualizacao/{$_GET['pagina']}.php"))
			include "visualizacao/{$_GET['pagina']}.php";
		elseif (file_exists("visualizacao/{$_GET['a']}.php"))
			include	"visualizacao/{$_GET['a']}.php";
	} else {
		redirecionar("?pagina=home&a=geral");
	}

	include "rodape.php";	
?>
