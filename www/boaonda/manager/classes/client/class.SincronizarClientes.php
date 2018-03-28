<?php

class SincronizarClientes extends ModuloDB {
	
	public function __construct( $cod = '' ) {

		$this->tabela = 'site_sincronizacao';
		$this->tituloModulo = 'SINCRONIZAR CLIENTES';
		$this->chave = 'SincronizacaoID';
		$this->acaoPadrao = 'Cadastro';
		
		$this->arquivo;
		
		$this->iconeMensagem = 'icone-sucesso.png';
		$this->totalInsert = 0;
		$this->totalUpdate = 0;
		$this->totalErrosCidade = 0;
		
		$this->ModuloDB();
		
		if ( $cod ) 
			$this->configDb($cod);
			
	}
	
	function getCampos($camposRequisitados = array('SincronizacaoID', 'Arquivo', 'Estabelecimentos', 'Data')) {
	
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
			
		if (in_array('Estabelecimentos',$camposRequisitados)) {
			$sql = "SELECT * FROM site_estabelecimento WHERE CidadeID = 0";
			$semCidade = new db();
			$semCidade = $semCidade->query($sql);
			$estabelecimentos = "<table>";
			$estabelecimentos .= "<tr><td colspan='5'><b>Cidades incompatíveis nos seguintes registros:</b></td></tr>";
			$estabelecimentos .= "<tr><td>Razão Social</td><td>Estabelecimento</td></tr>";
			while(!$semCidade->EOF) {
				$estabelecimentos .= "<tr><td>".$semCidade->fields('RazaoSocial')."</td><td><a href='".$_SERVER['PHP_SELF']."?modulo=Estabelecimento&acao=cadastro&id_tipo=&cod=".$semCidade->fields('EstabelecimentoID')."'>Ir para</a></td></tr>";
				$semCidade->MoveNext();
			}
			$estabelecimentos .= "</table>";		
		
			$campos[] = new fHtml($estabelecimentos);
		}		
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
		$codigoCliente = "~^[0-9]{1,2}.[0-9]{3}~";
		preg_quote('~');
//$count=0;		
//echo "<table border='1'>";
		while ($valores = fgetcsv($arquivo,0, ";")) {
	
			for($i=0;$i<count($valores);$i++) {

				if(preg_match($codigoCliente,trim($valores[$i])) > 0) {
//$count++;				
					$valor['Codigo'] 	   = trim($valores[$i]);
					$valor['RazaoSocial']  = trim(ucwords(strtolower($valores[$i+1])));
					$cidadeEstado = explode('/',$valores[$i+2]);
					$valor['CidadeID']	   = $this->getCidadeID(trim($cidadeEstado[0]));
					$valor['EstadoID']	   = $this->getEstadoID(trim($cidadeEstado[1]));
					$valor['PaisID']	   = '1';//Brasil sempre
					$valor['Endereco'] 	   = trim(ucwords(strtolower($valores[$i+3])));
					$valor['Bairro']       = trim(ucwords(strtolower($valores[$i+4])));
					$valor['Telefone'] 	   = $valores[$i+5];
					$valor['DataPublicacao'] = date( "Y-m-d H:i:s" );
					$valor['Ativo'] = 'S';
					$i = $i+5;
//echo "<tr><td>Nº: ".$count."</td><td>Código:</td><td>".$valor['Codigo']."</td><td> Razao Social: ".$valor['RazaoSocial']."</td><td> CidadeID: ".$valor['CidadeID']."</td><td> EstadoID: ".$valor['EstadoID']."</td><td> Endereco: ".$valor['Endereco']."</td><td> Bairro: ".$valor['Bairro']."</td><td> Telefone: ".$valor['Telefone']."</td></tr>";
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
		if($this->totalInsert == 0 && $this->totalUpdate == 0 && $this->totalErrosCidade == 0) {
			$mensagem = "Arquivo já processado ou de formato errado.";
			$this->iconeMensagem = 'icone-erro.png';
		} else {
			$mensagem = "Inseridos {$this->totalInsert} registros. Alterados {$this->totalUpdate} registros. Encontradas {$this->totalErrosCidade} incompatibilidades de cidades.";
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
	
		$sql = "INSERT INTO site_estabelecimento (".
		"`RazaoSocial`,".
		"`PaisID`,".	
		"`EstadoID`,".
		"`CidadeID`,".
		"`Telefone`,".
		"`Endereco`,".
		"`Bairro`,".
		"`DataPublicacao`,".
		"`Ativo`) VALUES (";
		$sql .= (!empty($dados['RazaoSocial'])) ? '"'.$dados['RazaoSocial']	.'",' : "NULL,";
		$sql .= "'".$dados['PaisID']		."',";
		$sql .= "'".$dados['EstadoID']		."',";
		$sql .= "'".$dados['CidadeID']		."',";
		$sql .= (!empty($dados['Telefone'])) ? '"'.$dados['Telefone']	.'",' : "NULL,";
		$sql .= (!empty($dados['Endereco'])) ? '"'.$dados['Endereco']	.'",' : "NULL,";
		$sql .= (!empty($dados['Bairro'])) ? '"'.$dados['Bairro']	.'",' : "NULL,";		
		$sql .= "'".$dados['DataPublicacao']."',";
		$sql .= "'".$dados['Ativo']."')";
	
		$insert = new db();
		if($insert->query($sql))
			$this->totalInsert++;
	
	}
	
	private function updateEstabelecimento($dados) {
	
		$db = new db();
		$query = 'SELECT EstabelecimentoID FROM site_estabelecimento WHERE RazaoSocial = "'.$dados['RazaoSocial'].'"';
		$rs = $db->query($query);
		$estabelecimentoID = $rs->fields('EstabelecimentoID');
		
		$sql = "UPDATE site_estabelecimento SET ".
		"`EstadoID`='".$dados['EstadoID']."',".
		"`CidadeID`='".$dados['CidadeID']."',".
		$sql .= (!empty($dados['RazaoSocial'])) ? '`RazaoSocial`="'.$dados['RazaoSocial'].'",' : "`RazaoSocial`=NULL,";
		$sql .= (!empty($dados['Telefone'])) ? '`Telefone`="'.$dados['Telefone'].'",' : "`Telefone`=NULL,";
		$sql .= (!empty($dados['Endereco'])) ? '`Endereco`="'.$dados['Endereco'].'",' : "`Endereco`=NULL,";
		$sql .= (!empty($dados['Bairro'])) ? '`Bairro`="'.$dados['Bairro'].'"' : "`Bairro`=NULL";
		$sql .= " WHERE EstabelecimentoID = ".$estabelecimentoID;
	
		$update = new db();
		if($update->query($sql))
			$this->totalUpdate++;
	
	}	
	
	private function needUpdate($dados) { //retorna "existe" caso nada precise ser feito, (update ou insert)
	
		$query = 'SELECT * FROM site_estabelecimento WHERE RazaoSocial ="'.$dados['RazaoSocial'].'"';
		$db = new db();
		$rs = $db->query($query);
		if($rs->_numOfRows > 0) {
			if(trim($rs->fields('EstadoID')) != trim($dados['EstadoID']) 	||
			trim($rs->fields('CidadeID'))    != trim($dados['CidadeID']) 	||
			trim($rs->fields('RazaoSocial')) != trim($dados['RazaoSocial']) ||
			trim($rs->fields('Telefone')) 	 != trim($dados['Telefone']) 	||
			trim($rs->fields('Endereco')) 	 != trim($dados['Endereco']) 	||
			trim($rs->fields('Bairro')) 	 != trim($dados['Bairro']))
				return true;
			else
				return 'existe';
		} else return false;
	}
	
	private function getCidadeID($cidadeNome) {
	
		$sql = "SELECT CidadeID FROM site_cidade WHERE UPPER(Nome) = UPPER('".trim($cidadeNome)."')";
		$db = new db();
		$data = $db->query($sql);
		if($data->fields('CidadeID'))
			return $data->fields('CidadeID');
		else {
			$sql = "SELECT CidadeID FROM site_cidade WHERE UPPER(Nome) LIKE UPPER('%".trim($cidadeNome)."%')";
			$db = new db();
			$data = $db->query($sql);
			if($data->fields('CidadeID'))
				return $data->fields('CidadeID');
			else {
				$this->totalErrosCidade++;
				return '0';
			}
		}
	
	}
	
	private function getEstadoID($estadoSigla) {

		$sql = "SELECT EstadoID FROM site_estado WHERE UPPER(Sigla) = UPPER('".trim($estadoSigla)."')";
		$db = new db();
		$data = $db->query($sql);
		return $data->fields('EstadoID');	
	
	}	
	
}
