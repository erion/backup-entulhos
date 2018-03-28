<?php

class Field {
	var $campo;
	var $width;
	var $tipo;
	var $valor;
	var $tipoBusca="=";
	var $readonly;
	var $validacao;
	var $obrigatorio;
	var $label;
	var $mascara;
    var $maxlength;
	var $dbType;
	var $visible = true;
	var $capturarValor = false;
	
	function Field(){
		$this->dbType = ' VARCHAR ';
	}
	function setWidth($width) {
		$this->width = $width;
		$this->tipoBusca = '';
	}

	function setValor($valor) {
		$this->valor = $valor;
	}
	
	function setObrigatorio($flag=true) {
		$this->obrigatorio = $flag;
	}

	function setValidacao($tipo) {
		$this->validacao = $tipo;
	}

	function setLabel($label) {
		$this->label = $label;
	}

	function setMask($mask) {
		$this->mascara = $mask;
	}

	function getObrigatorio() {
		if ($this->obrigatorio) {
			return ' required ';
		} else {
			return '';
		}
	}

	function getValidacao() {
		if ($this->validacao != "") {
			return ' validacao="'.$this->validacao.'" ';
		} else {
			return '';
		}
	}

	function getLabel() {
		if ($this->label != '') {
			return ' label="'.$this->label.'" ';
		} else {
			return '';
		}
	}

	function preDelete() {
		// faz nada..
	}

	function prePost() {
		// faz nada..
	}

	function doPost() {
		// faz nada..
	}

	function getDbType(){
		if($this->dbType == ' VARCHAR ' || $this->dbType == ' CHAR '){
			return " ".$this->dbType."(".$this->maxlength.") ";
		}else if($this->dbType == ' PRIMARY '){
			return " INT AUTO_INCREMENT PRIMARY KEY ";
		}else if ($this->dbType == '') {
			return '';
		} else {
			return " ".$this->dbType." ";
		}
	}

	function setFiltro() {
		// faz nada...
	}
	
	function getSQL(){
		$obrigatorio = '';
		
		if ($this->obrigatorio){
			$obrigatorio = ' NOT NULL ';
		}
		
		$sql = '';
		
		if ($this->getDbType() != '') {
			$sql = " ".$this->campo." ".$this->getDbType().$obrigatorio." ";
		}
		
		return $sql;
	}
	
	function capturarValor($cod="") {
		// faz nada...
	}
}


?>
