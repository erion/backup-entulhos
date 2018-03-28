<?php
include_once('includes/adodb5/adodb.inc.php');
include_once('includes/configs.php');

function __autoload($class_name) {
	$classFile = 'class.'.$class_name.'.php';
	
    if (file_exists(CORE_CLASSPATH.$classFile)) {
	    require_once(CORE_CLASSPATH.$classFile);
	} else if (file_exists(SYSTEM_CLASSPATH.$classFile)) {
	    require_once(SYSTEM_CLASSPATH.$classFile);
	} else if (file_exists(CLIENT_CLASSPATH.$classFile)) {
	    require_once(CLIENT_CLASSPATH.$classFile);
	} else if (file_exists(FIELDS_CLASSPATH.$class_name.'.php')) {//if (file_exists(FIELDS_CLASSPATH.$classFile)) {
		$classFile = $class_name.'.php';
	    require_once(FIELDS_CLASSPATH.$classFile);
	} else if (file_exists(SUPPORT_CLASSPATH.$classFile)) {
	    require_once(SUPPORT_CLASSPATH.$classFile);
	}
}

class Application{
	static $instance;
	var $db;
	var $secao;
	var $modulo;
	var $acao;
	var $metodo;
	var $cod;
	var $tpl;
	var $template;
	var $templateMaster;
	var $session;
	var $htmlAcao;

	function Application() {
		session_start();
		Application::$instance = &$this;
		//CRIAR A DB
		$this->verificarDatabase();
		$this->verificarSessao();
		$this->executarAcao();
		
		//INSTANCIAR O TEMPLATE POWER
		$this->tpl = new TemplatePower($this->templateMaster);
		$this->tpl->prepare();
		
		if ($this->isLogged()) {
			$this->configurarDadosUsuario();
			$this->configurarMenuModulos();
			$this->configurarMenuAcoes();
		}
		
		$this->configurarHTML();
		
		$this->tpl->printToScreen();
	}
	
	function configurarHTML() {
		$this->tpl->assign('HTML',$this->htmlAcao);
		$this->tpl->gotoBlock('_ROOT');
		$this->tpl->assign('modulo',$this->modulo->modulo);
		$this->tpl->assign('acao',$this->acao);
		$this->tpl->assign( 'metodo', $this->metodo );
		$this->tpl->assign('JS_CLASSPATH',JS_CLASSPATH);
		$this->tpl->assign('JS_PLUGINS_CLASSPATH',JS_PLUGINS_CLASSPATH);
		$this->tpl->assign('CSS_CLASSPATH',CSS_CLASSPATH);
		$this->tpl->assign('IMG_CLASSPATH',IMG_CLASSPATH);
		$this->tpl->assign('URL_MANAGER', MANAGER_URL);
		$this->tpl->gotoBlock('_ROOT');
		
		$flash = new FlashMessage();
		
		if ($flash->hasFlash('retorno-titulo')) { 
			$this->tpl->assign('retorno-titulo', $flash->getFlash('retorno-titulo'));
			$this->tpl->assign('retorno-mensagem', $flash->getFlash('retorno-mensagem'));
			$this->tpl->assign('retorno-imagem', 'comum/img/glitter/icone-sucesso.png');
		}
		
	}
	
	function executarAcao() {
		$html = "";
		
		if (is_object($this->modulo)) {
			if (isset($_GET['acao']) && $_GET['acao'] != '' && method_exists($this->modulo,$_GET['acao'])) {
				$this->acao = $_GET['acao'];
				$this->metodo = 'cadastro';
				
				if (isset($_GET['cod']) && $_GET['cod'] != '') {
					$this->cod = $_GET['cod'];
					$this->metodo = 'edicao';
				}
			} else {
				$this->acao = $this->modulo->getAcaoPadrao();
			}

			//TESTAR SE A FUNÇÃO EXISTE
			if (method_exists($this->modulo,$this->acao)){
				$acao = $this->acao;
	
				if ($this->cod != '') {
					$retorno = $this->modulo->$acao($this->cod);
				} else {
					$retorno = $this->modulo->$acao();
				}
	
				if (is_a($retorno, 'View')) {
					$html = $retorno->html;
				} else if (isset($_GET['method']) && $_GET['method'] == "ajax") {
					if (isset($_GET['valor']) && $_GET['valor'] != "") {
						$valor = $_GET['valor'];
					} else {
						$valor = '0';
					}
					
					echo " |".$_GET['modulo']."|".$_GET['campo']."|".$_GET['ajaxAcao']."|".$valor;
					exit();
				} else {
					header("location:".$retorno);
					exit();
				}
			}
		}
		
		$this->htmlAcao = $html;
	}
	
	function isLogged() {
		if (!isset($_SESSION[SESSION_FIELD_NAME]) || $_SESSION[SESSION_FIELD_NAME] != SESSION_NAME || !isset($_SESSION[SESSION_USER_ID]) || $_SESSION[SESSION_USER_ID] == '') {
			return false;
		} else {
			return true;
		}
	}
	
	function configurarDadosUsuario() {
		$usuario = new Usuario($_SESSION[SESSION_USER_ID]);
		$this->tpl->assign('nome_usuario',$usuario->campos['nome']);
		$this->tpl->assign('url_editar_usuario','index.php?modulo=Usuario&acao=cadastro&cod='.$usuario->campos['codusuario']);
	}
		
	function configurarMenuModulos() {
		$categorias = $this->capturarModulosUsuario();

		foreach($categorias as $categoria=>$modulos	) {
		
			$listaModulos = array();
			$mostraCategoria = false;
			foreach( $modulos as $key => $modulo ){
				$listaModulos[ $key ] = new $modulo['classe']();
				
				if ( $listaModulos[ $key ]->visible == 1 )
					$mostraCategoria = true;
			}

			if ( $mostraCategoria ) {
				$this->tpl->newBlock('MENU');

				$this->tpl->assign('categoria', $categoria);
				$this->tpl->assign('url','');

				foreach( $modulos as $key => $modulo ){
					if ( $listaModulos[ $key ]->visible == 1 ) {
						$this->tpl->newBlock('MENU-SUB');
					
						if($this->modulo->modulo == $listaModulos[$key]->modulo)
							$this->tpl->assign('ativo', 'atv');
						
						$this->tpl->assign('modulo', $modulo['modulo']);
						$this->tpl->assign('url','index.php?modulo='.$modulo['classe'].'&acao='.$listaModulos[$key]->getAcaoPadrao());	
					}
				}
				
				$this->tpl->goToBlock('_ROOT');
			}
		}
	}
	
	function configurarMenuAcoes() {
		
		if( $this->acao	!= 'cadastro' ) {
			$acoes = $this->modulo->getMenuAcoes();
			
			foreach ($acoes as $acao) {
				$this->tpl->newBlock('PERMISSOES');
				$this->tpl->assign('titulo', $acao['titulo']);
				$this->tpl->assign('css', $acao['css']);
				$this->tpl->assign('url_permissao','index.php?modulo='.$this->modulo->modulo.'&acao='.$acao['acao']);
				$this->tpl->goToblock('_ROOT');		
			}
		}	
		
	}
	
	// Dados de configuração de Database
	
	function verificarDatabase() {
		
		global $GLOBAL_CONNECTION;
		
		if ($GLOBAL_CONNECTION == 'FALHA') {
			$this->criarDatabase();
		}
		
		$modulo = new Modulo(); 
		
		$this->iniciarModulos(SYSTEM_CLASSPATH);
		$this->iniciarModulos(CLIENT_CLASSPATH);
		$this->criarConfiguracaoPadrao();
		
	}
	
	function criarDatabase() {
		//REFERENTE A CONEXO COM O BANCO
		global $GLOBAL_CONNECTION;
		
		$GLOBAL_CONNECTION = ADONewConnection(DBType);
		$GLOBAL_CONNECTION->Connect(DBServer, DBUser, DBPassword) or $GLOBAL_CONNECTION = 'FALHA';
		
		if ($GLOBAL_CONNECTION != 'FALHA') {
			$GLOBAL_CONNECTION->query("CREATE DATABASE IF NOT EXISTS ".DBDatabase);
			$GLOBAL_CONNECTION->Connect(DBServer, DBUser, DBPassword, DBDatabase) or $GLOBAL_CONNECTION = 'FALHA';			
		}
		
		if ($GLOBAL_CONNECTION == 'FALHA') {
			die('Não foi possível conectar ao banco de dados.');
		}
	}
	
	function iniciarModulos($classpath) {
		$db = new db();

		if ($classpath == CLIENT_CLASSPATH) {
			$verificarExistencia = true;
			
			$query = "SELECT * FROM mgr_modulos WHERE codcategoria IN (SELECT codcategoria FROM mgr_modulos_categorias WHERE titulo='".SECAO_CLIENT."')";
			$rs = $db->query($query);
			
			$modulos = array();
			while (!$rs->EOF) {
				$modulos[$rs->fields('classe')] = false;
				$rs->moveNext();
			}
		} else {
			$verificarExistencia = false;
		}
		
		//LER O DIRETRIO PEGANDO SOMENTE O NOME DA CLASSE
		$ponteiro = opendir($classpath);
		
		while ($arquivo = readdir($ponteiro)) {
			if ($arquivo != '.' && $arquivo != '..' && $arquivo != 'class.Login.php' && strpos($arquivo,'class.') == 0 && strpos($arquivo,'.php') > 0) {
				$class =  str_replace('.php','',str_replace('class.','',$arquivo));
				
				if ($verificarExistencia) {
					$modulos[$class] = true;
					$objeto = new $class();
				} else {
					$objeto = new $class();
				}
			}
		}
		
		if ($verificarExistencia) {
			foreach ($modulos as $class => $val) {
				if ($val == false) {
					$query = "DELETE FROM mgr_modulos WHERE classe='".$class."'";
					$rs = $db->query($query);
				}
			}
		}
	}
	
	function criarConfiguracaoPadrao() {
		
		$db = new db();
		$sql = "select count(*) as total from mgr_usuarios";
		
		$rs = $db->query($sql);
		
		if( $rs->fields('total') == 0) {
			$ga = new Grupo();
			$ga->campos['titulo'] = GRUPO_ADMINISTRADORES;
			$ga->campos['publicar'] = "S";
			$codgrupo = $ga->_insert();
			
			$user = new Usuario();
			$user->campos['nome'] = "Afirma.cc";
			$user->campos['email'] = "contato@afirma.cc";
			$user->campos['login'] = "afirma";
			$user->campos['senha'] = "afirma";
			$user->campos['publicar'] = "S";
			$user->campos['codgrupo'] = $codgrupo;
			$codusuario = $user->_insert();
			
			$ga->cadastrarUsuario($codusuario);
			
			$db = new db();
			$query = "SELECT codmodulo FROM mgr_modulos";
			$rs = $db->query($query);
			
			while (!$rs->EOF) {
				$codmodulo = $rs->fields('codmodulo');
				$ga->cadastrarModulo($codmodulo);
				$rs->moveNext();
			}
		}
		
	}
	
	function verificarSessao() {
		if (!$this->isLogged()) {
			$this->usuarioNaoLogado();		
		} else {
			$this->capturarModulo();
		}
	}
	
	function capturarModulo() {
		if (isset($_GET['modulo']) && $_GET['modulo'] == 'Login') {
			$tmpModulo = $_GET['modulo'];
			$this->modulo = new $tmpModulo();
		} else {
			$categorias = $this->capturarModulosUsuario();

			if (!$modulos) {
				
				$this->templateMaster = HTML_CLASSPATH."master.htm";
				
				if ( !empty($_GET['modulo']) ) {
					
					$temPermissao = false;
					$tmpModulo = $_GET['modulo'];

					foreach ( $categorias as $titulo => $modulos ) {
						
						foreach( $modulos as $modulo ) {
							if ($modulo['classe'] == $tmpModulo) {

								$this->secao = $modulo['codcategoria'];
								$this->modulo = new $modulo['classe'];
								
								$temPermissao = true;
								break; // achamos o módulo, matamos o processo
							}	
							
						}
						
					}

					if (!$temPermissao) {
						$this->usuarioSemPermissao();
					}	
								
				} else {
				
					$this->capturarModuloPadrao();
				
				}
				
			} else {
				$this->usuarioSemModulo();
			}
		}
	}
	
	function capturarModulosUsuario() {
		
		$db = new db();
		
		$query = "SELECT DISTINCT(mgr_modulos.codmodulo), mgr_modulos.titulo as modulo, mgr_modulos.classe, mgr_modulos.codcategoria, mgr_modulos_categorias.titulo as categoria FROM mgr_modulos 
					INNER JOIN mgr_modulos_categorias ON (mgr_modulos_categorias.codcategoria=mgr_modulos.codcategoria) 
					INNER JOIN mgr_grupos_modulos ON (mgr_grupos_modulos.codmodulo=mgr_modulos.codmodulo) 
					INNER JOIN mgr_grupos_usuarios ON (mgr_grupos_usuarios.codgrupo=mgr_grupos_modulos.codgrupo) 
					WHERE mgr_grupos_usuarios.codusuario=".$_SESSION[SESSION_USER_ID] . " ORDER BY mgr_modulos.codcategoria, mgr_modulos.ordem";
		
		$rs = $db->query($query);
		
		while( !$rs->EOF ) {
			$arr[$rs->fields('categoria')][$rs->fields('codmodulo')]['modulo'] = $rs->fields('modulo');
			$arr[$rs->fields('categoria')][$rs->fields('codmodulo')]['classe'] = $rs->fields('classe');
			$arr[$rs->fields('categoria')][$rs->fields('codmodulo')]['codmodulo'] = $rs->fields('codmodulo');
			$arr[$rs->fields('categoria')][$rs->fields('codmodulo')]['codcategoria'] = $rs->fields('codcategoria');
			$rs->MoveNext();
		}
		
		return $arr;
	}
	
	function capturarModuloPadrao() {
		
		$categorias = $this->capturarModulosUsuario();
				
		if (isset($_GET['codsecao']) && $_GET['codsecao'] != "") {
			$codsecao = $_GET['codsecao'];
			$temModulo = false;
						
			foreach ($modulos as $m=>$v) {
				
				deb($v);
				
				/*if ($rs->fields('codcategoria') == $codsecao) {
					$classe = $rs->fields('classe');
					$modulo = new $classe();
					
					if ($modulo->visible) {
						$this->modulo = new $classe();
						$this->secao = $codsecao;
						$temModulo = true;
						break;
					}
				}*/
			}
			
			if (!$temModulo) {
				$this->usuarioSemModulo();
			}
		} else {
						
			foreach($categorias as $modulos){
				foreach( $modulos as $modulo ){
					$classe = new $modulo['classe'];
					
					if ($classe->visible) {
						$this->modulo = new $modulo['classe'];
						$this->secao = $modulo['codmodulo'];
						return;
					}
				}

			}
			
			$this->usuarioSemModulo();
			
		}
	}
	
	function usuarioSemModulo() {
		$this->resetSession("Usuário não tem acesso a nenhum módulo.");
		header('location: index.php');
		exit();
	}
	
	function usuarioSemPermissao() {
		$this->resetSession("Usuário sem permissão para acessar o módulo.");
		header('location: index.php');
		exit();
	}
	
	function resetSession($mensagem='') {
		session_destroy();
		session_start();
		
		$_SESSION[LOGIN_MENSAGEM_CAMPO] = $mensagem;
	}
	
	function usuarioNaoLogado() {
		if (isset($_GET['modulo']) && $_GET['modulo'] != 'Login') {
			header('location: index.php');
			exit();
		} else {
			//REFERENTE AO LOGIN
			$this->modulo = new Login();
			$this->templateMaster = HTML_CLASSPATH."login.htm";
		}	
	}
	
}
