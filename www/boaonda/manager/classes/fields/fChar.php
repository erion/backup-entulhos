<?php
	class fChar extends Field {
		function fChar($campo,$label="",$obrigatorio=true,$maxLength=255,$width="",$visible=true, $readonly=0) {
			$this->tipo = 'fChar';
			$this->campo = $campo;
			$this->valor = "";
			$this->tipoBusca = "%";
		    $this->maxlength = $maxLength;
			$this->setObrigatorio($obrigatorio);
			$this->label = $label;
			$this->dbType = ' VARCHAR ';
			$this->visible = $visible;
			$this->readonly = $readonly;
			$this->width = $width;
		}

		function formatForm() {
			if ($this->readonly == 1) {
				$readonly = ' readonly="readonly" ';
			} else {
				$readonly = "";
			}

			$obrigatorio = $this->getObrigatorio();
			$validacao = $this->getValidacao();
			$label = $this->getLabel();

			$this->valor = str_replace('"','&quot;',$this->valor);

			$s = '<input class="input-text '.$obrigatorio.' '.$this->validacao.' " name="'.$this->campo.'" id="'.$this->campo.'" maxlength="'.$this->maxlength.'" value="'.$this->valor.'" '.$readonly.' />';

			return $s;
		}

		function formatListagem() {
			$this->valor = str_replace('"','&quot;',$this->valor);
			return $this->valor;
		}

		function getCampo(){
			return $this->campo;
		}
	}
