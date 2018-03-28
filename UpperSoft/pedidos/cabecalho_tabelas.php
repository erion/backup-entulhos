<h1><?php echo $tabelas_plural[$_GET['tabela']];?></h1>
<?php if (! strpos($_GET['pagina'],"cadastro") > 0 &&  $_GET['tabela'] != "usuario"): ?>
	<div class="botao_adicionar">
		<div class="botao_adicionar_esquerda">&nbsp;</div>
		<div class="botao_adicionar_meio"><a href="?pagina=<?php echo $_GET['pagina'] ?>cadastro&tabela=<?php echo $_GET['tabela']?>&acao=inserir"><img src="imagens/icone_adicionar.png" />  Adicionar</a></div>
		<div class="botao_adicionar_direita">&nbsp;</div>
	</div>
<?php endif; ?>		
