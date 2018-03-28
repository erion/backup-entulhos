<?php
	$campo = form_dropdown('cliente_id',$clientes,$this->input->get('cliente_id'),'id="cliente" placeholder="Cliente" size="280"');
	echo $campo;
?>