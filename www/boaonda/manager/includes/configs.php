<?php
//REFERENTE AS CONFIGS DO DB
## Conexao

function deb($str, $die = false) {
	
	echo "<div style=\"padding: 10px 20px; border: 1px solid #FF9900; background: #FFEDD2\">"
		. "<pre>"
		. print_r($str,1)
		. "</pre>"
		. "</div>";
	if( $die ) die;
	
}

error_reporting(E_ALL & ~E_NOTICE);

define('BASEPATH','.');

include('../application/config/constants.php');
include('../application/config/database.php');
include('../application/config/config.php');

define( 'SITE_URL', $config['base_url'] );
define( 'MANAGER_URL', SITE_URL . '/gerenciador' );

define("DBType",$db[$active_group]['dbdriver']);
define("DBServer",$db[$active_group]['hostname']);
define("DBUser",$db[$active_group]['username']);
define("DBPassword",$db[$active_group]['password']);
define("DBDatabase",$db[$active_group]['database']);
define("T", "\t");

define('SESSION_NAME','afirma');
define('NRO_REGISTROS_PAGINACAO','25');

define('CORE_CLASSPATH','./classes/core/');
define('SYSTEM_CLASSPATH','./classes/system/');
define('FIELDS_CLASSPATH','./classes/fields/');
define('CLIENT_CLASSPATH','./classes/client/');
define('SUPPORT_CLASSPATH','./classes/support/');

define('HTML_CLASSPATH','./comum/html/');
define('JS_CLASSPATH','./comum/js/');
define('JS_PLUGINS_CLASSPATH','./comum/js/plugins/');
define('CSS_CLASSPATH','./comum/css/');
define('IMG_CLASSPATH','./comum/img/');

define('SECAO_SYSTEM','Configurações');
define('SECAO_CLIENT','Gerenciar Conteúdo');
define('GRUPO_ADMINISTRADORES','Administradores');

define('LOGIN_MENSAGEM_CAMPO','LOGIN_ERRO');
define('SESSION_FIELD_NAME','SESSION_NAME');
define('SESSION_USER_ID','SESSION_USER_ID');

## Criacao da Conexao Global
$GLOBAL_CONNECTION = NewADOConnection(DBType);
$GLOBAL_CONNECTION->Connect(DBServer, DBUser, DBPassword, DBDatabase) or $GLOBAL_CONNECTION = "FALHA";

## VERIFICAÇÃO DE TABELAS
$VERIFICAR_TABELAS = true;

require_once("dicionario.php");