$().ready(function(){
	
	frmLogin();
	configureExclusao();
	configureFilters();
	
	// validacao do formul·rio
	$('.btn.salvar').click(function(){
		
		var obrigatorios = $('.required');
		var retorno = true;
		$.each(obrigatorios, function(k,v){
			if(!$(v).val()) {
				retorno = false;
				$(v).addClass('error');
			} else {
				$(v).removeClass('error');
			}
		});
		
		if( retorno == false ) {
			$.gritter.add({
				class_name: 'gritter-error',
				title: 'Erro de validação!',
				text: 'Você precisa preencher os campos sinalizados <b>"*"</b> para concluir o cadastro!',
				image: 'comum/img/glitter/icone-erro.png',
				time: 5000,
				before_open: function(){
                    if($('.gritter-item-wrapper').length == 1) {
                        return false;
                    }
                }
			});
			return false;
		} else {
			$("#frmCadastro").submit();
		}
		
	});

});

/*
$.ctrl( 'S', function () {
	$( '.btn.salvar' ).click();
});
*/

function removerArquivo(obj) {
	if(confirm("Deseja mesmo deletar a imagem?")) {
		$('#hdnUploadDel_'+obj)[0].checked = true;
		
		$('#divUpload_'+obj).fadeOut('fast', function(){
			$('#divMsgUpload_'+obj).fadeIn();
		});
	}
}

// ----------------------- fComboAdd
function actionComboAdd(arquivo, objeto, campo, acao, destino) {
	arq = arquivo + "?field=fComboAdd&objeto=" + objeto + "&campo=" + campo + '&acao=' + acao;

	if (acao == "add") {
		arq += "&item=&valor=" + $('#novo_' + campo).val();
	} else if (acao == "edit") {
		arq += "&item=" + $('#hdn_cod_'+campo).val() + '&valor=' + $('#novo_' + campo).val();
	} else if (acao == "delete") {
		if (confirm("Deseja remover este item?")) {
			arq += "&item=" + $('#hdn_cod_'+campo).val() + '&valor=';
		} else {
			return;
		}
	}

	$.post(arq, function(data) { $('#'+destino + campo).html(data); } );
}

function isComboEdit(obj) {
	if ($(obj).val() == 's' && $(obj+':checked').length > 0) {
		return true;
	} else {
		return false;
	}
}

function chkComboAdd(campo, obj) {
	if (obj != '') {
		valor = obj.value;
		label = obj.options[obj.selectedIndex].text;
		
		$('#hdn_cod_'+campo).val(valor);
		$('#hdn_label_'+campo).val(label);	
	} else {
		valor = $('#hdn_cod_'+campo).val();
		label = $('#hdn_label_'+campo).val();
	}
	
	if (isComboEdit('#lista_' + campo)) {
		if (valor != campo + '_novo' && valor != campo + '_0') {
			if ($('#novo_' + campo).length > 0) {
				$('#div_novo_' + campo).show();
				$('#novo_' + campo).removeAttr("disabled");
				$('#novo_' + campo).val(label);
			}
			
			if ($('#btEditar_' + campo).length > 0) {
				$('#btEditar_' + campo).show();
			}
			if ($('#btExcluir_' + campo).length > 0) {
				$('#btExcluir_' + campo).show();
			}

			$('#div_novo_' + campo).show();
			$('#ok_' + campo).hide();
			$('#novo_' + campo).show();
			$('#novo_' + campo).focus();
		} else {
			if (valor == campo + '_0') {
				$('#novo_' + campo).hide();
			} else {
				$('#novo_' + campo).val('');
				$('#novo_' + campo).attr('disabled','true');
				$('#btEditar_' + campo).hide();
				$('#btExcluir_' + campo).hide();
				$('#ok_' + campo).show();
				
				try {
					if ($('#novo_' + campo).length > 0) {
						$('#novo_' + campo).focus();
					}
				} catch(e) {
					// nada..	
				}
			}
		}
	} else {
		if (valor == campo + '_novo') {
				$('#div_novo_' + campo).show();
			$('#novo_' + campo).removeAttr("disabled");
			$('#btEditar_' + campo).hide();
			$('#btExcluir_' + campo).hide();
			$('#ok_' + campo).show();
			$('#novo_' + campo).focus();
		}
	
		if (valor != campo + '_novo' && document.getElementById('novo_' + campo).style.display != 'none') {
			$('#novo_' + campo).val('');
			$('#div_novo_' + campo).hide();
		}
	}
}

/* < tela de login */
function frmLogin() {
    
    var frm = "#frmLogin";
	
	$('#btn-login').click(function(){
		$(frm).submit();
	});
	
	$('#txtUsuario, #txtSenha').keyup(function(e){
		if( e.keyCode == 13)
			$(frm).submit();
	});
	
    if ($(frm).length > 0) {       
		var open = true;
		$(frm).validate({
			errorPlacement:function(error,element) {
				$('.login-msg').append(error);
			},
			wrapper: "ul",
			errorElement: "li",
			messages: {
				txtUsuario: "O campo usuário é campo obrigatório!",
				txtSenha: "O campo senha é obrigatório!"
			}
		});
    }

}
/* > tela de login */

function getNomeArquivo( arq ) {
	
	str = new String( arq );
	pos = str.lastIndexOf('\\');
	
	return new String(str.substr( pos + 1 ));
	
}

function getExtensao( arquivo ) {
	
	str = new String( arquivo );
	pos = str.lastIndexOf('.');
	extensao = str.substr( pos + 1 );
	
	return extensao + '.jpg';
	
}

function MultiSelector( list_target, max, obj_nome, com_chk, txt_chk, com_legenda ){

  if (com_chk != null)
    this.com_chk = com_chk;
  else
    this.com_chk = true;
  
  if (com_legenda != null)
    this.com_legenda = com_legenda;
  else
    this.com_legenda = true;
    
  if (txt_chk != null)
    this.txt_chk = txt_chk;
  else
    this.txt_chk = "Selecionar";

	this.obj_nome = obj_nome;
	// Where to write the list
	this.list_target = list_target;
	// How many elements?
	this.count = 0;
	// How many elements?
	this.id = 0;
	// Is there a maximum?
	if( max ){
		this.max = max;
	} else {
		this.max = -1;
	};
	
	
	/**
	 * Add a new file input element
	 */
	this.addElement = function( element ){

		// Make sure it's a file input element
		if( element.tagName == 'INPUT' && element.type == 'file' ){

			var temp_chk = this.com_chk;
			var temp_legenda = this.com_legenda;
			var temp_txt_chk = this.txt_chk;
      
			var temp_id = this.id++;
			
			// Element name -- what number am I?
			element.name = this.obj_nome + '_' + temp_id;

			// Add reference to this object
			element.multi_selector = this;

			// What to do when a file is selected
			element.onchange = function(){

				// New file input
				var new_element = document.createElement( 'input' );
				new_element.type = 'file';

				// Add new element
				this.parentNode.insertBefore( new_element, this );

				// Apply 'update' to element
				this.multi_selector.addElement( new_element );

				// Update list
				this.multi_selector.addListRow( this, temp_id, temp_chk, temp_txt_chk, temp_legenda );

				// Hide this: we can't use display:none because Safari doesn't like it
				this.style.position = 'absolute';
				this.style.left = '-1000px';

			};
			// If we've reached maximum number, disable input element
			if( this.max != -1 && this.count >= this.max ){
				element.disabled = true;
			};

			// File element counter
			this.count++;
			// Most recent element
			this.current_element = element;
			
		} else {
			// This can only be applied to file input elements!
			alert( 'Error: not a file input element' );
		};

	};

	/**
	 * Add a new row to the list of files
	 */
	this.addListRow = function( element, contador, chk, txt_chk, legenda){
		
		if (document.getElementById('formMultipleUpload').style.display == 'none')
			document.getElementById('formMultipleUpload').style.display = '';
		
		if (document.getElementById('msg_' + this.obj_nome).style.display == 'none')
			document.getElementById('msg_' + this.obj_nome).style.display = '';
			
		if (document.getElementById('mu_' + this.obj_nome).style.display == 'none')
			document.getElementById('mu_' + this.obj_nome).style.display = '';
		
		var new_row = document.createElement( 'div' );
		new_row.className = 'divImgContainer';
		
		var imgPreview = document.createElement( 'img' );
		imagem = getExtensao(getNomeArquivo(element.value));
		imagem = String(imagem).toLowerCase();
		imgPreview.src = 'comum/img/extensoes/' + imagem;
		imgPreview.align = 'left';
		
		var new_txt_row = document.createElement( 'div' );
		new_txt_row.innerHTML = getNomeArquivo(element.value);
		
		if (legenda)
		{
			var new_input = document.createElement( 'input' );
			new_input.name = 'l_' + contador + '_' + this.obj_nome;
			new_input.setAttribute('id', 'l_' + contador + '_' + this.obj_nome);
			new_input.type = 'text';
			new_input.className = 'input_text';
			new_input.style.width = '100px';
			new_input.style.marginRight = '6px';
	
			var new_label = document.createElement( 'label' );
			new_label.setAttribute('for', 'l_' + contador + '_' + this.obj_nome);
			new_label.innerHTML = 'Legenda: ';
	  	}		

		var new_button = document.createElement( 'a' );
	    new_button.innerHTML = 'Remover';
		new_button.href = '';
		
		var br = document.createElement ( 'br' );
		
		if (chk)
		{
			var new_chk = document.createElement( 'input' );
			new_chk.name = 'chk_' + this.obj_nome + '_' + contador;
			new_chk.setAttribute('id', 'chk_' + this.obj_nome + '_' + contador);
			new_chk.type = 'checkbox';
			new_chk.value = 'S';
			
			var chk_label = document.createElement( 'label' );
			chk_label.setAttribute('for', 'chk_' + this.obj_nome + '_' + contador);
			chk_label.innerHTML = txt_chk;
		}
		
	    // Row div
		//var new_row = document.createElement( 'div' );

		// Delete button
		//var new_row_button = document.createElement( 'input' );
		//new_row_button.type = 'button';
		//new_row_button.value = 'Remover';

		// References
		new_row.element = element;

		new_button.onclick = function()
		{
			this.parentNode.element.parentNode.removeChild( this.parentNode.element );
			this.parentNode.parentNode.removeChild( this.parentNode );
			this.parentNode.element.multi_selector.count--;
			this.parentNode.element.multi_selector.current_element.disabled = false;
			
			if (document.getElementById('msg_' + this.parentNode.element.multi_selector.obj_nome).style.display == '' && this.parentNode.element.multi_selector.count == 1)
				document.getElementById('msg_' + this.parentNode.element.multi_selector.obj_nome).style.display = 'none';
				
			if (document.getElementById('mu_' + this.parentNode.element.multi_selector.obj_nome).style.display == '' && this.parentNode.element.multi_selector.count == 1)
				document.getElementById('mu_' + this.parentNode.element.multi_selector.obj_nome).style.display = 'none';

			return false;
		}
		
		// Delete function
		/*
		new_row_button.onclick= function(){

			// Remove element from form
			this.parentNode.element.parentNode.removeChild( this.parentNode.element );

			// Remove this row from the list
			this.parentNode.parentNode.removeChild( this.parentNode );

			// Decrement counter
			this.parentNode.element.multi_selector.count--;

			// Re-enable input element (if it's disabled)
			this.parentNode.element.multi_selector.current_element.disabled = false;

			// Appease Safari
			//    without it Safari wants to reload the browser window
			//    which nixes your already queued uploads
			return false;
		};
		*/

		// Set row value
		//new_row.innerHTML = element.value;

		// Add button
		//new_row.appendChild( new_row_button );

		// Add it to the list
		new_row.appendChild( imgPreview );
		new_row.appendChild( new_txt_row );

		if (legenda)
		{
			new_row.appendChild( new_label );
			new_row.appendChild( new_input );
	    }
		
	    new_row.appendChild( new_button );

		if (chk)
		{
			new_row.appendChild( br );
			new_row.appendChild( chk_label );
			new_row.appendChild( new_chk );
		}

		this.list_target.appendChild( new_row );
	};

};


/* MicroModulos */
function toggleView(classe, acao, campo, valor, acaoSubmit) {
	var field = '#'+campo+'_'+acao;

	if ($(field+":hidden").length > 0) {
		updateView(classe, acao, campo, valor, acaoSubmit);
	} else {
		$(field).hide();
	}
}

function callActionViaURL(url, classe, campo, acao, valor) {
	var field = '#'+campo+'_'+acao;
	var fieldname = $('#'+campo+'_'+acao+'_field').val();
	
	$.post(url, function(data) {
		$(field).html(data);
		$(field).show();
		
		verificarForm(campo,acao,valor);
		
		if (acao == 'listagem') {
			configureListagem();
			configureSortable();
		}
		
		if (acao == 'cadastro') {
			$(field).dialog({width:500, title:$(field+' div.titulo:nth-child(1)').html(), modal:true, draggable:false, resizable:false});
			$(field+' .bt-cancelar-ajax').click(
				function() {
					$(field).dialog('close');
				}
			);
		}
		
	});
}


var onUpdateAjax;

function updateView(classe, acao, campo, valor, acaoSubmit) {
	var field = '#'+campo+'_'+acao;
	
	var fieldname = $('#'+campo+'_'+acao+'_field').val();

	if(!acaoSubmit) { acaoSubmit = 'editar' } 
	
	if (valor == '' || valor == "undefined" ) { valor = 0; }
	
	url = 'actions.php?field=fMicroModulo&method=ajax&classe='+classe+'&campo='+campo+'&acao='+acao+'&valor='+fieldname+'&'+fieldname+'='+valor+'&evento=busca&acaoSubmit='+acaoSubmit;
	console.log(url);
	$.post(url, function(data) {
		
		$(field).html(data);
		$(field).show();
		verificarForm(campo,acao,valor);
		if (acao == 'listagem') {
			configureListagem();
			configureSortable();
		}
		
		if (acao == 'cadastro') {
			$(field).dialog({width:500, title:$(field+' div.titulo:nth-child(1)').html(), modal:true, draggable:false, resizable:false, show:'slide'});
			$(field+' .bt-cancelar-ajax').click(
				function() {
					$(field).dialog('close');
				}
			);
		}
		
		if (onUpdateAjax) { onUpdateAjax(); }
	});
}

function verificarForm(campo,acao,valor) {
	if ($('#'+campo+'_'+acao+' > form').length > 0) {
		var forms = $('#'+campo+'_'+acao+' > form');
		var fieldname = $('#'+campo+'_'+acao+'_field').val();

		for (var i=0; i < forms.length; i++) {
			var frm = forms[i];
			var url = $(frm).attr('action')+'&method=ajax&campo='+campo+'&ajaxAcao='+acao+'&valor='+valor+'&'+fieldname+'='+valor;
			$(frm).attr('action',url);
				
			$(frm).submit(
				function() {
					$(this).ajaxSubmit({beforeSubmit: validateForm, success: retornoForm});
					return false;
				}
			);
		}
	}
}

function validateForm() { }


function retornoForm(valor) {
	dados = valor.split("|");
	classe = dados[1];
	campo = dados[2];
	acao = dados[3];
	valor = dados[4];
	
	if ($('#'+campo+'_'+acao).dialog('close')) {
		$('#'+campo+'_'+acao).dialog('close');
	}
	
	if (dados[0].indexOf('<') > -1 || dados.length != 5) {
		nome = '#'+campo+'_container > div[id*='+campo+'_]';
		if ($(nome).length > 0) {
			$(nome).html('ocorreu um erro.<br>'+dados[0]);
		}
	} else {
		nome = '#'+campo+'_container > div[id*='+campo+'_]';
		if ($(nome).length > 0) {
			for (var i=0; i<$(nome).length; i++) {
				if ($($(nome)[i]).css('display') != "none") {
					var act = $($(nome)[i]).attr('id').split('_')[1];			
					updateView(classe, act, campo, valor);
				}
			}
		}
	}
}


function configureExclusao() {
	$('.bt-excluir').live('click', function() {
		var check = $('input[name="deletar[]"]:checked').size();
			if( check > 0 ) {
				if (confirm('Deseja realmente excluir os dados selecionados?')) {
									
					var MicroModulo = $(this).parents('.campoMicroModulo');

					if ( MicroModulo.length > 0 ) {		
						var classeFilho = $( MicroModulo ).attr('name');			
						var campo = $( MicroModulo ).attr('id').split('_');			
						var valores = $( MicroModulo ).find('.chk-excluir:checked').serialize();
						var cod = $( MicroModulo ).attr('cod');
						$.post('actions.php', { action: 'deleteMicroModulo', classe: classeFilho, valor: valores }, function( retorno ){
							if( retorno == 'sucesso' ){
								updateView(classeFilho, 'listagem', campo[0], cod);
							} 
							
						});
						
					} else {
						var form = $(this).parents('form[name="frmDelete"]');
						$( form ).submit(); 
					}
				}
			}
		}
	);
}

function replaceAll(string, token, newtoken) {
	while (string.indexOf(token) != -1) {
 		string = string.replace(token, newtoken);
	}
	return string;
}

function strtr(str, from, to) {
    for (i = 0; i < from.length; i++) {
        str = replaceAll( str, from[i], to[i] );
    }
    return str;
}

function cleanUrl( url ) {
	var a = ['%','(',')','¿','¡','¬','√','ƒ','≈','∆','«','»','…',' ','À','Ã','Õ','Œ','œ','–','—','“','”','‘','’','÷','ÿ','Ÿ','⁄','€','‹','›','ﬁ','ﬂ','‡','·','‚','„','‰','Â','Ê','Á','Ë','È','Í','Î','Ï','Ì','Ó','Ô','','Ò','Ú','Û','Ù','ı','ˆ','¯','˘','˙','˚','˝','˝','˛','ˇ',' ','/'];
	var b = ['-porcento','','','a','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','d','n','o','o','o','o','o','o','u','u','u','u','y','b','s','a','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','d','n','o','o','o','o','o','o','u','u','u','y','y','b','y','-','-'];
	url = strtr( url, a, b );

	url = replaceAll( url, '--', '-' );
	string = replaceAll( url, '---', '-' );
	
	return string.toLowerCase();
}

/**
 * Fun??o para limitar TextArea!
 *
 * @name limitaTextArea
 * @param string obj id do objeto
 * @param int quant quantidade limitadora
 *
 */
function limitaTextArea( obj, quant ) {
	total = $( "#" + obj ).val().length;
	
	if( !( total <= quant ) )
		$( "#" + obj ).val( $( "#" + obj ).val().substr( 0, quant ) );
	$( "#contador" + obj + " span" ).html( $( "#" + obj ).val().length );
}

function campoCKEditor() {

	CKEDITOR.editorConfig = function( config )
	{
		// Define changes to default configuration here. For example:
		// config.language = 'fr';
		// config.uiColor = '#AADC6E';

		config.toolbar_Full = [
			{ name: 'document', items : [ 'Source' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
			{ name: 'paragraph', items : [ 'BulletedList' ] },
			{ name: 'links', items : [ 'Link','Unlink' ] },
			{ name: 'insert', items : [ 'Image', 'Table' ] },
			{ name: 'styles', items : [ 'Format' ] }
		];

/*		
		config.toolbar_Full =
		[
			{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
			{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
		 
				 'HiddenField' ] },
			'/',
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-
		 
				','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
			{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
			{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
			'/',
			{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
			{ name: 'colors', items : [ 'TextColor','BGColor' ] },
			{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
		];
*/	
	};

}
