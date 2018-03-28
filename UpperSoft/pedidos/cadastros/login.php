<form action="" method="post">
	<div class="login">
		<dl>
			<dt>Login:</dt>
			<dd><input type="text" name="login" size="15" maxlegth="20"></dd>
		</dl>
		<dl>
			<dt>Senha:</dt>
			<dd><input type="password" name="senha" size="15" maxlegth="15"></dd>		
		</dl>
		<dl>
			<dt>&nbsp;</dt>
			<dd><div class="ok"><input type="submit" value="OK"></div><a href="esqueci_senha.php">Esqueci a senha</a></dd>		
		</dl>
		<?php
			if (isset($erro)) {
				echo $erro;
			}
		?>
	</div>			
</form>
