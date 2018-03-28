<?php
	$campo = form_checkbox('amostrav[]',"0", (((int)$this->input->get('amostrav') == 2 || (int)	$this->input->get('amostrav') == 0) ? "checked" : ""), 'id="producao"' );
	echo $campo.'&nbsp;<label for="producao">Produção</label>&nbsp;';
?>