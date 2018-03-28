<?php

class fComboAdd extends Field {
	var $campo_label;
	var $classe;
	var $restricao;
	var $ajaxfile;
	var $tabela;
	var $txtSelecione;
	var $txtNovo;
	var $editar;
	var $excluir;
	var $adicionar;
	
	function fComboAdd($campo, $label, $campo_label, $tabela, $classe, $texto_selecione = "Selecione", $texto_novo = "Adicionar...", $editar=true, $excluir=true, $adicionar=true, $obrigatorio = true) {
		$this->tipo = 'fComboAdd';
		$this->campo = $campo;
		$this->classe = $classe;
		$this->valor = "";
		$this->label = $label;
		$this->campo_label = $campo_label;
		$this->tabela = $tabela;
		$this->txtSelecione = $texto_selecione;
		$this->txtNovo = $texto_novo;
		$this->editar = $editar;
		$this->excluir = $excluir;
		$this->adicionar = $adicionar;
		$this->restricao = "";
		$this->ajaxfile = "";
		$this->dbType = ' INT ';
		$this->setObrigatorio( $obrigatorio );
			
		$this->verifyTable();
	}
	
	function verifyTable() {
		$objs = array();
		
		$objs[] = new fId($this->campo);
		$objs[] = new fChar($this->campo_label,$this->label);
		
		$campos = '';
		foreach($objs as $valor){
			if (strlen($campos) > 0) { $campos .= ','; }
			$campos .= $valor->getSQL();
		}

		$db = new db();
		$db->query("CREATE TABLE IF NOT EXISTS ".$this->tabela." ( " . $campos . " ) ENGINE=Innodb ");
	}
	
	function formatForm() {
		if ($this->restricao != "")
			$this->restricao = " WHERE ".$this->restricao;
		
		if ($this->ajaxfile == "") {
			$this->ajaxfile = "actions.php";
		}
		
		$s = '<div id="divContainer_'.$this->campo.'" style="margin-bottom:8px;">';
		$s .= '<div id="div_'.$this->campo.'" style="margin-bottom:8px;">';
		$s .= '<select class="input_select" name="'.$this->campo.'" id="'.$this->campo.'" onchange="javascript:chkComboAdd(\''.$this->campo.'\', this);">';
		$s .= '<option value="'.$this->campo.'_0" style="background-color:#FFF3B3;" >'.$this->txtSelecione.'</option>';
		
		if ($this->adicionar == "true") {
			$s .= '<option value="'.$this->campo.'_novo" style="background-color:#FFF3B3;" >'.$this->txtNovo.'</option>';
		}
		
		$db = new db();
		$vQuery = "select ".$this->campo.", ".$this->campo_label." from ".$this->tabela." ".$this->restricao." order by ".$this->campo_label;
		$rsQ = $db->query($vQuery);
		
		$tmpValorInicialCod = '';
		$tmpValorInicialLabel = '';

		while (!$rsQ->EOF)
		{
			if ($this->valor == $rsQ->Fields($this->campo)) {
				$sel = "selected";
				$tmpValorInicialCod = $this->valor;
				$tmpValorInicialLabel = $rsQ->Fields($this->campo_label);
			} else {
				$sel = "";
			}
			
			if ( $this->ajax == true )
				$s .= '<option '.$sel.' value="'.$rsQ->fields($this->campo).'">'.utf8_encode( $rsQ->fields( $this->campo_label ) ).'</option>';
			else
				$s .= '<option '.$sel.' value="'.$rsQ->fields($this->campo).'">'.$rsQ->fields($this->campo_label).'</option>';
			
			$rsQ->MoveNext();
		}
		
		$s .= '</select>';
		$s .= '<input type="hidden" name="hdn_cod_'.$this->campo.'" id="hdn_cod_'.$this->campo.'" value="'.$tmpValorInicialCod.'" />';
		$s .= '<input type="hidden" name="hdn_label_'.$this->campo.'" id="hdn_label_'.$this->campo.'" value="'.$tmpValorInicialLabel.'" />';
		if ($this->editar) {
			$s .= '&nbsp;<input class="checkboxComboAdd" type="checkbox" value="s" name="lista_'.$this->campo.'" id="lista_'.$this->campo.'" onClick="javascript:chkComboAdd(\''.$this->campo.'\', \'\');" class="checkbox">';
			$s .= '<label for="lista_'.$this->campo.'">Edi&ccedil;&atilde;o</label>';
		}
		$s.="</div>";
		$s .= '<div id="div_novo_'.$this->campo.'" style="display:none;">';
		$s .= '<input type="text" class="input_text" name="novo_'.$this->campo.'" id="novo_'.$this->campo.'">&nbsp;&nbsp;';
		$s .= '<input type="button" class="button" value="Adicionar" name="ok_'.$this->campo.'" id="ok_'.$this->campo.'" onClick="javascript:actionComboAdd(\''.$this->ajaxfile.'\', \''.$this->classe.'\', \''.$this->campo.'\', \'add\', \'divContainer_\');">';

		if ($this->editar) {
			$s .= '<input style="display:none;" type="button" class="button" value="Alterar" name="btEditar_'.$this->campo.'" id="btEditar_'.$this->campo.'" onClick="javascript:actionComboAdd(\''.$this->ajaxfile.'\', \''.$this->classe.'\', \''.$this->campo.'\', \'edit\', \'divContainer_\');">';
		}
		if ($this->excluir) {
			$s .= '<input style="display:none;" type="button" class="button" value="Excluir" name="btExcluir_'.$this->campo.'" id="btExcluir_'.$this->campo.'" onClick="javascript:actionComboAdd(\''.$this->ajaxfile.'\', \''.$this->classe.'\', \''.$this->campo.'\', \'delete\', \'divContainer_\');">';
		}
		$s .= '</div>';
		$s .= '</div>';

		return $s;
	}

	function formatListagem() {
		$db = new db();
		$vQuery = "SELECT ".$this->campo_label." FROM ".$this->tabela." WHERE ".$this->campo."=".$this->valor;
		$rs = $db->query($vQuery);
		
		return $rs->fields($this->campo_label);
	}
	
	function prePost() {
		if (($this->valor == $this->campo."_0") || ($this->valor == $this->campo."_novo")) {
			$this->valor = 0;
		}
	}
	
}

?>
