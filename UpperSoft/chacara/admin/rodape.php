			</div>
	    	<div id="foto_todo">
	    		<?php
					$projectsListIgnore = array ('.','..');
		    		$dir = opendir("../galeria/{$_GET['pagina']}/miniatura");
		    		$i = 0;
					while ($arq = readdir($dir)) {
						if (!in_array($arq,$projectsListIgnore)) {
							$fotos[] = "<img src='../galeria/{$_GET['pagina']}/miniatura/{$arq}'/><br /><a href='?pagina={$_GET['pagina']}&a=geral&arq={$arq}'>Excluir</a><br />"; 
							$i++;							
						}
					}
					closedir($dir);
					
					if ($i > 0): //mostra fotos apenas se tem fotos	
				?>		    	
		    		<div id="foto_topo"></div>
		    		<div id="foto_centro"><?php echo implode(" ",$fotos);?></div>
		    		<div id="foto_baixo"></div>
	    		<?php endif;?>
	    	</div>	
			<div id="rodape">
				<img src="../images/rodape.jpg" />
			</div>
		</div>
	</body>
</html>