<?php

/**
 * Define o título das páginas
 * @package SEO
 */
function setTitulo( $title = '' ) {
	return ($title) ? $title . ' - ' . INTERNATITLE : CAPATITLE;	
}

/**
 * Define as palavras chaves
 * @package SEO
 */
function setKeywords( $str = '' ) {
	return ($str) ? $str : METAKEYWORDS;	
}

/**
 * Define o título das páginas
 * @package SEO
 */
function setMetaDescription( $str = '' ) {

	return ($str) ? $str : METADESCRIPTION;	
}




