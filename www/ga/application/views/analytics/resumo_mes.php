<?php 
	echo '<table style="width:25%" class="mesatual table">
				<tr>
				<th style="width:50%">Métrica</th>';
	
		echo '<th style="width:50%" colspan="2">'.getMesAnalytics($mesanalise). '</th>';
	
	echo '</tr>';
	echo '<tr>
			<td class="head">Visitas</td>';
	
		echo '<td colspan="2">'. number_format($visitasmesanalise,0,'.','.'). '</td>';
	
	echo '</tr>';	
	echo '<tr>
			<td class="head">Visitantes Únicos</td>';
				
	
		echo '<td colspan="2">'. number_format($unvisitorsanalise,0,'.','.'). '</td>';
	
	echo '</tr>';
	echo '<tr>
		<td class="head">Visualizaçoes de página</td>';
	
		echo '<td colspan="2">'.number_format($pvmesanalise,0,'.','.'). '</td>';
	
	echo '</tr>';
	echo '<tr>
		<td class="head">Conversões</td>';
		echo '<td colspan="2">'.number_format($metas[$mesanalise],0,'.','.'). '</td>';	
	echo '</tr>';
	
	echo '<tr>
			<td class="head">Tráfego Direto</td>';
	
		echo '<td>'. number_format($direct[$mesanalise],0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$mesanalise],$direct[$mesanalise]). '</td>';
	
	echo '</tr>';
	echo '<tr>
			<td class="head">Sites de Referência</td>';
	
		echo '<td>'. number_format($referencia[$mesanalise],0,'.','.') . '</td>';
		echo '<td>'.getPercentualParticipacao($visitas[$mesanalise],$referencia[$mesanalise]). '</td>';
		
	echo '</tr>';
	echo '<tr>
			<td class="head">Outros</td>';
		echo '<td>'. number_format($outros[$mesanalise],0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$mesanalise],$outros[$mesanalise]). '</td>';
		
	echo '</tr>';
	echo '<tr>
			<td class="head">Buscadores</td>';
		echo '<td>'. number_format($buscadores[$mesanalise],0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$mesanalise],$buscadores[$mesanalise]). '</td>';
	
	echo '</tr>';
	echo '<tr>
			<td class="ident head">Busca Paga</td>';
		echo '<td>'. number_format($buscapaga[$mesanalise],0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$mesanalise],$buscapaga[$mesanalise]). '</td>';
	echo '</tr>';
	echo '<tr>
			<td class="ident head">Busca Organica</td>';
		echo '<td>'.number_format($buscaorganica[$mesanalise],0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$mesanalise],$buscaorganica[$mesanalise]). '</td>';
	echo '</tr>					
			</table>
	<br />';		
	?>
	<div class="grafico">
		<div id="grafresumo"></div>
		<div id="chart_div"></div>
	</div>	
	
<!-- Scripts -->
    <script type="text/javascript">
		//variaveis para gráfico "Visitas X Usuários"
		totalVisitas = <?=count($visitas)?>;
		//var visitas = new Array();
		<?php $i=0;foreach($visitas as $visita): ?>
			visitas[<?=$i?>] = <?=$visita?>;
		<?php $i++;endforeach;?>
		//var uniqueVisitors = new Array();
		<?php $i=0;foreach($uniquevisitors as $uniquevisitor): ?>
			uniqueVisitors[<?=$i?>] = <?=$uniquevisitor?>;
		<?php $i++;endforeach;?>		
		//var meses = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];	
		//variaveis para gráfico "Resumo das Fontes de Tráfego"
		buscaOrganica = <?=(int)$buscaorganica[$mesanalise]?>;
		direct = <?=(int)$direct[$mesanalise]?>;
		referencia = <?=(int)$referencia[$mesanalise]?>;
		outros = <?=(int)$outros[$mesanalise]?>;
		buscapaga = <?=(int)$buscapaga[$mesanalise]?>;
    </script>