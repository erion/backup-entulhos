<?
class fMensagem extends Field {
	function fMensagem($mensagem) {
		$this->tipo = 'fMensagem';
		$this->campo = $this->tipo;
		$this->valor = $mensagem;
	}
	
	function formatForm() {
		$s = $this->valor;

		return $s;
	}

	function formatListagem() {
		return $this->valor;
	}
}

?>