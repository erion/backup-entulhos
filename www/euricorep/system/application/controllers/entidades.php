<?php

Class Entidades extends Controller {

    function Entidades() {
        parent::Controller();
        $this->data['usuario_logado'] = $this->session->userdata('nome');
        $this->data['tipo_usuario'] = $this->session->userdata('tipo');
        seleciona_menu($this, 'cadastro_menu');
    }

    function listar($tabela, $menu_principal = false) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $this->data['menu_acesso'] = $menu = null;
        if ($menu_principal) {
            seleciona_menu($this, 'clientes_menu');
            $this->data['menu_acesso'] = $menu = 1;
        }
        $this->load->helper('inflector');
        $tipo = strtoupper(singular($tabela));
        $e = new Entidade();
        $e->where('invisivel', '0');
        $e->where('tipo', $tipo);
        $e->filtrar();
        $this->data['titulo'] = ucfirst(plural($tabela));

        $CI = &get_instance();
        $por_pagina = $CI->config->item('pedidos_por_pagina');

        if ($this->input->get('order')) {
            $e->order_by($this->input->get('campo'), $this->input->get('order'));
        } else
            $e->order_by('nome');

        $this->data['e'] = $e->get($por_pagina, $this->input->get('per_page'))->all;
        $e->filtrar();
        $contador = $e->where('tipo', strtoupper($tabela))->count();

        $this->load->library('pagination');
        $this->pagination->initialize(config_pagination("entidades/listar/" . $tabela . "/", $contador, 'per_page', "entidades"));

        if (strtoupper($tabela) == strtoupper('cliente')) {
            $config['item'] = 'clientes';
            $config['form_location'] = 'filter_builder/clientes/';
            $config['form_action'] = 'entidades/listar/cliente/' . $menu;
            $this->load->library('FilterBuilder');
            $this->filterbuilder->initialize($config);
            $this->view->load('entidade/listar_clientes', $this->data);
        } else
            $this->view->load('entidade/listar', $this->data);
    }

    function cadastrar($tabela) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $this->data['jsatual'] = array('entidade_cadastrar', 'ajaxfileupload');
        $post = $this->input->post('entidade');
        $this->data['tipo'] = strtoupper(singular($tabela));
        $this->data['titulo'] = ucfirst($tabela);
        $u = new Usuario();
        $this->data['vendedores'] = $u->get_dropdown_representante();
        $this->data['entidade_id'] = '';
        $tabela = strtoupper(singular($tabela));
        if (empty($post)) {
            $this->load->helper('inflector');
            $this->data['entidade'] = $e = new Entidade();
        } else {
            $this->load->helper('inflector');
            $this->data['entidade'] = $e = new Entidade($this->input->post('entidade'));
            $e->tipo = $this->data['tipo'];
            if ($e->save()) {
                if (@opendir('logos/' . $e->id . "/")) {
                    foreach (glob("logos/" . $e->id . "/*.{jpg,gif,png}", GLOB_BRACE) as $filename) {
                        $e->caminho_logo = $filename;
                    }
                    $e->save();
                }
                if ($this->input->get('modal')) {
                    echo $e->id;
                    return;
                } else {
                    redirect('entidades/listar/' . $tabela);
                }
            }
        }
        if ($this->input->get('modal')) {
            $this->view->load('entidade/form', $this->data, true);
        } else {
            $this->view->load('entidade/form', $this->data);
        }
    }

    function detalhes($tabela, $id, $pag=null) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $this->data['jsatual'] = array('entidade_cadastrar', 'ajaxfileupload');
        $post = $this->input->post('entidade');
        $tipo = strtoupper(singular($tabela));
        $this->data['entidade_id'] = $id;
        $u = new Usuario();
        $this->data['vendedores'] = $u->get_dropdown_representante();
        if (empty($post)) {
            $this->load->helper('inflector');
            $this->data['titulo'] = ucfirst($tabela);
            $e = new Entidade();
            $e->where('tipo', $tipo);
            $this->data['entidade'] = $e->get_by_id($id);
            $this->view->load('entidade/form', $this->data);
        } else {
            $this->data['entidade'] = $e = new Entidade($this->input->post('entidade'));
            $e->id = $id;
            $e->tipo = $tipo;
            if ($e->save()) {
                if (@opendir('logos/' . $id . "/")) {
                    foreach (glob("logos/" . $id . "/*.{jpg,gif,png}", GLOB_BRACE) as $filename) {
                        $e->caminho_logo = $filename;
                    }
                    $e->save();
                }
                $uri = 'entidades/listar/' . $tipo . '?per_page=' . $pag;
                redirect($uri);
            }
            $this->view->load('entidade/form', $this->data);
        }
    }

    function excluir($tabela, $id, $pag=null) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $e = new Entidade();
        $e->get_by_id($id);
        $u = new Usuario();
        $usuarios = $u->get_by_entidade_id($id)->all;
        foreach ($usuarios as $u) {
            $u->invisivel = 1;
            $u->save();
        }
        $e->invisivel = 1;
        $e->save();
        $uri = 'entidades/listar/' . $tabela . "/" . $pag;
        redirect($uri);
    }

    function pedidos($mes = 0) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM', 'CCM'));
        seleciona_menu($this, 'pedido_cliente_menu');
        if ($mes == 0) {
            $this->data['current_month'] = $current_month = strftime("%m");
            $mes = get_month_name(strftime("%m"));
        } else {
            $this->data['current_month'] = $current_month = $mes;
            $mes = get_month_name($mes);
        }
        if ($current_month > strftime("%m"))
            $year = strftime('%Y') - 1;
        else
            $year = strftime('%Y');
        $this->data['titulo'] = 'Relação de pedidos por cliente em ' . $mes . ' de ' . $year;

        $p = new Pedido();
        $this->data['clientes'] = $p->get_relacao_clientes($this->session->userdata('tipo'), $current_month);

        $this->view->load('entidade/listar_pedidos', $this->data);
    }

    function upload($id = null) {
        if ($id == 'undefined') {
            $e = new Entidade();
            $e->select_max('id')->get();
            $entidade_id = $e->id + 1;
        } else {
            $entidade_id = $id;
        }

        if (!@opendir('logos/' . $entidade_id . "/")) {
            if (!mkdir('logos/' . $entidade_id . "/"))
                echo "Erro ao criar diretório.";
        } else {
            foreach (glob("logos/" . $entidade_id . "/*.{jpg,gif,png}", GLOB_BRACE) as $filename) {//somente um logo por empresa
                unlink($filename);
            }
        }

        $config['upload_path'] = 'logos/' . $entidade_id . '/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0'; //unlimited
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['file_name'] = $entidade_id;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $fInfo = $this->upload->data();
            $e->_create_thumbnail($fInfo['full_path']);
            $data = array('foto' => $this->upload->data());
        }
    }

}

?>
