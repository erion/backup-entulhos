<?php

class Modulo extends ModuloDB{

	function Modulo($cod=""){
		$this->tabela = "mgr_modulos";
		$this->modulo = "Modulo";
		$this->tituloModulo = 'MÓDULOS';
		$this->chave = 'codmodulo';
		$this->SQL_ORDER = "ordem";
		$this->ModuloDB();
		if ($cod != "") {
			$this->configDb($cod);
		}
	}
	
	function getTableDefinition() {
		$codmodulo = new fId('codmodulo',true);
		$classe = new fChar('classe','Classe',true,50);
		$titulo = new fChar('titulo','Título',true,50);
		$categoria = new fComboAdd('codcategoria','Categoria','titulo','mgr_modulos_categorias',$this->modulo);
		$ordem = new fInt('ordem','Ordem',true);

		$campos = array($codmodulo, $classe, $titulo, $categoria, $ordem);
		
		return $campos;
	}
	
	function cadastrarCategoria($titulo) {
		$db = new db();
		$query = "INSERT INTO mgr_modulos_categorias (titulo) VALUES ('".$titulo."')";
		$rs = $db->query($query);
		
		$query = "SELECT codcategoria FROM mgr_modulos_categorias ORDER BY codcategoria DESC LIMIT 1";
		$rs = $db->query($query);
		
		$codcategoria = $rs->fields('codcategoria');
		return $codcategoria;
	}
	
	function capturarCategoriaPorTitulo($titulo,$createIfNotExists=false) {
		$cod = 0;
		
		$db = new db();
		$query = "SELECT codcategoria FROM mgr_modulos_categorias WHERE titulo='".$titulo."'";
		$rs = $db->query($query);
		
		if (!$rs->EOF) {
			$cod = $rs->fields('codcategoria');
		} else if ($createIfNotExists) {
			$cod = Modulo::cadastrarCategoria($titulo);
		}
		
		return $cod;
	}
	
	function proximoNumero($codcategoria=0) {
		$db = new db();
		$query = "SELECT (MAX(ordem)+1) AS proximo FROM mgr_modulos WHERE codcategoria=".$codcategoria;
		$rs = $db->query($query);
		
		return $rs->fields('proximo');
	}
}

?>
