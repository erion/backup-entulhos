<?php

class fListaSimples extends Field {
	var $valores;
	var $exibirSelecione;
	var $valor;
	
	function fListaSimples($campo, $label, $valores = array(),$exibirSelecione=true) {
		$this->tipo = 'fListaSimples';
		$this->campo = $campo;
		$this->valores = $valores;
		$this->exibirSelecione = $exibirSelecione;
		$this->valor = "";
		$this->dbType = ' INT ';
		$this->label = $label;
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
	
		if ($readonly == "") {
			
			$s = '<select style="'.$width.'" name="'.$this->campo.'" class="input_select" id="'.$this->campo.'" '.$readonly.'>';
			if ($this->exibirSelecione) {
				$s .= '<option value="">Selecione</option>';
			}
			
			if (!empty($this->valores)) {
				foreach( $this->valores as $id => $rotulo ) {
					
					if( is_array( $rotulo ) ) {
					
						$s.='<optgroup label="'.$id.'">';
						
						foreach( $rotulo as $k=>$subcategoria ) {
							
							if ($this->valor == $k)
								$selected = 'selected';
							else
								$selected = '';
							
							$s .= '<option '.$selected.' value="'.$k.'">'.$subcategoria.'</option>';
						}
						
						$s.='</option>';
						
					} else {
					//deb($this->valor);
						if ($this->valor == $id)
							$selected = 'selected';
						else
							$selected = '';
							
						$s .= '<option '.$selected.' value="'.$id.'">'.$rotulo.'</option>';
					}
					
					
					
				}
			}
			
			$s .='</select>';
		} else {
			$s = '<input type="hidden" name="'.$this->campo.'" value="'.$this->valor.'" id="'.$this->campo.'" />';
			$s .= '<input class="input_text" style="'.$width.'" name="'.$this->campo.'_label" id="'.$this->campo.'_label" value="'.$this->valores[$this->valor].'" '.$readonly.' />';
		}
				
		return $s;
	}

	function formatListagem() {
		$valor = '';
		if ($this->valores) {
			if(!$this->valores[$this->valor]) {
				foreach( $this->valores as $valores ) {
					if( $valores[$this->valor] ) 
						$valor = $valores[$this->valor];
				}
			} else {
				$valor = $this->valores[$this->valor];
			}
				
		}
		return $valor;
	}
	
	function getCampo(){
		return $this->campo;
	}
	
}

?>