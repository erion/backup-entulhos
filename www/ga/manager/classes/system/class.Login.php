<?php
class Login extends ModuloDB {
	function Login() {
		$this->visible = false;
	}
	
	function getAcaoPadrao() {
		return "formLogin";
	}
	
	function formLogin() {
		$login = new fChar('txtUsuario','Usuário',true,200);
		$senha = new fSenha('txtSenha','Senha', true,200); // terceiro parametro define uso de hora junto no campo
		$campos = array($login, $senha);
		$tpl = new Form($campos,get_class($this),"validar","","login_form");
		
		return $tpl;
	}
	
	function validar() {
		if (isset($_POST['txtUsuario']) && isset($_POST['txtSenha']) && $_POST['txtUsuario'] != '' && $_POST['txtSenha'] != '') {
			$db = new db();
			
			$txtUsuario = Utils::clear($_POST['txtUsuario']);
			$txtSenha = Utils::clear($_POST['txtSenha']);
			
			$query = "SELECT codusuario FROM mgr_usuarios WHERE login='".$txtUsuario."' AND senha='".$txtSenha."' AND publicar='S'";
			$rs = $db->query($query);
			
			if ($rs->recordCount() > 0) {
				$_SESSION[SESSION_FIELD_NAME] = SESSION_NAME;
				$_SESSION[SESSION_USER_ID] = $rs->fields('codusuario');
			} else {
				Application::$instance->resetSession("Usuário/senha inválidos!");
			}
		}
		
		return "index.php";		
	}
	//MÉTODO PARA LOGOUT
	function logout() {
		Application::$instance->resetSession("Logout efetuado!");
		return 'index.php';
	}
	
}

?>