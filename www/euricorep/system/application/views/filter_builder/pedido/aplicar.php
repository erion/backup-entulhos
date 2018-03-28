<?php
	$uri = LISTAGEM_PADRAO."&projecao=".$this->input->get('projecao');
	if (filtrado($this) && $tipo_usuario == USUARIO_CURTUME_PROGRAMACAO)
		echo anchor("pedidos_programacao/listar/".$abertos.$uri,"Limpar |");
	elseif (filtrado($this) && $tipo_usuario == USUARIO_CURTUME_COMERCIAL)
		echo anchor("pedidos_comercial/listar".$uri,"Limpar |");
	elseif (filtrado($this) && $tipo_usuario == USUARIO_ADMINISTRADOR)
		echo anchor("pedidos/listar".$uri,"Limpar |");
	echo form_submit('filtrar','Aplicar',"id='btn_confirmar_filtro'");
?>