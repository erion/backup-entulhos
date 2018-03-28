<?php
class AjaxListagem extends View {
	var $template;
	var $modulo;
	var $acao;
	var $query;
	var $excluir;
	var $editar;
	
	function AjaxListagem($campos,$modulo,$query,$acao="delete",$template="ajax-list",$excluir=true,$editar=true) {
		$this->campos = $campos;
		$this->modulo = $modulo;
		$this->acao = $acao;
		$this->query = $query;
		$this->template = HTML_CLASSPATH.$template.".htm";
		$this->excluir = $excluir;
		$this->editar = $editar;
		$this->montaListagem();
	}
	
	function montaListagem(){
		
		$tpl = new TemplatePower($this->template);
		$tpl->prepare();
		$tpl->assign('modulo',$this->modulo);
		$tpl->assign('acao',$this->acao);
		
		//INICIALIZA A CLASSE ATUAL
		$mod = $this->modulo;
		$mod = new $mod();
				
		//MÉTODO PARA CRIAR A PESQUISA
		$campos_pesquisa = $mod->getFiltro();
		if(sizeof($campos_pesquisa) > 0){
			$tpl->newBlock('PESQUISA');
			$tpl->assign('modulo',$this->modulo);
			$tpl->assign('acao','listagem');

			foreach($campos_pesquisa as $campo => $obj){
				if($obj->visible){
					$tpl->newBlock('PESQUISA-CAMPO');
					$tpl->assign('label',$obj->label);
					$tpl->assign('input',$obj->formatForm());
				}
			}
		}
		
		//MÉTODO PARA CRIAR AS LABELS
		$tpl->newBlock('LABELS');
		if ($this->excluir) {
			$tpl->assign('label','<img class="bt-excluir" width="15" src="./comum/img/cms-bt-excluir.gif" title="Excluir registros" alt="Excluir registros" />');
		}
		foreach ($this->campos as $campo => $obj) {		
			if ($obj->visible) {
				$tpl->newBlock('LABELS');
				$tpl->assign('label',htmlentities($obj->label));
			}
		}
		
		$tpl->goToBlock('_ROOT');
		//REFERENTE AO ORDER BY
		$SQL_ORDER = '';
		$link_ordenar = '';
		if(isset($_GET['ord']) && $_GET['ord'] != ''){
			$link_ordenar = "&ord=".$_GET['ord'];
			if(isset($_GET['dir_ord']) && $_GET['dir_ord'] == 'DESC'){
				$SQL_ORDER = " ORDER BY ".$_GET['ord']." DESC ";
				$link_ordenar .= "&dir_ord=DESC";
			}else{
				$SQL_ORDER = " ORDER BY ".$_GET['ord']." ";
			}
		}else if($mod->SQL_ORDER != ''){
			$SQL_ORDER = " ORDER BY ".$mod->SQL_ORDER." ";
		}
		//MÉTODO PARA PEGAR OS VALORES
		$db = new db;
		//REFERENTE A PAGINACAO
		$paginacao = 0;
		if(isset($_GET['paginacao']) && $_GET['paginacao'] != ''){
			$paginacao = $_GET['paginacao'];
		}

		$SQL_PAGINACAO = " LIMIT $paginacao,".$mod->totalRegistrosListagem." ";
		//$SQL_PAGINACAO = "";
		//REFERENTE A CONSULTA NO BANCO
		if(isset($_GET['qr']) && $_GET['qr'] != ''){
			$this->query = base64_decode($_GET['qr']);
		}
		//EXECUTA A QUERY
		$rs = $db->query($this->query . $SQL_ORDER);
		//NRO DE REGISTROS ENCONTRADOS
		$tot_registros = $rs->recordCount();
		$rs = $db->query($this->query.$SQL_ORDER.$SQL_PAGINACAO);
		$paginacao_tot = $paginacao+10;
		if($paginacao_tot > $tot_registros){
			$paginacao_tot = $tot_registros;
		}
		/*if($tot_registros > 0){
			$tpl->assign('nro_registros',($paginacao+1).' ao '.$paginacao_tot.' de '.$tot_registros);
		}else{*/
			$tpl->assign('nro_registros',$tot_registros);
		//}
		
		
		//LOOP NOS REGISTROS
		while(!$rs->EOF){
			$tpl->newBlock('LINHAS');
			$tpl->assign('chave',$rs->fields($mod->chave));
			//CAMPO DELETE
			if ($this->excluir) {
				$tpl->newBlock('CAMPOS');
				$tpl->assign('tam_campo','20');
				$tpl->assign('valor','<input type="checkbox" name="deletar[]" value="'.$rs->fields[$mod->chave].'" class="chk-excluir" title="Excluir registro" />');
			}
			//LOOP NOS CAMPOS
			foreach ($this->campos as $campo => $obj) {
				if ($obj->visible) {
					$obj->valor = $rs->fields($obj->campo);
					
					$tpl->newBlock('CAMPOS');
					
					if ($obj->tipo != 'fSimNao') {
						if($this->modulo == 'Produtorecomendacao'){
							
						}else{
							$url = 'actions.php?field=fMicroModulo&method=ajax&classe='.$this->modulo.'&campo='.$_GET['campo'].'&acao=cadastro&cod='.$rs->fields($mod->chave).'&evento=busca&acaoSubmit=editar';
							$tpl->assign('par_editar',"onclick=\"javascript:callActionViaURL('".$url."', '".$this->modulo."', '".$_GET['campo']."', 'cadastro','".$_GET[$_GET['valor']]."')\"");
						}
					} else {
						$tpl->assign('par_editar','');
					}
					
					$valor = $obj->formatListagem();
					
					/*if ($obj->useSpecialChars) {
						$valor = htmlentities($valor);
					}*/
					
					$tpl->assign('tam_campo',$obj->width);
					$tpl->assign('class-campo', $obj->campo);	
					if(isset($_GET['method']) && $_GET['method'] == 'ajax') {
						$tpl->assign('valor',utf8_encode($valor));
					}else{
						$tpl->assign('valor',$valor);
					}
				}
			}
			$rs->moveNext();
		}
		$tpl->goToBlock('_ROOT');
		
		$this->html = $tpl->getOutputContent();
	}
}

?>