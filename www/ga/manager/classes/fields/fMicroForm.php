<?php
class fMicroForm extends Field {
	var $form;
	var $titulo;
	
	function fMicroForm($campo, $form) {
		$this->tipo = 'fMicroForm';
		$this->campo = $campo;
		$this->valor = "";
		$this->tipoBusca = "%";
		$this->form = $form;
		
		if (isset($form->config['titulo'])) {
			$this->titulo = $form->config['titulo'];
		} else {
			$this->titulo = "";
		}
	}
	
	function formatForm() {
		return '<div id="_'.$this->campo.'">'.$this->formatMicroForm().'</div>';
	}
	
	function formatMicroForm() {
		return '<fieldset style="width: 450px;" id="fMicroForm_'.$this->campo.'"><legend>aaa'.$this->titulo.'</legend>'.$this->form->html.'</fieldset>';
	}

	function formatListagem() {
		return $this->valor;
	}
}

?>