$(document).ready(function() {

    var login = new Ext.form.TextField({
        name: 'login',
        fieldLabel: 'Login',
        emptyText: 'Usuário',
        width: 150
    })
    login.applyToMarkup("login");
    
    var senha = new Ext.form.TextField ({
        name: 'senha',
        fieldLabel: 'Senha',
        width: 150
    })
    senha.applyToMarkup("senha");
});