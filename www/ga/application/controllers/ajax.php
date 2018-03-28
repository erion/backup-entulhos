<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	public function __construct() {
	
		parent::__construct();
		
		$this->load->helper('analytics');	
		$this->load->library('analytics');		
		$this->oAnalytics = new analytics();				
		//$this->oAnalytics =& getAnalyticsInstance();
	
	}
	
	private function config($filtros = null){
	
		//adiciona libs necessarias e cria objeto
		$user = $this->session->userdata('sUser');
		$pass = $this->session->userdata('sPass');
		$config = array('sUser' => $user, 'sPass' => $pass);
		$this->oAnalytics->auth($config);
		
		//seta perfil
		$this->oAnalytics->setProfileById($filtros['perfil']);
		
		//seta intervalo de datas
		if (($filtros['from'] && $filtros['to']) && ($filtros['from'] != '')){ 
			
			$start = $filtros['from'];
			$end = $filtros['to'];

			//set a date range:
			$this->oAnalytics->setDateRange($start, $end);
					
			//define a data de início e fim do relatório
			$data = explode('-',$end);
			$mes = $data[1];
			$mesanalise = $mes-1;
			$mesanterior = $mes-2;
			
			//Seta a o período da data do relatório
			$this->oAnalytics->setDateRange($start,$end);
				
			//adiciona zero dos meses de 1 a 9;
			if($mes <= 9){$mes = '0'.$mes;} 
			if($mesanalise <= 9){$mesanalise = '0'.$mesanalise;}
			if($mesanterior <= 9){$mesanterior = '0'.$mesanterior;}
			
		}else {

			//Pensar em uma forma de automatizar isso com os últimos 13 meses
			$hoje = date('Y-m-d', mktime(0,0,0, date('m'),date('d'), date('Y')));
			$ano = date('Y');
			$ano = $ano.'-01-01';
			
			//define a data de início e fim do relatório
			$mes = date("m");
			$mesanalise = $mes-1;
			$mesanterior = $mes-2;
			
			//busca dados de visitas/pageviews/usuarios unicos do ano
			$this->oAnalytics->setDateRange($ano,$hoje);
				
			//adiciona zero dos meses de 1 a 9;
			if($mes <= 9){$mes = '0'.$mes;} 
			if($mesanalise <= 9){$mesanalise = '0'.$mesanalise;}
			if($mesanterior <= 9){$mesanterior = '0'.$mesanterior;}
		}	
		
		$dados = array(
			'mes'		 => $mes,
			'mesanalise' => $mesanalise,
			'mesanterior'=> $mesanterior,
			'visitas'	 => $this->oAnalytics->getTraffic()
		);
		
		$dados['visitasmesanterior'] = $dados['visitas'][$mesanterior];
		$dados['visitasmesanalise'] = $dados['visitas'][$mesanalise];
		
		return $dados;
	
	}
	
	public function getResumoMes() {
		try {
		
			$filtros = array(
				'perfil' => $this->input->get('profileID'),
				'from'	 => $this->input->get('from'),
				'to'	 => $this->input->get('to')
			);
			$dadosPadrao = $this->config($filtros);
			$uniquevisitors = $this->oAnalytics->getTrafficUniqueVisitors();
			$pageviews = $this->oAnalytics->getTrafficPageviews();
			
			$dados = array(
				'mesanalise'		=> $dadosPadrao['mesanalise'],
				'visitasmesanalise'	=> $dadosPadrao['visitasmesanalise'],
				'uniquevisitors'	=> $uniquevisitors,
				'unvisitorsanalise' => $uniquevisitors[$dadosPadrao['mesanalise']],
				'pvmesanalise' 		=> $pageviews[$dadosPadrao['mesanalise']],
				'metas'				=> $this->oAnalytics->getMetas(),
				'direct' 			=> $this->oAnalytics->getDirectTraffic(),
				'visitas'			=> $dadosPadrao['visitas'],
				'referencia' 		=> $this->oAnalytics->getReferenceTraffic(),
				'buscadores' 		=> $this->oAnalytics->getSearchTraffic(),
				'buscapaga' 		=> $this->oAnalytics->getPpcTraffic(),
				'buscaorganica' 	=> $this->oAnalytics->getOrganicTraffic()
			);
			
			foreach($dadosPadrao['visitas'] as $key => $row)
				$outros[$key] = $dados['visitas'][$key] - ($dados['direct'][$key] + $dados['referencia'][$key] + $dados['buscadores'][$key]);							
			
			$dados['outros'] = $outros;
			
			try {
				$resumoMes = $this->load->view('analytics/resumo_mes',$dados);
			} catch (Exception $e){
				$resumoMes = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='resumo-mes' href='' onclick='return false;' >&nbsp;</a></div>";
			}		
		} catch (Exception $e){
			$resumoMes = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='resumo-mes' href='' onclick='return false;' >&nbsp;</a></div>";
		}			
		echo $resumoMes;		
	}	
	
	public function getTrafegoResumo() {
		try {
			$filtros = array(
				'perfil' => $this->input->get('profileID'),
				'from'	 => $this->input->get('from'),
				'to'	 => $this->input->get('to')
			);
			$dadosPadrao = $this->config($filtros);
			
			$uniquevisitors = $this->oAnalytics->getTrafficUniqueVisitors();
			$unvisitorsmesanterior = $uniquevisitors[$dadosPadrao['mesanterior']];
			$unvisitorsanalise 	= $uniquevisitors[$dadosPadrao['mesanalise']];		
			
			$pageviews = $this->oAnalytics->getTrafficPageviews();
			$pvmesanterior = $pageviews[$dadosPadrao['mesanterior']];
			$pvmesanalise = $pageviews[$dadosPadrao['mesanalise']];			
			
			$totalvisitassociais = $this->oAnalytics->getVisitasSociais();
			
			$dados = array(
				'visitasmesanterior'	=> $dadosPadrao['visitasmesanterior'],
				'visitasmesanalise'		=> $dadosPadrao['visitasmesanalise'],
				'percvisitas' 		 	=> getPercentual($dadosPadrao['visitasmesanalise'], $dadosPadrao['visitasmesanterior']),
				'nommesanterior' 		=> getNomeMes($dadosPadrao['mesanterior']),
				'nommesanalise' 		=> getNomeMes($dadosPadrao['mesanalise']),
				'nommes' 				=> getNomeMes($dadosPadrao['mes']),
				'unvisitorsmesanterior' => $unvisitorsmesanterior,
				'unvisitorsanalise' 	=> $unvisitorsanalise,
				'unvisitorsatual' 		=> $uniquevisitors[$dadosPadrao['mes']],
				'percunvisitors' 		=> getPercentual($unvisitorsanalise, $unvisitorsmesanterior),
				'pvmesanterior' 		=> $pvmesanterior,
				'pvmesanalise' 			=> $pvmesanalise,
				'pvmes' 				=> $pageviews[$dadosPadrao['mes']],
				'percpv' 				=> getPercentual($pvmesanalise, $pvmesanterior),			
				'twitter' 				=> $this->oAnalytics->getVisitasTwitter(),
				'ning' 					=> $this->oAnalytics->getVisitasNing(),
				'facebook' 				=> $this->oAnalytics->getVisitasFacebook(),
				'orkut' 				=> $this->oAnalytics->getVisitasOrkut(),
				'percvisitassociais' 	=> getPercentualParticipacao($dadosPadrao['visitasmesanalise'], $totalvisitassociais[$dadosPadrao['mesanalise']])
			);		
			
			try {
				$trafegoResumo = $this->load->view('analytics/trafego_resumo',$dados);
			} catch (Exception $e){
				$trafegoResumo = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='trafego-resumo' href='' onclick='return false;' >&nbsp;</a></div>";
			}		
			
		} catch (Exception $e){
			$trafegoResumo = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='trafego-resumo' href='' onclick=' return false;' >&nbsp;</a></div>";
		}
		echo $trafegoResumo;
	}
	
	public function getResumoAnual() {
		try {
			$filtros = array(
				'perfil' => $this->input->get('profileID'),
				'from'	 => $this->input->get('from'),
				'to'	 => $this->input->get('to')
			);
			$dadosPadrao = $this->config($filtros);

			$dados = array(
				'visitas'		 => $dadosPadrao['visitas'],
				'uniquevisitors' => $this->oAnalytics->getTrafficUniqueVisitors(),
				'pageviews' 	 => $this->oAnalytics->getTrafficPageviews(),
				'metas'			 => $this->oAnalytics->getMetas()
			);		
			
			try {
				$resumoAnual = $this->load->view('analytics/resumo_anual',$dados);
			} catch (Exception $e){
				$resumoAnual = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='resumo-anual' href='' onclick='return false;' >&nbsp;</a></div>";
			}		
		} catch (Exception $e){
			$resumoAnual = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='resumo-anual' href='' onclick='return false;' >&nbsp;</a></div>";
		}			
		echo $resumoAnual;
	}	
	
	public function getTrafego() {
		try {
			$filtros = array(
				'perfil' => $this->input->get('profileID'),
				'from'	 => $this->input->get('from'),
				'to'	 => $this->input->get('to')
			);
			$dadosPadrao = $this->config($filtros);

			$dados = array(
				'visitas'		=> $dadosPadrao['visitas'],
				'direct' 		=> $this->oAnalytics->getDirectTraffic(),
				'referencia' 	=> $this->oAnalytics->getReferenceTraffic(),
				'buscadores' 	=> $this->oAnalytics->getSearchTraffic(),
				'buscapaga' 	=> $this->oAnalytics->getPpcTraffic(),
				'buscaorganica' => $this->oAnalytics->getOrganicTraffic()
			);
			
			foreach($dadosPadrao['visitas'] as $key => $row)
				$outros[$key] = $dados['visitas'][$key] - ($dados['direct'][$key] + $dados['referencia'][$key] + $dados['buscadores'][$key]);							
			
			$dados['outros'] = $outros;
			
			try {
				$trafego = $this->load->view('analytics/trafego',$dados);
			} catch (Exception $e){
				$trafego = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='trafego' href='' onclick='return false;' >&nbsp;</a></div>";
			}
		} catch (Exception $e){
			$trafego = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='trafego' href='' onclick='return false;' >&nbsp;</a></div>";
		}			
		echo $trafego;
	}
	
	public function getKeyWords() {
		try {
			$filtros = array(
				'perfil' => $this->input->get('profileID'),
				'from'	 => $this->input->get('from'),
				'to'	 => $this->input->get('to')
			);
			$this->config($filtros);

			$dados = array(
				'keywords' => $this->oAnalytics->getKeywordsMes(),
				'urls' 	   => $this->oAnalytics->getUrls()
			);
			
			try {
				$keywords = $this->load->view('analytics/keywords',$dados);
			} catch (Exception $e){
				$keywords = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='key-words' href='' onclick='return false;' >&nbsp;</a></div>";
			}		
		} catch (Exception $e){
			$keywords = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='key-words' href='' onclick='return false;' >&nbsp;</a></div>";
		}
		echo $keywords;
	}	
	
	public function getMesAnalise() {
	
		$filtros = array(
			'perfil' => $this->input->get('profileID'),
			'from'	 => $this->input->get('from'),
			'to'	 => $this->input->get('to')
		);	
		$mesAnalise = $this->config($filtros);

		try{
			$mesAnalise = getMesAnalytics($mesAnalise['mesanalise']);
		} catch (Exception $e){
			$mesAnalise = "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5><div class='recarregar'><a id='mes-analise' href='' onclick='return false;' >&nbsp;</a></div>";
		}		
		echo $mesAnalise; 
	}
}

