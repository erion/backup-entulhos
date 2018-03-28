<?php
//fListaSimples aceita somente int, fCombo dbType é parâmetro

class fCombo extends Field {
	var $campo_label;
	var $txtSelecione;
	var $dados;
	
	function fCombo($campo, $label, $dados, $tipo, $texto_selecione = "Selecione", $obrigatorio = true) {
		$this->tipo = 'fCombo';
		$this->campo = $campo;
		$this->valor = "";
		$this->label = $label;
		$this->dados = $dados;
		$this->campo_label = $campo_label;
		$this->txtSelecione = $texto_selecione;
		$this->dbType = $tipo;
		$this->setObrigatorio( $obrigatorio );
	}
	
	function formatForm() {
		
		$s = '<div id="divContainer_'.$this->campo.'" style="margin-bottom:8px;">';
		$s .= '<div id="div_'.$this->campo.'" style="margin-bottom:8px;">';
		$s .= '<select class="input_select" name="'.$this->campo.'" id="'.$this->campo.'" >';
		$s .= '<option value="'.$this->campo.'_0" style="background-color:#FFF3B3;" >'.$this->txtSelecione.'</option>';

		foreach($this->dados as $k => $v)
		{
			if ($this->valor == $k) {
				$sel = "selected";
				$tmpValorInicialCod = $this->valor;
				$tmpValorInicialLabel = $v;
			} else {
				$sel = "";
			}
			$s .= '<option '.$sel.' value="'.$k.'" >'.$v.'</option>';
		}
		
		$s .= '</select>';
		$s .= '</div>';
		$s .= '</div>';

		return $s;
	}

	function formatListagem() {		
		return $this->valor;
	}
	
	function prePost() {
		if (($this->valor == $this->campo."_0") || ($this->valor == $this->campo."_novo")) {
			$this->valor = 0;
		}
	}
	
}

?>
