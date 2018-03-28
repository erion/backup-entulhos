$(document).ready(function(){		
	switch ($('body').attr('id')){
		case 'home':
			$('#slides').slides({
				play: 5000,
				pause:1,
				hoverPause: true,
				generatePagination: false,
				prev: 'btn-prev',
				next: 'btn-next'
			});
		break;
		case 'ondeEncontrar':
			initScrollPane();

			$('#loja-estado').change(function(){
				var estado = $(this).val();
				if(estado) {
					$.get(BASE_URL+'ajax/getCidades', {EstadoID: estado}, function( data ){
						$('#loja-cidade').html(data);
					});
				}
			});
			
			$('#loja-cidade').change(function(){
				var cidade = $(this).val();
				if(cidade) {
					$.get(BASE_URL+'ajax/getLojas', {CidadeID: cidade}, function( data ){
						$('#lst-lojas').html(data);
						initScrollPane();
					});
					$.get(BASE_URL+'ajax/getBairrosCidade', {CidadeID: cidade}, function( data ){
						$('#loja-bairro').html(data);
					});					
				}
			});
			
			$('#loja-bairro').change(function(){
				var bairro = $(this).val();
				var cidade = $('#loja-cidade').val();
				if(bairro) {
					$.get(BASE_URL+'ajax/getLojasBairro',{Bairro:bairro, CidadeID:cidade},function(data){
						$('#lst-lojas').html(data);
						initScrollPane();
					});
				}
			});
			
			$('#repres-estado').change(function(){
				var estado = $(this).val();
				if(estado) {
					$.get(BASE_URL+'ajax/getRepresentantes', {EstadoID: estado}, function( data ){
						$('#lst-representantes').html(data);
						initScrollPane();
					});
				}				
			});
			
			$('#repres-pais').change(function(){
				var pais = $(this).val();
				if(pais) {
					$.get(BASE_URL+'ajax/getRepresentantesPais', {PaisID: pais}, function( data ){
						$('#lst-representantes').html(data);
						initScrollPane();
					});
				}				
			});			
		break;
		case 'colecao':
			initScrollPane();
			
			$('.lst-colecao a')
				.mouseover(function(){
					$(this).parents('li').addClass('hover');
				})
				.mouseleave(function(){
					$(this).parents('li').removeClass('hover');
				});
		break;
		case 'colecao-detalhes':
		
			//troca a cor caso seja colocado o link direto na barra
			var filtroCor = $(location).attr('hash');
			$('#colecao-cor').find('a[href|="'+filtroCor+'"]').trigger('click');
			
			var imageContainer = $('#img-container'),		//controles do carrossel
				carousel = $('#carrossel-thumbs'),
				carouselLength = carousel.find('li').length,
				carouselCurrent = 1,
				theCarousel = null,							//fim dos controles
				selectedColor = $('#colecao-cor > li:first-child');//guarda o <li> com o <a> da cor selecionada

			carousel.jcarousel({
				initCallback: function(internalCarousel){
					theCarousel = internalCarousel;
				}
			});
			
			carousel.find('a').click(function() {

				var target = $(this).attr('href'),
					image = new Image(),
					colecaoID = $(this).attr('rel');
					
				refreshColecao(colecaoID);					
				carouselCurrent = $(this).parent().index() + 1;
				
				$(this).parent().addClass('current').siblings('.current').removeClass('current');
				
				image.src = target;
				
				if (!image.complete){
					imageContainer.insertLoader();
					image.onload = function(){
						imageContainer.fadeOut('fast', function(){
							$(this)
								.html(image)
								.fadeIn('fast');
						}).removeLoader();
					}
				} else
					imageContainer.fadeOut('fast', function(){
						$(this)
							.html(image)
							.fadeIn('fast');
					});

				return false;
			});
			
			$('#btn-next-img').click(function(){
				if($('#colecao-cor > li.current').next().is('li')) {
					selectedColor = $('#colecao-cor > li.current').next();
					selectedColor.addClass('current').siblings('.current').removeClass('current');
					changeImg(selectedColor);
				}
			});
			$('#btn-prev-img').click(function(){
				if($('#colecao-cor > li.current').prev().is('li')) {
					selectedColor = $('#colecao-cor > li.current').prev();
					selectedColor.addClass('current').siblings('.current').removeClass('current');
					changeImg(selectedColor);
				}
			});
			
			$('#carrossel-thumbs .jcarousel-next').click(function(){
				if (carouselCurrent < carouselLength){
					carouselCurrent++;
					moveCarousel();
				}
				return false;
			});
			$('#carrossel-thumbs .jcarousel-prev').click(function(){
				if (carouselCurrent > 1){
					carouselCurrent--;
					moveCarousel();
				}
				return false;
			});			

			function moveCarousel(){
				theCarousel.scroll($.jcarousel.intval(carouselCurrent));
				carousel.find('a').eq(carouselCurrent -1).click();
			}
			
			if ($('.twitter-share-button').length > 0)
				!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		break;
		case 'campanha':		
		
			$('a.fancy-campanha').fancybox({
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',			
				'width'			: 640,
				'height'		: 480,
				'type'			: 'inline'
			});
			
			$('#carrossel-thumbs').jcarousel({
				vertical:true
			});

			/*
			$('#book-campanha').booklet({
				pageNumbers:false,
				pagePadding:0,
				hoverWidth:100,
				width:700,
				height:450,
				closed:true,
				autoCenter:true,
				//covers:true,
				next:'#btn-next-img',
				prev:'#btn-prev-img'
				//arrows:true
			});
			*/
		break;
		case 'contato':
			$('.mapa a').fancybox({
				'width': 640,
				'height': 480,
				'type': 'iframe'
			});
		break;
	}
});

function campanhaImgChange(selected) {
	var selected = $(selected).parent().parent().parent().parent().parent().parent();
	console.log($(selected).attr('class'));
	selected.addClass('current').siblings('.current').removeClass('current');
}

function initScrollPane(){
	$('.overflow').jScrollPane({
		verticalDragMaxHeight: 11,
		showArrows: true
	});
}

function changeImg(selector) {

	var imageContainer = $('#img-container'),
		image = new Image();

	if(!$(selector).is('li'))
		selectedColor = $(selector).parent();
	else 
		selectedColor = selector;
	selectedColor.addClass('current').siblings('.current').removeClass('current');
	
	image.src = selectedColor.attr('rel');
	
	if (!image.complete){
		imageContainer.insertLoader();
		image.onload = function(){
			imageContainer.fadeOut('fast', function(){
				$(this)
					.html(image)
					.fadeIn('fast');
			}).removeLoader();
		}
	} else
		imageContainer.fadeOut('fast', function(){
			$(this)
				.html(image)
				.fadeIn('fast');
		});
		
	
	return false;
}

function refreshColecao(id) {
	$.post(BASE_URL+'ajax/colecaoDetalhe/'+id, function( data ){
		var colecao = $.parseJSON(data);
		$('#colecao-nome').html(colecao.Nome);
		$('#colecao-referencia').html(colecao.Referencia);
		var cores = '', 
			grades = '',
			corImagem = '',
			classe = 'class="current"';
		
		for(i=0;i<colecao.cores.length;i++) {
			if(i>0) classe = '';
			cores = cores + '<li rel="'+colecao.cores[i].imagem+'" '+classe+' style="background-color:#'+colecao.cores[i].cor+'"><a id="'+colecao.cores[i].cor+i+'" href="#'+colecao.cores[i].nome+'" onClick="changeImg(\'#'+colecao.cores[i].cor+i+'\');">&nbsp;</a></li>';
		}

		$('#colecao-cor').html(cores);
		for(i=0;i<colecao.grades.length;i++)
			grades = grades + '<li>'+colecao.grades[i]+'</li>';
		$('#colecao-grade').html(grades);
		
		var url = $(location).attr('pathname');
		url = url.match(/\/[a-z]*/g);
		//local
		var lang = url[2]+'/';
		lang = lang.replace('/','');
		var filtro = url[4]+'/';
		//server, não tem o "Site", verificar esta url
		//var filtro = url[3]+'/';
		window.history.pushState({quaquerCoisa: 'issoissoisso'}, colecao.Nome, BASE_URL+lang+'colecao'+filtro+colecao.Url );
		//$('#colecao-cor > li > a:first').trigger('click');
	});	
}