<?php
	session_start();
	
	include "../include/fckeditor/fckeditor.php";
	include "../include/class.upload.php";
	include "arquivos/senhas.php";
	
	function cria_fckeditor($valor){
		$oFCKeditor = new FCKeditor('conteudo') ;
		$oFCKeditor->BasePath = '../include/fckeditor/' ;
		$oFCKeditor->ToolbarSet = 'Basic';
		$oFCKeditor->Value = $valor;
		$oFCKeditor->Width  = 500;		
		$oFCKeditor->Create() ;
	}
	
	function redirecionar($endereco) {
		header("Location:{$endereco}");
	}	
	
	if (file_exists("actions/{$_GET['pagina']}.php"))
		include "actions/{$_GET['pagina']}.php";
	elseif (file_exists("actions/{$_GET['a']}.php"))
		include "actions/{$_GET['a']}.php";	
		
	include "cabecalho.php";		
	
	if (!isset($_SESSION['login'])) {
		include "login.php";
	} else {
		if (isset($_GET['pagina']))
			include "geral.php";
		else 
			redirecionar("index.php?pagina=home&a=geral");	
	}
	
	include "rodape.php";		
?>