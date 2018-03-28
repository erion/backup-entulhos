<?php


class ProjetoModel extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		
	}
	
	public function get( $tabela, $filtros=array(), $limit='', $pag='', $ordem='', $group_by = '' ) {

		if( $tabela ) {	
		
			$this->db->from( $tabela );		
			$this->db->where('Ativo', 'S');
			
			if($filtros)
				$this->db->where($filtros);

			if($group_by)
				$this->db->group_by($group_by);
			
			if($ordem) 
				$this->db->order_by($ordem);		
			
			if($limit && $pag) {
				$pag = $pag*$limit;
				$this->db->limit($limit, $pag);
			}
			
			if( $limit && !$pag )
				$this->db->limit($limit);
				
			$res = $this->db->get();
			
			// Mostra ultima query realizada...
			//deb($this->db->last_query());
			
			if ( $res->num_rows() == 1 )
				$retorno = $res->row_array();
			else
				$retorno = $res->result_array();
				
			return $retorno;
			
		}
	}
	
	public function query( $sql, $limit = null ) {
		$res = $this->db->query( $sql );

		if( $res === true )
			$retorno = true;
		else
			$retorno = $res->result();
	
		return $retorno;
	}
	
	public function getNovidadesDetalhes( $filtro='' ) {	
		
		return $this->get('site_novidades', '', '', '', array('Url'=>$filtro));
	
	}
	
	public function getMaxGAID() {
	
		$this->db->from('contasga');
		$this->db->select_max('id');
		$maxID = $this->db->get()->row_array();
		if(empty($maxID['id']))
			return 0;
		else 
			return $maxID['id'];
		
	}
	
	public function insert($tabela, $dados) {
	
		if(is_array($dados[0]))
			$this->db->insert_batch($tabela,$dados);
		else
			$this->db->insert($tabela,$dados);
		
	}
	
	public function update($tabela, $dados, $filtro) {
	
		$this->db->where($filtro);
		$this->db->update($tabela,$dados);
	
	}
}
