<?php
class Grupo extends ModuloDB{
	var $tabela = "mgr_grupos";
	var $modulo = "Grupo";
	var $tituloModulo = 'GRUPOS';
	var $chave = 'codgrupo';

	function Grupo($cod=""){
		$this->ModuloDB();
		
		if ($cod != "") {
			$this->configDb($cod);
		}
	}
	
	function cadastrarUsuario($codusuario,$codgrupo=false) {
		if (!$codgrupo && isset($this) && isset($this->campos['codgrupo']) && is_numeric($this->campos['codgrupo'])) {
			$codgrupo = $this->campos['codgrupo'];
		}
		
		if (is_numeric($codgrupo) && is_numeric($codusuario)) {
			$db = new db();
			$query = "INSERT INTO mgr_grupos_usuarios (codgrupo, codusuario) VALUES ('".$codgrupo."','".$codusuario."')";
			$rs = $db->query($query);
		}
	}
	
	function cadastrarModulo($codmodulo,$codgrupo=false) {
		if (!$codgrupo && isset($this) && isset($this->campos['codgrupo']) && is_numeric($this->campos['codgrupo'])) {
			$codgrupo = $this->campos['codgrupo'];
		}
		
		if (is_numeric($codgrupo) && is_numeric($codmodulo)) {
			$db = new db();
			$query = "INSERT INTO mgr_grupos_modulos (codgrupo, codmodulo) VALUES ('".$codgrupo."','".$codmodulo."')";
			$rs = $db->query($query);
		}
	}

	function getTableDefinition() {
		$codgrupo = new fId('codgrupo',true);
		$titulo = new fChar('titulo','Título',true,50);
		$gruposUsuarios = new fManyToMany('codusuario','Usuários','Grupo', 'nome','Usuario', 'titulo', true);
		$gruposModulos = new fManyToMany('codmodulo','Módulos','Grupo','titulo','Modulo', 'titulo', true);
		$publicar = new fSimNao('publicar','Liberar Acesso');
		
		$campos = array($codgrupo, $titulo, $gruposUsuarios, $gruposModulos, $publicar);
		return $campos;
	}
}
?>