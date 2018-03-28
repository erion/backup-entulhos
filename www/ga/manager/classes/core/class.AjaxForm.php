<?php
class AjaxForm extends View {
	var $template;
	var $modulo;
	var $acao;
	var $cod;
	
	function AjaxForm($campos,$modulo,$acao,$cod="",$template="ajax-form") {

		$this->campos = $campos;
		$this->modulo = $modulo;
		$this->acao = $acao;
		$this->cod = $cod;
		$this->template = HTML_CLASSPATH.$template.".htm";
		$this->montaForm();
	}
	
	function montaForm(){
		$tpl = new TemplatePower($this->template);
		$tpl->prepare();
		$tpl->assign('modulo',$this->modulo);
		$tpl->assign('IMG_CLASSPATH',IMG_CLASSPATH);
		
		if($this->template != 'views/login_form.htm'){
			$tpl->assign('acao','salvar');
		}else{
			$tpl->assign('acao',$this->acao);
		}
		
		if(isset($_GET['id_tipo'])){
			$tpl->assign('id_tipo',$_GET['id_tipo']);
		}
		if(isset($_GET['cod'])){
			$tpl->assign('cod',$_GET['cod']);
		}
		//REFERENTE A MSG
		if (isset($_SESSION[LOGIN_MENSAGEM_CAMPO]) && $_SESSION[LOGIN_MENSAGEM_CAMPO] != '') {
			$tpl->assign('msg',$_SESSION[LOGIN_MENSAGEM_CAMPO]);
			$_SESSION[LOGIN_MENSAGEM_CAMPO] = '';
		}
		
		foreach ($this->campos as $obj) {
			if($obj->visible){
				$tpl->newBlock('CAMPOS');
				$tpl->assign('campo',$obj->label);
				$tpl->assign('input',$obj->formatForm());
			}
		}
		
		$tpl->goToBlock('_ROOT');
		//TESTAR SE VEIO O COD PELA URL
		if ($this->cod != "") {
			$tpl->newBlock('BT-DELETAR');
			$tpl->assign('par_deletar',"index.php?modulo=".$this->modulo."&acao=excluir&cod=".$_GET['cod']);
			$tpl->goToBlock('_ROOT');
		}
		//REFERENTE AO BOTÃO CANCELAR
		if ($this->template != 'views/login_form.htm'){
			//$tpl->assign('par_voltar',"index.php?modulo=".$this->modulo."&acao=listagem");
			$tpl->assign('par_voltar',"javascript:void(0);");
		}
		$this->html = $tpl->getOutputContent();
	}
}
?>