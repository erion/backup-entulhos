<?php

class fLista extends Field {
	var $valores;
	var $valor;
	
	function fLista($label, $valores) {
		$this->tipo = 'fLista';
		$this->valores = $valores;
		$this->valor = "";
		$this->label = $label;
	}
	
	function formatForm() {
		
		$s = "";			
		if( !empty( $this->valores ) ) {
			
			$s.="<ol> \n ";
			foreach($this->valores as $id => $rotulo) {
				$s .= "<li>".$rotulo['quantidade']." - ".$rotulo['nome_resumo']."</li> \n ";
			}
			$s.="</ol> \n ";
		
		}
		
		
		return $s;
	}
	
}

?>