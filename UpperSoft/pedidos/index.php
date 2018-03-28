<?php
	include "funcoes.php";
	include "includes/paginacao.php";
	include "config.php";
	
	if (isset($_GET['pagina'])) {
		$busca = explode("cadastro",$_GET['pagina']);
		
		if (file_exists("actions/{$busca[0]}.php")){	
			include "actions/{$busca[0]}.php";
		}
		
	} else {
		redirecionar('index.php?pagina=logincadastro');
	}
	
	include "cabecalho.php";
	
	if (isset($_GET['pagina'])) {
		if (stristr($_GET['pagina'],"cadastro")) {
			
			$busca = explode("cadastro",$_GET['pagina']);
			
			if (file_exists("cadastros/{$busca[0]}.php")) {
				include "cadastros/{$busca[0]}.php";
			}
				
		} else {
			
			if (file_exists("consultas/{$_GET['pagina']}.php")) {
				include "consultas/{$_GET['pagina']}.php";
			}
		}
	}
	
	include "rodape.php";
?>