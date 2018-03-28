<?php


class ProjetoModel extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		$this->dbSite = $this->load->database('default', TRUE);
		$this->dbBlog = $this->load->database('blog', TRUE);
		
	}
	
	public function get( $tabela, $filtros=array(), $limit='', $pag='', $ordem='', $group_by = '' ) {

		if( $tabela ) {	
		
			$this->dbSite->from( $tabela );		
			$this->dbSite->where('Ativo', 'S');
			
			if($filtros)
				$this->dbSite->where($filtros);

			if( $group_by )
				$this->dbSite->group_by($group_by);
			
			if( $ordem ) 
				$this->dbSite->order_by($ordem);		
			
			if( $limit && $pag ) {
				$pag = $pag*$limit;
				$this->dbSite->limit($limit, $pag);
			}
			
			if( $limit && !$pag )
				$this->dbSite->limit($limit);
				
			$res = $this->dbSite->get();
			
			// Mostra ultima query realizada...
			//deb($this->db->last_query());
			
			if ( $limit == 1 )
				$retorno = $res->row_array();
			else
				$retorno = $res->result_array();
				
			return $retorno;
			
		}
	}
	
	public function select($tabela, $campos='', $filtros='', $limit='', $ordem='') {
	
		if( $tabela ) {	
		
			if($campos)
				$this->dbSite->select($campos);
				
			$this->dbSite->from( $tabela );		
			
			if($filtros)
				$this->dbSite->where($filtros);
				
			if( $ordem ) 
				$this->dbSite->order_by($ordem);				
				
			if($limit)
				$this->dbSite->limit($limit);
				
			$res = $this->dbSite->get();				
			
			if ( $limit == 1 )
				$retorno = $res->row_array();
			else
				$retorno = $res->result_array();
				
			return $retorno;

		}
	
	}
	
	public function query( $sql, $limit = null ) {
		$res = $this->dbSite->query( $sql );

		if( $res === true )
			$retorno = true;
		else
			$retorno = $res->result();
	
		return $retorno;
	}
	
	public function getColecao($url = null) {
	
		if($url) {
			$colecao = $this->get('site_colecao',array('Url' => $url),1);
		} else {
			$colecao = $this->get('site_colecao');
			foreach($colecao as &$produto) {
				$colecaoGenero = $this->select('site_colecao_genero_site_colecao','ColecaoGeneroID',array('ColecaoID' => $produto['ColecaoID']),1);
				$produto['genero'] = $this->select('site_colecao_genero','Titulo',array('ColecaoGeneroID' => $colecaoGenero['ColecaoGeneroID']),1);
				$produto['genero'] = $produto['genero']['Titulo'];
			}
		}
		return $colecao;
	}
	
	public function getColecaoImagem($colecao) {

		foreach($colecao as $produto)
			$colecaoImagem[$produto['ColecaoID']] = $this->ProjetoModel->select('site_colecao_cor_imagem','Imagem',array('ColecaoID' => $produto['ColecaoID']),1,'ColecaoCorID');
		
		return $colecaoImagem;
	}
	
	public function getColecaoGenero($genero) {
	
		if($genero) {
			$genero = ucfirst($genero);
			$generos = $this->get('site_colecao_genero',array('Titulo' => $genero),1);
			$colecaoGenero = $this->select('site_colecao_genero_site_colecao','ColecaoID',array('ColecaoGeneroID' => $generos['ColecaoGeneroID']));
			$colecoesID = '';
			foreach($colecaoGenero as $colecaoID)
				$colecoesID .= $colecaoID['ColecaoID'].',';
			$colecoesID = rtrim($colecoesID,',');
			$colecao = $this->ProjetoModel->get('site_colecao','ColecaoID IN ('.$colecoesID.')');			
			
			return $colecao;
		}
	
	}

	public function getColecaoCorImagem($produtoID) {
	
		$corImagem = $this->ProjetoModel->select('site_colecao_cor_imagem','ColecaoCorID,Imagem',array('ColecaoID' => $produtoID),'','ColecaoCorID');
		$cores = '';
		foreach($corImagem as $cor) {
			$cores .= $cor['ColecaoCorID'].',';
			$corImg[$cor['ColecaoCorID']] = $cor['Imagem'];
		}
		$cores = rtrim($cores,',');
		$colecaoCores = $this->ProjetoModel->get('site_colecao_cor','ColecaoCorID IN ('.$cores.')');
		
		foreach($colecaoCores as $cor)
			$colecao[] = array(
					'nome'=> strtolower($cor['Nome']),
					'cor' => $cor['Cor'],
					'imagem' => $corImg[$cor['ColecaoCorID']]
				);
		
		return $colecao;
		
	}
	
	public function getColecaoGrades($produtoID) {

		$colecaoGrades = $this->ProjetoModel->select('site_colecao_grade_site_colecao','ColecaoGradeID',array('ColecaoID' => $produtoID));
		$grades = '';
		foreach($colecaoGrades as $grade)
			$grades .= $grade['ColecaoGradeID'].',';
		$grades = rtrim($grades,',');	
		if($grades) {
			$colecaoGrades = $this->ProjetoModel->get('site_colecao_grade','ColecaoGradeID IN ('.$grades.')');	
			
			$grades = '';
			foreach($colecaoGrades as $grade) {
				$grades .= $grade['Grade']." ";
				$grades = str_replace('/'," ",$grades);
			}
			$grades = rtrim($grades," ");
			$grades = explode(" ",$grades);
			asort($grades);		
			
			return $grades;
		}
	
	}
	
	public function getColecaoAjax($colecaoID) {
	
		$colecao = $this->get('site_colecao',array('ColecaoID' => $colecaoID),1);
		$colecaoCores = $this->select('site_colecao_cor_imagem','ColecaoCorID,Imagem',array('ColecaoID' => $colecao['ColecaoID']));
		$colecaoGrades = $this->select('site_colecao_grade_site_colecao','ColecaoGradeID',array('ColecaoID' => $colecao['ColecaoID']));
		
		//cores
		$cores = '';
		foreach($colecaoCores as $cor) {
			$cores .= $cor['ColecaoCorID'].',';
			$imgCor[$cor['ColecaoCorID']] = $cor['Imagem'];
		}
		$cores = rtrim($cores,',');		
		$colecaoCores = $this->get('site_colecao_cor','ColecaoCorID IN ('.$cores.')');
		//grades
		$grades = '';
		if($colecaoGrades) {
			foreach($colecaoGrades as $grade)
				$grades .= $grade['ColecaoGradeID'].',';
			$grades = rtrim($grades,',');		
			$colecaoGrades = $this->get('site_colecao_grade','ColecaoGradeID IN ('.$grades.')');
			
			$grades = '';
			foreach($colecaoGrades as $grade) {
				$grades .= $grade['Grade']." ";
				$grades = str_replace('/'," ",$grades);
			}
			$grades = rtrim($grades," ");
			$grades = explode(" ",$grades);
			asort($grades);	
		}

		foreach($colecaoCores as $cor)
			$colecao['cores'][] = array(
					'nome'	 => strtolower($cor['Nome']),
					'cor' 	 => $cor['Cor'],
					'imagem' => imgUpload($imgCor[$cor['ColecaoCorID']],425,216)
				);
			
		//formata as grades para exibição (junta todas as grades em uma string, quebra em array para melhor ordenação)
		$colecao['grades'] = $grades;

		return $colecao;		
	
	}
	
	public function getGeneros($genero = null) {
	
		if($genero) {
			$genero = ucfirst($genero);
			$generos = $this->get('site_colecao_genero',array('Titulo' => $genero),1);	
		} else {
			$generos = $this->get('site_colecao_genero','','','','Titulo ASC');	
		}
		return $generos;
		
	}
	
	public function getLojas($cidadeID) {
	
		if($cidadeID) {
			$lojas = $this->get('site_estabelecimento',array('CidadeID' => $cidadeID),'','','Bairro');
			return $lojas;
		}
	
	}
	
	public function getEstados($sigla = false) {
		if($sigla)
			$campos = 'EstadoID, Sigla';
		else
			$campos = 'EstadoID, Nome';
		$estados = $this->select('site_estado',$campos);
		return $estados;	
	}
	
	public function getEstadosRepresentantes($sigla = false) {
	
		if($sigla)
			$campos = 'EstadoID, Sigla';
		else
			$campos = 'EstadoID, Nome';
			
		$sql = "SELECT DISTINCT EstadoID FROM site_representante";
		$estados = $this->query($sql);
		$estadosID = '';
		foreach($estados as $estado)
			$estadosID .= $estado->EstadoID.",";
		$estadosID = rtrim($estadosID,',');
		$estadosRepresentantes = $this->select('site_estado',$campos,"EstadoID IN({$estadosID})");
		
		return $estadosRepresentantes;
	
	}
	
	public function getPaisesRepresentantes() {
			
		$sql = "SELECT DISTINCT PaisID FROM site_representante WHERE PaisID <> 1"; //tds menos Brasil
		$paises = $this->query($sql);
		$paisesID = '';
		foreach($paises as $pais)
			$paisesID .= $pais->PaisID.",";
		$paisesID = rtrim($paisesID,',');
		$paisesRepresentantes = $this->select('site_pais',$campos,"PaisID IN({$paisesID})");
		
		return $paisesRepresentantes;
	
	}	
	
	public function getCidades($estadoID) {
	
		if($estadoID) {
			$cidades = $this->select('site_cidade','CidadeID, Nome',array('EstadoID' => $estadoID),'RegiaoAtendimento');
			return $cidades;
		}
	
	}
	
	public function getCidadesLojas($estadoID) {
	
		if($estadoID) {
		
			$sql = "SELECT DISTINCT CidadeID FROM site_estabelecimento WHERE EstadoID = {$estadoID} AND CidadeID <> 0";
			$lojas = $this->query($sql);
			$lojasID = '';
			foreach($lojas as $loja)
				$lojasID .= $loja->CidadeID.",";
			$lojasCidadesID = rtrim($lojasID,',');
			
			$cidadesLoja = $this->select("site_cidade","CidadeID, Nome","CidadeID IN({$lojasCidadesID})");
			return $cidadesLoja;
		
		}
	
	}
	
	public function getBairrosCidades($cidadeID) {
	
		if($cidadeID) {
		
			$sql = "SELECT DISTINCT Bairro FROM site_estabelecimento WHERE CidadeID = {$cidadeID} ORDER BY Bairro";
			$bairros = $this->query($sql);
			return $bairros;		
		
		}
	
	}
	
	public function getLojasBairro($cidadeID,$bairro) {
	
		$bairro = strtoupper($bairro);
		$cidadesBairro = $this->get("site_estabelecimento",array('CidadeID' => $cidadeID, 'UPPER(Bairro)' => $bairro));
		return $cidadesBairro;		
	
	}
	
	public function getRepresentantes($estadoID) {
	
		if($estadoID) {
		
			$representantes = $this->get('site_representante',array('EstadoID' => $estadoID));
			return $representantes;
		
		}
	
	}
	
	public function getRepresentantesPais($paisID) {
	
		if($paisID) {
		
			$representantes = $this->get('site_representante',array('PaisID' => $paisID));
			return $representantes;
		
		}
	
	}	
	
	public function insert($tabela, $dados) {
	
		if(!empty($dados)) {
			if(is_array($dados[0]))
				$this->db->insert_batch($tabela,$dados);
			else
				$this->db->insert($tabela,$dados);
		}
		
	}	
	
	public function getBlogContent() {
				
		$this->dbBlog->select('post_title, post_content, guid');
		$this->dbBlog->from('wp_posts');
		$this->dbBlog->where(array('post_status' => 'publish', 'post_type' => 'post'));
		$this->dbBlog->order_by('ID DESC');
		$this->dbBlog->limit(3,0);
		$return = $this->dbBlog->get()->result_array();
		return $return;

	}	
	
}
