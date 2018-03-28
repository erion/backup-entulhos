$(document).ready(function() {
    var cliente = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"cliente",
        hiddenName:"oferta[cliente_id]",
        emptyText:"Cliente",
        width:135,
        forceSelection:true
    });

    var email = new Ext.form.HtmlEditor ({
        name: 'email',
        fieldLabel: 'Mensagem',
        emptyText: 'Digite o centeúdo do e-mail aqui...',
        width: 500
    })
    email.applyToMarkup('email');
});