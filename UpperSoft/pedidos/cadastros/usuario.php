<form method="post">
	<div class="usuario">
		<dl>
			<dt>Login:</dt>
			<dd><input type="text" name="login" value="<?php echo retornar_valor('login') ?>" /></dd>
		</dl>
		<dl>
			<dt>Senha:</dt>
			<dd><input type="password" name="senha" value="<?php echo retornar_valor('senha') ?>" /></dd>
		</dl>
		<dl>
			<dt>Confirmação Senha:</dt>
			<dd><input type="password" name="conf_senha" /></dd>
		</dl>
		<dl>
			<dt>E-mail:</dt>
			<dd><input type="text" name="email" value="<?php echo retornar_valor('email') ?>" /></dd>
		</dl>
		<div class="botoes">
			<input type="submit" value="Salvar" />
			<a href="?pagina=usuario&tabela=usuario">  Cancelar</a>
		</div>	
	</div>				
</form>