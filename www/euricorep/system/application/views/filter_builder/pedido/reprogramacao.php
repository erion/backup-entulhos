<?php
	$campo1 = form_input('reprogramado_ini',$this->input->get('reprogramado_ini'),'id="reprogramado_ini" size="100" rel="data"');
	$campo2 = form_input('reprogramado_fim',$this->input->get('reprogramado_fim'),'id="reprogramado_fim" size="100" rel="data"');
	($this->session->userdata('tipo') == 'ADM') ? $label1 = 'Confirmado para ' : $label1 = 'Reprogramado para';
?>
<span><?php echo $label1 ?></span>
<span><?php echo $campo1 ?></span>
<span>até</span>
<span><?php echo $campo2 ?></span>