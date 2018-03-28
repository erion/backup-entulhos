<?php
/*
 * Todas as funções chamadas aqui pertencem aos helpers
 * 
 * Exemplo: 
 * anchor() -> está no URL Helper (só dar uma olhada na documentação do CodeIgniter que tem mais detalhes)
 * money()/anchor_confirm() -> tá em "rosana_helper" que eu criei no diretorio application/helpers para ajudar na formatação
 * 
 */
?>
<h2>Postos de Combustível</h2>
<table cellspacing="0">
	<thead>
		<tr>
			<td>Cidade</td>
			<td>Tipo</td>
			<td>Localização</td>
			<td>Ações</td>
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