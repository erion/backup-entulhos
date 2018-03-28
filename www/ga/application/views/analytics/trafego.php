<?php 				
	echo '<table class="thduplo table">
			<tr>
				<th width="120grádpx">Métrica</th>';
	foreach($visitas as $key => $row){ 
		  echo '<th colspan="2">'.getMesAnalytics($key). '</th>';
	}
	echo '</tr>';
	echo '<tr>
			<td class="head">Tráfego Direto</td>';
	foreach($direct as $key => $row){
		echo '<td>'. number_format($row,0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$key],$row). '</td>';
	}
	echo '</tr>';
	echo '<tr>
			<td class="head">Sites de Referência</td>';
	foreach($referencia as $key => $row){
		echo '<td>'. number_format($row,0,'.','.'). '</td>';
		echo '<td>'. getPercentualParticipacao($visitas[$key],$row). '</td>';
	}
	echo '</tr>';
	echo '<tr>
			<td class="head">Outros</td>';
	foreach($outros as $key => $row){
		
		echo '<td>'. number_format($row,0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$key],$row). '</td>';
	}
	echo '</tr>';
	echo '<tr>
			<td class="head">Buscadores</td>';
	foreach($buscadores as $key => $row){
		
		echo '<td>'. number_format($row,0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$key],$row). '</td>';
	}
	echo '</tr>';
	echo '<tr>
			<td class="ident head">Busca Orgânica</td>';
	foreach($buscaorganica as $key => $row){
		
		echo '<td>'. number_format($row,0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$key],$row). '</td>';
	}
	echo '</tr>';
	
	echo '<tr>
			<td class="ident head">Busca Paga</td>';
	foreach($buscapaga as $key => $row){
		
		echo '<td>'. number_format($row,0,'.','.'). '</td>';
		echo '<td>'. $percent = getPercentualParticipacao($visitas[$key],$row). '</td>';
	}						
	echo '</tr>					
			</table>
	<br />';	
?>