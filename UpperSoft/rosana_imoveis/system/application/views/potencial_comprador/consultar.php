<h2>Potencial Comprador</h2>
<table>
	<thead>
		<tr>			
			<td>Cliente</td>
			<td>Email</td>
			<td>Celular</td>
			<td>Endereço</td>
			<td>Cidade</td>
			<td>Bairro</td>
			<td>Numero</td>
			<td>Valor</td>
			<td>Ações</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($registros as $registro) : ?>
		<tr>
			<td><?php echo $registro['nome'] ?></td>
			<td><?php echo $registro['email'] ?></td>
			<td><?php echo $registro['celular'] ?></td>
			<td><?php echo $registro['endereco'] ?></td>
			<td><?php echo $registro['cidade'] ?></td>
			<td><?php echo $registro['bairro'] ?></td>
			<td><?php echo $registro['numero'] ?></td>
			<td><?php echo $registro['valor'] ?></td>
			<td>
				<?php echo anchor('potencial_comprador/editar/'.$registro['id'],'Editar') ?> |
				<?php echo anchor_confirm('potencial_comprador/excluir/'.$registro['id'],'Tem certeza disto?','Excluir'); ?>  
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php echo pagination() ?>