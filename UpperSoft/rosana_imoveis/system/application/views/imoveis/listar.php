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
<h2>Imóveis</h2>
<table cellspacing="0">
	<thead>
		<tr>
			<td>Modalidade</td>
			<td>Cidade</td>
			<td>Área</td>
			<td>Ações</td>
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
				<?php echo anchor_confirm('imovel/excluir/'.$registro['id'],'Deseja realmente excluir o imóvel?','Excluir'); ?>  
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php echo pagination() ?>