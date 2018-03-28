var cont = 0;
var nota_fiscal = new Array();
var qtd = new Array();
var novo_valor = new Array();
var obs = new Array();

function excluir(selector) {
    $(selector).parent().parent().remove();
}

function addObs(ap_id) {
	obs[ap_id] = new Ext.form.HtmlEditor({
		name:'msg['+ap_id+']',
		fieldLabel: 'Obs.',
		id:"observacao"+ap_id,
		width: 500
	});
	obs[ap_id].applyToMarkup('observacao'+ap_id);
}

function addFaturamento(nf,quantidade,data,faturamento_id,ap_id,selector) {
   var contador_interno = 0;
   var listagem = $(selector).parent().parent().parent().parent().parent().children("tbody");
   if(faturamento_id != '') {
       $(listagem).append("<tr>"+
           "<td><input type='text' name='nota_fiscal["+ap_id+"][]' value='"+nf+"' rel='nao_valida' id='nf"+cont+"' /></td>"+
           "<td><input type='text' name='qtd["+ap_id+"][]' value='"+quantidade+"' rel='nao_valida' id='qtd"+cont+"' />"+
           "<input type='hidden' name='faturamento_id["+ap_id+"][]' value='"+faturamento_id+"' rel='nao_valida' id='qtd"+cont+"' /></td>"+
           "<td><input type='text' name='data["+ap_id+"][]' value='"+data+"' rel='nao_valida' id='data"+cont+"' /></td></tr>");
   } else {
       $(listagem).append("<tr>"+
           "<td><input type='text' name='nota_fiscal["+ap_id+"][]' value='"+nf+"' rel='nao_valida' id='nf"+cont+"' /></td>"+
           "<td><input type='text' name='qtd["+ap_id+"][]' value='"+quantidade+"' rel='nao_valida' id='qtd"+cont+"' />"+
           "<input type='hidden' name='faturamento_id["+ap_id+"][]' value='"+faturamento_id+"' rel='nao_valida' id='qtd"+cont+"' /></td>"+
           "<td><input type='text' name='data["+ap_id+"][]' value='"+data+"' rel='nao_valida' id='data"+cont+"' /></td>"+
           "<td>&nbsp;<img src='"+getBaseURL()+"/assets/img/excluir.png' onclick='excluir(this)' id='deletar' /></td></tr>");
   }

    nota_fiscal[cont] = new Ext.form.TextField({
        name: "nota_fiscal["+ap_id+"][]",
        blankText:'',
        fieldLabel: 'nf',
        emptyText: 'N° N.F.',
        id:"nf"+cont,
        width: 100
    });
    nota_fiscal[cont].applyToMarkup("nf"+cont);

    qtd[cont] = new Ext.form.TextField({
        name: "qtd["+ap_id+"][]",
        blankText:'',
        fieldLabel: 'qtd',
        emptyText: 'Entregue',
        id:"qtd"+cont,
        width: 60
    });
    qtd[cont].applyToMarkup("qtd"+cont);

    novo_valor[cont] = new Ext.form.DateField ({
        name: "data["+ap_id+"][]",
        id:"data"+cont,
        validationEvent:false,
        maxLength:50
    });
    novo_valor[cont].applyToMarkup("data"+cont);

    cont += 1;
    return false;
}

function contrai_expande(selector,artigo_id) {
	var selector2 = '#'+artigo_id;
	if ($(selector).parent().attr('class') == 'artigo_comprimido') {
		$(selector).parent().attr('class','artigo_expandido');
		$(selector2).slideDown(510, function() {});
	} else {
		$(selector).parent().attr('class','artigo_comprimido');
		$(selector2).slideUp(510, function() {});
	}
}

$(document).ready(function(){
    $('.form_cadastro').submit(function(){
        var campos = $('.form_cadastro input, .form_cadastro select');
        campos.each(function() {
            if ($(this).attr("id") == "btn_confirmar" || $(this).attr("type") == "hidden" || $(this).attr("id") == "observacao" || $(this).attr('id') == 'ext-comp-1001') {
                return;
            }
            var id = $(this).attr('id');
            var componente = Ext.ComponentMgr.get(id);
            if (componente.emptyText == $(this).val()) {
                $(this).val(null);
            }
        });
    });

    var i = 0;
    var valor = new Array();
    var oi_curtume = new Array();

    $('input[name=valor_alterado[]]').each(function(){
        valor[i] = new Ext.form.TextField({
            name: 'valor',
            blankText:'',
            fieldLabel: 'Valor',
            emptyText: 'Valor',
            id:"valor["+i+"]",
            width: 100
        });
        valor[i].applyToMarkup("valor["+i+"]");
        i += 1;
    });
    i = 0;

    $('input[name=oi_curtume[]]').each(function(){
       oi_curtume[i] = new Ext.form.TextField({
            name: 'oi_curtume',
            blankText:'',
            fieldLabel: 'oi_curtume',
            emptyText: 'Ordem de produção',
            id:"oi_curtume["+i+"]",
            width: 150
        });
        oi_curtume[i].applyToMarkup("oi_curtume["+i+"]");
        i += 1;
    });
});