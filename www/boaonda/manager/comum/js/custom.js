function carregaCidades( objPai, objFilho, txtSelecione, modulo ) {
	var cidades = '<option value="' + objFilho + '_0">' + txtSelecione + '</option>';
	
	if ( $( '#' + objPai ).val() != objPai + '_0' ) {
		$.getJSON( 'index.php?modulo=' + modulo + '&acao=carregaCidadesAjax&EstadoID=' + $( '#' + objPai ).val(), function( retorno ) {
			$.each( retorno, function( key, val ) {
				cidades = cidades + '<option value="' + key + '">' + val + '</option>';
			} );
			$( '#' + objFilho ).html( cidades );
		} );
	} else
		$( '#' + objFilho ).html( cidades );
}