// JavaScript Document
// Função para iniciar as demais
$(document).ready(function() {
	linksRetorno();
    linksExternos();
    linksAmpliacao();
    configureEvents();
	configureCSS();
	configurePesquisa();
	configureFilters();
	configurePaginacao();
	
	configureListagem();
	configureSortable();
	
	msgRetorno();
	fixButtonsBar();
	fixCabecalhoTabelas();
});

function msgRetorno(msg_titulo, msg_retorno, msg_imagem){
	if( msg_titulo && msg_retorno ) {
		$.gritter.add({
			title: msg_titulo,
			text: msg_retorno,
			image: msg_imagem,
			time: 3000
		});
	}	
}

function fixCabecalhoTabelas(){
	
	/*if( $.browser.msie != true ) {
		if( $('#__acao').val() != 'cadastro' ) {

			$('#frmDelete').prepend('<table class="tbl-fixed hidden"></table>');
			
			var tbl = $('.tbl-listagem thead').html();
			
			$('.tbl-fixed').html(tbl).width($('.tbl-listagem').width());
			
			$(window).scroll(function(){
				var scrollTop = $(this).scrollTop();
				var topTable = $('.tbl-listagem').offset().top;
				if( scrollTop > topTable ) {
					$('.tbl-fixed').fadeIn('slow').removeClass('hidden');
				} else {
					$('.tbl-fixed').fadeOut('slow').addClass('hidden');
				}
			});
	
		}

	}*/
		
}

// Funcao para inserir _blank em links externos
function linksRetorno() {
	$("a[rel=back]").click( function(){ history.back(); return false });
}

// Funcao para inserir _blank em links externos
function linksExternos() {
	$("a[rel=external]").attr("target", "_blank");
}

function linksAmpliacao() {
	$("a.ampliacao").fancybox();
}

function configureEvents() {

	//REFERENTE AOS CAMPOS DATA DA PESQUISA
	if ($('.date-pick').length > 0) {
		$('.date-pick').datePicker({startDate:'01/01/1996'});
	}
	
}

function configureListagem() {
	$('.tbl-linha').each(
		function() {
			$(this).mouseover(function() { if ($(this).find('td').length > 0) { $(this).find('td').addClass('tbl-linha-over'); } else { $(this).addClass('tbl-linha-over'); }});
			$(this).mouseout(function() { if ($(this).find('td').length > 0) { $(this).find('td').removeClass('tbl-linha-over'); } else { $(this).removeClass('tbl-linha-over'); }});
		}
		
	);
}

function configureCSS() {
	//console.log($.browser);
	//console.log('here');
	if ($.browser.msie) {
		if (parseInt($.browser.version) == 7) {
			$("body").addClass('ie7');
		}
		if (parseInt($.browser.version) <= 6) {
			$("body").addClass('ie6');
		}
	}
}

function configureFilters() {
	if ($('#frmPesquisa').length > 0) {
		var campos = "";
		$('#frmPesquisa input[type!=checkbox][type!=hidden][type!=image][type!=button], #frmPesquisa .input_select').each(
			function() {
				$(this).change(function() { changeField(this); });
				$(this).click(function() { changeField(this); });
				$(this).keyup(function() { changeField(this); });
				$(this).blur(function() { changeField(this); });
			}
		);
		
	}
	
	if ($('.fSimNao').length > 0) {
		$('.fSimNao').click(function() { fSimNaoChangeValue(this); });
	}
}

function configurePesquisa() {
	$('.bt-pesquisar').css('cursor','pointer');
	$('.bt-pesquisar').click(function() {
		$('.pesquisar').slideToggle();	
	});
}

function configurePaginacao() {
	$('#paginacao-topo').html($('#paginacao-rodape').html());
}

function fSimNaoChangeValue(p_field) {
	var modulo;
	var cod = $(p_field).parent().parent().parent().find('input[type=checkbox]').attr('value');
	
	if ($(p_field).parent().parent().parent().hasClass('ajax-listagem')) {
		var objeto = $(p_field);
		while (!objeto.hasClass('tbl-listagem')) {
			objeto = objeto.parent();
		}
		
		modulo = $('#'+objeto.parent().attr('id')+'_modulo').val();
	
	} else {
		modulo = $('#__modulo').val();
	}
	
	
	var field = $(p_field).attr('title').split("#")[0];
	var value = ($(p_field).attr('title').split("#")[1] == 'S') ? 'N' : 'S';
	var url = 'index.php?modulo='+modulo+'&acao=updateField&field='+field+'&cod='+cod+'&value='+value;
	
	
	
	var src = $(p_field).attr('src');
	var src_novo;
	if (value == 'N') {
		src_novo = src.split('true').join('false');
	} else {
		src_novo = src.split('false').join('true');
	}
	
	$.get(url,
		function(dados) {
			$(p_field).attr('title',field+'#'+value);
			$(p_field).attr('src',src_novo);
		}
	);
	
}

function changeField(p_name) {
	var chk = false;

	if ($(p_name).val() != undefined && $(p_name).val() != null && $(p_name).val() != "") {
		chk = true;	
	}
	
	var campo_name = $(p_name).attr('id');
	
	if(campo_name != 'cod_referencia'){
		$('#chk_' + $(p_name).attr('name'))[0].checked = chk;
	}
}


function configureCSS() {
	if ($.browser.msie) {
		if (parseInt($.browser.version) == 7) {
			$("body").addClass('ie7');
		}
		if (parseInt($.browser.version) <= 6) {
			$("body").addClass('ie6');
		}
	}
}

function configureSortable() {
	var titulos = 'ul.tbl-listagem li dt';
	var linhas = 'ul.tbl-listagem li.tbl-linha';
	
	if ($(titulos).length > 0) {
		configureSortableWidths();
				
		$('ul.tbl-listagem').sortable(
			{
				items: 'li.tbl-linha',
				update: function(evt, ui) {
					var arr = $('ul.tbl-listagem').sortable('toArray');
					//console.log(arr);
					for (var i = 0; i<arr.length; i++) {
						arr[i] = String(arr[i]).replace('l','');
					}
					
					arr = arr.join(',');
					urlOrdem = $(this).parent().parent().find('.URL-Ordem').html().split('&amp;').join('&');

					$.post(urlOrdem, { ordem:arr },
					   function(data){
						 $('#aviso-update').html("Ordem alterada com sucesso.\n"+data);
						 $('#aviso-update').show(500).delay(1000).hide(500);
					   }
					);
				}				
			}
		);
		
		$('ul.tbl-listagem').disableSelection();
	}
	
	bindConfigSortableOnResize();
}

var sortableOnResize = false;
var timeoutSortableOnResize = 0;
var timesSortableOnResize = 0;

function bindConfigSortableOnResize() {
	if (!sortableOnResize) {
		sortableOnResize = true;
		$(window).resize(delayedSortableWidths);
	}
}

function delayedSortableWidths() {
	clearTimeout(timeoutSortableOnResize);
	timeoutSortableOnResize = setTimeout(configureSortableWidths, 50);
}

function configureSortableWidths() {
	timesSortableOnResize++;
	
	var titulos = 'ul.tbl-listagem li dt';
	var linhas = 'ul.tbl-listagem li.tbl-linha';
	
	var totalLinhas = $(linhas).length;
	var padding = 30;
	var totalWidth = 0;
	var maiorElementoIndice = '';
	var maiorElementoWidth = 0;
	
	for (var i=0; i<$(titulos).length; i++) {
		var indice = ":nth-child("+(i+1)+")";
		var maxWidth = $(titulos+indice).width() + ((timesSortableOnResize == 1) ? padding : 0);
		var tmpWidth = 0;
		var elemento = " dd"+indice;
		
		for (var j=0; j<=totalLinhas; j++) {
			var indiceLinha = ":nth-child("+(j+1)+")";
			tmpWidth = $(linhas+indiceLinha+elemento).width();
			
			if (tmpWidth > maxWidth) {
				maxWidth = tmpWidth + padding;
			}
		}
	
		if (maxWidth > maiorElementoWidth) {
			maiorElementoWidth = maxWidth;
			maiorElementoIndice = indice;
		}
		
		if (i == 0) {
			maxWidth = 30;
		}
	
		$(titulos+indice).width(maxWidth);
			
		for (var j=0; j<=totalLinhas; j++) {
			var indiceLinha = ":nth-child("+(j+1)+")";
			$(linhas+indiceLinha+elemento).width(maxWidth);
		}
		
		totalWidth += maxWidth;
	}
	
	var tamanhoWidth = $('ul.tbl-listagem li').width();
	
	if (tamanhoWidth < totalWidth) {
		var elemento = " dd"+maiorElementoIndice;
		var falta = $(titulos+maiorElementoIndice).width() - (totalWidth - tamanhoWidth);
		
		$(titulos+maiorElementoIndice).width(falta);		
			
		for (var j=0; j<=totalLinhas; j++) {
			var indiceLinha = ":nth-child("+(j+1)+")";
			$(linhas+indiceLinha+elemento).width(falta);
		}
		
	}
}


// Remoção das imagens no form…
function removerImagem(codimagem, obj) {
	$('#hdn_' + obj + '_' + codimagem).val(codimagem);
	$('#div_' + obj + '_' + codimagem).fadeOut('fast');
}

// Remoção dos Uploads no form…
function removerArquivo(obj) {
	$('#hdnUploadDel_'+obj)[0].checked = true;
	$('#divMsgUpload_'+obj).show();
	$('#divUpload_'+obj).hide();
}

// Campo FCK
function configureFCKEditor() {
	if ($('.fckeditor').length > 0) {
		$('.fckeditor').each(
			function() { convertToFCKEditor($(this).attr('id')); }
		);
	}
}

function convertToFCKEditor(campo) {
	var sBasePath = "./comum/js/fckeditor/";
	var oFCKeditor = new FCKeditor(campo) ;
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ToolbarSet = "Onze";
	oFCKeditor.Height	= 300;
	oFCKeditor.Width	= 450;
	oFCKeditor.ReplaceTextarea();
}

function fixButtonsBar(){
	var bar = $('#form-botoes');
	if (bar.length > 0){
		var barBottom = bar.offset().top + bar.innerHeight(),
			//barBG = $('#bg-form-botoes')
			isFixed = false;
		$(window).scroll(function(){
			var scrollBottom = $(this).scrollTop() + $(this).height();
				
			if( scrollBottom < barBottom){
				if (!isFixed){
					bar.addClass('fixed');
					isFixed = true;
					//console.log('fixed');
				}
			} else {
				if (isFixed){
					bar.removeClass('fixed');
					isFixed = false;
					//console.log('not fixed');
				}
			}
		});
	}
}
