var cont = 0;
var cor_campo = new Array();
var qtd_campo = new Array();
var valor_campo = new Array();

function projecao_checked() {
	if ($('#projecao').attr('checked')) {
		$('#projecao_box').slideDown();
	} else {
		$('#projecao_box').slideUp();
	}
}

function dropdown_projecao() {
	if ($('#projecao_existente').attr('checked')) {
		$('#verschwinden_mull').slideDown();
	} else {
		$('#verschwinden_mull').slideUp();
	} 
	if ($('#projecao_nova').attr('checked')) {
		$('#ordem_servico').parent().parent().slideUp();
		$('#nota_fiscal').parent().parent().slideUp();
	} else {
		$('#ordem_servico').parent().parent().slideDown();
		$('#nota_fiscal').parent().parent().slideDown();
	}
}

function projecao_change(id) {
	$('#TB_load').show();
	$.getJSON(getBaseURL()+'index.php/pedidos/detalhes_json/'+id,'', function(data){
		for(pedido in data['pedido']) {
			Ext.ComponentMgr.get(pedido).setValue(data['pedido'][pedido]);
		}
		for(artigo_pedido_id in data['artigo_pedido']) {
			addCor(data['artigo_pedido'][artigo_pedido_id]['cor'],data['artigo_pedido'][artigo_pedido_id]['quantidade'],data['artigo_pedido'][artigo_pedido_id]['valor_unitario_corrigido'],artigo_pedido_id,data['artigo_pedido'][artigo_pedido_id]['amostra']);
		}
		$('#TB_load').remove();
		Ext.ComponentMgr.get('cliente_id').focus();
	});
}

function trhover() {
    $("tr").hover(
         function () {
            $(this).addClass('del_cor');
         },
         function () {
            $(this).removeClass('del_cor');
         }
     );
}

function removeCor(obj,ap_id) {
	$('.form_cadastro').append("<input type='hidden' name='artigo_pedido_remover[]' value='"+ap_id+"' rel='nao_valida' />");
    $(obj).parent().parent().remove();
}

function muda_amostra(artigo_pedido_id,selector) {
	if ($(selector).attr('checked')) {
		$('#'+artigo_pedido_id).val("1");
	} else {
		$('#'+artigo_pedido_id).val("0");
	}
}

function verifica_add_cor() {
	if ($('#cadastro_cor').val() != '' && $('#cadastro_cor').val() != 'Cor') {
		if($('#amostra').attr('checked')) var amostra = 1;
		else							  var amostra = 0;
		addCor($('#cadastro_cor').val(),$('#quantidade').val(),$('#valor').val(),'',amostra);
	}
}

function addCor(cor,quantidade,valor,ap_id,amostra) {
	var amostra_producao;
	if(ap_id == '') ap_id = 0;

	if (amostra == 1) {
		amostra_producao = "<input type='checkbox' name='amostra[]' rel='nao_valida' id='amostra"+cont+"' checked onclick='muda_amostra("+ap_id+",this)' /><label for='amostra"+cont+"'>&nbsp;Amostra</label>";
	} else {
		amostra = 0;
		amostra_producao = "<input type='checkbox' name='amostra[]' rel='nao_valida' id='amostra"+cont+"' onclick='muda_amostra("+ap_id+",this)' /><label for='amostra"+cont+"'>&nbsp;Amostra</label>";
	}
    if (cor != '' & quantidade != '') {
        if (cont % 2 == 0) {
           $('#cores').append("<tr class='cor'><td><input type='text' name='artigo_pedido_cor[]' value='"+cor+"' id='cor"+cont+"' rel='nao_valida' /></td>"+
			   "<td><input type='text' name='artigo_pedido_quantidade[]' value='"+quantidade+"' id='qtd"+cont+"' rel='nao_valida' /></td>"+
			   "<td><input type='text' name='artigo_pedido_valor[]' value='"+valor+"' id='valor"+cont+"' rel='nao_valida' /></td>"+
			   "<td>"+amostra_producao+"</td>"+
			   "<td><img src='"+getBaseURL()+"/assets/img/del.png' onclick='removeCor(this,"+ap_id+")' />"+
               "<input type='hidden' name='artigo_pedido_id[]' value='"+ap_id+"' rel='nao_valida' />"+
			   "<input type='hidden' name='artigo_pedido_amostra[]' value='"+amostra+"' rel='nao_valida' id='"+ap_id+"' /></td></tr>");
        } else {
           $('#cores').append("<tr><td>&nbsp;<input type='text' name='artigo_pedido_cor[]' value='"+cor+"' id='cor"+cont+"' rel='nao_valida' /></td>"+
			   "<td>&nbsp;<input type='text' name='artigo_pedido_quantidade[]' value='"+quantidade+"' id='qtd"+cont+"' rel='nao_valida' /></td>"+
			   "<td>&nbsp;<input type='text' name='artigo_pedido_valor[]' value='"+valor+"' id='valor"+cont+"' rel='nao_valida' /></td>"+
			   "<td>&nbsp;"+amostra_producao+"</td>"+
			   "<td><img src='"+getBaseURL()+"/assets/img/del.png' onclick='removeCor(this,"+ap_id+")' />"+
               "<input type='hidden' name='artigo_pedido_id[]' value='"+ap_id+"' rel='nao_valida' />"+
			   "<input type='hidden' name='artigo_pedido_amostra[]' value='"+amostra+"' rel='nao_valida' id='"+ap_id+"' /></td></tr>");
        }
        $('#cadastro_cor').val("");
        $('#quantidade').val("");
        $('#cadastro_cor').focus();

		cor_campo[cont] = new Ext.form.TextField({
			name: "artigo_pedido_cor[]",
			blankText:'',
			fieldLabel: 'cor',
			emptyText: 'Cor',
			id:"cor"+cont,
			width: 150
		});
		cor_campo[cont].applyToMarkup("cor"+cont);

		qtd_campo[cont] = new Ext.form.TextField({
			name: "artigo_pedido_quantidade[]",
			blankText:'',
			fieldLabel: 'qtd',
			emptyText: 'Quantidade',
			id:"qtd"+cont,
			width: 100
		});
		qtd_campo[cont].applyToMarkup("qtd"+cont);

		valor_campo[cont] = new Ext.form.TextField({
			name: "artigo_pedido_valor[]",
			blankText:'',
			fieldLabel: 'valor',
			emptyText: 'Valor Unit.',
			id:"valor"+cont,
			width: 100
		});
		valor_campo[cont].applyToMarkup("valor"+cont);

        cont += 1;
        trhover();

        return false;
    }
}

var nova_entidade;
var tabela_salvar;//usado em entidade_cadastrar.js tb

function entidadeBlur(owner,tabela) {
    if (!tb_modal) {
        tabela_salvar = tabela.toLowerCase();
        var url = getBaseURL()+"index.php/"+tabela+"/cadastrar?width=528&modal=true";
        if (!is_int(owner.getValue()) && owner.getValue() != '') {
            tb_register_onload(function() {
                $('#nome').val(owner.getValue());
                nova_entidade = $('#nome').val();
                $('#nome').focus();//p/nao ficar com cor como se fosse texto vazio
                $('#endereco').focus();
                $('.form_entidade').submit(function(){
                    return false;
                });
            });
            tb_show('',url);
        }
    }
}

$(document).ready(function() {

	$("body").append("<div id='TB_load'><img src='"+getBaseURL()+"assets/img/loadingAnimation.gif"+"' /></div>");

    var tem_cor = false;
    Ext.QuickTips.init();

    $('.form_cadastro').submit(function(){
		verifica_add_cor();
        var submit = true;
        var campos = $('.form_cadastro input, .form_cadastro select');
        campos.each(function() {
            if ($(this).attr("rel") == "nao_valida") {
                tem_cor = true;
                return;
            }
            if ($(this).attr("name") == "" || $(this).attr("id") == "btn_confirmar" || $(this).attr("name") == "cor" || $(this).attr("name") == "quantidade" || $(this).attr("name") == "valor" || $(this).attr("id") == "amostra") {
                return;
            }
            var regex = new RegExp(/.*\[(.*?)\]/);
            var ext_id = regex.exec($(this).attr("name"));
            var componente = Ext.ComponentMgr.get(ext_id[1]);
            if(!(componente.validationEvent == 'keyup')) {
                if($.trim($(this).val()).length < 1 || $(this).val() == '' || $(this).val() == componente.emptyText){
                    componente.markInvalid(componente.blankText);
                    submit = false;
                }
            }
        });
        if (!tem_cor) {
            cor.markInvalid(cor.blankText);
            quantidade.markInvalid(quantidade.blankText);
            valor.markInvalid(valor.blankText);
            submit = false;
        }
        if (submit == true) {
            campos.each(function() {
                if ($(this).attr("name") == "" || $(this).attr("rel") == "nao_valida"
				|| $(this).attr("id") == "btn_confirmar" || $(this).attr("type") == "hidden" || $(this).attr("id") == "amostra") {
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
        return submit;
    });

    trhover();

    var cliente_id = new Ext.form.ComboBox({
        typeAhead: true,
        blankText:"É necessário inserir um cliente.",
        triggerAction: "all",
        transform:"cliente_id",
        hiddenName:"pedido[cliente_id]",
        emptyText:"Cliente",
        id:"cliente_id",
        width:350,
        forceSelection:false,
        validationEvent:false,
        listeners:{blur:function() {
                entidadeBlur(this,'clientes')
            }
        }
    });

    var fornecedor_id = new Ext.form.ComboBox({
        typeAhead: true,
        blankText:"É necessário inserir um fornecedor.",
        triggerAction: "all",
        transform:"fornecedor_id",
        hiddenName:"pedido[fornecedor_id]",
        emptyText:"Fornecedor",
        id:'fornecedor_id',
        width:350,
        forceSelection:false,
        validationEvent:false,
        listeners:{blur:function() {
                entidadeBlur(this,'fornecedores')
            }
        }
    });

    var icms = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"icms",
        hiddenName:"pedido[icms]",
        emptyText:"ICMS",
        id:"icms",
        width:135,
        validationEvent:false,
        forceSelection:false
    });

    var moeda = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"moeda",
        hiddenName:"pedido[moeda]",
        emptyText:"Moeda",
        id:"moeda",
        width:135,
        validationEvent:false,
        forceSelection:true
    });

    var artigo_id = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"artigo_id",
        hiddenName:"pedido[artigo_id]",
        emptyText:"Artigo",
        id:"artigo_id",
        width:350,
        validationEvent:false,
        forceSelection:false
    });

    var linha_producao = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"linha_producao_id",
        hiddenName:"pedido[linha_producao_id]",
        emptyText:"Linha de produção",
        id:"linha_producao_id",
        width:120,
        validationEvent:false,
        forceSelection:true
    });

    var representante_id = new Ext.form.ComboBox({
        typeAhead: true,
		blankText:"É necessário inserir um representante.",
        triggerAction: "all",
        transform:"representante_id",
        hiddenName:"pedido[representante_id]",
        emptyText:"Representante",
        id:"representante_id",
        width:200,
        validationEvent:false,
        forceSelection:true
    });

    var projecao_id = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"projecao_id1",
        hiddenName:"pedido[projecao_id]",
        emptyText:"Projeção",
        id:"projecao_id",
        width:350,
        listeners:{select:function() {
                projecao_change(this.value)
            }
        }
    });

    var materia_prima_id = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"materia_prima_id",
        hiddenName:"pedido[materia_prima_id]",
        emptyText:"Matéria prima",
        id:"materia_prima_id",
        width:350,
        validationEvent:false,
        forceSelection:false
    });


    var couro = new Ext.form.ComboBox({
        transform:"couro",
        hiddenName:"pedido[couro]",
        emptyText:"Couro",
        id:"couro",
        width:100
    });

    var raspa = new Ext.form.ComboBox({
        transform:"raspa",
        hiddenName:"pedido[raspa]",
        emptyText:"Raspa",
        id:"raspa",
        width:100
    });

    var divisao = new Ext.form.TextField({
        name: 'divisao',
        allowBlank:true,
        fieldLabel: 'Divisão',
        emptyText: 'Divisão',
        id:"divisao",
        width: 110
    });
    divisao.applyToMarkup("divisao");

    var revisor = new Ext.form.TextField({
        name: 'revisor',
        allowBlank:true,
        fieldLabel: 'Revisor',
        emptyText: 'Revisor',
        id:"revisor",
        width: 110
    });
    revisor.applyToMarkup("revisor");

    var ordem_servico = new Ext.form.TextField({
        name: 'ordem_servico',
        allowBlank:true,
        fieldLabel: 'O.S.',
        emptyText: 'Ordem do cliente',
        id:"ordem_servico",
        width: 110
    });
    ordem_servico.applyToMarkup("ordem_servico");

    var faturamento = new Ext.form.TextField({
        name: 'faturamento',
        fieldLabel: 'Faturamento',
        emptyText: 'Faturamento',
        id:"faturamento",
        width: 150
    });
    faturamento.applyToMarkup("faturamento");

    var nota_fiscal = new Ext.form.TextField({
        name: 'nota_fiscal',
        allowBlank:true,
        fieldLabel: 'N.F:',
        emptyText: 'N° NF',
        id:"nota_fiscal",
        width: 100
    });
    nota_fiscal.applyToMarkup("nota_fiscal");

    var classificacao = new Ext.form.TextField({
        name: 'classificacao',
        allowBlank:true,
        fieldLabel: 'Classificação',
        emptyText: 'Classificação',
        id:"classificacao",
        width: 150
    });
    classificacao.applyToMarkup("classificacao");

    var unidade_medida = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"unidade_medida",
        hiddenName:"pedido[unidade_medida]",
        emptyText:"Medida",
        id:"unidade_medida",
        width:50,
        validationEvent:false,
        forceSelection:true
    });

    var tamanho_peca = new Ext.form.TextField({
        name: 'tamanho_peca',
        allowBlank:true,
        fieldLabel: 'Tamanho Peça',
        emptyText: 'Tamanho peça',
        id:"tamanho_peca",
        width: 100
    });
    tamanho_peca.applyToMarkup("tamanho_peca");

    var espessura = new Ext.form.TextField({
        name: 'espessura',
        allowBlank:true,
        fieldLabel: 'Espessura',
        emptyText: 'Espessura',
        id:"espessura",
        width: 100
    });
    espessura.applyToMarkup("espessura");

    var cupim = new Ext.form.TextField({
        name: 'cupim',
        allowBlank:true,
        fieldLabel: 'Cupim',
        emptyText: '%',
        id:"cupim",
        width: 50
    });
    cupim.applyToMarkup("cupim");

    var tipo_embarque = new Ext.form.TextField({
        name: 'tipo_embarque',
        allowBlank:true,
        fieldLabel: 'Tipo de embarque',
        emptyText: 'Tipo de embarque',
        id:"tipo_embarque",
        width: 150
    });
    tipo_embarque.applyToMarkup("tipo_embarque");

    var tipo_embalagem = new Ext.form.TextField({
        name: 'tipo_embalagem',
        allowBlank:true,
        fieldLabel: 'Tipo de embalagem',
        emptyText: 'Tipo de embalagem',
        id:"tipo_embalagem",
        width: 150
    });
    tipo_embalagem.applyToMarkup("tipo_embalagem");

    var tolerancia_metragem = new Ext.form.TextField({
        name: 'tolerancia_metragem',
        allowBlank:true,
        fieldLabel: 'Tolerância metragem',
        emptyText: 'Tol. erro de metragem',
        id:"tolerancia_metragem",
        width: 150
    });
    tolerancia_metragem.applyToMarkup("tolerancia_metragem");

    var cor = new Ext.form.TextField({
        name: 'cor',
        blankText:'Mínimo de uma cor requirida',
        fieldLabel: 'Cor',
        emptyText: 'Cor',
        id:"cadastro_cor",
        width: 150
    });
    cor.applyToMarkup("cadastro_cor");
  
    var quantidade = new Ext.form.TextField({
        name: 'quantidade',
        blankText:'Mínimo de uma cor requirida',
        fieldLabel: 'Quantidade',
        emptyText: 'Quantidade',
        id:"quantidade",
        width: 100
    });
    quantidade.applyToMarkup("quantidade");

    var valor = new Ext.form.TextField({
        name: 'valor',
        blankText:'Artigo requer um valor',
        fieldLabel: 'Valor',
        emptyText: 'Valor unitário',
        id:"valor",
        width: 100
    });
    valor.applyToMarkup("valor");

    var data_entrega = new Ext.form.DateField ({
        name: 'data_entrega',
        id:"data_entrega",
        validationEvent:false,
        maxLength:100
    });
    data_entrega.applyToMarkup('data_entrega');

    if ($('#observacao')[0]) {
        var obs = new Ext.form.HtmlEditor({
            name:'msg',
            fieldLabel: 'Obs.',
            id:"observacao",
            width: 500
        });
        obs.applyToMarkup('observacao');
    }

	projecao_checked();
	dropdown_projecao()

});