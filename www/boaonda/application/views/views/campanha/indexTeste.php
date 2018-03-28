<div class="container">
	<div class="content-ttl clearfix">
		<h1 class="ttl-main"><?php __('site','campanha'); ?></h1>
	</div>
	<div class="content clearfix">
		<div class="col-img">
			<div id="btn-prev-img">&nbsp;</div>
			<div id="book-campanha">
				<?php foreach($galeriaCampanha as $campanha): ?>
					<div>
						<img src="<?php echo imgUpload($campanha['Imagem'],350,450); ?>" alt="" />
					</div>
				<?php endforeach; ?>
			</div>
			<div id="btn-next-img">&nbsp;</div>
			<h4 style="text-align:center">Use as setas do teclado para navegar</h4>
		</div>
	</div>
</div>