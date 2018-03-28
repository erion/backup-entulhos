<?php
	if (filtrado($this))
		echo anchor("entidades/listar/cliente/".$menu_acesso,"Limpar |");
	echo form_submit('filtrar','Aplicar',"id='btn_confirmar_filtro'");	
?>