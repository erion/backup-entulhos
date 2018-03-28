<div class="container">
	<div class="content-ttl clearfix">
		<h1 class="ttl-main"><?php echo $cadastro['Titulo'] ?></h1>
	</div>
	<div class="content clearfix">
		<div class="col-left">
			<?php echo $cadastro['Descricao'] ?>
		</div>
		<div class="col-right clearfix">
			<?php echo $mensagem; ?>
			<form action="<?php site_url('cadastro') ?>" method="post">
				<ul class="form">
					<li class="nome">
						<label for=""><?php __('cadastro','nome') ?>:*</label>
						<input type="text" name="cadastro[Nome]" class="inp-text" value="<?php echo $nome ?>" />
					</li>
					<li class="email">
						<label for=""><?php __('cadastro','email') ?>:*</label>
						<input type="text" name="cadastro[Email]" class="inp-text" value="<?php echo $email ?>" />
					</li>
					<li class="telefone">
						<label for=""><?php __('cadastro','telefone') ?>:</label>
						<input type="text" name="cadastro[Telefone]"  class="inp-text" />
					</li>
					<li class="sexo">
						<span><?php __('cadastro','sexo') ?>:</span>
						<input type="radio"  name="cadastro[Sexo]" value="Feminino" id="rbFeminino" />
						<label for="rbFeminino"><?php __('cadastro','sexo_opt1') ?></label>
						<input type="radio"  name="cadastro[Sexo]" value="Masculino" id="rbMasculino" />
						<label for="rbMasculino"><?php __('cadastro','sexo_opt2') ?></label>
					</li>
					<li class="nasc">
						<label for=""><?php __('cadastro','nascimento') ?>:</label>
						<input type="text" name="cadastro[DataNascimento]"  class="inp-text" />
					</li>
					<li class="calcados">
						<label for=""><?php __('cadastro','calcados') ?>:</label>
						<select  name="cadastro[Calcado]" id="" class="inp-text">
							<?php foreach($tamanhos as $grade): ?>							
								<option value="<?php echo $grade ?>"><?php echo $grade ?></option>
							<?php endforeach; ?>
						</select>
					</li>
					<li class="profissao">
						<label for=""><?php __('cadastro','profissao') ?>:</label>
						<input type="text" name="cadastro[Profissao]"  class="inp-text" />
					</li>
					<li class="endereco">
						<label for=""><?php __('cadastro','endereco') ?>:</label>
						<input type="text" name="cadastro[Endereco]"  class="inp-text" />
					</li>
					<li class="numero">
						<label for=""><?php __('cadastro','numero') ?>:</label>
						<input type="text" name="cadastro[Numero]"  class="inp-text" />
					</li>
					<li class="compl">
						<label for=""><?php __('cadastro','complemento') ?>:</label>
						<input type="text" name="cadastro[Complemento]"  class="inp-text" />
					</li>
					<li class="estado">
						<label for=""><?php __('cadastro','estado') ?>:</label>
						<select  name="cadastro[Estado]"  id="" class="inp-text">
						<?php foreach($estados as $sigla => $nome): ?>
							<option value="<?php echo $sigla ?>"><?php echo $nome ?></option>
						<?php endforeach; ?>
						</select>
					</li>
					<li class="cidade">
						<label for=""><?php __('cadastro','cidade') ?>:</label>
						<input type="text" name="cadastro[Cidade]"  class="inp-text" />
					</li>
				</ul>
				<input type="submit" value="" class="btn btn-enviar" />
			</form>
		</div>
	</div>
</div>