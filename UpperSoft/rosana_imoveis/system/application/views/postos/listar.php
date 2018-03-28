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
<h2>Postos de Combust�vel</h2>
<table cellspacing="0">
	<thead>
		<tr>
			<td>Cidade</td>
			<td>Tipo</td>
			<td>Localiza��o</td>
			<td>A��es</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($registros as $registro) : ?>
		<tr>
			<td><?php echo $registro['cidade'] ?></td>
			<td><?php echo tipo($registro['tipo']) ?></td>
			<td><?php echo localizacao($registro['localizacao']) ?></td>
			<td>
				<?php echo anchor('posto/editar/'.$registro['id'],'Editar') ?> |
				<?php echo anchor_confirm('posto/excluir/'.$registro['id'],'Deseja realmente excluir o posto?','Excluir'); ?>  
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php echo pagination() ?>