<?php
	class Metas extends Controller {

		function metas() {
			parent::Controller();
            $this->load->model('meta');
            $this->data['titulo'] = 'Metas';
            $this->data['usuario_logado'] = $this->session->userdata('nome');
            $this->data['tipo_usuario'] = $this->session->userdata('tipo');

            verificar_permissao($this->session->userdata('tipo'),array('SAD','ADM'));

            seleciona_menu($this,'meta_menu');
		}

		function listar() {
			$CI = &get_instance();
            $por_pagina = $CI->config->item('pedidos_por_pagina');

			$m = new Meta();
			$this->data['metas'] = $m->listar($por_pagina,$this->input->get('per_page'));
			//$this->data['metas'] = $m->get()->all;
			$in_out = $m->entradas_saidas();
			$this->data['in_out'] = $in_out;
			$count = new Meta();

			$this->load->library('pagination');
            $this->pagination->initialize(config_pagination('metas/listar', $count->count(),'per_page'));
			$this->view->load('meta/listar',$this->data);
		}

		function cadastrar() {
			$f = new Fornecedor();
			$this->data['fornecedores'] = $f->get_dropdown();

			$this->data['meta'] = $m = new Meta();

			$this->data['jsatual'] = array('meta_cadastrar');

			$post = $this->input->post('metas');
			if(!empty($post)) {
				$m = new Meta($post);
				$m->data_inicio = data_mysql($m->data_inicio);
				$m->data_fim = data_mysql($m->data_fim);
				$m->save();
				redirect('metas/listar');
			}

			$semana = date('w',now());
			if($semana > 3) { //3 = quarta-feira
				$semana = $semana - 3;
				$this->data['data_inicio'] = date('Y-m-d', time() - ($semana * 24 * 60 * 60));
				$semana += 7;
				$this->data['data_fim'] = date('Y-m-d', time() + ($semana * 24 * 60 * 60));
			} elseif ($semana < 3) {
				$semana = 3 - $semana;
				$this->data['data_inicio'] = date('Y-m-d', time() + ($semana * 24 * 60 * 60));
				$semana += 7;
				$this->data['data_fim'] = date('Y-m-d', time() + ($semana * 24 * 60 * 60));
			} else {
				$this->data['data_inicio'] = date('Y-m-d', time() + ($semana * 24 * 60 * 60));
				$semana += 7;
				$this->data['data_fim'] = date('Y-m-d', time() + ($semana * 24 * 60 * 60));
			}

			$this->view->load('meta/form',$this->data);
		}

		function excluir($id) {
			$m = new Meta();
			$m->get_by_meta_id($id);
			$m->delete();
			redirect('metas/listar');
		}
	}
?>
