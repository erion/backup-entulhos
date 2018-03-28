<?php $currentColecao = $colecao['ColecaoID']; ?>
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
		<div class="col-img">
			<div id="btn-prev-img"><!-- --></div>
			<table>
				<tr>
					<td id="img-container" id="colecao-imagem">
						<img src="<?php echo imgUpload($colecao['cores'][0]['imagem'],425,216); ?>" alt="" />
					</td>
				</tr>
			</table>
			<div id="btn-next-img"><!-- --></div>
		</div>
		<div class="col-descricao">
			<dl>
				<dt id="colecao-nome"><?php echo $colecao['Nome'] ?></dt>
					<dd id="colecao-referencia">Ref: <?php echo $colecao['Referencia'] ?></dd>
				<dt><?php __('colecao_detalhes','cores'); ?></dt>
					<dd>
						<ul class="lst-cores clearfix" id="colecao-cor">
							<?php $i=0;foreach($colecao['cores'] as $corImagem): ?>
								<li class="<?php echo ($i ==0)?'current':'' ?>" rel="<?php echo imgUpload($corImagem['imagem'],425,216) ?>" style="background-color:#<?php echo $corImagem['cor'] ?>;"><a id="<?php echo $corImagem['cor'].$i ?>" href="#<?php echo $corImagem['nome'] ?>" onClick="changeImg('<?php echo '#'.$corImagem['cor'].$i ?>')">&nbsp;</a></li>
							<?php $i++;endforeach; ?>
						</ul>
					</dd>
				<?php if($colecao['grades']): ?>
				<dt><?php __('colecao_detalhes','tamanhos'); ?></dt>
					<dd>
						<ul class="lst-tamanhos clearfix" id="colecao-grade">
							<?php foreach($colecao['grades'] as $grade): ?>
							<li><?php echo $grade; ?></li>
							<?php endforeach; ?>
						</ul>
					</dd>
				<?php endif; ?>
			</dl>
		</div>
		<div class="thumbs">
			<div id="carrossel-thumbs">
				<div class="jcarousel-clip">
					<ul>
						<?php foreach($colecaoCompleta as $colecao): 
							$current = ($currentColecao == $colecao['ColecaoID']) ? 'class="current"' : '';
						?>
							<li <?php echo $current ?>><a href="<?php echo imgUpload($colecaoCompletaImagens[$colecao['ColecaoID']]['Imagem'],425,216); ?>" rel="<?php echo $colecao['ColecaoID'] ?>" title="<?php echo $colecao['Nome'] ?>"><img src="<?php echo imgUpload($colecaoCompletaImagens[$colecao['ColecaoID']]['Imagem'],142,95); ?>" alt="" /></a></li>
						<?php $i++; endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>