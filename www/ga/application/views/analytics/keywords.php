<div class="boxduplo">
	<?php
	$mes = date('n') - 1; 
	echo '<table id="table" class="tablesorter">
			<thead>
			<tr>
				<th width="120px" class="head">Keywords</th>';
	for($i = 1; $i <= $mes; $i++){ 
		echo '<th>'.getNomeMes($i). '</th>';
	}
	echo '</tr>
		 </thead>
		 <tbody>';							
	foreach($keywords as $key => $row){
		echo '<tr>';
		echo '<td>'.$key.'</td>';
		for($i = 1; $i <= $mes; $i++){ 
			if($row[$i] == ''){
				echo '<td>0</td>';
			}else {
				echo '<td>'.$row[$i].'</td>';
			}
			
		}	
		echo '</tr>';
	}
	echo '</tbody>					
			</table>
	<br />';		
	
	?>
</div>
<div class="boxduplo">
<?php 	
echo '<table class="thduplo table">
			<tr>
				<th width="80%">URL</th>
				<th width="20%">Visitas</th>';
	echo '</tr>';
	
	foreach($urls as $key => $row){
		$url = explode('ga:pagePath=',$key);
		echo '<tr>';
		echo '<td>'. $url[1]. '</td>';
		echo '<td>'. $row. '</td>';
		echo '</tr>';
	}		
	echo'				
			</table>
	<br />';	
?>
</div>