<div id="slides">
	<?php 
		$banners = $dadosComuns['banners'];
		foreach($banners as $banner):
	?>	
		<div class="slides_container">
			<div class="item" style="background-image:url('<?php echo imgUpload($banner['Imagem'],1904,715,'size') ?>');">
				<div class="container">
					<div class="box-banner">
						<div class="content-ttl">
							<span class="ttl"><?php echo $banner['Nome'] ?></span>
						</div>
						<div class="clearfix">
							<div class="content-txt">
								<?php echo $banner['Descricao'] ?>
							</div>
							<a href="<?php echo (trim($banner['Url'] != '')? $banner['Url'] : "#") ?>" title="" class="lnk">&gt;</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>			
	<div class="btn-prev"><!-- --></div>
	<div class="btn-next"><!-- --></div>
</div>