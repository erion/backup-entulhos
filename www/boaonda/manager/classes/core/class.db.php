<?php

class db
{
	var $db;
	var $tabela;
	var $obrigatorios;
	var $chave;
	var $campos;
	var $recordSet;
	var $transaction;
	
	function db() {
		//Instanciar classe SQL INJECTION;
		if (!$this->db) {
			global $GLOBAL_CONNECTION;
			
			if (!$GLOBAL_CONNECTION || $GLOBAL_CONNECTION == 'FALHA') {
				$GLOBAL_CONNECTION = ADONewConnection(DBType);
				$GLOBAL_CONNECTION->Connect(DBServer, DBUser, DBPassword, DBDatabase);
			}
			
			$this->db = $GLOBAL_CONNECTION;
		}

		$this->setTransaction();
	}

	function configDb($cod="") {
		$this->db();
		
		if ($cod == "") { // modo insert
			$this->_modo = "insert";
			$this->campos = $this->loadFields($this->tabela);
		} else { // modo update
			$query = "SELECT * FROM ". $this->tabela ." WHERE ". $this->chave ."=".$cod;
			$rs = $this->query($query);
			
			$this->recordSet = $rs;
						
			$this->_modo = "update";
			$this->campos = $this->loadFields($this->tabela, $this->recordSet);
		}
	}
	
	// Monta a "view" da tabela, automaticamente. :)
	function buildView() {
		$arrCampos = $this->db->MetaColumns($this->tabela);
	}

	function loadFields($tabela, $rsQuery = "") {	
		$arr_temp = array();
		$arrCampos = $this->db->MetaColumns($tabela);
		
		if (is_object($rsQuery)) {
			foreach ($arrCampos as $campo) {
				$arr_temp[$campo->name] = $rsQuery->fields($campo->name);
			}
		} else if (is_array($arrCampos)) {
			foreach ($arrCampos as $campo) {
				$arr_temp[$campo->name] = NULL;
			}
		}		
		return $arr_temp;
	}
		
	function query($query) {
		if ( $this->transaction )
			$rs = $this->db->Execute($query) or $this->rollback();
		else
			$rs = $this->db->Execute($query) or $this->showErro($this->db->ErrorMsg(), $query);

		return $rs;
	}
	
	function insert_id(){
		return $this->db->Insert_ID();
	}

	function command($cmdSQL) {
		$this->query($cmdSQL);
	}

	function showErro($msg, $query = "") {
		echo "<div><strong>Ocorreu um erro:</strong> ".$msg."</div>";
		if ($query != "") {
			echo "<div><strong>Instrução SQL:</strong> ".$query."</div>";
		}
		exit();
	}

	function _insert() {
		$query = $this->db->GetInsertSQL($this->tabela, $this->campos);
		$this->command($query);
		
		$query = "SELECT ".$this->chave." FROM ".$this->tabela." ORDER BY ".$this->chave." DESC";
		$rs = $this->query($query);
		
		$this->campos[$this->chave] = $rs->fields($this->chave);
		
		return $this->campos[$this->chave];
	}
	
	function _update($condicao="") {
		if ($condicao == "" && isset($this->chave) && $this->chave != "" && isset($this->campos[$this->chave]) && $this->campos[$this->chave] != "") {
			$condicao = $this->chave."=".$this->campos[$this->chave];
		}
		
		if ($condicao != "") {
			$query = "SELECT * FROM ".$this->tabela." WHERE ".$condicao;
			$rs = $this->query($query);
			
			$query = $this->db->GetUpdateSQL($rs, $this->campos);
			
			if ($query) {
				$this->command($query);
			}
		}
	}
		
	function _delete($tabela="", $condicao="") {
		if ($tabela == "" && $condicao == "" && $this->chave != "" && $this->tabela != "" && isset($this->campos) && is_array($this->campos) && $this->campos[$this->chave] != "") {
			$query = "DELETE FROM ". $this->tabela ." WHERE ".$this->chave."=".$this->campos[$this->chave];
			$this->command($query);
		} else if ($tabela != "" && $condicao != "") {
			$query = "DELETE FROM ". $tabela ." WHERE ".$condicao;
			$this->command($query);
		}
	}

	function setTransaction( $bool = false ) {
		$this->transaction = $bool;
	}
	
	function startTransaction() {
		$this->setTransaction( true );
		$this->query( 'START TRANSACTION;' );
		$this->query( 'SET AUTOCOMMIT=0;' );
	}

	function rollback() {
		$this->query( 'ROLLBACK;' );
		return false;
	}

	function endTransaction() {
		$this->query( 'COMMIT;' );
		$this->setTransaction();
	}
}

