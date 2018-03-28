<?php
/*
 * Para todos os formulários será utilizado a library "form_post", que está localizada em application/libraries/form_post.php
 * Esta classe gera a saída em HTML dos inputs e faz a verificação se há dados no post, para estes não serem perdidos
 * caso ocorra erro de validação no formulário.
 */
?>

<h2>Potencial comprador &raquo; <?php echo $acao ?></h2>
<form method="post" class="formulario">
	<dl>
		<dt><label>Categoria</label></dt>
		<dd><?php echo form_post::dropdown('categoria',$categoria)?></dd>
	</dl>
	<dl>
		<dt>Modalidade</dt>
		<dd><?php echo form_post::dropdown('modalidade',$modalidade)?></dd>
	</dl>
	<dl>
		<dt>Construção</dt>
		<dd><?php echo form_post::dropdown('construcao',$construcao)?></dd>
	</dl>
	<dl>
		<dt>Tipo</dt>
		<dd><?php echo form_post::dropdown('tipo',$tipo)?></dd>
	</dl>
	<dl>
		<dt>Quartos</dt>
		<dd><?php echo form_post::input('quartos')?></dd>
	</dl>
	<dl>
		<dt>Área</dt>
		<dd><?php echo form_post::input('area')?></dd>
	</dl>
	<dl>
		<dt>Valor</dt>
		<dd><?php echo form_post::input('valor')?></dd>
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
		<dt>Descrição</dt>
		<dd><?php echo form_post::input('descricao')?></dd>
	</dl>											
	
	<?php echo form_post::submit($acao) ?> - <?php echo anchor('imovel/listar','Cancelar') ?>
</form>