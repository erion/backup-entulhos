<?php

class Usuario extends ModuloDB {

	function Usuario($cod=""){
		$this->tabela = "mgr_usuarios";
		$this->modulo = "Usuario";
		$this->tituloModulo = 'USUÁRIOS';
		$this->chave = 'codusuario';
		$this->ModuloDB();

		if ($cod != "") {
			$this->configDb($cod);
		}
	}
	
	function getTableDefinition() {
		$id_usuario = new fId('codusuario',true);
		$nome = new fChar('nome','Nome',true,100);
		$email = new fChar('email','E-mail',true,200);
		$login = new fChar('login','Login',true,50);
		$senha = new fSenha('senha','Senha',true,100);
		$publicar = new fSimNao('publicar','Liberar Acesso');
		$gruposUsuarios = new fManyToMany('codgrupo','Grupos','Grupo', 'titulo','Usuario', 'nome', true);
		
		$campos = array($id_usuario, $nome, $email, $login, $senha, $gruposUsuarios, $publicar);
		
		return $campos;
	
	}
}

