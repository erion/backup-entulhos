<?php
	$campo = form_dropdown('artigo_id',$artigos,$this->input->get('artigo_id'),'id="artigo_id" placeholder="Artigo" size="150"');
	echo $campo;
?>