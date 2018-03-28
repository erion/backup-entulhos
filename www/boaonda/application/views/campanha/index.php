<div class="container">
	<div class="content-ttl clearfix">
		<h1 class="ttl-main"><?php __('site','campanha'); ?></h1>
	</div>
	<div class="content clearfix">
		<div class="thumbs">
			<div id="carrossel-thumbs">
				<div class="jcarousel-clip">
					<ul>
						<?php $i=0;foreach($galeriaCampanha as $galeria): ?>
						<li <?php echo $i == 0 ? 'class="current"' : ''; $i++; ?>>
							<div class="lnk-img">
								<table><tr class="campanha-imagem"><td><a class="fancy-campanha" href="#galeria-campanha-<?php echo $galeria['CampanhaGaleriaID'] ?>" onClick="campanhaImgChange($(this));" title=""><img src="<?php echo imgUpload($galeria['Imagem'],142,95) ?>" alt="" /></a></td></tr></table>
								<div style="display:none"><table class="campanha-fancy" style="width:600px;height:500px" id="galeria-campanha-<?php echo $galeria['CampanhaGaleriaID'] ?>"><tr class="campanha-imagem"><td><img src="<?php echo imgUpload($galeria['Imagem'],620,460); ?>" alt="" /></td></tr></table></div>
							</div>
							<h2 class="ttl"><a class="fancy-campanha" href="#galeria-campanha-<?php echo $galeria['CampanhaGaleriaID'] ?>" title=""><?php echo $galeria['Legenda'] ?></a></h2>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-img-old">
			<table>
				<tr>
					<td id="img-container" style="z-index:0">
						<iframe width="700" height="435" src="http://www.youtube.com/embed/<?php echo $dadosComuns['videoCampanha'] ?>?wmode=transparent" frameborder="0" allowfullscreen></iframe>
					</td>
				</tr>
			</table>
			<strong class="ttl"><?php echo $campanha['Nome'] ?></strong>
		</div>
	</div>
</div>