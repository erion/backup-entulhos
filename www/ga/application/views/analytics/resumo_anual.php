<?php 
	echo '<table class="table">
				<tr>
				<th width="120px" class="head">Métrica</th>';
	foreach($visitas as $key => $row){ 
		echo '<th>'.getMesAnalytics($key). '</th>';
	}
	echo '</tr>';
	echo '<tr>
			<td class="head">Visitas</td>';
	foreach($visitas as $key => $row){
		echo '<td>'. number_format($row,0,'.','.'). '</td>';
	}
	echo '</tr>';	
	echo '<tr>
			<td class="head">Usuários Únicos</td>';
				
	foreach($uniquevisitors as $key => $row){
		echo '<td>'. number_format($row,0,'.','.'). '</td>';
	}
	echo '</tr>';
	echo '<tr>
		<td class="head">Pageviews</td>';
	foreach($pageviews as $key => $row){
		echo '<td>'.number_format($row,0,'.','.'). '</td>';
	}
	echo '</tr>';
	echo '<tr>
		<td class="head">Metas</td>';
	foreach($metas as $key => $row){
		echo '<td>'.number_format($row,0,'.','.'). '</td>';
	}		
	echo '</tr>					
			</table>
	<br />';		
	
	?>