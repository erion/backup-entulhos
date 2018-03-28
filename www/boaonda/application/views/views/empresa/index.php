<div class="container">
	<div class="content-ttl">
		<h1 class="ttl-main"><?php echo $empresa['Titulo'] ?></h1>
	</div>
	<div class="content clearfix">
		<div class="col-left">
			<?php echo $empresa['Descricao'] ?>
		</div>
		<div class="col-right">
			<div class="block-empresa">
				<h2 class="ttl-blt"><?php __('empresa','empresa'); ?></h2>
				<img src="<?php echo imgUpload($empresa['Imagem'],385,152); ?>" alt="" />
			</div>
			<div class="block-campanha">
				<h2 class="ttl-blt"><a href="<?php echo site_url('campanha') ?>" title=""><?php __('empresa','campanha'); ?></a></h2>
				<iframe width="385" height="222" src="http://www.youtube.com/embed/<?php echo $dadosComuns['videoCampanha'] ?>" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>