<img src="../images/<?php echo $_GET['pagina'] ?>.jpg"/><br /><br />
<form method="POST" enctype="multipart/form-data">
	<?php cria_fckeditor($conteudo_arquivo); ?>
	<br />
	<h2>Fotos - <a href="#" onclick="gera_input();return false;">Adicionar</a></h2>
	<input type="file" name="caminho_foto0" />
	<div id="add_input"></div><br />
	<input type="submit" class="botao_salvar" value="Salvar" />	
</form>