$(document).ready(function() {
    var cliente = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"cliente",
        hiddenName:"log[relation_id]",
        emptyText:"Cliente",
        width:335,
        forceSelection:true
    });

    var mensagem = new Ext.form.HtmlEditor({
        name:'mensagem',
        fieldLabel: 'Mensagem',
        width: 500
    });
    mensagem.applyToMarkup('mensagem');
});