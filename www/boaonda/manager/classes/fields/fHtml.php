<?
class fHtml extends Field {
	function __construct( $valor = null, $label = null ) {
		$this->tipo = 'fHtml';
		$this->valor = $valor;
		$this->label = $label;
	}
	
	function formatForm() {
		return $this->valor;
	}

	function formatListagem() {
		return null;
	}
}
