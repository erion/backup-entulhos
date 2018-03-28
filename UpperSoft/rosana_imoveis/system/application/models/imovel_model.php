<?php
class Imovel_Model extends Model {
	
	var $table = 'imovel';
	
	function Imovel_Model() {
		parent::Model();
	}
	
	function listar_dropdown() {
		return SQL::id_value('imovel_categoria',array('id','nome'));
	}	
	
	function listar($pagina=0) {
		return SQL::result(
			$this->table,
			array(
				'`imovel`.`id`',
				'`imovel`.`modalidade`',
				'`imovel`.`tipo`',
				'`imovel`.`area`',
				'`imovel`.`valor`',
				'`imovel`.`cidade`'
			),
			'',
			'',
			'ASC',
			$pagina,
			$this->config->item('per_page'),
			array(
			)
		);
	}
	
	function detalhes($id) {
		return SQL::row($this->table,'*',array('id' => $id));
	}
	
	function total_consulta() {
		
	}
	
	function consulta($pagina=0) {

	}
	
	function cadastrar($categoria,$modalidade,$construcao,$tipo,$quartos,$area,$valor,$cidade,$uf,$endereco,$numero,$apto,$bairro,$descricao) {
		return SQL::insert($this->table, array(
				'categoria' => $categoria,
				'modalidade' => $modalidade,
				'construcao' => $construcao,
				'tipo' => $tipo,
				'quartos' => $quartos,
				'area' => $area,
				'valor' => $valor,
				'cidade' => $cidade,
				'uf' => $uf,
				'endereco' => $endereco,
				'numero' => $numero,
				'apto' => $apto,
				'bairro' => $bairro,
				'descricao' => $descricao
		));
	}
	
	function editar($id,$categoria,$modalidade,$construcao,$tipo,$quartos,$area,$valor,$cidade,$uf,$endereco,$numero,$apto,$bairro,$descricao) {
		return SQL::update($this->table, array(
				'categoria' => $categoria,
				'modalidade' => $modalidade,
				'construcao' => $construcao,
				'tipo' => $tipo,
				'quartos' => $quartos,
				'area' => $area,
				'valor' => $valor,
				'cidade' => $cidade,
				'uf' => $uf,
				'endereco' => $endereco,
				'numero' => $numero,
				'apto' => $apto,
				'bairro' => $bairro,
				'descricao' => $descricao
		),'`id` = '.$id);
	}
	
	function excluir($id) {
		return SQL::delete($this->table,array('id' => $id));
	}
	
	function total() {
		return SQL::total($this->table);
	}	
	
}
?>
