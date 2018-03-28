<?php

class SincronizarRepresentantes extends ModuloDB {
	
	public function __construct( $cod = '' ) {

		$this->tabela = 'site_sincronizacao';
		$this->tituloModulo = 'SINCRONIZAR REPRESENTANTES';
		$this->chave = 'SincronizacaoID';
		$this->acaoPadrao = 'Cadastro';
		
		$this->arquivo;
		
		$this->iconeMensagem = 'icone-sucesso.png';
		$this->totalInsert = 0;
		$this->totalUpdate = 0;
		
		$this->ModuloDB();
		
		if ( $cod ) 
			$this->configDb($cod);
			
	}
	
	function getCampos($camposRequisitados = array('SincronizacaoID', 'Arquivo', 'Data')) {
	
		$html = '<span class="ajuda">Utilize somente arquivos "csv"</span>' . PHP_EOL;
		$html .= '<script>' . PHP_EOL;
		$html .= 	'$( function () {' . PHP_EOL;
		$html .= 		'$( "form" ).submit( function () {' . PHP_EOL;
		$html .= 			'if ( $( "#Arquivo" ).val().length > 0 ) {' . PHP_EOL;
		$html .= 				'var arquivo = $( "#Arquivo" ).val().split( "." );' . PHP_EOL;
		$html .= 				'if ( arquivo[ arquivo.length - 1 ] == "csv" )' . PHP_EOL;
		$html .= 					'return true;' . PHP_EOL;
		$html .= 				'else {' . PHP_EOL;
		$html .= 					'msgRetorno( "Arquivo", \'O arquivo deve ser "csv"!\', "comum/img/glitter/icone-alerta.png");' . PHP_EOL;
		$html .= 					'return false;' . PHP_EOL;
		$html .= 				'}' . PHP_EOL;
		$html .= 			'} else {' . PHP_EOL;
		$html .= 				'msgRetorno( "Arquivo", \'Selecione um arquivo!\', "comum/img/glitter/icone-alerta.png");' . PHP_EOL;
		$html .= 				'return false;' . PHP_EOL;
		$html .= 			'}' . PHP_EOL;
		$html .= 		'} );' . PHP_EOL;
		$html .= 		'$( ".maisDetalhes" ).click( function () { ' . PHP_EOL;
		$html .= 			'$( this ).parent( ".boxMensagem" ).children( ".lista" ).slideToggle();' . PHP_EOL;
		$html .= 		' } );' . PHP_EOL;
		$html .= 	'} );' . PHP_EOL;
		$html .= '</script>' . PHP_EOL;		
	
		if (in_array('SincronizacaoID', $camposRequisitados)) 
			$campos[] 	= new fId('SincronizacaoID',true);
		
		if (in_array('Arquivo', $camposRequisitados)) 
			$campos[]	= new fUpload('Arquivo', 'Arquivo', '../uploads/files/', 'csv', false, true);
		
		if (in_array('Data', $camposRequisitados)) 
			$campos[]	= new fData( 'Data', 'Data', false, true, false, false, true );
			
		return $campos;
	
	}
	
	function listagem(){
		
		$query = "SELECT * FROM ".$this->tabela;
		
		$campos = $this->getCampos(array('Arquivo', 'Data'));
		
		$view = new Listagem($campos,$this->modulo,$query, 'delete', 'list');

		return $view;
		
	}
	
	function getTableDefinition() {
	
		return $this->getCampos();
		
	}	
	
	// antes da postagem
	function prePost(){	

		return $_POST;
	
	}
	
	// depois da postagem
	function posPost() {
	
		$this->arquivo = $_FILES['Arquivo']['name'];	
		set_time_limit(0);
		$arquivo = fopen('../uploads/files/'.$this->arquivo,'r');
		$codigoCliente = "~^[0-9]{1,2}$~";
		preg_quote($regex, '~');
//$count=0;		
//echo "<table border='1'>";
		while ($valores = fgetcsv($arquivo,0, ";")) {
	
			for($i=0;$i<count($valores);$i++) {

				if(preg_match($codigoCliente,trim($valores[$i])) > 0) {
//$count++;				
					$valor['PaisID']	   	   = '1';//Brasil sempre
					$valor['EstadoID']	   	   = $this->getEstadoID(trim($valores[$i+1]));
					$valor['RazaoSocial']  	   = trim(ucwords(strtolower($valores[$i+2])));
					$valor['Nome'] 	   	   	   = trim(ucwords(strtolower($valores[$i+3])));
					$valor['TelefoneFixo'] 	   = trim($valores[$i+4]);
					$valor['TelefoneMovel']	   = trim($valores[$i+5]);
					$valor['Email'] 	   	   = $valores[$i+7];
					$valor['RegiaoAtendimento']= trim($valores[$i+8]);
					$valor['DataPublicacao'] = date( "Y-m-d H:i:s" );
					$valor['Ativo'] = 'S';
					$i = $i+8;
//echo "<tr><td>Nº: ".$count."</td><td>PaisID:".$valor['PaisID']."</td><td>EstadoID: ".$valor['EstadoID']."</td><td> Razão Social: ".$valor['RazaoSocial']."</td><td> Nome: ".$valor['Nome']."</td><td> Fone fixo: ".$valor['TelefoneFixo']."</td><td> Fone móvel: ".$valor['TelefoneMovel']."</td><td>Email: ".$valor['Email']."</td><td>Região Atendimento: ".$valor['RegiaoAtendimento']."</td></tr>";
					$needUpdate = $this->needUpdate($valor);
					if($needUpdate == true)
						$this->updateEstabelecimento($valor);
					elseif($needUpdate == false)
						$this->insertEstabelecimento($valor);						
				}
			}
		}
//echo "</table>";
		$flash = new FlashMessage();		
		$flash->setFlash('retorno-titulo', 'Importação');		
		if($this->totalInsert == 0 && $this->totalUpdate == 0) {
			$mensagem = "Arquivo já processado ou de formato errado.";
			$this->iconeMensagem = 'icone-erro.png';
		} else {
			$mensagem = "Inseridos {$this->totalInsert} registros. Alterados {$this->totalUpdate} registros.";
		}
		$flash->setFlash('retorno-mensagem', $mensagem);		
		$flash->setFlash('retorno-imagem', 'comum/img/glitter/'.$this->iconeMensagem);
	}	
	
	/*
	private function checkEstabelecimento($razaoSocial) {
		$sql = "SELECT * FROM site_estabelecimento_nao_encontrado WHERE RazaoSocial = '{$razaoSocial}'";
		$check = new db();
		$check = $check->query($sql);
		if($check->_numOfRows > 0) {
			$check = new db();
			$sql = "DELETE FROM site_estabelecimento_nao_encontrado WHERE RazaoSocial = '{$razaoSocial}'";
			$check->query($sql);
		}
	}*/
	
	private function insertEstabelecimento($dados) {
	
		$sql = "INSERT INTO site_representante (".
		"`PaisID`,".	
		"`EstadoID`,".
		"`RazaoSocial`,".
		"`Nome`,".
		"`TelefoneFixo`,".
		"`TelefoneMovel`,".
		"`Email`,".
		"`RegiaoAtendimento`,".
		"`DataPublicacao`,".
		"`Ativo`) VALUES (";
		$sql .= "'".$dados['PaisID']		."',";
		$sql .= "'".$dados['EstadoID']		."',";
		$sql .= (!empty($dados['RazaoSocial'])) 	  ? '"'.$dados['RazaoSocial']	.'",' 	  : "NULL,";
		$sql .= (!empty($dados['Nome'])) 			  ? '"'.$dados['Nome']	.'",' 			  : "NULL,";
		$sql .= (!empty($dados['TelefoneFixo'])) 	  ? '"'.$dados['TelefoneFixo']	.'",' 	  : "NULL,";
		$sql .= (!empty($dados['TelefoneMovel'])) 	  ? '"'.$dados['TelefoneMovel']	.'",' 	  : "NULL,";
		$sql .= (!empty($dados['Email'])) 			  ? '"'.$dados['Email']	.'",' 			  : "NULL,";		
		$sql .= (!empty($dados['RegiaoAtendimento'])) ? '"'.$dados['RegiaoAtendimento']	.'",' : "NULL,";		
		$sql .= "'".$dados['DataPublicacao']."',";
		$sql .= "'".$dados['Ativo']."')";
	
		$insert = new db();
		if($insert->query($sql))
			$this->totalInsert++;
	
	}
	
	private function updateEstabelecimento($dados) {
	
		$db = new db();
		$query = 'SELECT RepresentanteID FROM site_representante WHERE TRIM(RazaoSocial) ="'.trim($dados['RazaoSocial']).'" AND TRIM(RegiaoAtendimento) ="'.trim($dados['RegiaoAtendimento']).'"';
		$rs = $db->query($query);
		$representanteID = $rs->fields('RepresentanteID');
		
		$sql = "UPDATE site_representante SET ".
		"`PaisID`='".$dados['PaisID']."',".
		"`EstadoID`='".$dados['EstadoID']."',".
		$sql .= (!empty($dados['RazaoSocial'])) 	  ? '`RazaoSocial`="'.$dados['RazaoSocial'].'",' 			: "`RazaoSocial`=NULL,";
		$sql .= (!empty($dados['Nome'])) 			  ? '`Nome`="'.$dados['Nome'].'",' 							: "`Nome`=NULL,";
		$sql .= (!empty($dados['TelefoneFixo'])) 	  ? '`TelefoneFixo`="'.$dados['TelefoneFixo'].'",' 			: "`TelefoneFixo`=NULL,";
		$sql .= (!empty($dados['TelefoneMovel'])) 	  ? '`TelefoneMovel`="'.$dados['TelefoneMovel'].'",' 		: "`TelefoneMovel`=NULL,";
		$sql .= (!empty($dados['Email'])) 			  ? '`Email`="'.$dados['Email'].'",' 						: "`Email`=NULL,";
		$sql .= (!empty($dados['RegiaoAtendimento'])) ? '`RegiaoAtendimento`="'.$dados['RegiaoAtendimento'].'"' : "`RegiaoAtendimento`=NULL";
		$sql .= " WHERE RepresentanteID = ".$representanteID;
	
		$update = new db();
		if($update->query($sql))
			$this->totalUpdate++;
	
	}	
	
	private function needUpdate($dados) { //retorna "existe" caso nada precise ser feito, (update ou insert)
	
		$query = 'SELECT * FROM site_representante WHERE TRIM(RazaoSocial) ="'.trim($dados['RazaoSocial']).'" AND TRIM(RegiaoAtendimento) ="'.trim($dados['RegiaoAtendimento']).'"';
		$db = new db();
		$rs = $db->query($query);
		//se não retornou registro, não precisa update
		if($rs->_numOfRows > 0) {
			//se algum campo é diferente precisa update
			if(trim($rs->fields('EstadoID')) 	  != trim($dados['EstadoID']) 	  ||
			trim($rs->fields('PaisID'))    	 	  != trim($dados['PaisID']) 	  ||
			trim($rs->fields('RazaoSocial')) 	  != trim($dados['RazaoSocial'])  ||
			trim($rs->fields('Nome')) 		 	  != trim($dados['Nome']) 		  ||
			trim($rs->fields('TelefoneFixo')) 	  != trim($dados['TelefoneFixo']) ||
			trim($rs->fields('TelefoneMovel')) 	  != trim($dados['TelefoneMovel'])||
			trim($rs->fields('Email')) 	 		  != trim($dados['Email']) 		  ||
			trim($rs->fields('RegiaoAtendimento'))!= trim($dados['RegiaoAtendimento']))
				return true;
			else
				return 'existe';
		} else return false;
	}
	
	private function getEstadoID($estadoSigla) {

		$sql = "SELECT EstadoID FROM site_estado WHERE UPPER(Sigla) = UPPER('".trim($estadoSigla)."')";
		$db = new db();
		$data = $db->query($sql);
		return $data->fields('EstadoID');	
	
	}	
	
}
