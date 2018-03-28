<?php
class fManyToMany extends Field {
	var $valores;
	var $exibirSelecione;
	var $valor;
	var $classePK;
	var $classeFK;
	var $labelPK;
	var $labelFK;
	
	function fManyToMany($campoFK, $label, $classePK, $labelPK, $classeFK, $labelFK, $visible=true, $valores="") {
		if ($valores == "") { $valores = array(); }
		
		$this->tipo = 'fManyToMany';
		$this->campo = $campoFK;
		$this->label = $label;
		$this->valores = $valores;
		$this->visible = $visible;
		$this->valor = array();
		$this->classePK = $classePK;
		$this->classeFK = $classeFK;
		$this->labelPK = $labelPK;
		$this->labelFK = $labelFK;
		$this->dbType = '';	
		$this->capturarValor = true;			
		$this->verifyTable();
	}
	
	function getTableName() {
		$buffVerificar = $GLOBALS['VERIFICAR_TABELAS'];
		$GLOBALS['VERIFICAR_TABELAS'] = false;
				
		$cpk = $this->classePK;
		$cfk = $this->classeFK;
		
		$cpk = new $cpk();
		$cfk = new $cfk();

		$GLOBALS['VERIFICAR_TABELAS'] = $buffVerificar;
		
		if ($cpk->getNomeSecao() == SECAO_SYSTEM) {
			$nomeTabela = "mgr_".str_replace('mgr_','',$cpk->tabela)."_".str_replace('mgr_','',$cfk->tabela);
		} else {
			$nomeTabela = $cpk->tabela.'_'.$cfk->tabela;
		}
		return $nomeTabela;
	}
	
	function verifyTable() {
		$buffVerificar = $GLOBALS['VERIFICAR_TABELAS'];
		$GLOBALS['VERIFICAR_TABELAS'] = false;
				
		$cpk = $this->classePK;
		$cfk = $this->classeFK;
		
		$cpk = new $cpk();
		$cfk = new $cfk();

		$GLOBALS['VERIFICAR_TABELAS'] = $buffVerificar;
		$nomeTabela = $this->getTableName();
		
		$pk = $cpk->chave;
		$fk = $cfk->chave;
		
		$db = new db();
		$query = "CREATE TABLE IF NOT EXISTS ".$nomeTabela." (".$pk." INT NOT NULL, ".$fk." INT NOT NULL, PRIMARY KEY (".$pk.",  ".$fk.")) ENGINE=Innodb ";		
		$db->query($query);
	}
	
	function formatForm() {
		if ($this->readonly == 1) {
			$readonly = ' readonly="readonly" ';
		} else {
			$readonly = "";
		}

		if (isset($this->width))
			$width = "width:".$this->width.";";
		else
			$width = "";
		
			
					
		$s = '<div class="campoManyMany">';
		if( empty($this->valores) ) {
			$s.="Não há itens cadastrados.";
		} else {
			foreach ($this->valores as $id => $rotulo) {
				if (in_array($id,$this->valor)) {
					$checked = ' checked="checked" ';
				} else {
					$checked = '';
				}

				$rotulo = ctype_xdigit($rotulo) ? '<div class="color-pick-box fManyToMany" style="background-color:#'.str_replace('"','&quot;',$rotulo).'"></div>' : $rotulo;

				$s .= '<label><input type="checkbox" '.$checked.' name="'.$this->campo.'[]" id="'.$this->campo.'" value="'.$id.'" /> '.$rotulo.'<br /></label>';
			} 
		}
		$s.='</div>';
		return $s;
	}
	
	function doPost($cod, $classe) {
		$cpk = $this->classePK;
		$cpk = new $cpk();
		$pk = $cpk->chave;
		
		$cfk = $this->classeFK;		
		$cfk = new $cfk();
		$fk = $cfk->chave;
		
		$nomeTabela = $this->getTableName();

		if ($classe == $this->classePK) {
			$campo1 = $pk;
			$campo2 = $fk;
		} else {
			$campo2 = $pk;
			$campo1 = $fk;
		}

		$db = new db();
		$query = "DELETE FROM ".$nomeTabela." WHERE ".$campo1."=".$cod;
		
		$rs = $db->query($query);
		
		if (isset($_POST[$this->campo]) && is_array($_POST[$this->campo])) {
			$this->valor = $_POST[$this->campo]; 
		} else {
			$this->valor = array();
		}
		
		if (isset($this->valor) && is_array($this->valor) && count($this->valor) > 0) {
			foreach ($this->valor as $val) {
				$query = "INSERT INTO ".$nomeTabela." (".$campo1.", ".$campo2.") VALUES ('".$cod."','".$val."')";
				$rs = $db->query($query);
			}
		}
		
	}

	function formatListagem() {
		$html = "<ul>";
		
		if (is_array($this->valor)) {
			foreach ($this->valor as $id) {
				if (isset($this->valores[$id])) {
					$html .= "<li>".$this->valores[$id]."</li>";
				}
			}
		}
		
		$html .= '</ul>';
		
		return $html;
	}
	
	function capturarValor($cod="") {
		if ($cod == '') {
			$cod = 0;
		}
		//die($cod);
		
		$db = new db();
		
		$this->valores = array();
		
		$classePK = $this->classePK;
		$classeFK = $this->classeFK;
		
		$objPK = new $classePK();
		$objFK = new $classeFK();		
		
		$classe = $this->classePK;
		$label = $this->labelPK;
		$obj = $objPK;
		$chave = $objFK->chave;
		
		if ($obj->chave != $this->campo) {
			$classe = $this->classeFK;
			$label = $this->labelPK;
			$obj = $objFK;
			$chave = $objPK->chave;
			
			if ($obj->chave != $this->campo) {
				$obj = "";
			}
		}
		
		if ($obj != "") {
			$query = "SELECT ".$this->campo.", ".$label." FROM ".$obj->tabela." ORDER BY ".$label;
			$rs = $db->query($query);
			
			while (!$rs->EOF) {
				$this->valores[$rs->fields($this->campo)] = $rs->fields($label);
				$rs->moveNext();
			}
			
			$query = "SELECT ".$this->campo." FROM ".$this->getTableName()." WHERE ".$chave."=".$cod;
			$rs = $db->query($query);
			
			$this->valor = array();
			while (!$rs->EOF) {
				$this->valor[] = $rs->fields($this->campo);
				$rs->moveNext();
			}
		}
	}
}

