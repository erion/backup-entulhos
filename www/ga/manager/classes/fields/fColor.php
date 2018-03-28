<?php
	class fColor extends Field {
		function fColor($campo, $label="", $obrigatorio=true) {
			$this->tipo = 'fColor';
			$this->campo = $campo;
			$this->valor = "";
			$this->tipoBusca = "%";
		    $this->maxlength = 6;
			$this->setObrigatorio($obrigatorio);
			$this->label = $label;
			$this->dbType = ' VARCHAR ';
		}

		function formatForm() {
			$obrigatorio = $this->getObrigatorio();
			$validacao = $this->getValidacao();
			$label = $this->getLabel();

			$this->valor = str_replace('"','&quot;',$this->valor);

			$s = '
				<input class="input-text color-pick '.$obrigatorio.' '.$this->validacao.' " name="'.$this->campo.'" id="'.$this->campo.'" value="'.$this->valor.'" size="6" maxlength="'.$this->maxlength.'" />
				<script type="text/javascript">
				$("#'.$this->campo.'").ColorPicker({
					onSubmit: function(hsb, hex, rgb, el) {
						$(el).val(hex);
						$(el).ColorPickerHide();
					},
					onBeforeShow: function () {
						$(this).ColorPickerSetColor(this.value);
					}
				})
				.bind("keyup", function(){
					$(this).ColorPickerSetColor(this.value);
				});
				</script>
			';

			return $s;
		}

		function formatListagem() {
			$this->valor = '<div class="color-pick-box" style="background-color:#'.str_replace('"','&quot;',$this->valor).'"></div>';
			
			return $this->valor;
		}

		function getCampo(){
			return $this->campo;
		}
	}
