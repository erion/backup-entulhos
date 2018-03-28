<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	public function __construct() {
	
		parent::__construct();
		
	}
	
	public function index() {
		
	}
	
	public function getCidades() {
		
		$estadoID = $this->input->get('EstadoID');
		$cidades = $this->ProjetoModel->getCidadesLojas($estadoID);
		if(count($cidades) > 0)
			$option = '<option value="">Selecione uma cidade</option>';
		else
			$option = '<option value="">Desculpe, nenhuma cidade com Boa Onda</option>';
		foreach($cidades as $cidade)
			$option .= "<option value='".$cidade['CidadeID']."'>".$cidade['Nome']."</option>";
		echo $option;
	
	}

	public function getLojas() {
	
		$cidadeID = $this->input->get('CidadeID');
		$lojas = $this->ProjetoModel->getLojas($cidadeID);
		$htmlLojas = '';
		$bairro = '';
		foreach($lojas as $loja) {
			$htmlLojas .= "<li>";
			if($bairro != $loja['Bairro']) {
				$bairro = $loja['Bairro'];
				$htmlLojas .= "<h3 class='ttl'>".strtoupper($bairro)."</h3><br />";
			}
			$htmlLojas .= "<h3 class='ttl'>".$loja['RazaoSocial']."</h3>";
			$telefone = explode("-",$loja['Telefone']);
			if(strlen($telefone[0]) == 2)
				$htmlLojas .= "<p>(".$telefone[0].") ".$telefone[1]."<br />".$loja['Endereco'];
			else
				$htmlLojas .= "<p>".$telefone[0]."<br />".$loja['Endereco'];
			$htmlLojas .= "</li>";
		}
		//$htmlLojas .= $htmlLojas;
		echo $htmlLojas;
	}
	
	public function getRepresentantes() {
	
		$estadoID = $this->input->get('EstadoID');
		$representantes = $this->ProjetoModel->getRepresentantes($estadoID);
		$htmlRep = '';
		$atendimento = '';
		foreach($representantes as $rep) {
			$htmlRep .= "<li>";
			if($atendimento != $rep['RegiaoAtendimento']) {
				$atendimento = $rep['RegiaoAtendimento'];
				$htmlRep .= "<h3 class='ttl'>".strtoupper($atendimento)."</h3><br />";
			}			
			$htmlRep .= "<h3 class='ttl'>".$rep['RazaoSocial']."</h3><br />";
			$htmlRep .= "<h3 class='ttl'>".$rep['Nome']."</h3>";
			$htmlRep .= "<p>".$rep['TelefoneFixo']." ".$rep['TelefoneMovel']."<br />".$rep['Email']."</p>";
			$htmlRep .= "</li>";
		}
		echo $htmlRep;
		/*
					<li>
						<h3 class="ttl">MARY JANE WATSON INC.</h3>
						<p>(51) 3545-1414<br />maryjane@gmail.com</p>
					</li>		
		*/
	}
	
	public function getRepresentantesPais() {
	
		$paisID = $this->input->get('PaisID');
		$representantes = $this->ProjetoModel->getRepresentantesPais($paisID);
		$htmlRep = '';
		foreach($representantes as $representante) {
			$htmlRep .= '<li>';
			$htmlRep .= '<h3 class="ttl">'.$representante['Nome'].'</h3>';
			$htmlRep .= '<p>'.$representante['Email'].'</p>';
			$htmlRep .= '</li>';
		}		
		echo $htmlRep;
	
	}
	
	public function getBairrosCidade() {
	
		$cidadeID = $this->input->get('CidadeID');
		$bairros = $this->ProjetoModel->getBairrosCidades($cidadeID);
		$option = "<option value=''>Selecione</option>";
		foreach($bairros as $bairro)
			$option .= "<option value='".$bairro->Bairro."'>".$bairro->Bairro."</option>";
		echo $option;
	
	}
	
	public function getLojasBairro() {
	
		$bairro = $this->input->get('Bairro');
		$cidade = $this->input->get('CidadeID');
		$lojas = $this->ProjetoModel->getLojasBairro($cidade,$bairro);
		foreach($lojas as $loja) {
			$htmlLojas .= "<li>";
			$htmlLojas .= "<h3 class='ttl'>".$loja['RazaoSocial']."</h3>";
			$telefone = explode("-",$loja['Telefone']);
			if(strlen($telefone[0]) == 2)
				$htmlLojas .= "<p>(".$telefone[0].") ".$telefone[1]."<br />".$loja['Endereco'];
			else
				$htmlLojas .= "<p>".$telefone[0]."<br />".$loja['Endereco'];
			$htmlLojas .= "</li>";
		}
		echo $htmlLojas;
	
	}
	
	public function colecaoDetalhe($colecaoID) {
	
		$colecao = $this->ProjetoModel->getColecaoAjax($colecaoID);

		echo json_encode ($colecao);	
	
	}	
}

