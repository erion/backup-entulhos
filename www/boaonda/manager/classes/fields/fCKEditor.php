<?
class fCKEditor extends Field {
	function fCKEditor( $campo, $label = null, $valor = null, $obrigatorio = true ) {
		$this->tipo = 'fCKEditor';
		$this->campo = $campo;
		$this->valor = $valor;
		$this->tipoBusca = "%";
		$this->label = $label;
		$this->dbType = ' TEXT ';
		$this->setObrigatorio( $obrigatorio );
	}
	
	function formatForm() {
	
		$obrigatorio = $this->getObrigatorio();
		$label = $this->label;
	
		$width = 'width:500px; height:200px';
		
		$s = '
		<textarea name="' . $this->campo . '" id="' . $this->campo . '" style="' . $width . '" >' . $this->valor . '</textarea>
		<script type="text/javascript">
			CKEDITOR.replace( "' . $this->campo . '", {
				filebrowserImageBrowseUrl : "' . MANAGER_URL . '/comum/js/plugins/ckfinder/ckfinder.html?Type=Images",
				filebrowserImageUploadUrl : "' . MANAGER_URL . '/comum/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images"
			} );
			campoCKEditor();
		</script>
		';
		
		return $s;
	}

	function formatListagem() {
		return '<div style="padding:10px;">'.$this->valor.'</div>';
	}
}

?>
