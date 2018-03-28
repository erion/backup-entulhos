<?php
/*
 * Para todos os formulários será utilizado a library "form_post", que está localizada em application/libraries/form_post.php
 * Esta classe gera a saída em HTML dos inputs e faz a verificação se há dados no post, para estes não serem perdidos
 * caso ocorra erro de validação no formulário.
 */
?>

<h2>Potencial Comprador &raquo; <?php echo $acao ?></h2>
<form method="post" class="formulario">
	<dl>
		<dt><label>Cliente</label></dt>
		<dd><?php echo form_post::dropdown('cliente_id', $clientes)?></dd>
	</dl>
	<dl>
		<dt>Investimento mínimo</dt>
		<dd><?php echo form_post::input('investimento_minimo')?></dd>
	</dl>
	<dl>
		<dt>Investimento máximo</dt>
		<dd><?php echo form_post::input('investimento_maximo')?></dd>
	</dl>
	
	<?php echo form_post::submit($acao) ?> - <?php echo anchor('potencial_comprador/listar','Cancelar') ?>
</form>