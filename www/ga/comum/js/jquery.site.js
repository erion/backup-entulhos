//inicializa variaveis p/ n bugar o ie
//variaveis para gráfico "Visitas X Usuários"
var totalVisitas = 0;
var visitas = new Array();
var uniqueVisitors = new Array();	
var meses = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];	
//variaveis para gráfico "Resumo das Fontes de Tráfego"
var buscaOrganica = 0;
var direct = 0;
var referencia = 0;
var outros = 0;
var buscapaga = 0;
$('#resumo-mes').live('click',function(){
	recarregar("getResumoMes");  	
});
$('#trafego-resumo').live('click',function(){
	recarregar("getTrafegoResumo");
});
$('#resumo-anual').live('click',function(){
	recarregar("getResumoAnual");
});
$('#trafego').live('click',function(){
	recarregar("getTrafego");
});
$('#key-words').live('click',function(){
	recarregar("getKeyWords");
});
$('#mes-analise').live('click',function(){
	recarregar("getMesAnalise");
});


 function recarregar( funcao ) {
	var perfil = $('#profileId').val();
	var filtroFrom = $('#from').val();
	var filtroTo = $('#to').val();	
	
	switch(funcao) {
		case 'getTrafegoResumo':
			var trafegoResumo = $('#trafego-resumo');
			trafegoResumo.insertLoader();
			$.get(BASE_URL+'ajax/getTrafegoResumo/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				trafegoResumo.html(data);
				trafegoResumo.removeLoader();
			});			
		break;
		case 'getResumoMes':
			var resumoMes = $('#resumo-mes');
			resumoMes.insertLoader();
			$.get(BASE_URL+'ajax/getResumoMes/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				resumoMes.html(data);
				geraGraficos();
				resumoMes.removeLoader();
			});			
		break;
		case 'getResumoAnual':
			var resumoAnual = $('#resumo-anual');
			resumoAnual.insertLoader();
			$.get(BASE_URL+'ajax/getResumoAnual/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				resumoAnual.html(data);
				resumoAnual.removeLoader();
			});				
		break;
		case 'getTrafego':
			var trafego = $('#trafego');
			trafego.insertLoader();		
			$.get(BASE_URL+'ajax/getTrafego/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				trafego.html(data);
				trafego.removeLoader();
			});			
		break;
		case 'getKeyWords':
			var keyWords = $('#keywords');
			keyWords.insertLoader();
			$.get(BASE_URL+'ajax/getKeyWords/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				keyWords.html(data);
				keyWords.removeLoader();
			});			
		break;		
	}
 }
 
  google.load("visualization", "1", {packages:["corechart"]});
  function drawChartTrafego() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Task');
		data.addColumn('number', 'Visits');        
		data.addRows(5);
		data.setValue(0, 0,'Busca Organica');
		data.setValue(0, 1,buscaOrganica);		
		data.setValue(1, 0,'Tráfego Direto');
		data.setValue(1, 1,direct);
		data.setValue(2, 0,'Sites de Referência');
		data.setValue(2, 1,referencia);
		data.setValue(3, 0,'Outros');
		data.setValue(3, 1,outros);
		data.setValue(4, 0,'Busca Paga');
		data.setValue(4, 1,buscapaga);
		var chart = new google.visualization.PieChart(document.getElementById('grafresumo'));
		chart.draw(data, {width: 420, height: 200, title: 'Resumo das Fontes de Tráfego'});
  } 
  
  function drawChartVisitasXUsuarios() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Mês');
		data.addColumn('number', 'Visitas');
		data.addColumn('number', 'Usuários únicos');		
		data.addRows(totalVisitas);

		for(i=0;i<=totalVisitas-1;i++) {
			data.setValue(i, 0,meses[i]);
			data.setValue(i, 1,visitas[i]);
			data.setValue(i, 2,uniqueVisitors[i]);
		}

		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		chart.draw(data, {width: 500, height: 250, title: 'Visitas x Usuários Únicos',
			  hAxis: {title: '', titleTextStyle: {color: 'red'}}, colors:['#000080','#FFD700'],legend:'bottom',
			  series: [{visibleInLegend: true}]
		});  
  }
  
 function geraGraficos() {
		drawChartTrafego();
		drawChartVisitasXUsuarios();
 }
 
 $(document).ready(function(){		
 
	$('#profileId').change(function(){
		var perfil = $(this).val();
		var perfilNome = $('#profileId option:selected').text();
		var filtroFrom = $('#from').val();
		var filtroTo = $('#to').val();
		
		if( perfil ) {
		
			var trafegoResumo = $('#trafego-resumo');
			var resumoMes = $('#resumo-mes');
			var resumoAnual = $('#resumo-anual');
			var trafego = $('#trafego');
			var keyWords = $('#keywords');
			
			trafegoResumo.insertLoader();
			resumoMes.insertLoader();
			resumoAnual.insertLoader();
			trafego.insertLoader();
			keyWords.insertLoader();
			
			$('#titulo1').html("&nbsp;");
			$('#titulo2').html("&nbsp;");
			
			$.get(BASE_URL+'ajax/getMesAnalise/', {profileID: perfil}, function( data ){
				$('#titulo1').append("<h1 class='titresumo'>Cliente: "+perfilNome+": "+data+"</h1>");
				$('#titulo2').append("<h5 class='titresumo'>Resumo dados mês Análise: "+data+"</h5>");
			});

			$.get(BASE_URL+'ajax/getTrafegoResumo/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				trafegoResumo.html(data);
				trafegoResumo.removeLoader();
			});

			$.get(BASE_URL+'ajax/getResumoMes/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				resumoMes.html(data);				
				geraGraficos();
				resumoMes.removeLoader();
			});
			
			$.get(BASE_URL+'ajax/getResumoAnual/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				resumoAnual.html(data);
				resumoAnual.removeLoader();
			});			

			$.get(BASE_URL+'ajax/getTrafego/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				trafego.html(data);
				trafego.removeLoader();
			});
		
			$.get(BASE_URL+'ajax/getKeyWords/', {profileID: perfil, from: filtroFrom, to: filtroTo}, function( data ){
				keyWords.html(data);
				keyWords.removeLoader();
			});
		}
		
	});

});