<html>
	<head>
		<title>Rosana Imóveis - Administração</title>
		<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>css/principal.css'>
		<script type="text/javascript" src='<?php echo base_url() ?>js/javascript.js'></script>
	</head>
	<body>
	<div id='tudo'>
		<div class='cabecalho'><div class='cabecalho_logo'></div><h1>Área Administrativa</h1>
			<div class='menu'>
				<?php
					$potencial_comprador="";$imovel="";$posto="";$cliente="";
					if (!(uri_string())) {
						$potencial_comprador="class='selecionado'";
					} else {
						$selecionado =$this->uri->segment(1)."=class='selecionado'";
						parse_str($selecionado);						
					}
					echo anchor("imovel/listar","Imóveis",$imovel)," | ", anchor("posto/listar","Postos de Combustível", $posto)," | ", anchor("cliente/listar","Clientes",$cliente)," | ", anchor("potencial_comprador/listar/imovel","Potenciais Compradores",$potencial_comprador)," | ";									 
				?>	
			</div>
		</div>
		<div class='cabecalho_linha'></div>
		<div class='botoes'><ul>
		<?php if (!($this->uri->segment(2))): ?>
			<li><?php echo anchor($this->uri->segment(1).'/listar',"<span class='listar'>&nbsp;</span>") ?></li>
			<li><?php echo anchor($this->uri->segment(1).'/buscar',"<span class='buscar'>&nbsp;</span>") ?></li>
			<li><?php echo anchor($this->uri->segment(1).'/cadastrar',"<span class='cadastrar'>&nbsp;</span>") ?></li>
		<?php else: ?>
			<li><?php echo anchor($this->uri->segment(1).'/listar/'.$this->uri->segment(3),"<span class='listar'>&nbsp;</span>") ?></li>
			<li><?php echo anchor($this->uri->segment(1).'/buscar/'.$this->uri->segment(3),"<span class='buscar'>&nbsp;</span>") ?></li>
			<li><?php echo anchor($this->uri->segment(1).'/cadastrar/'.$this->uri->segment(3),"<span class='cadastrar'>&nbsp;</span>") ?></li>		
		<?php endif;?>		
		</ul></div>
		<div class='conteudo'>