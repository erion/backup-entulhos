function atualizar_tabela_financeira() {
        if($('#tabela_financeira').val() != 'Tabela') {
            $("#loading")

            .ajaxStart(function(){
                    $(this).show();
            })

            .ajaxComplete(function(){
                    $(this).hide();
            });

            $.ajaxFileUpload({
                    url:getBaseURL()+'index.php/pedidos/financeiro/upload',
                    secureuri:false,
                    fileElementId:'tabela_financeira-file',
                    dataType: 'json',
                    beforeSend:function() {$("#loading").show();},
                    complete  :function() {$("#loading").hide();},
                    success	  :function (data, status) {},
                    error	  :function (data, status, e){}
            });
        }
}