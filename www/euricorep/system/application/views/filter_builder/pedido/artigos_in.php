<?php
	$campo = form_dropdown('artigo_in[]',$artigos,$this->input->get('artigo_in'),'id="artigo_in" placeholder="Digite o nome de um artigo" size="740" multiple="multiple"');
	echo "Mostrar artigos específicos ".$campo;
?>