<?php
	$u = new Usuario();
	$campo = form_dropdown('vendedor_id', $u->get_dropdown_representante(),$this->input->get('vendedor_id'),'id="vendedor" placeholder="Vendedor" size="280"');
	echo $campo;
?>