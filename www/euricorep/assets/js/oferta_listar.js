$(document).ready(function() {
    var cliente = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"cliente",
        hiddenName:"cliente_id",
        emptyText:"Cliente",
        width:135,
        forceSelection:true
    });

    var criado_ini = new Ext.form.DateField ({
        name: 'criado_ini',
        maxLength:100
    });
    criado_ini.applyToMarkup('criado_ini');

    var criado_fim = new Ext.form.DateField ({
        name: 'criado_fim',
        maxLength:100
    });
    criado_fim.applyToMarkup('criado_fim');

   var texto = new Ext.form.TextField({
        name: 'texto',
        fieldLabel: 'Texto',
        width: 550
    });
    texto.applyToMarkup("texto");
});