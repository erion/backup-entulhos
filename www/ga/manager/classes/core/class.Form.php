<?php
class Form extends View {
	
	var $template;
	var $modulo;
	var $acao;
	var $cod;
	
	function Form($campos,$modulo,$acao,$cod="",$template="form",$tituloModulo='') {
		if ($cod == "" && isset($_GET['cod']) && $_GET['cod'] != "") {
			$cod = $_GET['cod'];
		}
		
		$this->campos = $campos;
		$this->modulo = $modulo;
		$this->acao = $acao;
		$this->cod = $cod;
		$this->tituloModulo = $tituloModulo;
		$this->template = HTML_CLASSPATH.$template.".htm";
		$this->montaForm();
	}
	
	function montaForm(){
		$tpl = new TemplatePower($this->template);
		$tpl->prepare();
		
		$tpl->assign('IMG_CLASSPATH',IMG_CLASSPATH);
		$tpl->assign('modulo',$this->modulo);
		$tpl->assign('tituloModulo',$this->tituloModulo);
		
		if ($this->template != HTML_CLASSPATH.'login_form.htm') {
			$tpl->assign('acao','salvar');
		} else {
			$tpl->assign('acao',$this->acao);
		}
		
		if (isset($_GET['id_tipo'])) {
			$tpl->assign('id_tipo',$_GET['id_tipo']);
		}
		
		if ($this->cod != "") {
			$tpl->assign('cod',$this->cod);
		}
		
		if (isset($_SESSION[LOGIN_MENSAGEM_CAMPO]) && $_SESSION[LOGIN_MENSAGEM_CAMPO] != '') {
			$tpl->assign('msg',$_SESSION[LOGIN_MENSAGEM_CAMPO]);
			$_SESSION[LOGIN_MENSAGEM_CAMPO] = '';
		}
		
		foreach ($this->campos as $obj) {
			if ($obj->visible) {
				$tpl->newBlock('CAMPOS');
				$tpl->assign('campo',$obj->label . $str);
				$tpl->assign('input',$obj->formatForm());
				
				if( $obj->obrigatorio )
					$tpl->assign('obrigatorio','*');
			}

			if ($obj->hiddenData) {
				$tpl->newBlock('CAMPOS');
				$tpl->assign('input',$obj->formatForm());
			}
		}
		
		$tpl->goToBlock('_ROOT');
		
		
		$obj = new $this->modulo;
		
		//TESTAR SE VEIO O COD PELA URL
		if (isset($_GET['cod']) && $_GET['cod'] != '' && array_keys( $obj->getMenuAcoes(), 'cadastro' ) ) {
			$tpl->newBlock('BT-DELETAR');
			$tpl->assign('IMG_CLASSPATH',IMG_CLASSPATH);
			$tpl->assign('par_deletar',"index.php?modulo=".$this->modulo."&acao=excluir&cod=".$_GET['cod']);
			$tpl->goToBlock('_ROOT');
		}
			
		//REFERENTE AO BOTÃO CANCELAR
		if ($this->template != HTML_CLASSPATH.'login_form.htm') {
			$tpl->assign('par_voltar',"index.php?modulo=".$this->modulo."&acao=".$obj->acaoPadrao);
		}
		
		$this->html = $tpl->getOutputContent();
	}
}
?>
