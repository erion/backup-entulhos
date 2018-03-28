<?php
class fData extends Field {
	var $hasHora;
	var $readonly;
	
	function fData($campo, $label="", $obrigatorio=true, $hasHora=false, $visible=true, $hidden = false, $readonly = false ) {
		$this->tipo = 'fData';
		$this->campo = $campo;
		$this->hasHora =  $hasHora;
		$this->valor = "";
		$this->readonly = $readonly;
		$this->setObrigatorio($obrigatorio);
                if ($hasHora) {
                    $this->dbType = ' DATETIME ';
                } else {
                    $this->dbType = ' DATE ';
                }
		$this->label = $label;
		$this->visible = $visible;
		$this->hiddenData = $hidden;
	}
	
	function formatForm() {
		$obrigatorio = $this->getObrigatorio();
		$validacao = $this->getValidacao();
		$label = $this->getLabel();

		if ( $this->hasHora )
			$valor = ($this->valor) ? Utils::formatDateTime($this->valor) : date( "d/m/Y H:i:s" );
		else
			$valor = ($this->valor) ? Utils::formatDateTime($this->valor) : date( "d/m/Y" );

		if ( !$this->hiddenData ) {
			if ( $this->readonly ) {
				$s = '<input type="hidden" class="'.$obrigatorio.'" name="'.$this->campo.'" id="'.$this->campo.'" value="' . $valor . '" />';
				$s .= $valor;
				
			} else {
				$s = '<input type="text" class="date-pick '.$obrigatorio.'" name="'.$this->campo.'" id="'.$this->campo.'" value="' . $valor . '" '.$validacao.' '.$label.'>';
			}
		} else {
			$s = '<input type="hidden" name="'.$this->campo.'" id="'.$this->campo.'" value="' . $valor . '" />';
		}
		
		return $s;
	}
	
	function prePost() {
		$this->valor = Utils::strToDbDate($this->valor);
	}

	function formatListagem() {
		return Utils::formatDateTime($this->valor);
	}
	function getCampo(){
		return $this->campo;
	}
}

?>
