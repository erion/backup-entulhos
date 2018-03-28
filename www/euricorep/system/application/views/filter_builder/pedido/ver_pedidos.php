<?php
	$campo = form_checkbox('ver_pedidos',"1", (($this->input->get('ver_pedidos') == '1') ? "checked" : ""), 'id="ver_pedidos" onclick="$(\'#form_filtro\').submit()"');
	echo $campo.'&nbsp;<label for="ver_pedidos">Ver todos pedidos</label>&nbsp;';
?>