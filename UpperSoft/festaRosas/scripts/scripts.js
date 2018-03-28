$(document).ready(function() {
	
	$(".listaPrincipal li a").click(function(){
		var conteudo = $(this).attr("id");
		
		$.ajax({
			type: "POST",
			url: "templates/"+conteudo+".php",
			success: function(resposta){
				$("#conteudo").html(resposta);
				$.scrollTo( '+=500' , 800 );
			}
		});
		
		return false;
		
	});
	
});
