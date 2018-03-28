<?php
class fCsv extends Field {
	var $caminho;
	var $exclusao;
	var $tipoArquivo;
	
	function fCsv($campo, $label="", $caminho = "", $tipoArquivo = "") {
		$this->tipo = 'fUpload';
		$this->campo = $campo;
		$this->tipoArquivo = $tipoArquivo;
		$this->caminho = $caminho;
		$this->valor = '';
		$this->label = $label;
		$this->exclusao = $exclusao;
        $this->maxlength = "50";
		$this->dbType = ' VARCHAR ';
	}
	
	function prePost() {
		if (isset($_POST['hdnUploadDel_'.$this->campo]) && $_POST['hdnUploadDel_'.$this->campo] != "") {
			$arquivo = $this->caminho.$_POST['hdnUpload_'.$this->campo];
			$_POST['hdnUpload_'.$this->campo] = "";
			if (file_exists($arquivo))
				unlink($arquivo);
		}
		
		if ((isset($_FILES[$this->campo]['name'])) && ($_FILES[$this->campo]['name'] != "")) {
			if (isset($_POST['hdnUpload_'.$this->campo]) && $_POST['hdnUpload_'.$this->campo] != "") {
				$arquivo = $this->caminho.$_POST['hdnUpload_'.$this->campo];
				$_POST['hdnUpload_'.$this->campo] = "";
				if (file_exists($arquivo))
					unlink($arquivo);
			}
			$tmpFileName = Utils::fileNameTest($_FILES[$this->campo]['name'],$this->caminho);
			$tmpNewFile = $this->caminho.$tmpFileName;
			move_uploaded_file($_FILES[$this->campo]['tmp_name'],$tmpNewFile);
			$this->valor = $tmpFileName;
			$_FILES[$this->campo]['name'] = $tmpFileName;
		} else {
			$this->valor = $_POST['hdnUpload_'.$this->campo];
		}
	}
	
	function formatForm() {
		if (isset($this->width))
			$width = ' style="width:'.$this->width.';" ';
		else
			$width = '';
			
		if ($this->tipoArquivo != "") {
			$tmpHtml = ' accept="'.$this->tipoArquivo.'" ';
		} else {
			$tmpHtml = '';
		}
		
		$s = '<input id="'.$this->campo.'" class="input_upload" name="'.$this->campo.'" type="file" '.$tmpHtml.' />';
		$tipo_arquivo = "O arquivo será removido";
		if ($this->valor != "") {
			$s .= '<div class="field_box" id="divUpload_'.$this->campo.'" style="padding:5px 0;">Arquivo existente:<br><a href="'.$this->caminho.$this->valor.'" class="field_link" target="_blank">'.Utils::showInicio($this->valor,30).'</a>
				<input type="hidden" name="hdnUpload_'.$this->campo.'" id="hdnUpload_'.$this->campo.'" value="'.$this->valor.'" />';
			$s .= '</div>';

		}		
		$s .= '<div id="divMsgUpload_'.$this->campo.'" style="display:none; padding:5px 0;"><span style="color:#FF0000;"><b>Removido</b></span><br />'.$tipo_arquivo.' quando os dados forem gravados.</div>';

		return $s;
	}

	function formatListagem() {
		return '<a href="'.$this->caminho.$this->valor.'" rel="external" title="Clique para visualizar o arquivo">'.$this->valor.'</a>';
	}
	function getCampo(){
		return $this->campo;
	}
}

?>