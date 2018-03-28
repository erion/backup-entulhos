<?php
	$campo = form_checkbox('artigos_pedidos',"artigos", (($this->input->get('artigos_pedidos') == 'artigos') ? "checked" : ""), 'id="artigos_pedidos" onclick="$(\'#form_filtro\').submit()"');
	echo $campo.'&nbsp;<label for="artigos_pedidos">Ver relação de cores</label>&nbsp;';
?>