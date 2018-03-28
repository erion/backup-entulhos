<?php


class Campanha extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {

		$lang = $this->lang->lang();
		//ordenado pela campanha para pegar a última caso tenha mais de uma ativa
		$campanha = $this->ProjetoModel->get('site_campanha',array('Destaque' => 'S'),1,'','CampanhaID DESC');
		$galeriaCampanha = $this->ProjetoModel->select('site_campanha_galeria','',array('CampanhaID' => $campanha['CampanhaID']));

		/*
		$campanhaDestaque = $galeriaCampanha[0]['Imagem'];
		$i=0;
		foreach($galeriaCampanha as $galeria) {
			if($galeria['Destaque'] == 'S') {
				$campanhaDestaque = $galeria['Imagem'];
				unset($galeriaCampanha[$i]);
				break;
			}
			$i++;
		}
		*/

		$dadosComuns = getDadosComuns($lang);
		
		$data = array(
			'conteudo'=>'campanha/index',
			'paginaID'=>'campanha',
			'title'	  => 'Campanha - Boa Onda',
			'menu'	  => getMenuLang($lang),
			'campanha' => $campanha,
			'galeriaCampanha' => $galeriaCampanha,
			'destaqueCampanha' => $campanhaDestaque,
			'currentLang' => $lang,
			'dadosComuns' => $dadosComuns,
			'javascript'=> array('jquery.jcarousel.min.js', 'loader.js', 'fancybox/jquery.fancybox-1.3.4.pack.js')
		);
		
		$this->load->view('master', $data);
		
	}
	
	public function old() {
	
		$lang = $this->lang->lang();
		//ordenado pela campanha para pegar a última caso tenha mais de uma ativa
		$campanha = $this->ProjetoModel->get('site_campanha','',1,'','CampanhaID DESC');
		$galeriaCampanha = $this->ProjetoModel->select('site_campanha_galeria','',array('CampanhaID' => $campanha['CampanhaID']));
		$campanhaDestaque = $galeriaCampanha[0]['Imagem'];
		$i=0;
		foreach($galeriaCampanha as $galeria) {
			if($galeria['Destaque'] == 'S') {
				$campanhaDestaque = $galeria['Imagem'];
				unset($galeriaCampanha[$i]);
				break;
			}
			$i++;
		}

		$dadosComuns = getDadosComuns($lang);
		
		$data = array(
			'conteudo'=>'campanha/indexTeste',
			'paginaID'=>'campanha',
			'title'	  => 'Campanha - Boa Onda',
			'menu'	  => getMenuLang($lang),
			'campanha' => $campanha,
			'galeriaCampanha' => $galeriaCampanha,
			'destaqueCampanha' => $campanhaDestaque,
			'currentLang' => $lang,
			'dadosComuns' => $dadosComuns,
			'javascript'=> array('jquery.jcarousel.min.js', 'loader.js')
		);
		
		$this->load->view('master', $data);	
	
	}
	
}