/*
*	JavaScript Document
*	DOCUMENTO: Arquivo com os scripts bsicos do site
*	CRIAO: 11/10/2009
*	AUTOR: Juliano Torriani (juliano@torriani.com.br
*	VERSAO: 1.0
*	ATUALIZAÇÕES:
*	
*/

function DatePicker(){
    var dates = $('#from, #to').datepicker({
            defaultDate: "-1w",
            dateFormat: 'yy-mm-dd',
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro', 'Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set', 'Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior',
            changeMonth: true,
			changeYear: true,
            numberOfMonths: 3,
            onSelect: function(selectedDate) {
                    var option = this.id == "from" ? "minDate" : "maxDate";
                    var instance = $(this).data("datepicker");
                    var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                    dates.not(this).datepicker("option", option, date);
            }
    });
}

// Função para iniciar as demais
$(document).ready(function() {
	
	DatePicker(); // Funçao date picker


});


//Cria os elementos do HTML5 no ie
document.createElement("article");
document.createElement("nav");
document.createElement("section");
document.createElement("header");
document.createElement("hgroup");
document.createElement("aside");
document.createElement("figure");
document.createElement("legend");
document.createElement("footer");