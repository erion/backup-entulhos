Ext.override(Ext.form.HtmlEditor, {
	cssRules : this.cssRules,
	getDocMarkup : function(){
		return '<html><head><style type="text/css">'+this.cssRules+'</style>' +
	(this.stylesheet ? '<link href="' + this.stylesheet + '"  rel="stylesheet" type="text/css">' : '') +
	'</head><body></body></html>';
	}
});

function excluir_contato(selector,contato) {
    if(confirm('Este contato não receberá mais nenhuma mensagem do sistema. \nDeseja excluir este contato?')) {
        $.post(getBaseURL()+'index.php/usuarios/excluir_contato/'+contato,null,function(data) {
            var remover_classe = '#'+selector;
            $(remover_classe).remove();
        });
    }
}

var mostra_menu = true;
//var menu = null;

function esconder_menu() {
    $('#esconder_menu').animate({width:'toggle'},500);
    if (mostra_menu) {
        $('#contrair').attr('id','expandir');
        $('#conteudo').animate({width:'95%'},510);
    } else {
        $('#expandir').attr('id','contrair');
        if(uri_segment2 == 'visualizar_resumo')
            $('#conteudo').animate({width:'50%'},350);
        else
            $('#conteudo').animate({width:'77%'},350);
    }
	if (navigator.appName == "Microsoft Internet Explorer") {
		$('#filtro').hide();
		$('#filtro').show();
	}
    mostra_menu = !mostra_menu;
//    menu = $.cookie('mostra_menu',mostra_menu.toString(),{path:'/eurico_intranet_php/'});
}
/*
function cookie_esconder_menu() {
    var cookie = $.cookie('mostra_menu',mostra_menu.toString(),{path:'/eurico_intranet_php/'});
    if(cookie != mostra_menu)
        $('#esconder_menu').animate({width:'toggle'},500);
    if (!cookie) {
        $('#contrair').attr('id','expandir');
        $('#conteudo').animate({width:'95%'},510);
    } else {
        $('#expandir').attr('id','contrair');
        if(uri_segment2 == 'visualizar_resumo')
            $('#conteudo').animate({width:'50%'},350);
        else
            $('#conteudo').animate({width:'77%'},350);
    }
}*/

var mostra_filtro = true;

function esconder_filtro() {
    $('#form_filtro').slideToggle();
    if (!mostra_filtro) {
        document.images['filtro'].src = getBaseURL()+'assets/img/seta_dir.gif';
		$('#form_filtro').slideDown();
    } else {
        document.images['filtro'].src = getBaseURL()+'assets/img/seta_baixo.gif';
		$('#form_filtro').slideUp();
    }
    mostra_filtro = !mostra_filtro;
}

function isArray(obj) {
   if (obj.constructor.toString().indexOf("Array") == -1)
      return false;
   else
      return true;
}

function is_int(valor) {
    return !isNaN(parseInt(valor *1));
}

function get_form_fields_object(selector) {
    var array_serialized = $(selector).serializeArray();
    var fields_object = new Object();
        for(var i = 0;i < array_serialized.length;i++) {
            if (fields_object[array_serialized[i].name]) {
                if (isArray(fields_object[array_serialized[i].name])) {
                    fields_object[array_serialized[i].name].push(array_serialized[i].value);
                } else {
                    fields_object[array_serialized[i].name] = new Array(fields_object[array_serialized[i].name], array_serialized[i].value);
                }
            } else {
                fields_object[array_serialized[i].name] = array_serialized[i].value;
            }
        }
    return fields_object;
}

var fieldArray = new Array();
function transform_js_field(elementId, myOptions) {
	var converted = null;

	$('#'+elementId+" :input").each(function(){
		var type = $(this).attr('type');
		elementId = $(this).attr('id');
		if(elementId != null && type != null) {

			switch( type ) {
				case 'select-one':
					options = $.extend({
						emptyText:$(this).attr("placeholder"),
						typeAhead: true,
						triggerAction: 'all',
						transform: elementId,
						id:elementId,
						width:$(this).attr("size"),
						mode:'local',
						//minListWidth:100,
						forceSelection:true
					}, myOptions);
					converted = new Ext.form.ComboBox(options);
				break;
				case 'select-multiple':
					options = $.extend({
						emptyText:$(this).attr("placeholder"),
						typeAhead: true,
						triggerAction: 'all',
						transform: elementId,
						id:elementId,
						width:$(this).attr("size"),
						mode:'local',
						//minListWidth:100,
						forceSelection:true
					}, myOptions);
					converted = new Ext.ux.form.SuperBoxSelect(options);
				break;
				case 'text':
					options = $.extend({
						emptyText:$(this).attr("placeholder"),
						typeAhead: true,
						triggerAction: 'all',
						id:elementId,
						name:elementId,
						width:$(this).attr("size")
					}, myOptions);
					if($(this).attr('rel') == 'data')
						converted = new Ext.form.DateField(options);
					else if($(this).attr('rel') == 'hora')
						converted = new Ext.form.TimeField(options);
					else if($(this).attr('rel') == 'mes') {
						options.plugins ='monthPickerPlugin';
						options.format = 'm/Y';
						converted = new Ext.form.DateField(options);
					} else if($(this).attr('rel') == 'file') {
						options.xtype = 'fileuploadfield';
						options.buttonText = '';
						options.buttonCfg = {iconCls: 'upload-icon'};
						converted = new Ext.form.FileUploadField(options);
					} else
						converted = new Ext.form.TextField(options);
					converted.applyToMarkup(elementId);
				break;
				case 'file'://file = text que a Ext converte
				break;
				case 'password':
					options = $.extend({
						name: elementId,
						inputType: type,
						//fieldLabel: 'Nome',
						width:$(this).attr("size")
					}, myOptions);
					converted =  new Ext.form.TextField(options);
					converted.applyToMarkup(elementId);
				break;
				case 'textarea':
					options = $.extend({
						name: elementId,
						//fieldLabel: 'Nome',
						width:$(this).attr("size")
						//height: 100
					}, myOptions);
					converted =  new Ext.form.HtmlEditor(options);
					converted.applyToMarkup(elementId);
				break;
			}
			fieldArray.push( converted );

		}
	});
}

$(document).ready(function(){
/*
    $.cookie('mostra_filtro',true);
    
    menu = $.cookie('mostra_menu',{path:'/eurico_intranet_php/'});

    if(menu == null) {
        alert("oi");
        menu = $.cookie('mostra_menu','true',{path:'/eurico_intranet_php/'});
    }
    if(menu == false || menu == 'false') {
        cookie_esconder_menu();
    }
*/

    $('a[title],img[title]').each(function() {
       $(this).qtip({
           style: {name: 'cream', tip: true},
           show: 'mouseover',
           hide: 'mouseout',
           onHide: function(){
                $(this).qtip('destroy');
           }
       })
    });

    //bugs do Internet Exploder
    if (navigator.appName == "Microsoft Internet Explorer") {
        $("tr").mouseover(function(){
            $(this).children('.detalhes').children().children().css('visibility','visible')
        });
        $("tr").mouseout(function(){
            $('tr td.detalhes img').css('visibility','hidden')
        })
    } else {
		var tamanho_menu = parseInt($('#esconder_menu').css('height'));
		var tamanho_conteudo = parseInt($('#conteudo').css('height'));
		if(tamanho_conteudo > tamanho_menu) {
			$('#contrair').css('height',tamanho_conteudo);
		} else {
			$('#contrair').css('height',tamanho_menu);
		}
	}

	$('form:not(#busca)').each(function(){
		var form_id = $(this).attr('id');
		if(form_id != null && form_id != '')
			transform_js_field(form_id);
	});

});