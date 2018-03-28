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
<h2>Im�veis</h2>
<table cellspacing="0">
	<thead>
		<tr>
			<td>Modalidade</td>
			<td>Cidade</td>
			<td>�rea</td>
			<td>A��es</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($registros as $registro) : ?>
		<tr>
			<td><?php echo modalidade($registro['modalidade']) ?></td>
			<td><?php echo $registro['cidade'] ?></td>
			<td><?php echo $registro['area'] ?></td>
			<td>
				<?php echo anchor('imovel/editar/'.$registro['id'],'Editar') ?> |
				<?php echo anchor_confirm('imovel/excluir/'.$registro['id'],'Deseja realmente excluir o im�vel?','Excluir'); ?>  
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php echo pagination() ?>