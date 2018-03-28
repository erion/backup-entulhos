<?php
class fMultiSelect extends Field {
	var $valores;
	var $exibirSelecione;
	var $valor;
	
	function fMultiSelect($campo, $label, $valores, $valor=array()) {
		$this->tipo = 'fMultiSelect';
		$this->campo = $campo;
		$this->label = $label;
		$this->valores = $valores;
		$this->visible = true;
		$this->valor = $valor;
		$this->dbType = '';
	}
	
	function formatForm() {
		if ($this->readonly == 1) {
			$readonly = ' readonly="readonly" ';
		} else {
			$readonly = "";
		}

		if (isset($this->width))
			$width = "width:".$this->width.";";
		else
			$width = "";
			
		$s = '';	
		foreach($this->valores as $id => $rotulo) {
			if (in_array($id,$this->valor)) {
				$checked = ' checked="checked" ';
			} else {
				$checked = '';
			}
			$s .= '<label><input type="checkbox" '.$checked.' name="'.$this->campo.'[]" id="'.$this->campo.'" value="'.$id.'"> '.$rotulo.'<br></label>';
		}
				
		return $s;
	}

	function formatListagem() {
		$html = "<ul>";
		if (is_array($this->valor)) {
			foreach ($this->valor as $id) {
				$html .= "<li>".$this->valores[$id]."</li>";
			}
		}
		$html .= '</ul>';
		
		return $html;
	}
}

?>