<?php
include_once('./classes/core/class.Application.php');

/*
fMicroModulo
*/

if( $_POST['action'] == 'deleteMicroModulo' ) {
	
	parse_str($_POST['valor'], $params);
	$classe = $_POST['classe'];
	$_POST['deletar'] = $params['deletar'];
	$acao 	= 'delete';
	
	if( $params ) {
		$objeto = new $classe();
		$retorno = $objeto->$acao();
		echo 'sucesso';
	} 
	
	die;
}

if ( isset( $_GET[ 'field' ] ) && $_GET[ 'field' ] == 'fMicroModulo' ) {
	if ( !isset( $_GET['classe'] ) )
		die;

	$cod = $_GET[ isset( $_GET[ 'valor' ] ) ? $_GET[ 'valor' ] : "cod" ];
	$classe = $_GET[ 'classe' ];
	if( $_GET['acaoSubmit'] == 'adicionar' ) { 
		$cod = 0; // para não preencher o formulário
	}
	$objeto = new $classe( $cod );

	if ( isset( $_GET[ 'acao' ] ) ) {
		$acao = $_GET[ 'acao' ];

		$view = $objeto->$acao();

		exit( $view->html );
	}
}


/*
fComboAdd
*/
if (isset($_GET['field']) && $_GET['field'] == 'fComboAdd') {
	$objeto = $_GET["objeto"];
	$campo  = $_GET["campo"];
	$acao   = $_GET["acao"];
	$item   = $_GET["item"];
	$valor  = $_GET["valor"];
	
	$o = new $objeto();
	$form = $o->cadastro();
	
	$arrOut = "";
	
	$tabela = "";
	$campo_label = "";
	
	foreach($form->campos as $field) {
		if ($field->campo == $campo) {
			$tabela = $field->tabela;
			$campo_label  = $field->campo_label;
		}
	}
	
	$campos = array();
	
	$db = new db();
	
	if ($acao == "add") {
		$campos[$campo_label] = $valor;
		$cmdSQL = $db->db->GetInsertSQL($tabela, $campos);
	} else if ($acao == "edit") {
		$campos[$campo_label] = $valor;
		$cmdSQL = "select * from ".$tabela." where ".$campo."='".$item."'";
		$rsQ = $db->query($cmdSQL);
		$cmdSQL = $db->db->GetUpdateSQL($rsQ, $campos);
	} else if ($acao == "delete") {
		$cmdSQL = "delete from ".$tabela. " where ".$campo."=".$item;
	}
	
	if ($cmdSQL != "") {
		$db->command($cmdSQL);
	}
	
	$o = new $objeto();
	$form = $o->cadastro();
	
	foreach($form->campos as $field) {
		if ($field->campo == $campo) {
			$arrOut = $field;
		}
	}
	
	if ($valor != "") {
		$vQuery = "SELECT ".$campo." FROM ".$tabela." WHERE ".$campo_label."='".$valor."'";
		$rs = $db->query($vQuery);
		$valor = $rs->fields($campo);
	} else if ($item != "") {
		$valor = $item;
	}
	
	$arrOut->valor = $valor;
	$arrOut->ajax = 'ééééé';
	
	echo $arrOut->formatForm();
}
?>
