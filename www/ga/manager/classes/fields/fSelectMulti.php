<?php
class fSelectMulti extends Field {
	
	function fSelectMulti($campo, $label, $valores) {
		$this->tipo = 'fSelectMulti';
		$this->campo = $campo;
		$this->label = $label;
		$this->valores = $valores;
		$this->visible = true;
		$this->valor = array();
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
			
		$s = '<select name="'.$this->campo.'[]" size="5" multiple="multiple">';	
		foreach($this->valores as $id => $rotulo) {
			if (in_array($id,$this->valor)) {
				$selected = ' selected="selected" ';
			} else {
				$selected = '';
			}
			$s.= '<option '.$selected.' value="'.$id.'"> '.$rotulo.'</option>';
		}
		$s.= '</select>';	
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