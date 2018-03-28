<?php
    class Logs extends Controller {

        function logs() {
            parent::Controller();
            $this->load->model('log');
            $this->data['titulo'] = $this->log->titulo;
            $this->data['usuario_logado'] = $this->session->userdata('nome');
            $this->data['tipo_usuario'] = $this->session->userdata('tipo');

            verificar_permissao($this->session->userdata('tipo'),array('SAD','ADM'));

            seleciona_menu($this,'diario_menu');
        }

        function listar() {
            $l = new Log();
            $l->order_by("created_at desc");

            $CI = &get_instance();
            $por_pagina = $CI->config->item('pedidos_por_pagina');

            if (!empty($_GET)) {
                $l->filtrar();
                $contador = $l->count();
                $l->filtrar();
                $this->data['l'] = $l->get($por_pagina,$this->input->get('per_page'))->all;
            } else {
                $l->where('relation_table','entidades');
                $this->data['l'] = $l->get($por_pagina,$this->input->get('per_page'))->all;
                $l->where('relation_table','entidades');
                $contador = $l->count();
            }
            
            $c = new Cliente();
            $this->data['clientes'] = $c->get_dropdown();

            $u = new Usuario();
            $this->data['usuarios'] = $u->get_dropdown();

            $this->load->library('pagination');
            $this->pagination->initialize(config_pagination('logs/listar',$contador,'per_page'));

			$config['item'] = 'D_VISITA';
			$config['form_location'] = 'filter_builder/diario/';
			$config['form_action'] = 'logs/listar';
			$this->load->library('FilterBuilder');
			$this->filterbuilder->initialize($config);

            $this->view->load('log/listar',$this->data);
        }

        function cadastrar() {
            $post = $this->input->post('log');
            $this->data['jsatual'] = array('extjs/ext.ux.htmleditor-all-debug');

            $c = new Cliente();
            $this->data['clientes'] = $c->get_dropdown();

            if (empty($post)) {
                $this->data['log'] = $l = new Log();
                $this->view->load('log/form',$this->data);
            } else {
                $this->data['log'] = $l = new Log($this->input->post('log'));
                $l->relation_table = 'entidades';
                $l->usuario_id = $this->session->userdata('id');
                if ($l->save()) {
                    redirect('logs/listar');
                }
                $this->view->load('log/form',$this->data);
            }
        }

        function detalhes($id) {
            $post = $this->input->post('log');
            $this->data['jsatual'] = array('log_cadastrar');

            $c = new Cliente();
            $this->data['clientes'] = $c->get_dropdown();

            if (empty($post)) {
                $l = new Log();
                $this->data['log'] = $l->get_by_id($id);
                $this->view->load('log/form',$this->data);
            } else {
                $this->data['log'] = $l = new Log($this->input->post('log'));
                $l->id = $id;
                $l->relation_table = 'entidades';
                $l->usuario_id = $this->session->userdata('id');
                if ($l->save()) {
                    redirect('logs/listar');
                }
                $this->view->load('log/form',$this->data);
            }
        }

        function excluir($id,$pag = null) {
            $l = new Log();
            $l->get_by_id($id);
            $l->delete();
            $uri = 'logs/listar/'.$pag;
            redirect($uri);
        }
    }
?>
