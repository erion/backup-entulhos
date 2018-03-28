<?php
class Analise extends CI_Controller {

	//private $oAnalytics;
	
	public function __construct() {
		parent::__construct();
		//$this->oAnalytics =& getAnalyticsInstance();
	}
	
	public function index() {
	
		$dados = array(
			'analytics' => true,
			'conteudo' => 'analytics/inicial'
		);
		
		if(isset($_POST['username'])){

			$user = $_POST['username'];
			$pass = $_POST['password'];
			
			$conexao = array('sUser' => $_POST['username'], 'sPass' => $_POST['password']);
			
			$this->session->set_userdata($conexao);
		
		}else {
			
			$user = $this->session->userdata('sUser');
			$pass = $this->session->userdata('sPass');
			
		}		
		
		$this->load->view('master',$dados);
	}
	
	public function resumo() {
	
		$user = $this->session->userdata('sUser');
		$pass = $this->session->userdata('sPass');	
		
		$config = array('sUser' => $user, 'sPass' => $pass);
		
		$this->load->helper('form');	
		$this->load->helper('analytics');	
		$this->load->library('analytics');

		$oAnalytics = new analytics();
		$oAnalytics->auth($config);

		$aProfiles = $oAnalytics->getProfileList();

		$aProfileKeys = array_keys($aProfiles);
		
		$dados = array(
			'aProfiles'				=> $aProfiles,
			'selectedProfile'		=> $selectedProfile,
			'filtroDataIni'			=> $start,
			'filtroDataFim'			=> $end,
			'conteudo' 				=> 'analytics/index',
			'analytics'				=> true		
		);
		
		$this->load->view('master',$dados);
	}
	
	public function importar() {
	
		//setar a data de pesquisa
		if (isset($_POST['from'],$_POST['to']) && ($_POST['from'] != '')){ 
		
			$this->load->helper('analytics');	
			$this->load->library('analytics');
			$user = $this->session->userdata('sUser');
			$pass = $this->session->userdata('sPass');				
			$config = array('sUser' => $user, 'sPass' => $pass);			
			$oAnalytics = new analytics();
			$oAnalytics->auth($config);		
			
			$start = $_POST['from'];
			$end = $_POST['to'];
			$oAnalytics->setDateRange($start, $end);		
			//define a data de início e fim dos dados
			$data = explode('-',$end);
			$mes = $data[1];
			$ano = $data[0]; //talvez tenha que mudar (dezembro janeiro)
			
			$mesanalise = $mes-1;
			$mesanterior = $mes-2;
			//adiciona zero dos meses de 1 a 9;
			//if($mes <= 9){$mes = '0'.$mes;} 
			if($mesanalise <= 9){$mesanalise = '0'.$mesanalise;}
			if($mesanterior <= 9){$mesanterior = '0'.$mesanterior;}
			
			$insertContasGa = array();
			$updateContaGa = array();
			$insertMetrica = array();
			$updateMetrica = array();
			
			$aProfiles = $oAnalytics->getProfileList(true);
			
			$maxGAID = $this->ProjetoModel->getMaxGAID();
			$gaID = 0;
			
			foreach($aProfiles as $profile) {
			
				$conta = $this->db->get('contasga',array('desc',$profile['tableId']));
				if($conta->num_rows() > 0)
					$currentGaID = $conta['id'];
				
				if(empty($currentGaID) || is_null($currentGaID)) {
					$insertContasGa[]['nome'] = $profile['title'];
					$insertContasGa[]['desc'] = $profile['tableId'];
					$gaID++;
					$currentGaID = (int)$maxGAID + $gaID;
				} else {
					$updateContaGa[]['nome'] = $profile['title'];
					$updateContaGa[]['desc'] = $profile['tableId'];
				}
				
				$oAnalytics->setProfileById($profile['tableId']);
				
				$visitas = $oAnalytics->getTraffic();
				$metas = $oAnalytics->getMetas();	
				$pageViews = $oAnalytics->getTrafficPageviews();
				$uniqueVisitors = $oAnalytics->getTrafficUniqueVisitors();
				$direct = $oAnalytics->getDirectTraffic();
				$referencia = $oAnalytics->getReferenceTraffic();
				$buscadores = $oAnalytics->getSearchTraffic();
				$buscapaga = $oAnalytics->getPpcTraffic();
				
				$buscaorganica = $oAnalytics->getOrganicTraffic();
				$paginasvisita = $oAnalytics->getPagePerVisit();
				$taxarejeicao = $oAnalytics->getBounceRate();
				$temponosite = $oAnalytics->getTimeOnSite();
				$duracaovisita = $oAnalytics->getTimeOnPage();
				$trafegodireto = $oAnalytics->getDirectTraffic();
				
deb($temponosite);
deb($visitas);
deb(date('H:i:s',$temponosite[$mes]/$visitas[$mes]));

				foreach($visitas as $key => $row)
					$outros[$key] = $visitas[$key] - ($direct[$key] + $referencia[$key] + $buscadores[$key]);
				
				$filtrosMetricas = array(
					'constasga_id' => $currentGaID,
					'mes'		   => $mes,
					'ano'		   => $ano
				);
				
				$metricas = $this->db->get('metricas',$filtrosMetricas);
					
				if($metricas->num_rows() == 0) {
					$metrica['NaoVaiFicar'] = $profile['title'];
					$metrica['contasga_id'] 		= $currentGaID;
					$metrica['mes'] 				= $mes;
					$metrica['ano'] 				= $ano;
					$metrica['visitas'] 			= $visitas[$mes];
					$metrica['pageviews'] 			= $pageViews[$mes];
					$metrica['usuariosunicos'] 		= $uniqueVisitors[$mes];
					$metrica['paginasvisita'] 		= round($paginasvisita[$mes],2);
					$metrica['taxarejeicao'] 		= round($taxarejeicao[$mes],2);
					$metrica['temponosite'] 		= date('H:i:s',$temponosite[$mes]);
					$metrica['conversoes'] 			= $metas[$mes];
					$metrica['trafegodireto'] 		= $trafegodireto[$mes];
					$metrica['sitesreferencia'] 	= $referencia[$mes];
					$metrica['outros'] 				= $outros[$mes];
					$metrica['buscadores'] 			= $buscadores[$mes];
					$metrica['buscapaga'] 			= $buscapaga[$mes];
					$metrica['buscaorganica'] 		= $buscaorganica[$mes];
					$metrica['perctrafegodireto'] 	= getPercentualParticipacao($visitas[$mes],$trafegodireto[$mes]);
					$metrica['percsitesreferencia'] = getPercentualParticipacao($visitas[$mes],$referencia[$mes],true);
					$metrica['percoutros'] 			= getPercentualParticipacao($visitas[$mes],$outros[$mes],true);
					$metrica['percbuscadores'] 		= getPercentualParticipacao($visitas[$mes],$buscadores[$mes],true);
					$metrica['percbuscapaga'] 		= getPercentualParticipacao($visitas[$mes],$buscapaga[$mes],true);
					$metrica['percbuscaorganica']   = getPercentualParticipacao($visitas[$mes],$buscaorganica[$mes],true);
					$metrica['duracaovisita'] 		= date('H:i:s',$duracaovisita[$mes]);
					
					array_push($insertMetrica,$metrica);
				} else {
				
				}
				deb($insertMetrica,1);
				$gaID++;
			}
			
			//deb($insertMetrica,1);
			
			//$this->ProjetoModel->insert('contasga',$insertContasGa);
			
		} else {
			$this->load->helper('form');
			$dados['conteudo'] = 'analytics/importar';
			$this->load->view('master',$dados);
/*
			//Pensar em uma forma de automatizar isso com os últimos 13 meses
			$hoje = date('Y-m-d', mktime(0,0,0, date('m'),date('d'), date('Y')));
			$ano = date('Y');
			$ano = $ano.'-01-01';
			
			//define a data de início e fim do relatório
			$mes = date("m");
			$mesanalise = $mes-1;
			$mesanterior = $mes-2;
			
			//busca dados de visitas/pageviews/usuarios unicos do ano
			$oAnalytics->setDateRange($ano,$hoje);
				
			//adiciona zero dos meses de 1 a 9;
			if($mes <= 9){$mes = '0'.$mes;} 
			if($mesanalise <= 9){$mesanalise = '0'.$mesanalise;}
			if($mesanterior <= 9){$mesanterior = '0'.$mesanterior;}
*/
		}		
	}
	
	public function teste() {
	
		
		$dados = Array(
		    '1' => Array
		        (
		            '(not set)' => 610,
		            'sulmodulos' => 86,
		            'sul modulos' => 81,
		            '(not provided)' => 59,
		            'divisórias porto alegre' => 59,
		            'gesso acartonado porto alegre' => 58,
		            'parede de pvc' => 53,
		            'sonex' => 49,
		            'divisórias para escritório porto alegre' => 36,
		            'paredes de pvc' => 30,
		            'divisorias de paredes' => 27,
		            'gesso porto alegre' => 25,
		            'divisoria de pvc' => 23,
		            'paredes divisorias' => 23,
		            'parede pvc' => 21,
		            'paviflex porto alegre' => 19,
		            'divisorias porto alegre' => 17,
		            'gesso acartonado' => 17,
		            'sulmodulos porto alegre' => 15,
		            'sulmódulos' => 15,
		            'forro mineral' => 13,
		            'parede de pvc preço' => 13,
		            'decorsound' => 12,
		            'preço forro mineral' => 12,
		            'divisórias em porto alegre' => 11,
		            'isolamento acustico' => 11,
		            'pvc para parede' => 11,
		            'forro acartonado' => 10,
		            'lamb engenharia' => 10,
		            'parede divisória' => 10,
		            'pvc parede' => 10,
		            'revestimento de parede em pvc' => 10,
		            'sul módulos' => 9,
		            'divisorias de parede' => 8,
		            'divisorias em porto alegre' => 8,
		            'divisorias parede' => 8,
		            'gesso acartonado construção porto alegre' => 8,
		            'paredes de divisorias' => 8,
		            'paredes divisórias' => 8,
		            'revestimento parede pvc' => 8,
		            'divisórias banheiros' => 7,
		            'eucatex' => 7,
		            'gesso acartonado em porto alegre' => 7,
		            'gesso acartonado porto alegre preço' => 7,
		            'paredes em pvc' => 7,
		            'piso elevado porto alegre' => 7,
		            'placa cimenticia porto alegre' => 7,
		            'sonex porto alegre' => 7,
		            'sul modulos porto alegre' => 7,
		        ),
		
		    '2' => Array
		        (
		            '(not set)' => 745,
		            'divisórias porto alegre' => 84,
		            'sonex' => 81,
		            'gesso acartonado porto alegre' => 75,
		            'sulmodulos' => 52,
		            '(not provided)' => 51,
		            'sul modulos' => 46,
		            'divisórias para escritório porto alegre' => 43,
		            'parede de pvc' => 36,
		            'paredes de pvc' => 25,
		            'divisorias porto alegre' => 22,
		            'forro mineral' => 21,
		            'divisorias de paredes' => 20,
		            'parede pvc' => 16,
		            'revestimento de parede em pvc' => 16,
		            'divisoria de pvc' => 15,
		            'sul módulos' => 15,
		            'gesso acartonado' => 14,
		            'gesso porto alegre' => 14,
		            'paredes divisorias' => 14,
		            'sonex para estudio' => 14,
		            'sonex porto alegre' => 13,
		            'paredes divisórias' => 12,
		            'eucatex porto alegre' => 11,
		            'divisórias eucatex' => 10,
		            'lamb engenharia' => 10,
		            'painel wall porto alegre' => 10,
		            'divisorias de parede' => 9,
		            'divisorias eucatex' => 9,
		            'divisórias para banheiros' => 9,
		            'forro acartonado' => 9,
		            'paviflex porto alegre' => 9,
		            'divisórias eucatex porto alegre' => 8,
		            'eucatex' => 8,
		            'pvc para parede' => 8,
		            'gesso acartonado construção porto alegre' => 7,
		            'painel wall' => 7,
		            'parede em pvc' => 7,
		            'piso paviflex porto alegre' => 7,
		            'placas de gesso acartonado' => 7
		        ),
		
		    '3' => Array
		        (
		            '(not set)' => 1298,
		            '(not provided)' => 446,
		            'divisórias porto alegre' => 95,
		            'gesso acartonado porto alegre' => 80,
		            'sonex' => 75,
		            'sulmodulos' => 68,
		            'sul modulos' => 59,
		            'parede de pvc' => 45,
		            'divisórias para escritório porto alegre' => 34,
		            'sonex para estudio' => 32,
		            'divisorias porto alegre' => 26,
		            'gesso acartonado' => 22,
		            'revestimento de parede em pvc' => 21,
		            'paredes de pvc' => 20,
		            'paviflex porto alegre' => 18,
		            'pvc para parede' => 16,
		            'gesso porto alegre' => 14,
		            'lamb engenharia' => 13,
		            'divisorias de paredes' => 12,
		            'forro mineral' => 12,
		            'divisoria de pvc' => 11,
		            'isolamento acustico' => 11,
		            'parede pvc' => 11,
		            'sonex porto alegre' => 11,
		            'sulmódulos' => 11,
		            'painel wall' => 10,
		            'eucatex porto alegre' => 9,
		            'paredes divisórias' => 9,
		            'placa cimenticia porto alegre' => 9,
		            'www.sulmodulos.com.br' => 9,
		            'divisoria de parede' => 8,
		            'divisória naval eucatex' => 8,
		            'divisórias eucatex' => 8,
		            'eucatex' => 8,
		            'forro de pvc porto alegre' => 8,
		            'forro pvc porto alegre' => 8,
		            'igreja bola de neve porto alegre' => 8,
		            'isopor porto alegre' => 8,
		            'painel wall porto alegre' => 8,
		            'paredes divisorias' => 8,
		            'divisoria em pvc' => 7,
		            'divisorias de parede' => 7,
		            'forro de gesso' => 7,
		            'paines de isolamento acustico' => 7,
		            'parede divisória' => 7,
		            'parede em pvc' => 7,
		            'paviflex' => 7,
		        ),
		
		    '4' => Array
		        (
		            '(not set)' => 862,
		            '(not provided)' => 564,
		            'gesso acartonado porto alegre' => 108,
		            'divisórias porto alegre' => 97,
		            'sonex' => 65,
		            'sul modulos' => 62,
		            'sulmodulos' => 52,
		            'gesso porto alegre' => 39,
		            'gesso acartonado' => 34,
		            'parede de pvc' => 28,
		            'divisória eucatex' => 23,
		            'paredes de pvc' => 16,
		            'parede pvc' => 14,
		            'paredes divisorias' => 14,
		            'sonex para estudio' => 14,
		            'isolamento acustico porto alegre' => 13,
		            'sonex porto alegre' => 13,
		            'divisorias de paredes' => 12,
		            'paviflex porto alegre' => 11,
		            'piso elevado porto alegre' => 11,
		            'divisoria de pvc' => 10,
		            'divisórias para escritório porto alegre' => 10,
		            'paviflex porto alegre rs' => 10,
		            'placa cimenticia porto alegre' => 10,
		            'divisorias porto alegre' => 9,
		            'eucatex porto alegre' => 9,
		            'forro isopor porto alegre' => 9,
		            'isopor porto alegre' => 9,
		            'parede em pvc' => 9,
		            'pisos paviflex' => 9,
		            'sulmodulos.com.br' => 9,
		            'isolamento acustico' => 8,
		            'revestimento de parede em pvc' => 8,
		            'sul módulos' => 8,
		            'divilux eucatex' => 7,
		            'divisorias de gesso' => 7,
		            'divisorias de parede' => 7,
		            'divisória naval eucatex' => 7,
		            'divisórias em porto alegre' => 7,
		            'forro acartonado' => 7
		        )
		
		);
		
		
		foreach($dados as $mes => $row){

			foreach ($row as $kwd => $sub) {
				
				if(array_key_exists($kwd, $keywords)){
					
					$keywords[$kwd][$mes] = $sub; 
				
				}else{
				
					$keywords[$kwd] = array(
											$mes => $sub
											);
				
				}

			}
		}
			
			
			deb($keywords);
	}
	
	
	
	
	
}