<?php
/*
 * Para todos os formul�rios ser� utilizado a library "form_post", que est� localizada em application/libraries/form_post.php
 * Esta classe gera a sa�da em HTML dos inputs e faz a verifica��o se h� dados no post, para estes n�o serem perdidos
 * caso ocorra erro de valida��o no formul�rio.
 */
?>

<h2>Potencial Comprador &raquo; <?php echo $acao ?></h2>
<form method="post" class="formulario">
	<dl>
		<dt><label>Cliente</label></dt>
		<dd><?php echo form_post::dropdown('cliente_id', $clientes)?></dd>
	</dl>
	<dl>
		<dt>Investimento m�nimo</dt>
		<dd><?php echo form_post::input('investimento_minimo')?></dd>
	</dl>
	<dl>
		<dt>Investimento m�ximo</dt>
		<dd><?php echo form_post::input('investimento_maximo')?></dd>
	</dl>
	
	<?php echo form_post::submit($acao) ?> - <?php echo anchor('potencial_comprador/listar','Cancelar') ?>
</form>