<div id="filtro">
	<h2><a href="#" onclick="esconder_filtro()" >Filtrar<img src="<?php echo base_url()."assets/img/seta_dir.gif" ?>" name="filtro" alt="" /></a></h2>
	<?php
		if ($this->filterbuilder->form_action != null) {
			echo form_open($this->filterbuilder->form_action,"method='get' id='form_filtro'");
		} else {
			switch($this->session->userdata('tipo')) {
				case (USUARIO_ADMINISTRADOR || USUARIO_SUPER_ADMINISTRADOR):
					echo form_open("pedidos/listar?order=".$this->input->get('order')."&campo=".$this->input->get('campo')."","method='get' id='form_filtro'");
				break;
				case USUARIO_CURTUME_COMERCIAL:
					echo form_open("pedidos_comercial/listar?order=".$this->input->get('order')."&campo=".$this->input->get('campo')."","method='get' id='form_filtro'");
				break;
				case USUARIO_CURTUME_PROGRAMACAO:
					echo form_open("pedidos_programacao/listar?order=".$this->input->get('order')."&campo=".$this->input->get('campo')."","method='get' id='form_filtro'");
				break;
			}
		}
		$this->filterbuilder->build();
		echo form_hidden('order_by', $this->input->get('order'));
		echo form_hidden('campo', $this->input->get('campo'));
		echo form_hidden('projecao', $this->input->get('projecao'));
		echo form_close();
	?>
</div>