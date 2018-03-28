<?php
	$campo = form_dropdown('usuario_id',$usuarios,$this->input->get('usuario_id'),'id="usuario" placeholder="Usuário" size="280"');
	echo $campo;
?>