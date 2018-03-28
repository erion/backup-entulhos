<form method="post">
	<div class="companhia">
		<dl>
			<dt>Nome:</dt>
			<dd><input type="text" name="nome" value="<?php echo retornar_valor('nome'); ?>"/></dd>
		</dl>
		<dl>
			<dt>Endereço:</dt>
			<dd><input type="text" name="endereco" value="<?php echo retornar_valor('endereco');?> "/></dd>
		</dl>
		<dl>
			<dt>País:</dt>
			<dd>			
				<select name="pais">
					<?php foreach ($paises as $valor): ?>
					<option value="<?php echo $valor["pais_id"]; ?>"<?php echo retornar_selecionado("pais",$valor["pais_id"],"pais_id") ?> ><?php echo $valor["descricao"]; ?></option>
					<?php endforeach; ?>
				</select>
			</dd>
		</dl>		
		<dl>
			<dt>Telefone:</dt>
			<dd><input type="text" name="telefone" value="<?php echo retornar_valor('fone'); ?>"/></dd>
		</dl>
		<dl>
			<dt>Celular:</dt>
			<dd><input type="text" name="celular" value="<?php echo retornar_valor('celular'); ?>"/></dd>
		</dl>
		<dl>
			<dt>Contato:</dt>
			<dd><input type="text" name="contato" value="<?php echo retornar_valor('contato'); ?>"/></dd>
		</dl>
		<dl>
			<dt>Tipo:</dt>
			<dd>
			<?php if($_GET['acao'] == 'editar'): ?>
				<input type="radio" name="tipo" value="COMPANHIA" <?php if ($editar['tipo']=='COMPANHIA') echo 'checked'; ?>/> Compania
				<input type="radio" name="tipo" value="FABRICA" <?php if ($editar['tipo'] == 'FABRICA') echo 'checked'; ?> /> Fábrica
				<input type="radio" name="tipo" value="CURTUME" <?php if ($editar['tipo'] == 'CURTUME') echo 'checked'; ?>/> Curtume			
			<?php else: ?>
			</dd>			
			<dd>
				<input type="radio" name="tipo" value="COMPANHIA" <?php echo retornar_checado("tipo","COMPANHIA") ?> /> Compania
				<input type="radio" name="tipo" value="FABRICA" <?php echo retornar_checado("tipo","FABRICA") ?> /> Fábrica
				<input type="radio" name="tipo" value="CURTUME" <?php echo retornar_checado("tipo","CURTUME") ?> /> Curtume
			</dd>
			<?php endif; ?>
		</dl>	
		<div class="botoes">
			<input type="submit" name="salvar" value="Salvar"/>
			<a href="?pagina=companhia&tabela=companhia">  Cancelar</a>
		</div>	
	</div>
</form>	