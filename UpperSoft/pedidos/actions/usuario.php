<?php
	testa_sessao();
	
	require("includes/ServerValidator.php");
	
	function VerificaSenha($senha,$campo,$conf_senha) {
		if ($_POST[$conf_senha] != $_POST[$campo]) {
			return false;
		} else {
			return true;			
		}	
	}	
	
	$validacao = new ServerValidator($_POST);
	
	$regras['login'] = "Required|NotNull";
	$regras['senha'] = "Required|NotNull|VerificaSenha(conf_senha)";
	$regras['email'] = "Required|NotNull";
	
	$campos['login'] = "Login";
	$campos['senha'] = "Senha";
	$campos['email'] = "E-mail";
	
	$validacao->setRules($regras);
	$validacao->setFields($campos);
	
	if (count($_POST)>0) {
		
		if ($validacao->Run()) {
			
			if ($_GET['acao'] == 'inserir') {
				$insert = "INSERT INTO usuario(login,senha,email) " .
						"VALUES ('" .
						"'{$_POST['login']}'," .
						"'{$_POST['senha']}'," .
						"'{$_POST['email']}');";
				$query = mysql_query($insert);
				
				if ($query) {
					echo "Registro inserido com sucesso.";
					redirecionar("?pagina=usuario&tabela=usuario");
				} else {
					echo "Erro ao inserir registro, tente novamente.";
				}			
			} elseif ($_GET['acao'] == 'editar') {
				$update = "UPDATE usuario SET login = '{$_POST['login']}', " .
						"senha = '{$_POST['senha']}', email = '{$_POST['email']}'" .
						"WHERE usuario_id = {$_SESSION['usuario_id']}";
				$query = mysql_query($update);						
							
				if ($query) {
					redirecionar("?pagina=usuario&tabela=usuario");
				} else {
					echo "Erro ao alterar registro, tente novamente.";
				}
			}			
			
		} else {
			echo $validacao->getErrorList();
		}		
		
	}
	
	if ($_GET['acao'] == 'editar') {
		if ($_GET['id'] == $_SESSION['usuario_id']) {
			$query = mysql_query("SELECT * FROM usuario WHERE usuario_id = {$_GET['id']}");
			$editar = mysql_fetch_assoc($query);
		} else {
			echo "É permitido alterar apenas o próprio usuário.";
		}		
	}
	
	if ($_GET['acao'] == 'excluir') {
		echo "Por questão de segurança, não é permitido excluir usuários.";
	}
?>