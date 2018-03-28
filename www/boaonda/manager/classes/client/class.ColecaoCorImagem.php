<?php
class ColecaoCorImagem extends ModuloDB {
	
	public function ColecaoCorImagem( $cod = '' ) {
	
		$this->tabela = "site_colecao_cor_imagem";
		$this->tituloModulo = 'MCOLEÇÃO';
		$this->chave = 'ColecaoCorImagemID';
		
		$this->ModuloDB();
		//$this->visible = false;
		
		if ( $cod ) 
			$this->configDb($cod);
	}
	
	function getMenuAcoes() {
		return array(
			array('acao'=>'listagem','titulo'=>'Listagem','css'=>'novo-registro'),
			array('acao'=>'cadastro','titulo'=>'Novo Registro','css'=>'novo-registro')
		);
	}	
	
	function getCampos($camposRequisitados = array('ColecaoCorImagemID', 'ColecaoID', 'ColecaoCorID', 'ColecaoGaleriaID', 'Ativo')) {
	
		if (in_array('ColecaoCorImagemID', $camposRequisitados)) 
			$campos[] 		= new fId('ColecaoCorImagemID',true);
			
		if (in_array('ColecaoID', $camposRequisitados))
			$campos[] 		= new fInt('ColecaoID','ColecaoID');
		
		if (in_array('ColecaoCorID', $camposRequisitados))
			$campos[]		= new fComboAdd('ColecaoCorID','Cor','Nome','site_colecao_cor','ColecaoCor','Selecione','',false,false,false);

		if (in_array('ColecaoGaleriaID', $camposRequisitados))
			$campos[] 		= new fImagemUpload('Imagem', 'Imagem:', '../uploads/imagens/');
			
		if (in_array('Ativo', $camposRequisitados)) 
			$campos[]		= new fSimNao('Ativo', 'Publicado');
		
		return $campos;
	
	}
	
	
	function listagem(){
		$query = "SELECT * FROM ".$this->tabela;
		
		if (isset($_GET['ColecaoID']) && is_numeric($_GET['ColecaoID'])) {
			$query .= " WHERE ColecaoID=".$_GET['ColecaoID'];	
		}
	
		$campos = $this->getCampos( array('ColecaoCorID','ColecaoGaleriaID','Ativo') );	

		$view = new AjaxListagem($campos,$this->modulo,$query, 'delete', 'ajax-list');
		
		return $view;
	}

	function getTableDefinition() {
		return $this->getCampos();
	}
	
}