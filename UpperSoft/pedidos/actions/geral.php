<?php
	testa_sessao();
	
	if ($_GET['keepThis'] == true) {
		require("../includes/ServerValidator.php");		
	} else {
		require("includes/ServerValidator.php");		
	}
	
	$validacao = new ServerValidator($_POST);
	
	$regras['descricao'] = "Required|NotNull";
	
	$campos['descricao'] = "{$_GET['tabela']}";
	
	$validacao->setRules($regras);
	$validacao->setFields($campos);
	
	if (count($_POST)>0) {
		
		if ($validacao->Run()) {
			
			if ($_GET['acao'] == 'inserir') {
				$insert = "INSERT INTO {$_GET['tabela']} (descricao) VALUES ('{$_POST['descricao']}')";
				$query = mysql_query($insert);
				
				if (isset($_GET['retorna_id'])) {
					echo mysql_insert_id(); exit;
				}
				
				if ($query) {
					echo "Registro inserido com sucesso.";
					redirecionar("?pagina=geral&tabela={$_GET['tabela']}");
				} else {
					echo "Erro ao inserir registro, tente novamente.";
				}			
			} elseif ($_GET['acao'] == 'editar') {
				$update = "UPDATE {$_GET['tabela']} SET descricao = '{$_POST['descricao']}' WHERE {$_GET['tabela']}_id = {$_GET['id']}";
				$query = mysql_query($update);						
							
				if ($query) {
					redirecionar("?pagina=geral&tabela={$_GET['tabela']}");
				} else {
					echo "Erro ao alterar registro, tente novamente.";
				}
			}			
			
		} else {
			echo $validacao->getErrorList();
		}		
		
	}
	
	if ($_GET['acao'] == 'editar') {
		$query = mysql_query("SELECT descricao FROM {$_GET['tabela']} WHERE {$_GET['tabela']}_id = {$_GET['id']}");
		$editar = mysql_fetch_assoc($query);
	}
	
	if ($_GET['acao'] == 'excluir') {
		mysql_query("DELETE FROM {$_GET['tabela']} WHERE {$_GET['tabela']}_id = {$_GET['id']}");
	}
?>