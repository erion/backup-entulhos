<?php
	if ($_GET['sessao'] == 'fim') {
		session_destroy();
		redirecionar("index.php?pagina=logincadastro");
	}
	
	if ($_SESSION['usuario'] != '') {
		redirecionar("index.php?pagina=pedido&tabela=pedido");
	} else {
		if (count($_POST) > 0 ) {
			
			$_SESSION['usuario'] = $_POST['login'];
			$_SESSION['senha'] = $_POST['senha'];
			
			$logar = mysql_query("SELECT * FROM usuario WHERE login = '{$_SESSION['usuario']}' AND senha = '{$_SESSION['senha']}'");		
			$resultado = mysql_fetch_assoc($logar);

			if ($resultado) {
				$_SESSION['usuario_id'] = $resultado['usuario_id'];					
				header('Location: index.php?pagina=pedido&tabela=pedido');
			} else {
				$_SESSION['usuario'] = '';
				$_SESSION['senha'] = '';				
				session_destroy();
				$erro = "Login ou senha não conferem.";
			}
		} 
	}
?>
