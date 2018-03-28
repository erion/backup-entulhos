<?php


class Inicial extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
		$lang = $this->lang->lang();
		$dadosComuns = getDadosComuns($lang);

		$data = array(
			'conteudo'=>'inicial/index',
			'paginaID'=>'home',
			'title'	  =>'Boa Onda',
			'menu'	  => getMenuLang($lang),
			'dadosComuns' => $dadosComuns,
			'javascript'=> array('slides.min.jquery.js')
		);
		
		$this->load->view('master', $data);
		
	}
	
}