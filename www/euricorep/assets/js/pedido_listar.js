$(document).ready(function() {
    var cliente = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"cliente",
        hiddenName:"cliente_id",
        emptyText:"Cliente",
        width:280,
        forceSelection:true
    });

    var artigo = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"artigo",
        hiddenName:"artigo_id",
        emptyText:"Artigo",
        width:135,
        forceSelection:true
    });

    var amostra = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"amostra",
        hiddenName:"amostrav",
        emptyText:"Amostra",
        width:135,
        forceSelection:true
    });

    var linha_producao = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"linha_producao",
        hiddenName:"linha_producao_id",
        emptyText:"Linha de Produção",
        width:120,
        forceSelection:true
    });

    var entrega_ini = new Ext.form.DateField ({
        name: 'entrega_ini',
        maxLength:100
    });
    entrega_ini.applyToMarkup('entrega_ini');

    var entrega_fim = new Ext.form.DateField ({
        name: 'entrega_fim',
        maxLength:100
    });
    entrega_fim.applyToMarkup('entrega_fim');

    var reprogramado_ini = new Ext.form.DateField ({
        name: 'reprogramado_ini',
        maxLength:100
    });
    reprogramado_ini.applyToMarkup('reprogramado_ini');

    var reprogramado_fim = new Ext.form.DateField ({
        name: 'reprogramado_fim',
        minValue:reprogramado_ini.dateFormat,
        maxLength:100
    });
    reprogramado_fim.applyToMarkup('reprogramado_fim');

	var filtro_status = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"status",
        hiddenName:"status",
        emptyText:"",
        width: 120,
        forceSelection: true
    });
});