<?php
class fUrl extends Field {
	function fUrl( $campo, $label = 'Url:', $siteurl = SITE_URL, $campoTitulo = 'Titulo', $obrigatorio = TRUE, $maxLength = 255, $width = NULL, $visible = TRUE, $readonly = TRUE, $classe = NULL ) {
		$this->tipo = 'fUrl';
		$this->campo = $campo;
		$this->valor = NULL;
		$this->tipoBusca = "%";
        $this->maxlength = $maxLength;
		$this->setObrigatorio( $obrigatorio );
		$this->label = $label;
		$this->dbType = ' VARCHAR ';
		$this->visible = $visible;
		$this->readonly = $readonly;
		$this->classe = $classe;
		$this->width = $width;
		$this->siteurl = $siteurl;
		$this->campoTitulo = $campoTitulo;
		$this->textoAjuda = '<span class="ajuda">Especifique uma URL alternativa. Por exemplo, digite "afirma-cc-faz-sistemas-web-com-expertise" se estiver cadastrando "Afirma CC faz sistemas web com expertise".<br />Coloque somente o titulo e não utilize: "' . SITE_URL . '", "/", "?", aspas duplas nem aspas simples.</span>';
	}
	
	function formatForm() {
		$readonly = '';
		if ( $this->readonly == TRUE )
			$readonly = ' readonly="readonly" ';

		$width = '';
		if ( isset( $this->width ) )
			$width = ' style="width:'.$this->width.';" ';
			
		$obrigatorio = $this->getObrigatorio();
		$validacao = $this->getValidacao();
		$label = $this->getLabel();
		
		$this->valor = str_replace( '"', '&quot;', $this->valor );
		
		$s = '<div class="lblUrl"><input type="checkbox" name="chk' . $this->campo . '" id="chk' . $this->campo . '" class="" /> <label for="chk' . $this->campo . '">Alterar</label></div>';
		$s .= '<input class="input-text ' . $obrigatorio . ' ' . $this->validacao . ' ' . $this->classe . '" ' . $width . ' name="' . $this->campo . '" id="' . $this->campo . '" maxlength="' . $this->maxlength . '" value="' . $this->valor . '"' . $readonly . '  />';
		$s .= '<div class="site-url">' . $this->siteurl . '<span class="url Url' . $this->campo . '"></span></div>';
		
		if( $this->textoAjuda ) 
			$s.= $this->textoAjuda;
		
		$s .= '<script language="javascript" type="text/javascript">
					$( function() {
						$( ".Url' . $this->campo . '" ).text( $( "#' . $this->campo . '" ).val() );
						$( "#' . $this->campo . '" ).hide();
						$( "#' . $this->campoTitulo . '" ).keyup( function() {
							if ( $( "#' . $this->campo . '" ).attr( "readonly" ) && ( $( "#__metodo" ).val() == "cadastro" ) ) {
								var urlLimpa = replaceAll( $( this ).val(), "-", "" );
								urlLimpa = cleanUrl( urlLimpa );
								$( "#' . $this->campo . '" ).val( urlLimpa );
								$( ".Url' . $this->campo . '" ).text( urlLimpa );
							}
						} );
						$( "#' . $this->campo . '" ).keyup( function() {
								var urlLimpa = cleanUrl( $( this ).val() );
								$( this ).val( urlLimpa );
								$( ".Url' . $this->campo . '" ).text( urlLimpa );
						} );
						$( "#chk' . $this->campo . '" ).click( function() {
								if ( $( this ).attr( "checked" ) ) {
									$( "#' . $this->campo . '" ).removeAttr( "readonly" ).show();
									$( ".site-url" ).show();
								} else {
									$( "#' . $this->campo . '" ).attr( "readonly", "readonly" ).hide();
									$( ".site-url" ).hide();
								}
						} );
					} );
			   </script>';

		return $s;
	}

	function formatListagem() {
		$this->valor = str_replace( '"', '&quot;', $this->valor );
		return $this->valor;
	}
	
	function getCampo() {
		return $this->campo;
	}
}
