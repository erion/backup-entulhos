<?php
/*
 * Todas as fun��es chamadas aqui pertencem aos helpers
 * 
 * Exemplo: 
 * anchor() -> est� no URL Helper (s� dar uma olhada na documenta��o do CodeIgniter que tem mais detalhes)
 * money()/anchor_confirm() -> t� em "rosana_helper" que eu criei no diretorio application/helpers para ajudar na formata��o
 * 
 */
?>

<h2>Clientes</h2>
<table cellspacing="0">
	<thead>
		<tr>
			<td>Cliente</td>
			<td>Cidade</td>
			<td>Contato</td>
			<td>A��es</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($registros as $registro) : ?>
		<tr>
			<td><?php echo $registro['nome'] ?></td>
			<td><?php echo $registro['cidade'] ?></td>
			<td><?php echo $registro['telefone']," | ",$registro['celular']," | ",$registro['email'] ?></td>
			<td>
				<?php echo anchor('cliente/editar/'.$registro['id'],'Editar') ?> |
				<?php echo anchor_confirm('cliente/excluir/'.$registro['id'],'Deseja realmente excluir o cliente?','Excluir'); ?>  
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php echo pagination() ?>