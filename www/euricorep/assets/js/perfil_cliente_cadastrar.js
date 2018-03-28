$(document).ready(function() {
    var cliente = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"cliente",
        hiddenName:"perfil_cliente[cliente_id]",
        emptyText:"Cliente",
        width:135,
        forceSelection:true
    });

    var artigo = new Ext.form.ComboBox({
        typeAhead: true,
        triggerAction: "all",
        transform:"artigo",
        hiddenName:"perfil_cliente[artigo_id]",
        emptyText:"Artigo",
        width:135,
        forceSelection:true
    });
});