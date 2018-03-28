z<?php

class fLink extends Field {
	var $href;
	var $title;
	var $descricao;
	var $externo;
	
	function fLink($label, $href, $title='', $descricao, $attr=array()) {
		$this->tipo = 'fLink';
		$this->hrefModelo = $href;
		$this->title = $title;
		$this->descricao = $descricao;
		$this->attr = $attr;
		$this->label = $label;
		$this->valor = "";
	}
	
	function recebeValor($cod) {
		$this->valor = $cod;
		
	}
	
	function formatListagem() {
		$h = '';
		if($this->attr) {
			foreach( $this->attr as $id => $value  ) {
				$h.= $id. '="'.$value.'"'; 				
			}
		}

		$this->href = str_replace("{1}", $this->valor, $this->hrefModelo);
		
		$s = '<a href="'.$this->href.'" title="'.$this->title.'" '.$h.'>'.$this->descricao.'</a>';	

		return $s;
		
	}
	
	function formatForm() {		
		$h = '';
		if($this->attr) {
			foreach( $this->attr as $id => $value  ) {
				$h.= $id. '="'.$value.'"'; 				
			}
		}

		$this->href = str_replace("{1}", $this->valor, $this->hrefModelo);
		
		$s = '<a href="'.$this->href.'" title="'.$this->title.'" '.$h.'>'.$this->descricao.'</a>';	

		return $s;
	}
	
}
