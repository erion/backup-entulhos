<?php
/**
 * Description of FormBuilder
 *
 * @author Erion
 */
class FilterBuilder {

	private $config;       //item do config filter_builder a ser pego
	private $form_location;//pasta com os campos do form
	private $CI;
	private $artigos_in;
	private $artigos_not_in;
	public  $form_action;

	function FilterBuilder() {
		$this->CI = &get_instance();
		$this->CI->config->load('filter_builder');
	}

	function getField($fieldname) {
		$this->view->load();
	}

	function initialize($config) {
		$index = 'filter_builder_'.$config['item'];
		$this->config = $this->CI->config->item($index);
		$this->form_location = $config['form_location'];
		$this->form_action = $config['form_action'];
		$this->CI->load->library('ConfigFilter');
	}

	function filtro_artigos_in_notin() {
		if (isset($_GET['artigo_in'])) {
			if($_GET['artigo_in'][0] != 'Digite o nome de um artigo' && $_GET['artigo_in'] != 'Array') {
				if ($this->CI->configfilter->change_filter($this->CI->input->get('artigo_in'),'artigo_in')) {
					$this->CI->configfilter->insere_filtro($this->CI->input->get('artigo_in'),'artigo_in');
					$this->artigos_in = '';
				} else $this->artigos_in = $this->CI->configfilter->get_artigo_in();
			} else $this->CI->configfilter->limpa_filtro('artigo_in');
		} else $this->artigos_in = $this->CI->configfilter->get_artigo_in();
		if (isset($_GET['artigo_not_in'])) {
			if($_GET['artigo_not_in'][0] != 'Digite o nome de um artigo' && $_GET['artigo_not_in'] != 'Array') {
				if ($this->CI->configfilter->change_filter($this->CI->input->get('artigo_not_in'),'artigo_not_in')) {
					$this->CI->configfilter->insere_filtro($this->CI->input->get('artigo_not_in'),'artigo_not_in');
					$this->artigos_not_in = '';
				} else $this->artigos_not_in = $this->CI->configfilter->get_artigo_not_in();
			} else $this->CI->configfilter->limpa_filtro('artigo_not_in');
		} else $this->artigos_not_in = $this->CI->configfilter->get_artigo_not_in();
	}

	function build() {
		$this->filtro_artigos_in_notin();
		//$this->data['artigo_in'] = $this->artigos_in;
		//$this->data['artigo_not_in'] = $this->artigos_not_in;
		$j = -1;
		foreach($this->config as $k => $v) {
			if(is_array($v)) {
				echo "<div class='linha'>";
				foreach($v as $k2 => $v2) {
					if(is_array($v2)) {
						$j++;
						echo ($j%2) ? "<span class='coluna_r'>" : "<span class='coluna_l'>";
						for($i=0;$i<=count($v2)-1;$i++) {
							if($v2[$i] == 'aplicar')
								echo "<span class='btn_aplicar'>";
							else
								echo "<span>";
							$this->CI->load->view($this->form_location.$v2[$i]);
							echo "</span>";
						}
						echo "</span>";
					} else {
						$this->CI->load->view($this->form_location.$v2);
					}
				}
				echo "</div>";
			}
		}
	}

}
?>
