<?php


class Empresa extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {

		$lang = $this->lang->lang();
		switch($lang) {		
			case 'pt': $empresa = $this->ProjetoModel->get('site_conteudo',array('Nome' => 'EMPRESA'),1);
			break;
			case 'en': $empresa = $this->ProjetoModel->get('site_conteudo',array('Nome' => 'EMPRESA_EN'),1);
			break;
			case 'es': $empresa = $this->ProjetoModel->get('site_conteudo',array('Nome' => 'EMPRESA_SP'),1);
			break;
			default	 : show_404(); break;
		}
		
		$dadosComuns = getDadosComuns($lang);
		
		$data = array(
			'conteudo'=>'empresa/index',
			'empresa' => $empresa,
			'title'	  => 'Empresa - Boa Onda',
			'menu'	  => getMenuLang($lang),
			'currentLang' => $lang,
			'dadosComuns' => $dadosComuns,
			'paginaID'=>'empresa'
		);		
		
		if($empresa['Title'])
			$data['title'] = $empresa['Title'];
		if($empresa['Description'])
			$data['metaDescription'] = $empresa['Description'];
		
		$this->load->view('master', $data);
		
	}
	
}