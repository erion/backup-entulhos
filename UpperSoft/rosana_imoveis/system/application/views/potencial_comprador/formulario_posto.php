<?php
/*
 * Created on 10/05/2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<h2>Potencial Comprador &raquo; <?php echo $acao ?></h2>
<form method="post" class="formulario">
	<dl>
		<dt><label>Cliente</label></dt>
		<dd><?php echo form_post::dropdown('cliente_id', $clientes)?></dd>
	</dl>
	<dl>
		<dt>Bandeira</dt>
		<dd><?php echo form_post::input('bandeira')?></dd>
	</dl>
	<?php echo form_post::submit($acao) ?> - <?php echo anchor('potencial_comprador/listar/posto','Cancelar') ?>
</form>