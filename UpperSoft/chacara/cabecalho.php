<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<script type="text/javascript" src="scripts/jquery.lightbox-0.5.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" />				
		<link rel="stylesheet" type="text/css" href="css/tulum_css.css" />
		<title>Chácara Tulum</title>
		<script type="text/javascript">
			$(function() {
				$('#foto_centro a').lightBox({fixedNavigation:true});
			});
		</script>		
	</head>
	<body>
		<div id="tudo">
			<div id="menu">
				<ul id="nav">
					<li id="home"><a href="?pagina=home&a=geral" <?php if ($_GET['pagina'] == "home") echo 'class="selecionado"' ?>>Home</a></li>
					<li id="estrutua"><a href="?pagina=estrutura&a=geral" <?php if ($_GET['pagina'] == "estrutura") echo 'class="selecionado"' ?>>Estrutura</a></li>
					<li id="contato"><a href="?pagina=contato&a=geral" <?php if ($_GET['pagina'] == "contato") echo 'class="selecionado"' ?>>Contato</a></li>
					<li id="pavao"><a href="?pagina=pavao&a=geral" <?php if ($_GET['pagina'] == "pavao") echo 'class="selecionado"' ?>>Pavão</a></li>
					<li id="faisao"><a href="?pagina=faisao&a=geral" <?php if ($_GET['pagina'] == "faisao") echo 'class="selecionado"' ?>>Faisão</a></li>
					<li id="Ganso"><a href="?pagina=ganso&a=geral" <?php if ($_GET['pagina'] == "ganso") echo 'class="selecionado"' ?>>Ganso</a></li>
					<li id="cisne"><a href="?pagina=cisne&a=geral" <?php if ($_GET['pagina'] == "cisne") echo 'class="selecionado"' ?>>Cisne</a></li>   
					<li id="tadorna"><a href="?pagina=tadorna&a=geral" <?php if ($_GET['pagina'] == "tadorna") echo 'class="selecionado"' ?>>Tadorna</a></li>
					<li id="marreco"><a href="?pagina=marreco&a=geral" <?php if ($_GET['pagina'] == "marreco") echo 'class="selecionado"' ?>>Marreco</a></li>
					<li id="outros"><a href="?pagina=outros&a=geral" <?php if ($_GET['pagina'] == "outros") echo 'class="selecionado"' ?>>Outros</a></li>
				</ul><br />
			</div>
			<div id="topo">
				<img src="images/topo.jpg"/>  
	  		</div>
			<div id="conteudo_todo">
		    	<div id="conteudo">		