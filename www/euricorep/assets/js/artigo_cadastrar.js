$(document).ready(function() {

    Ext.QuickTips.init();

    $('.form_cadastro').submit(function(){
        var submit = true;
        var campos = $('.form_cadastro input');
        campos.each(function() {
            if ($(this).attr("name") == "" || $(this).attr("id") == "btn_confirmar" || $(this).attr("type") == "hidden") {
                return;
            }
            var regex = new RegExp(/.*\[(.*?)\]/);
            var ext_id = regex.exec($(this).attr("name"));
            var componente = Ext.ComponentMgr.get(ext_id[1]);
            if($.trim($(this).val()).length < 1 || $(this).val() == '' || $(this).val() == componente.emptyText) {
                componente.markInvalid(componente.blankText);
                submit = false;
            }
        });
        return submit;
    });

});