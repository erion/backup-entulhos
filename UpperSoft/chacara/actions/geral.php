<?php
	if (file_exists("admin/arquivos/{$_GET['pagina']}.php")) {
		$arquivo = fopen("admin/arquivos/{$_GET['pagina']}.php", "r");
		$conteudo_arquivo = file_get_contents("admin/arquivos/{$_GET['pagina']}.php",FILE_TEXT);
		fclose($arquivo);		
	}
?>
