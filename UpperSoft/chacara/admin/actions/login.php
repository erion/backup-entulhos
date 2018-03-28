<?php
	if (count($_POST) > 0) {
		if ($usuarios[$_POST['login']] == $_POST['senha']) {
			$_SESSION['login'] = $_POST['login'];
			redirecionar("index.php?pagina=home&a=geral");
		}
	} 
?>