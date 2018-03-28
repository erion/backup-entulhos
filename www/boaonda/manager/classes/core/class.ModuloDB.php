<?php
class ModuloDB extends db {
	var $db;
	var $tabela;
	var $modulo;
	var $tituloModulo;
	var $chave;
	var $totalRegistrosListagem = NRO_REGISTROS_PAGINACAO;
	var $SQL_ORDER="";
	var $SQL_BUSCA;
	var $acaoPadrao = "listagem";
	var $visible = true;
	var $campoOrdem;
	var $MenuAcoes = array();
	var $cod = '';

	function ModuloDB($cod="") {
		$this->modulo = get_class($this);
		$this->verificarTabela();
		$this->DefineMenuAcoes( 'C' );
		$this->configDb($cod);
	}
	//MÉTODO PARA A BUSCA DA PESQUISA
	function getBusca($post="") {
		if ($post == "") {
			$post = $_POST;
		}

		$SQL_BUSCA = ' WHERE 1=1 ';

		$mod = $this->modulo;
		$mod = new $mod();
		$campos_pesquisa = $mod->getFiltro();
		if (count($campos_pesquisa) == 0) {
			$view = $mod->cadastro();
			$campos_pesquisa = $view->campos;
		}

		foreach ($campos_pesquisa as $campo => $obj){
			if (isset($post[$obj->campo]) && $post[$obj->campo] != '' && isset($post['chk_'.$obj->campo]) && $post['chk_'.$obj->campo] != "") {
				if ($obj->tipoBusca == '=') {
					$SQL_BUSCA .= " and ".$obj->campo." = '".$post[$obj->campo]."' ";
				} else if ($obj->tipoBusca == '%') {
					$SQL_BUSCA .= " and ".$obj->campo." like '%".$post[$obj->campo]."%' ";
				}
			}
		}

		return $SQL_BUSCA;
	}

	//MÉTODO PARA CRIAÇÃO DAS PÁGINAS DE LISTAGEM
	function listagem() {
		$SQL_BUSCA = $this->getBusca();

		$query = "SELECT * FROM ".$this->tabela." ".$SQL_BUSCA." ";
		$campos = $this->getTableDefinition();

		if (isset($_GET['method']) && $_GET['method'] == 'ajax') {
			$view = new AjaxListagem($campos,$this->modulo,$query);
		} else {
			$view = new Listagem($campos,$this->modulo,$query);
		}

		return $view;
	}

	function listagemOrdenacao() {
		$SQL_BUSCA = $this->getBusca();

		$query = " SELECT ".$this->tabela.".* FROM ".$this->tabela." ".$SQL_BUSCA." ";
		$campos = $this->getTableDefinition();
		$view = new Listagem($campos,$this->modulo,$query,"delete","ordered-list");

		return $view;
	}

	function ordenar() {
		$html = '';

		if (isset($_POST['ordem']) && $_POST['ordem'] != '') {
			$dados = explode(",",$_POST['ordem']);
			$ordem = 0;

			$db = new db();

			while ($ordem < count($dados)) {
				$query = "UPDATE ".$this->tabela." SET ".$this->campoOrdem."=".$ordem." WHERE ".$this->chave."=".$dados[$ordem];
				$db->query($query);
				$ordem++;
			}

		}
		die();
	}

	function getMenu() {
		$menu = array();
		$menu['listagem'] = "Listagem";
		$menu['editar'] = "Editar";
		$menu['cadastro'] = "Cadastro";
		$menu['excluir'] = "Excluir";

		return $menu;
	}

	function DefineMenuAcoes( $acoes = 'C' ) {
		$menu = array();

		if ( stripos( $acoes, 'C' ) !== false )
			$menu[] = array('acao'=>'cadastro','titulo'=>'Novo Registro','css'=>'novo-registro');

		if ( stripos( $acoes, 'E' ) !== false )
			$menu[] = array('acao'=>'Exportar','titulo'=>'Exportar','css'=>'exportar'); 

		$this->MenuAcoes = $menu;
	}

	function getMenuAcoes() {
		return $this->MenuAcoes;
	}

	function getAcaoPadrao() {
		return $this->acaoPadrao;
	}

	//MÉTODO PARA CRIAÇÃO DAS PÁGINAS DE FORMULÁRIO
	function cadastro($cod="") {
		if(!$cod){
			//$cod = isset( $_GET['cod'] ) ? $_GET['cod'] : $_GET[ $_GET[ 'valor' ] ] ;
			$cod = ($this->campos[$this->chave]) ? $this->campos[$this->chave] : 0;
		}
		
		$campos = $this->getTableDefinition();

		$campos = $this->fillFields($campos, $cod);

		$acao = __METHOD__;

		if (isset($_GET['method']) && $_GET['method'] == 'ajax') {
			$view = new AjaxForm($campos,$this->modulo,$acao);
		} else {
			$view = new Form($campos,$this->modulo,$acao,"","form",$this->tituloModulo);
		}
		
		return $view;
		
	}

	function fillFields($campos, $cod) {
		$obj = new db();
		$obj->tabela = $this->tabela;
		$obj->chave = $this->chave;
		$obj->configDb($cod);

		foreach ($obj->campos as $dbField => $dbValue) {
			foreach ($campos as $indice => $formObject) {
				$formField = $formObject->campo;
				if ($dbField == $formField) {
					if(isset($_GET['method']) && $_GET['method'] == 'ajax') {
						$campos[$indice]->valor = utf8_encode($dbValue);
					} else {
						$campos[$indice]->valor = $dbValue;
					}
				}
			}
		}

		foreach ($campos as $indice => $formObject) {
			if ($formObject->capturarValor) {
				$campos[$indice]->capturarValor($cod);
			}
		}

		return $campos;
	}

	function preDetele( $arr = NULL ) {  } // faz nada

	//MÉTODO PARA EXCLUIR REGISTROS NA LISTAGEM
	function delete() {
		if (isset($_POST['deletar'])) {
			$arr = $_POST['deletar'];
			$this->preDetele( $arr );
			for ($x=0; $x < sizeof($arr); $x++) {
				$db = new db();
				$db->query("DELETE FROM ".$this->tabela." WHERE ".$this->chave." = ".$arr[$x]);
			}
		}

		if (isset($_REQUEST['method']) && $_REQUEST['method'] == 'ajax') {
			die('true');
		} else {

			$flash = new FlashMessage();
			$flash->setFlash('retorno-titulo', TITULO_DEL_REGISTRO);
			$flash->setFlash('retorno-mensagem', MSG_DEL_REGISTRO);

			return "index.php?modulo=".$this->modulo."&acao=".$this->getAcaoPadrao();
		}
	}

	//MÉTODO PARA EXCLUIR REGISTRO
	function excluir() {
		if(isset($_GET['cod']) && $_GET['cod'] != '' && isset($_GET['modulo']) && $_GET['modulo'] != '' && isset($_GET['acao']) && $_GET['acao'] == 'excluir'){
			$mod = $this->modulo;
			$obj = new $mod($_GET['cod']);
			$form = $obj->cadastro();

			foreach ($form->campos as $field) {
				$field->preDelete($obj);
			}

			$obj->_delete();
		}

		$flash = new FlashMessage();
		$flash->setFlash('retorno-titulo', TITULO_DEL_REGISTRO);
		$flash->setFlash('retorno-mensagem', MSG_DEL_REGISTRO);

		return "index.php?modulo=".$this->modulo."&acao=".$this->getAcaoPadrao();
	}

	//MÉTODO PARA SALVAR DADOS DO FORM NO BANCO
	function salvar() {
		$db = new db();

		if (isset($_GET['cod']) && $_GET['cod'] != ''){
			$cod = $_GET['cod'];
		} else {
			$cod = "";
		}

		$mod = $this->modulo;
		$registro = new $mod($cod);

		$frm = $registro->cadastro($cod);
		$frmCampos = $frm->campos;

		if(method_exists($registro, 'prePost')) {
			$registro->prePost();
		}

		foreach ($frmCampos as $indice => $field) {
			if (is_object($field) && isset($field->tipo) && ($field->visible || $field->tipo != 'fId')) {
				if (isset($_POST[$field->campo])) {
					$field->valor = $_POST[$field->campo];
				} else if (isset($_GET[$field->campo])) {
					$field->valor = $_GET[$field->campo];
				}
				$field->prePost();
				$frmCampos[$indice] = $field;
				if (array_key_exists($field->campo, $registro->campos)) {
					$registro->campos[$field->campo] = $field->valor;
				}
			}
		}

		if ($cod == "") {
			$cod = $registro->_insert();
			$action_type = "insert";
		} else {
			$registro->_update($registro->chave."=".$cod);
			$action_type = "update";
		}

		foreach ($frmCampos as $indice => $field) {
			if (is_object($field) && isset($field->tipo) && $field->visible) {
				$field->doPost($cod, $registro->modulo);
			}
		}

		$registro->posPost($cod,$action_type);

		$flash = new FlashMessage();
		if(!$flash->hasFlash('retorno-titulo')) {
			$flash->setFlash('retorno-titulo', TITULO_NOVO_REGISTRO);		
			$flash->setFlash('retorno-mensagem', MSG_NOVO_REGISTRO);
		}		

		if( $_POST['bt-salvar-continuar_x'] ) {
			return "index.php?modulo=".$this->modulo."&acao=cadastro&cod=".$cod;
		}else{
			return "index.php?modulo=".$this->modulo."&acao=".$this->getAcaoPadrao();
		}
	}

	function posPost($cod) { }

	function getFiltro() {
		$campos = array();
		return $campos;
	}

	function getTableDefinition() {
		$campos = array();
		return $campos;
	}

	function updateField() {
		$field = $_GET['field'];
		$cod = $_GET['cod'];
		$value = $_GET['value'];

		$o = new $this->modulo($cod);
		$o->campos[$field] = $value;
		$o->_update($this->chave."=".$cod);

		die($value);
	}

	function verificarTabela() {
		if ($GLOBALS['VERIFICAR_TABELAS'] === true) {
			if ($this->tabela != "") {
				$db = new db();
				$erro = false;

				$query = "SELECT COUNT(*) AS total FROM ".$this->tabela;
				$db->db->execute($query) or $erro = true;

				if ($erro) {
					$this->criarTabela();
				}
			}

			$this->verificarRegistroModulo();
		}
	}

	function criarTabela() {
		$db = new db();
		$fields = $this->getTableDefinition();

		$campos = '';

		foreach ($fields as $valor) {
			if ($valor->getSQL() != "") {
				if ($campos != "") { $campos .= ","; }
				$campos .= $valor->getSQL();
			}
		}

		$query = "CREATE TABLE IF NOT EXISTS ".$this->tabela." (".$campos.")";
		$db->query($query);
	}

	function verificarRegistroModulo() {
		$db = new db();
		$tmpVerificarTabelas = $GLOBALS['VERIFICAR_TABELAS'];
		$GLOBALS['VERIFICAR_TABELAS'] = false;

		$modulo = new Modulo();

		$GLOBALS['VERIFICAR_TABELAS'] = $tmpVerificarTabelas;

		$query = "SELECT * FROM ".$modulo->tabela." WHERE classe='".$this->modulo."'";
		$rs = $db->query($query);

		if (is_object($rs) && $rs->EOF) {
			$tituloCategoria = $this->getNomeSecao();
			$codcategoria = Modulo::capturarCategoriaPorTitulo($tituloCategoria,true);

			$modulo->campos['classe'] = $this->modulo;
			$modulo->campos['titulo'] = $this->tituloModulo;
			$modulo->campos['codcategoria'] = $codcategoria;
			$modulo->campos['ordem'] = Modulo::proximoNumero($codcategoria);
			$codmodulo = $modulo->_insert();
		}
	}

	function getNomeSecao() {
		$arquivo = "class.".$this->modulo.".php";

		if (file_exists(SYSTEM_CLASSPATH.$arquivo)) {
			return SECAO_SYSTEM;
		} else {
			return SECAO_CLIENT;
		}
	}

	function Exportar() {
		$colecaoFiltro = $_SESSION[ 'filtro_' . $_GET[ 'modulo' ] ];

		foreach ( $colecaoFiltro as $filtro => $valor ) {
			if ( $colecaoFiltro[ 'chk_' . $filtro ] )
				$where .= ' AND ' . $filtro . ' like "%' . $valor . '%"';
		}
		$where = ' WHERE 1 = 1' . $where;

		$sql = 'SELECT * FROM ' . $this->tabela . $where . ';';
		$Ex = new Exportar( $sql, $_GET[ 'modulo' ] . '_' . date( 'd-m-Y_H-i-s' ) );
	}


}
