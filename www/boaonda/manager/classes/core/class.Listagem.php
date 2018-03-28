<?php
class Listagem extends View {
	var $template;
	var $modulo;
	var $acao;
	var $query;
	var $objeto;
	var $editar;
	var $excluir;
	
	var $tpl;
	var $id_tipo;
	var $urlOrder;
	
	// Paginação
	var $currentPage;
	var $totalPages;
	var $totalRegistros;
	var $registroInicial;
	var $registroFinal;
	
	var $SQLOrder;
	var $SQLPage;
	var $composedQuery;
	
	function Listagem($campos,$modulo,$query,$acao="delete",$template="list",$excluir=true,$editar=true) {
		$this->campos = $campos;
		$this->modulo = $modulo;
		$this->acao = $acao;
		$this->query = $query;
		$this->excluir = $excluir;
		$this->editar = $editar;
		$this->template = HTML_CLASSPATH.$template.".htm";

		$this->configListagem();
		$this->configQuery();
		$this->configPaginacao();
		$this->configFiltro();
		$this->montaListagem();
		$this->html = $this->tpl->getOutputContent();
	}
	
	function configListagem() {
		$this->currentPage = 0;
		
		if (isset($_GET['paginacao']) && $_GET['paginacao'] != '') {
			$_SESSION['pagina_'.$this->modulo] = $_GET['paginacao'];
		} else if (!isset($_SESSION['pagina_'.$this->modulo]) || (isset($_GET['evento']) && $_GET['evento'] == 'busca')) {
			$_SESSION['pagina_'.$this->modulo] = 0;
		}
		
		if (isset($_SESSION['pagina_'.$this->modulo])) {
			$this->currentPage = $_SESSION['pagina_'.$this->modulo];
		}
		
		//REFERENTE A CONSULTA NO BANCO
		if (isset($_GET['qr']) && $_GET['qr'] != '') {
			$this->query = base64_decode($_GET['qr']);
		}
		
		$this->tpl = new TemplatePower($this->template);
		$this->tpl->prepare();
		
		$this->tpl->assign('modulo',$this->modulo);
		$this->tpl->assign('acao',$this->acao);
		
		$mod = $this->modulo;
		$this->objeto = new $mod();
	}
		
	function configPaginacao() {
		$paginacao = $this->currentPage;
		$tpl = $this->tpl;
		
		$db = new db();
		
		$arrQuery = explode('FROM',$this->query,2);
		$queryCount = "SELECT COUNT(*) AS total FROM ".$arrQuery[1];
		$rs = $db->query($queryCount);
		
		$this->totalRegistros = $rs->fields('total');
		$this->registroFinal = $this->registroInicial + $this->objeto->totalRegistrosListagem;

		if ($this->totalRegistros < $this->registroFinal) {
			$this->registroFinal = $this->totalRegistros;
		}
		
		$totalPaginas = ceil($this->totalRegistros / $this->objeto->totalRegistrosListagem);
		
		$paginaAtual = $this->currentPage + 1;
		$paginaInicial = $paginaAtual - 5;
		$paginaFinal = $paginaAtual + 5;
		
		$paginacaoNoFim = false;
		
		if ($paginaFinal >= $totalPaginas) {
			$diferenca = abs(($totalPaginas - 1) - $paginaFinal);			
			$paginaInicial -= $diferenca;
			$paginaFinal = $totalPaginas;
			$paginacaoNoFim = true;
		}
		
		if ($paginaInicial < 0) {
			$diferenca =  $paginaInicial * -1;
			$paginaInicial = 0;
			
			if (!$paginacaoNoFim) {
				$paginaFinal += $diferenca;
				
				if ($paginaFinal > $totalPaginas) {
					$diferenca = $totalPaginas - $paginaFinal;
					$paginaInicial -= $diferenca;
				}
			}
		}
		
		$txtTotalRegistros = $this->totalRegistros;
		
		if ($this->totalRegistros > 0) {
			if ($totalPaginas == 1) {
				$txtTotalRegistros = $this->registroFinal;			
			} else {
				$txtTotalRegistros = ($this->registroInicial + 1).' ao '.$this->registroFinal.' de '.$this->totalRegistros;
			}
		}
		
		$tpl->assign('nro_registros',$txtTotalRegistros);
		
		if ($totalPaginas > 1) {
			$htmlPaginas = '';
			
			for ($i=$paginaInicial; $i < $paginaFinal; $i++) {
				if ($htmlPaginas != "") { $htmlPaginas .= ' | '; }
				if ($i == ($paginaAtual - 1)) {
					$htmlPaginas .= '<strong>'.($i+1).'</strong>';
				} else {
					$htmlPaginas .= '<a href="index.php?modulo='.$this->modulo.'&acao=listagem&id_tipo='.$this->id_tipo.'&paginacao='.$i.$this->urlOrder.'&qr='. base64_encode($this->query).'">'.($i+1).'</a>';
				}
			}
		
			$tpl->newBlock('PAGINACAO');
			$tpl->assign('paginacao',$htmlPaginas);
		
			if ($paginacao > 0) {
				$tpl->newBlock('BT-PAGINACAO-ANTERIOR');
				$tpl->assign('par_paginacao_anterior','index.php?modulo='.$this->modulo.'&acao=listagem&id_tipo='.$this->id_tipo.'&paginacao='.($paginacao-1).$this->urlOrder.'&qr='. base64_encode($this->query));
			}
			
			if ($paginacao < ($totalPaginas - 1)) {
				$tpl->newBlock('BT-PAGINACAO-PROXIMA');
				$tpl->assign('par_paginacao_proxima','index.php?modulo='.$this->modulo.'&acao=listagem&id_tipo='.$this->id_tipo.'&paginacao='.($paginacao+1).$this->urlOrder.'&qr='. base64_encode($this->query));
			}
		}
		
		$tpl->goToBlock('_ROOT');		
	}	
	
	function configQuery() {
		$strFiltro = 'filtro_'.$this->modulo;

		if (isset($_GET['evento']) && $_GET['evento'] == "busca") {
			$arrFiltro = array();
			$campos_pesquisa = $this->objeto->getFiltro();
			
			foreach ($campos_pesquisa as $campo => $obj){
				if ($obj->visible && isset($_POST[$obj->campo]) && $_POST[$obj->campo] != '') {
					$arrFiltro[$obj->campo] = $_POST[$obj->campo];
					if (isset($_POST['chk_'.$obj->campo]) && $_POST['chk_'.$obj->campo] != "") {
						$arrFiltro['chk_'.$obj->campo] = true;
					}
				}
			}
			
			$_SESSION[$strFiltro] = $arrFiltro;
		
		}
		
		if (!isset($_SESSION[$strFiltro])) {
			$_SESSION[$strFiltro] = array();
		}
		
		$arrFiltro = $_SESSION[$strFiltro];
		$condicoes = $this->objeto->getBusca($arrFiltro);
		
		if (strpos($this->query,' WHERE ')) {
			$condicoes = str_replace("WHERE","AND",$condicoes);
		}
		
		$this->query .= $condicoes;

		if (isset($_GET['ord']) && $_GET['ord'] != '') {
			$ordem = $_GET['ord'];
			$this->urlOrder = "&ord=".$ordem;

			$this->SQLOrder = " ORDER BY ".$ordem." ";
			if (isset($_GET['dir_ord'])) {
				$ordemDirecao = $_GET['dir_ord'];
				$this->SQLOrder = " ORDER BY ".$ordem." ".$ordemDirecao." ";
				$this->urlOrder .= "&dir_ord=".$ordemDirecao;
			}

		} else if ($this->objeto->SQL_ORDER != '') {
			$this->SQLOrder = " ORDER BY ".$this->objeto->SQL_ORDER." ";
		} else {
			$id = $this->campos;
			$this->SQLOrder = " ORDER BY ".$id[0]->campo." DESC ";
		}

		$this->registroInicial = ($this->currentPage * $this->objeto->totalRegistrosListagem);
		$this->SQLPage = " LIMIT ".$this->registroInicial.",".$this->objeto->totalRegistrosListagem." ";
		$this->composedQuery = $this->query . $this->SQLOrder . $this->SQLPage;
	}	
	
	function montaListagem(){
		$tpl = $this->tpl;
		$mod = $this->objeto;
		
		//MÉTODO PARA CRIAR AS LABELS
		
		if ($this->excluir) {
			$tpl->newBlock('LABELS');
			$tpl->assign('label','<img class="bt-excluir" width="15" src="./comum/img/cms-bt-excluir.gif" title="Excluir registros" alt="Excluir registros" />');
		}
		
		foreach ($this->campos as $campo => $obj) {
			if ($obj->visible) {
				$tpl->newBlock('LABELS');
				$bt_ordenacao = '';
				$dir_ord = '';
				
				if (isset($_GET['ord']) && $_GET['ord'] != '' && $_GET['ord'] == $obj->campo) {
					if ((isset($_GET['dir_ord']) && $_GET['dir_ord'] == '') or !isset($_GET['dir_ord'])) {
						$dir_ord = "&dir_ord=DESC";
						$imgOrdenacao = 'baixo';
					} else {
						$imgOrdenacao = 'cima';
					}
					
					$bt_ordenacao = '<img src="'.IMG_CLASSPATH.'bt-ordenacao_'.$imgOrdenacao.'.gif" />';
				}
				
				$linkOrdenacao = '<a href="index.php?modulo='.$this->modulo.'&acao=listagem&id_tipo='.$this->id_tipo.'&ord='.$obj->campo.$dir_ord.'" title="Ordenar">'.$obj->label.'</a> '.$bt_ordenacao;
				
				if ($obj->tipo == "fSimNao") {
					$linkOrdenacao = '<div align="center">'.$linkOrdenacao.'</div>';
				}
				
				$tpl->assign('label',$linkOrdenacao);
			}
		}
		
		$tpl->goToBlock('_ROOT');
		
		//LOOP NOS REGISTROS
		
		$db = new db();
		$rs = $db->query($this->composedQuery);
		
		while (!$rs->EOF){
			$tpl->newBlock('LINHAS');
			$tpl->assign('chave',$rs->fields($mod->chave));
						
			//CAMPO DELETE
			if ($this->excluir) {
				$tpl->newBlock('CAMPOS');
				$tpl->assign('tam_campo','20');
				$tpl->assign('valor','<input type="checkbox" name="deletar[]" value="'.$rs->fields[$mod->chave].'" title="Excluir registro" />');
			}
			
			//LOOP NOS CAMPOS
			foreach ($this->campos as $campo => $obj) {
				if ($obj->visible) {
					$obj->valor = $rs->fields($obj->campo);
					
					if ($obj->capturarValor) {
						$obj->capturarValor($rs->fields($mod->chave));
					}
					
					$tpl->newBlock('CAMPOS');
					
					if ($this->editar) {
						if ($obj->tipo == 'fSimNao' or $obj->tipo == 'fLink' or $obj->tipo == 'fUpload' ) {
							$tpl->assign('par_editar','');
						} else {
							$tpl->assign('par_editar','onclick="window.location.href=\'index.php?modulo='.$this->modulo.'&acao=cadastro&id_tipo='.$this->id_tipo.'&cod='.$rs->fields[$mod->chave].'\'"');
						}
						if( method_exists($obj, 'recebeValor') ){
							$obj->recebeValor($rs->fields[$mod->chave]);	
						}
					}
					
					$tpl->assign('tam_campo',$obj->width);
					$tpl->assign('valor',$obj->formatListagem());
				}
			}
			
			$rs->moveNext();
		}
		
		$tpl->goToBlock('_ROOT');		
	}
	
	function configFiltro() {
		$mod = $this->objeto;
			
		//MÉTODO PARA CRIAR A PESQUISA
		$campos_pesquisa = $mod->getFiltro();
		$tpl = $this->tpl;
		
		
		
		
		$strFiltro = 'filtro_'.$this->modulo;
		
		if (isset($_SESSION[$strFiltro]) && $_SESSION[$strFiltro] != "") {
			$arrFiltro = $_SESSION[$strFiltro];
		} else {
			$arrFiltro = array();
		}
		
		if (sizeof($campos_pesquisa) > 0) {
			
			$tpl->newBlock('PESQUISA');
			/*if( $_GET['evento']) {
				$tpl->assign('status','aberto');
			} else {
				$tpl->assign('status','fechado');
			}*/
			$tpl->assign('IMG_CLASSPATH',IMG_CLASSPATH);
			$tpl->assign('modulo',$this->modulo);
			$tpl->assign('acao','listagem');
			$tpl->assign('id_tipo',$this->id_tipo);
			
			foreach ($campos_pesquisa as $campo => $obj) {
				if ($obj->visible) {
					if (isset($arrFiltro[$obj->campo]) && $arrFiltro[$obj->campo] != '') {
						$obj->valor = $arrFiltro[$obj->campo];
					}
					
					$tpl->newBlock('PESQUISA-CAMPO');
					$tpl->assign('label',$obj->label);
					$tpl->assign('fieldname',$obj->campo);
					$tpl->assign('input',$obj->formatForm());
					
					if (isset($arrFiltro['chk_'.$obj->campo]) && $arrFiltro['chk_'.$obj->campo] != "") {
						$tpl->assign('field_checked',"checked=\"checked\"");
					}
				}
			}
		}
		
	}

}

?>
