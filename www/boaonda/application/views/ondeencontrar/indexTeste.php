<div class="container">
	<div class="content-ttl">
		<h1 class="ttl-main"><?php __('site','ondeencontrar') ?></h1>
	</div>
	<div class="content clearfix">
		<?php if($currentLang == 'pt'): ?>
			<div class="col-left">
				<div class="filtro">
					<ul class="clearfix">
						<li class="estado">
							<label for="loja-estado">Estado</label>
							<select name="" id="loja-estado" class="inp-text">
								<option value="">Selecione...</option>
								<?php foreach($estados as $estado): ?>
									<option value="<?php echo $estado['EstadoID'] ?>"><?php echo $estado['Nome'] ?></option>
								<?php endforeach; ?>
							</select>
						</li>
						<li class="bairro">
							<label for="loja-cidade">Bairro</label>
							<select name="" id="loja-bairro" class="inp-text">
								<option value="">Selecione uma cidade</option>
							</select>
						</li>
						<li class="cidade">
							<label for="loja-cidade">Cidade</label>
							<select name="" id="loja-cidade" class="inp-text">
								<option value="">Selecione um estado</option>
							</select>
						</li>			
					</ul>
				</div>
				<!-- aqui estava div overflow -->
			</div>
			<div class="overflow">
				<ul class="lst-filtro" id='lst-lojas'>
				</ul>
			</div>			
		<?php endif; ?>
		<?php if($currentLang == 'pt'): ?>
		<div class="col-right">
		<?php endif; ?>
			<div class="ttl-blt <?php echo ($filtro == 'lojas') ? 'current' : '' ?>"><a href="<?php echo site_url('onde-encontrar/lojas') ?>">Lojas</a></div>
			<div class="ttl-blt <?php echo ($filtro == 'representantes') ? 'current' : '' ?>"><a href="<?php echo site_url('onde-encontrar/representantes') ?>">Representantes</a></div>		
			<p class="intro"><?php __('onde_representante','texto') ?></p>
			<p class="intro"><?php echo $intro; ?></p>
<!--
			<div class="filtro">
				<ul>
					<li class="estado">
						<label for="repres-estado"><?php __('onde_representante','filtro') ?></label>
						<select name="" id="<?php echo $selectRepID ?>" class="inp-text">
							<option value="">Selecione...</option>
							<?php if($currentLang == 'pt'): //lista estados
									  foreach($estadosRep as $estado): ?>
											<option value="<?php echo $estado['EstadoID'] ?>"><?php echo $estado['Nome'] ?></option>
								<?php endforeach;
							else: 							//lista países
									foreach($estadosRep as $pais): ?>
											<option value="<?php echo $pais['PaisID'] ?>"><?php echo $pais['Nome'] ?></option>
							<?php	endforeach;
							endif; ?>
						</select>
					</li>
				</ul>
			</div>
-->			
			<div class="overflow">
				<ul class="lst-filtro" id="lst-representantes">

				</ul>
			</div>
		<?php if($currentLang == 'pt'): ?>
		</div>
		<?php endif; ?>
	</div>
</div>