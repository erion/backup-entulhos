<?php


class OndeEncontrar extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
	
		$lang = $this->lang->lang();
		if($lang == 'pt') {
			$cidadeID = $this->input->post('loja-cidade');
			if($cidadeID)
				$lojas = $this->ProjetoModel->getLojas($cidadeID);
			$estados = $this->ProjetoModel->getEstados();
			$estadosRepresentantes = $this->ProjetoModel->getEstadosRepresentantes();
			$selectRepID = 'repres-estado';
		} else {
			$estadosRepresentantes = $this->ProjetoModel->getPaisesRepresentantes();
			$selectRepID = 'repres-pais';
		}
		
		$dadosComuns = getDadosComuns($lang);
		
		$data = array(
			'conteudo'=>'ondeencontrar/index',
			'paginaID'=>'ondeEncontrar',
			'title'	  =>'Onde encontrar - Boa Onda',
			'lojas'	  =>$lojas,
			'estados' =>$estados,
			'estadosRep'=>$estadosRepresentantes,
			'selectRepID'=>$selectRepID,
			'menu'	  => getMenuLang($lang),
			'dadosComuns' =>$dadosComuns,
			'currentLang' => $lang,
			'javascript'=> array('jquery.jscrollpane.min.js', 'jquery.mousewheel.js')
		);
		
		$this->load->view('master', $data);
		
	}
	
}