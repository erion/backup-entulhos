<?php
	$campo = form_dropdown('fornecedor_id',$fornecedores,$this->input->get('fornecedor_id'),'id="fornecedor" placeholder="Fornecedor" size="280"');
	echo $campo;
?>
