<html>
	<head>
		<title>Euricorep - Sistema de Pedidos</title>
		<link rel="stylesheet" type="text/css" href="css/estilo_principal.css" />
		<script type="text/javascript" src="scripts/jquery.min.js" ></script>
		<script type="text/javascript" src="scripts/jquery.autocomplete.js" ></script>
		<script type="text/javascript" src="scripts/date.js" ></script>
		<script type="text/javascript" src="scripts/jquery.datePicker.js"></script>
		<script type="text/javascript" src="scripts/date_pt-br.js"></script>
		<script type="text/javascript" src="scripts/jquery.maskedinput-1.1.4.pack.js"></script>
		<script type="text/javascript" src="scripts/script.js"></script>
		<script type="text/javascript" src="scripts/jquery.ifixpng.js"></script>
		<script type="text/javascript" src="scripts/thickbox.js"></script>		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
		<link rel="stylesheet" type="text/css" href="css/datePicker.css" />
		<link rel="stylesheet" type="text/css" href="css/thickbox.css" />	
	</head>
	<body>
		<script type="text/javascript">
			$(document).ready(function(){
				$('img[@src$=.png]').ifixpng(); 
			});
		</script>	
		<div class="cabecalho_todo">
			<img src="imagens/euricorep-logotipo.png" class="png"/>
			<div class="cabecalho_usuario">
				<div class="cabecalho_esquerda"></div>
				<div class="cabecalho1">Bem vindo <?php	echo ucfirst($_SESSION['usuario']); if($_SESSION['usuario'] != ''): ?>(<a href="index.php?pagina=logincadastro&sessao=fim">Sair</a>)<?php endif;?></div>
				<div class="cabecalho_direita"></div>
			</div>					
		</div>						
		<div class="conteudo_todo">									
			<div class="conteudo">	
				<?php if($_GET['pagina'] != 'logincadastro'): ?>					
					<div class="menu_principal">
						<ul class="menu_principal_baixo">
							<li><a href="?pagina=pedido&tabela=pedido" <?php if($_GET['tabela'] == 'pedido') echo 'class="selecionado"' ?>>Pedidos</a></li>
							<li><a href="?pagina=companhia&tabela=companhia"<?php if($_GET['tabela'] == 'companhia') echo 'class="selecionado"' ?>>Companhias</a></li>
							<li><a href="?pagina=geral&tabela=item"<?php if($_GET['tabela'] == 'item') echo 'class="selecionado"' ?>>Itens</a></li>
							<li><a href="?pagina=geral&tabela=artigo"<?php if($_GET['tabela'] == 'artigo') echo 'class="selecionado"' ?>>Artigos</a></li>
							<li><a href="?pagina=geral&tabela=mat_prima"<?php if($_GET['tabela'] == 'mat_prima') echo 'class="selecionado"' ?>>Mat.Prima</a></li>
							<!--<li><a href="?pagina=geral&tabela=classificacao"<?php /*if($_GET['tabela'] == 'classificacao') echo 'class="selecionado"' */?>>Classificação</a></li>-->
							<li><a href="?pagina=geral&tabela=tipo_acabamento"<?php if($_GET['tabela'] == 'tipo_acabamento') echo 'class="selecionado"' ?>>Tipo de Acabamento</a></li>
							<li><a href="?pagina=geral&tabela=cor"<?php if($_GET['tabela'] == 'cor') echo 'class="selecionado"' ?>>Cores</a></li>
							<li><a href="?pagina=geral&tabela=pais"<?php if($_GET['tabela'] == 'pais') echo 'class="selecionado"' ?>>Países</a></li>
							<li><a href="?pagina=geral&tabela=unidade"<?php if($_GET['tabela'] == 'unidade') echo 'class="selecionado"' ?>>Unidades</a></li>
							<li><a href="?pagina=geral&tabela=finalidade"<?php if($_GET['tabela'] == 'finalidade') echo 'class="selecionado"' ?>>Finalidades</a></li>
							<li><a href="?pagina=usuario&tabela=usuario"<?php if($_GET['tabela'] == 'usuario') echo 'class="selecionado"' ?>>Usuários</a></li>
						</ul>	
					</div>
				<?php endif; ?>
				<!--<div class="bordaBox"> -->
					<!--<b class="b1"></b><b class="b2"></b><b class="b3"></b><b class="b4"></b>-->
					<!--<div class="conteudo2">-->				
						<div class="conteudo_tabelas">	
							<?php if($_GET['pagina'] != 'logincadastro'){ 
								include "cabecalho_tabelas.php"; 
							}?>		
												