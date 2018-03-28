<div class="container">
	<div class="content-ttl clearfix">
		<h1 class="ttl-main"><?php __('contato','contato') ?></h1>
	</div>
	<div class="content clearfix">
		<p class="intro"><?php echo __('contato','intro') ?></p>
		<div class="col-left">
			<form action="<?php echo site_url('contato') ?>" method="post" >
				<ul class="form">
					<li>
						<label for=""><?php __('contato','assunto') ?>:*</label>
						<select name="txtAssunto" id="" class="inp-text">
						<option value="">Selecione...</option>
						<?php foreach($assuntos as $assunto): ?>
							<option value="<?php echo $assunto['ConfigID'] ?>"><?php echo $assunto['Assunto'] ?></option>
						<?php endforeach; ?>
						</select>
					</li>
					<li>
						<label for=""><?php __('contato','nome') ?>:*</label>
						<input type="text" name="txtNome" class="inp-text" />
					</li>
					<li class="telefone">
						<label for=""><?php __('contato','telefone') ?>:*</label>
						<input type="text" name="txtTelefone" class="inp-text" />
					</li>
					<li class="email">
						<label for=""><?php __('contato','email') ?>:*</label>
						<input type="text" name="txtEmail" class="inp-text" />
					</li>
					<li>
						<label for=""><?php __('contato','mensagem') ?>:*</label>
						<textarea name="txtMensagem" id="" class="inp-text"></textarea>
					</li>
				</ul>
				<input type="submit" value="" class="btn btn-enviar" />
			</form>
		</div>
		<div class="col-right">
			<div class="mapa">
				<a href="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=RS-239,+471,+Sapiranga+-+Rio+Grande+do+Sul&amp;aq=0&amp;oq=RS+239,+471,+Sapiranga&amp;sll=-29.64354,-50.992575&amp;sspn=0.041924,0.084543&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=RS-239+-+Sapiranga+-+Rio+Grande+do+Sul&amp;ll=-29.643528,-50.992613&amp;spn=0.035807,0.054932&amp;z=14&amp;iwloc=A&amp;output=embed" title=""><img src="<?php echo imgSkin('img-mapa.jpg'); ?>" alt="" /></a>
			</div>
			<strong class="telefone">51 3529 8482</strong>
			<a href="mailto:contato@dcloset.com.br" title="" class="email">contato@dcloset.com.br</a>
			<p class="endereco">Rodovia RS 239, 471 - KM 30 Sapiranga, RS</p>
		</div>
	</div>
</div>