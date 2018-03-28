$(document).ready(function() {
    var tipo = new Ext.form.ComboBox({
        typeAhead: true,
        id:'tipo',
        triggerAction: "all",
        transform:"tipo",
        hiddenName:"usuario[tipo]",
        emptyText:"Tipo Usuário",
        width:135,
        forceSelection:true
    });

    var nome = new Ext.form.TextField ({
        name:'nome',
        id:'nome',
        emptyText:'Nome',
        width:250
    })
    nome.applyToMarkup('nome');

    var email = new Ext.form.TextField ({
        name:'e_mail',
        id:'e_mail',
        fieldLabel:'E-mail',
        emptyText:'E-mail',
        width:250
    })
    email.applyToMarkup('email');

    var entidade_id = new Ext.form.ComboBox({
        typeAhead:true,
        id:'entidade_id',
        triggerAction: "all",
        transform:"entidade",
        hiddenName:"usuario[entidade_id]",
        emptyText:"Empresa",
        width:135,
        forceSelection:true
    });

    var senha = new Ext.form.TextField ({
        name:'senha',
        id:'senha',
        fieldLabel:'Senha',
        emptyText:'',
        width:200
    })
    senha.applyToMarkup('senha');

    var confirma_senha = new Ext.form.TextField ({
        name:'confirma_senha',
        id:'confirma_senha',
        fieldLabel:'Confirmar Senha',
        emptyText:'',
        width: 200
    })
    confirma_senha.applyToMarkup('confirma_senha');
});