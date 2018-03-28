<form method="post">
	<div class="geral">
		<dl>
			<dt><?php echo $tabelas[$_GET['tabela']]; ?>:</dt>
			<?php if ($_GET['acao'] == 'editar' ): ?>
				<dd><input type="text" name="descricao" value="<?php echo $editar['descricao'] ?>" size="20" maxlegth="25" /></dd>
			<?php else: ?>
				<dd><input type="text" name="descricao" value="" size="20" maxlegth="25" /></dd>
			<?php endif; ?>			
		</dl>
		<div class="botoes">
			<input type="submit" name="salvar" value="Salvar" />		
			<a href="?pagina=geral&tabela=<?php echo $_GET['tabela'] ?>">  Cancelar</a>
		</div>				
	</div>			
</form>