<?php


class Cadastro extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
	
		$lang = $this->lang->lang();
		switch($lang) {		
			case 'pt': $cadastro = $this->ProjetoModel->get('site_conteudo',array('Nome' => 'CADASTRO'),1);
			break;
			case 'en': $cadastro = $this->ProjetoModel->get('site_conteudo',array('Nome' => 'CADASTRO_EN'),1);
			break;
			case 'es': $cadastro = $this->ProjetoModel->get('site_conteudo',array('Nome' => 'CADASTRO_SP'),1);
			break;
			default	 : show_404(); break;
		}
		
		$tamanhos = $this->ProjetoModel->select('site_colecao_grade','Grade');
		$grades = '';
		foreach($tamanhos as $grade) {
			$grades .= $grade['Grade']." ";
			$grades = str_replace('/'," ",$grades);
		}
		$grades = rtrim($grades," ");
		$grades = explode(" ",$grades);
		asort($grades);		

		$mensagem = '';
		$dadosComuns = getDadosComuns($lang);
		
		$dadosFormCadastro = $this->input->post('cadastro');
		if($dadosFormCadastro){
			$dadosFormCadastro['DataNascimento'] = date('Y-m-d',$dadosFormCadastro['DataNascimento']);
			$dadosFormCadastro['Ativo'] = 'S';
			if($this->ProjetoModel->insert('site_cadastro',$dadosFormCadastro))
				$mensagem = 'Cadastro realizado com sucesso';
			else
				$mensagem = 'Ocorreu um erro ao realizar seu cadsatro, tente novamente.';
		}
		
		$data = array(
			'conteudo'=>'cadastro/index',
			'paginaID'=>'cadastro',
			'title'	  => 'Cadastro - Boa Onda',
			'menu'	  => getMenuLang($lang),
			'cadastro'=> $cadastro,
			'currentLang' => $lang,
			'nome' => $this->input->post('site_nome'),
			'email' => $this->input->post('site_email'),
			'estados' => listaEstados(),
			'tamanhos' => $grades,
			'dadosComuns' => $dadosComuns,
			'mensagem' => $mensagem,
			'javascript'=> array('jquery.jscrollpane.min.js', 'jquery.mousewheel.js')
		);
		
		$this->load->view('master', $data);
		
	}
	
}