$(document).ready(function() {
    var fornecedor_id = new Ext.form.ComboBox({
        typeAhead: true,
        blankText:"É necessário inserir um fornecedor.",
        triggerAction: "all",
        transform:"fornecedor_id",
        hiddenName:"metas[fornecedor_id]",
        emptyText:"Fornecedor",
        id:'fornecedor_id',
        width:350,
        forceSelection:false,
        validationEvent:false
    });

    var meta = new Ext.form.TextField({
        name: 'meta',
        allowBlank:true,
        fieldLabel: 'Meta',
        emptyText: 'Meta',
        id:"meta",
        width: 110
    });
    meta.applyToMarkup("meta");

    var data_inicio = new Ext.form.DateField ({
        name: 'data_inicio',
        id:"data_inicio",
        validationEvent:false,
        maxLength:100
    });
    data_inicio.applyToMarkup('data_inicio');

    var data_fim = new Ext.form.DateField ({
        name: 'data_fim',
        id:"data_fim",
        validationEvent:false,
        maxLength:100
    });
    data_fim.applyToMarkup('data_fim');
});