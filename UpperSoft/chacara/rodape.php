				</div>
		    	<div id="foto_todo">
		    		<?php
						$projectsListIgnore = array ('.','..');		    		
			    		$dir = opendir("galeria/{$_GET['pagina']}/miniatura");
			    		$i = 0;
						while ($arquivo = readdir($dir)) {
							if (!in_array($arquivo,$projectsListIgnore)) {
								$fotos[] = "<a href='galeria/{$_GET['pagina']}/{$arquivo}' rel='lightbox'>" .
										"<img src='galeria/{$_GET['pagina']}/miniatura/{$arquivo}'/><br /><br />" .
										"</a>"; 
								$i++;							
							}
						}
						closedir($dir);
						
						//mostra fotos apenas se tem fotos
						if ($i > 0): ?>
				    		<div id="foto_topo"></div>
				    		<div id="foto_centro">
				    			<?php echo implode('',$fotos);?>
				    		</div>
				    		<div id="foto_baixo"></div>
		    			<?php endif; ?>
		    	</div>
				
			</div>
			<div id="rodape">
				<img src="images/rodape.jpg" />
			</div>
		</div>
	</body>
</html>