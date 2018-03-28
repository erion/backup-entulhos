<div class="container">
	<div class="content-ttl clearfix">
		<h1 class="ttl-main"><?php __('colecao','colecao'); ?></h1>
		<ul class="menu">
			<?php foreach($generos as $genero): ?>
				<li <?php echo (strtolower($filtro) == strtolower($genero['Titulo']))?'class="current"':'' ?>><a href="<?php echo site_url('colecao/'.strtolower($genero['Titulo'])) ?>" title="<?php echo ucfirst($genero['Titulo']) ?>"><?php __('colecao',strtolower($genero['Titulo'])); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="content clearfix">
		<div class="overflow">
			<ul class="lst-colecao clearfix">
				<?php foreach($colecao as $produto): 
						if($produto['genero']) $filtro = strtolower($produto['genero']);				
				?>
				<li>
					<div class="lnk-img">
						<a href="<?php echo site_url('colecao')."/".$filtro."/".$produto['Url'] ?>" title=""><img src="<?php echo imgUpload($colecaoImagem[$produto['ColecaoID']]['Imagem'],140,91) ?>" alt="" /></a>
					</div>
					<h2 class="ttl"><a href="<?php echo site_url('colecao')."/".$filtro."/".$produto['Url'] ?>" title=""><?php echo $produto['Nome'] ?></a></h2>
					<span><?php echo $produto['Referencia'] ?></span>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>