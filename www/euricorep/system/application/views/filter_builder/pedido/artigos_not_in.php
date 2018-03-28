<?php
	$campo = form_dropdown('artigo_not_in[]',$artigos,$this->input->get('artigo_not_in'),'id="artigo_not_in" placeholder="Digite o nome de um artigo" size="740" multiple="multiple"');
	echo "Remover artigos específicos ".$campo;
?>