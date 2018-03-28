<?php
	$campo1 = form_input('criado_ini',$this->input->get('criado_ini'),'id="criado_ini" size="100" rel="data"');
	$campo2 = form_input('criado_fim',$this->input->get('criado_fim'),'id="criado_fim" size="100" rel="data"');
	$label1 = 'Criado entre ';
?>
<span><?php echo $label1 ?></span>
<span><?php echo $campo1 ?></span>
<span>até</span>
<span><?php echo $campo2 ?></span>