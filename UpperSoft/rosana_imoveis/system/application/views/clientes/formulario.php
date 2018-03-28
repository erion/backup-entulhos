<?php
/*
 * Para todos os formulários será utilizado a library "form_post", que está localizada em application/libraries/form_post.php
 * Esta classe gera a saída em HTML dos inputs e faz a verificação se há dados no post, para estes não serem perdidos
 * caso ocorra erro de validação no formulário.
 */
?>

<h2>Cliente &raquo; <?php echo $acao ?></h2>
<form method="post" class="clientes">
	<dl>
		<dt><label>Nome</label></dt>
		<dd><?php echo form_post::input('nome')?></dd>
	</dl>
	<dl>
		<dt>Pessoa</dt>
		<dd><?php echo form_post::dropdown('pessoa',$pessoa)?></dd>
	</dl>
	<dl>
		<dt>CPF/CNPJ</dt>
		<dd><?php echo form_post::input('cpf_cnpj')?></dd>
	</dl>
	<dl>
		<dt>Cidade</dt>
		<dd><?php echo form_post::input('cidade')?></dd>
	</dl>
	<dl>
		<dt>UF</dt>
		<dd><?php echo form_post::input('uf')?></dd>
	</dl>
	<dl>
		<dt>Endereço</dt>
		<dd><?php echo form_post::input('endereco')?></dd>
	</dl>
	<dl>
		<dt>Nº</dt>
		<dd><?php echo form_post::input('numero')?></dd>
	</dl>
	<dl>
		<dt>Apto.</dt>
		<dd><?php echo form_post::input('apto')?></dd>
	</dl>
	<dl>
		<dt>Bairro</dt>
		<dd><?php echo form_post::input('bairro')?></dd>
	</dl>
	<dl>
		<dt>CEP</dt>
		<dd><?php echo form_post::input('cep')?></dd>
	</dl>
	<dl>
		<dt>Telefone</dt>
		<dd><?php echo form_post::input('telefone')?></dd>
	</dl>
	<dl>
		<dt>Celular</dt>
		<dd><?php echo form_post::input('celular')?></dd>
	</dl>
	<dl>
		<dt>E-mail</dt>
		<dd><?php echo form_post::input('email')?></dd>
	</dl>										
	<dl>
	<dd><?php echo form_post::submit($acao) ?> - <?php echo anchor('cliente/listar','Cancelar') ?></dd>
	</dl>
</form>