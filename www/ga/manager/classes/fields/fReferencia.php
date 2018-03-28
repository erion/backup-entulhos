<?php
class fReferencia extends Field {
	var $tabela;
	var $campo_rotulo;
	var $referencia;
	
	function fReferencia($campo,$label,$tabela,$campo_rotulo,$obrigatorio=false,$visible=true) {
		$this->tipo = 'fReferencia';
		$this->campo = $campo;
		$this->valor = "";
		$this->tipoBusca = "=";
		$this->setObrigatorio($obrigatorio);
		$this->label = $label;
		$this->dbType = ' INT ';
		$this->visible = $visible;
		$this->tabela = $tabela;
		$this->campo_rotulo = $campo_rotulo;
	}
	
	function formatForm() {
		$this->capturarReferencia();
		
		if ($this->readonly == 1) {
			$readonly = ' readonly="readonly" ';
		} else {
			$readonly = "";
		}

		if (isset($this->width))
			$width = ' style="width:'.$this->width.';" ';
		else
			$width = '';
			
		$obrigatorio = $this->getObrigatorio();
		$validacao = $this->getValidacao();
		$label = $this->getLabel();
		
		$s = '<input class="input-text '.$obrigatorio.' '.$this->validacao.' " '.$width.' name="'.$this->campo.'__referencia" id="'.$this->campo.'__referencia" maxlength="'.$this->maxlength.'" value="'.$this->referencia.'" readonly="readonly" />';

		return $s;
	}
	
	function capturarReferencia() {
		if ($this->valor != "") {
			$db = new db();
			$query = "SELECT ".$this->campo_rotulo." FROM ".$this->tabela." WHERE ".$this->campo."='".$this->valor."'";
			$rs = $db->query($query);
			die($rs->fields);
			if (!$rs->EOF) {
				$this->referencia = $rs->fields($this->campo_rotulo);
			} else {
				$this->referencia = '';
			}
		} else {
			$this->referencia = '';
		}
		
		
	}

	function formatListagem() {
		$this->capturarReferencia();
		return $this->referencia;
	}
	function getCampo(){
		return $this->campo;
	}
}

?>