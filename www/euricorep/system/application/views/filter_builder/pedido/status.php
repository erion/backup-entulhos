<?php
	$campo = form_dropdown('status',$status,$this->input->get('status'),'id="status" size="120"');
?>
<span>Status</span>
<span><?php echo $campo ?></span>