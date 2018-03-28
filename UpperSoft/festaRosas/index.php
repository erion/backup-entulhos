<html>
	<head> 
		<link rel="stylesheet" type="text/css" href="css/estiloPrincipal.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.lightbox.packed.css" />
		<script type="text/javascript" src="scripts/jquery-1.2.6.pack.js"></script>
		<script type="text/javascript" src="scripts/jquery.scrollTo-min.js"></script>
		<script type="text/javascript" src="scripts/scripts.js"></script>
<!--		<script type="text/javascript" src="http://www.sapiranga.rs.gov.br/jlightbox/js/jquery.lightbox.packed.js"></script>  -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	<body>
	
		<div id="tudo">
			<table cellpadding="0" cellspacing="0">
				<tr>
				<!-- LINHA1 -->
					<td><a href="#"> <img src="imagens/principal01.jpg" alt="Festa das Rosas"/></a></td>
					<td><img src="imagens/principal02.jpg"/></td>
					<td><img src="imagens/principal03.jpg"/></td>
				</tr>	
				<tr>
				<!-- LINHA2 -->
					<td><img src="imagens/principal04.jpg"/></td>
					<td><img src="imagens/banner.jpg"/></td>
					<td class="menu">&nbsp; 
					 	<ul class="listaPrincipal">
					 		<li><a href="#" id="agenda" class="selecionado"> Agenda </a></li>
					 		<li><a href="#" id="noticias"> Notícias </a></li>
					 		<li><a href="#" id="fotos"> Fotos </a></li>
					 		<li><a href="#" id="videos"> Vídeos </a></li>
					 		<li><a href="#" id="mapafesta"> Mapa da festa </a></li>
					 		<li><a href="#" id="comochegar"> Como chegar </a></li>
					 		<li><a href="#" id="contato"> Contato </a></li>
					 	</ul>					 
					</td>
				</tr>	
				<tr>
				<!-- LINHA3 -->
					<td><img src="imagens/principal06.jpg" /></td>
					<td><img src="imagens/principal07.jpg" /></td>
					<td><img src="imagens/principal08.jpg" /></td>
				</tr>			
			</table>
			
			<div class="conteudo_principal">
				<div class="lateral1">&nbsp;</div> 
					<div id="conteudo"> 
						<?php
							include "templates/agenda.php";
						?>
						<div class="rodape1">
							Realização:
						</div>
						<div class="rodape2">
							Comissão Organizadora da XXV Festa das Rosas
						</div>							
					</div>	
			</div>			
		</div>		
	</body>

</html>