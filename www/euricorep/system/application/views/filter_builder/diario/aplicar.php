<?php
	if (filtrado($this))
		echo anchor("logs/listar","Limpar |");
	echo form_submit('filtrar','Aplicar',"id='btn_confirmar_filtro'");	
?>