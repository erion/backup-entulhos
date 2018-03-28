<?php
	$c = new Cliente();
	$campo = form_dropdown('entidade_id', $c->get_dropdown(),$this->input->get('entidade_id'),'id="cliente" placeholder="Cliente" size="280"');
	echo $campo;
?>