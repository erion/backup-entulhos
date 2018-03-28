<?php
	if (file_exists("arquivos/{$_GET['pagina']}.php")) {
		$arquivo = "arquivos/{$_GET['pagina']}.php";
			
		if (count($_POST) > 0) {
			file_put_contents($arquivo,$_POST['conteudo']);
		} 
		$conteudo_arquivo = file_get_contents("arquivos/{$_GET['pagina']}.php",FILE_TEXT);
	}	

	for ($i=0;$i<= count($_FILES);$i++) {

		if ($_FILES["caminho_foto{$i}"]['name'] != '') {
			
			$foo = new Upload($_FILES["caminho_foto{$i}"]);
					
			if ($foo->uploaded) {
				// save uploaded image with no changes
				$foo->file_new_name_body = 'foto';
				$foo->image_convert = 'jpg';
				$foo->Process('../galeria/'.$_GET['pagina'].'/');	
	
				// save uploaded image with a new name,
				// resized to 100px wide
				$foo->file_new_name_body = 'foto';
				$foo->image_resize = true;
				$foo->image_convert = 'jpg';
				$foo->image_x = 115;
				$foo->image_ratio_y = true;
				$foo->Process('../galeria/'.$_GET['pagina'].'/miniatura');
			}			
		}
	}
	
	if (isset($_GET['arq'])) {
		unlink("../galeria/{$_GET['pagina']}/{$_GET['arq']}");
		unlink("../galeria/{$_GET['pagina']}/miniatura/{$_GET['arq']}");
		redirecionar("?pagina={$_GET['pagina']}&a={$_GET['a']}");
	}
?>
