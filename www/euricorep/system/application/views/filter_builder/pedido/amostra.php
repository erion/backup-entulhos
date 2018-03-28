<?php
	$campo = form_checkbox('amostrav[]',"1", (((int)$this->input->get('amostrav') == 2 || (int)	$this->input->get('amostrav') == 1 || !isset($_GET['amostrav']) ) ? "checked" : ""), 'id="amostra"' );
	echo $campo.'&nbsp;<label for="amostra">Amostra</label>&nbsp;';
?>