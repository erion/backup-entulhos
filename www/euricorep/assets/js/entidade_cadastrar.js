function ajaxFileUpload(id) {
	$("#loading")
	.ajaxStart(function(){
		$(this).show();
	})

	.ajaxComplete(function(){
		$(this).hide();
	});

	$.ajaxFileUpload({
		url:getBaseURL()+'index.php/entidades/upload/'+id,
		secureuri:false,
		fileElementId:'foto-file',
		dataType: 'json',
		beforeSend:function() {$("#loading").show();},
		complete  :function() {$("#loading").hide();},
		success	  :function (data, status) {submit();},
		error	  :function (data, status, e) {submit();}
	});
}

function submit() {
	var submit = true;
	var campos = $('.form_entidade input');
	campos.each(function() {
		if ($(this).attr("name") == "" || $(this).attr("id") == "btn_confirmar" || $(this).attr("type") == "hidden" || $(this).attr("type") == "file" || $(this).attr("id") == '') {
			return;
		}
		var regex = new RegExp(/.*\[(.*?)\]/);
		var ext_id = regex.exec($(this).attr("name"));
		var componente = Ext.ComponentMgr.get(ext_id[1]);
		if($(this).hasClass('valida')) {
			if($.trim($(this).val()).length < 1 || $(this).val() == '' || $(this).val() == componente.emptyText) {
				componente.markInvalid(componente.blankText);
				submit = false;
			}
		}
	});
	if (submit == true) {
		campos.each(function() {
			if ($(this).attr("name") == "" || $(this).attr("id") == "btn_confirmar" || $(this).attr("type") == "hidden" || $(this).attr("type") == "file" || $(this).attr("id") == '' || $(this).attr("rel") == 'nao_valida') {
				return;
			}
			var regex = new RegExp(/.*\[(.*?)\]/);
			var ext_id = regex.exec($(this).attr("name"));
			var componente2 = Ext.ComponentMgr.get(ext_id[1]);
			if(componente2.validationEvent == 'keyup' && ($(this).val() == componente2.emptyText || $(this).val() == '')) {
				componente2.setValue(" ");
			}
		});
	}
	if(submit) {
		$('.form_entidade').submit();
		if (tb_modal) {
			$.post(getBaseURL()+'index.php/'+tabela_salvar+'/cadastrar?modal=true', get_form_fields_object('.form_entidade'), function(entidade_id){
				if (tabela_salvar == 'clientes') {
					var store = Ext.ComponentMgr.get('cliente_id').getStore();
					store.insert(entidade_id, new Ext.data.Record({value: entidade_id, text: nova_entidade}));
					Ext.ComponentMgr.get('cliente_id').setValue(entidade_id);
				} else {
					var store2 = Ext.ComponentMgr.get('fornecedor_id').getStore();
					store2.insert(entidade_id, new Ext.data.Record({value: entidade_id, text: nova_entidade}));
					Ext.ComponentMgr.get('fornecedor_id').setValue(entidade_id);
				}
			});
			tb_remove();
		}
	}
}

function salvar_entidade(id) {
	$('#TB_load').show();
	if($('#upload_foto').val() != 'Logo-tipo') {
		ajaxFileUpload(id);
	} else {
		submit();
	}
	$('#TB_load').remove();
}

$(document).ready(function() {
    Ext.QuickTips.init();
	if(tb_modal)
		transform_js_field('form_entidade');
});