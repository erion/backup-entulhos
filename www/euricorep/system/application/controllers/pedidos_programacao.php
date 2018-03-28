<?php

class Pedidos_programacao extends Controller {

    function Pedidos_programacao() {
        parent::Controller();
        $this->load->model('pedido');

        $this->data['titulo'] = $this->pedido->titulo;
        $this->data['usuario_logado'] = $this->session->userdata('nome');
        $this->data['tipo_usuario'] = $this->session->userdata('tipo');

        seleciona_menu($this, 'pedidos_menu');
    }

    function listar($abertos = true) {
        if (empty($this->data['usuario_logado']))
            redirect("usuarios/login");
        if (!$abertos)
            seleciona_menu($this, 'finalizado_prog_menu');
        elseif(!empty($_GET['projecao']))
            seleciona_menu($this, 'projecao_menu');
        $this->data['abertos'] = $abertos;
        $p = new Pedido();
        $sql = "";
        $num_reg = "";
        $p->set_sql($sql, USUARIO_CURTUME_PROGRAMACAO, $this->session->userdata('empresa'), !$abertos);
        $p->filtrar($sql, USUARIO_CURTUME_PROGRAMACAO);
        $cont = new Pedido();
        $cont->set_sql_count($num_reg, USUARIO_CURTUME_PROGRAMACAO, $this->session->userdata('empresa'), !$abertos);
        $cont->filtrar($num_reg, USUARIO_CURTUME_PROGRAMACAO, true);
        $contador = $cont->query($num_reg);
        if (count($contador) > 0)
            $contador = $contador[0]->total;
        else
            $contador = 0;
        $fields = "pedidos.id,pedidos.cancelado,pedidos.fechado,artigos_pedidos.oi_curtume," .
                " c.nome as cliente,pedidos.ordem_servico,artigos.nome as artigo,pedidos.moeda," .
                " artigos_pedidos.quantidade,artigos_pedidos.cor,artigos_pedidos.id as cod," .
                " pedidos.data_entrega,artigos_pedidos.data_reprogramacao,pedidos.amostra";
        //$sql = str_replace('{FIELDS}', $fields, $sql);
        /*
          $contador = $p->registro("SELECT COUNT(pedidos.id) as total ".
          " FROM pedidos,artigos,artigos_pedidos, entidades c".
          " WHERE pedidos.id = artigos_pedidos.pedido_id".
          " AND pedidos.artigo_id = artigos.id".
          " AND pedidos.cliente_id = c.id".
          " AND pedidos.fornecedor_id = ".$this->session->userdata('empresa'))->total;
         *
         */
        if (!$this->input->get('imprimir'))
            $p->paginacao($sql, $this->input->get('per_page'), $this);
        else
            $this->data['p'] = $p->query($sql);

        $pedido = $this->data['p'];
        if ($this->input->get('buscar') && $contador == 1)
            redirect("pedidos/visualizar_resumo/" . $pedido[0]->visualizar);

        $c = new Cliente();
        $this->data['clientes'] = $c->get_dropdown();

        $a = new Artigo();
        $this->data['artigos'] = $a->get_dropdown();

        $lp = new Linhas_producoe();
        $this->data['linha_producao'] = $lp->get_dropdown();

        $f = new Fornecedor();
        $this->data['fornecedores'] = $f->get_dropdown();

        //$this->data['jsatual'] = array('pedido_listar');

        $this->data['status'] = $this->config->item('status');
        $this->data['amostra'] = $this->config->item('amostra');

        if (!$this->input->get('imprimir')) {
            $this->load->library('pagination');
            if ($abertos)
                $this->pagination->initialize(config_pagination('pedidos_programacao/listar', $contador, 'per_page'));
            else
                $this->pagination->initialize(config_pagination('pedidos_programacao/listar/0', $contador, 'per_page'));
        } else {
            $this->data['custom_css'] = array('imprimir_pedidos' => 'all');
            $this->data['printable'] = true;
        }
        
        $config['item'] = $this->session->userdata('tipo');
        $config['form_location'] = 'filter_builder/pedido/';
        $config['form_action'] = null;
        $this->load->library('FilterBuilder');
        $this->filterbuilder->initialize($config);

        if (!$this->input->get('artigos_pedidos') && $this->session->userdata('tipo') != USUARIO_CURTUME_PROGRAMACAO)
            if ($this->session->userdata('tipo') == USUARIO_CURTUME_COMERCIAL)
                redirect('pedidos_comercial/listar' . LISTAGEM_PADRAO . keep_current_gets($this->uri) . $this->configfilter->get_artigo_in_URL() . $this->configfilter->get_artigo_not_in_URL());
            else
                redirect('pedidos/listar' . LISTAGEM_PADRAO . keep_current_gets($this->uri) . $this->configfilter->get_artigo_in_URL() . $this->configfilter->get_artigo_not_in_URL());
        else
            $this->view->load('pedido/listar_programacao', $this->data);
    }

    function editar($id) {
        if ($this->input->post('data_reprogramacao'))
            $reprogramado = data_mysql($this->input->post('data_reprogramacao')) . " 00:00:00";
        else
            $reprogramado = data_mysql($this->input->post('data_reprogramacao'));
        $envia_email = true;

        $ap = new Artigo_pedido();
        $ap->get_by_id($id);

        $old_valor = $ap->data_reprogramacao;
        if ($reprogramado == $ap->data_reprogramacao) {
            $envia_email = false;
        }

        $ap->data_reprogramacao = $reprogramado;
        $p = new Pedido();
        $p->get_by_id($ap->pedido_id);
        $ap->save();

        $valor_log = array(
            'tabela_id' => $ap->id,
            'tabela_nome' => 'artigos_pedidos',
            'campo_nome' => 'data_reprogramacao',
            'campo_old' => $old_valor,
            'campo_new' => $reprogramado,
            'usuario_id' => $this->session->userdata('id'),
            'data_hora' => date('Y-m-d H:M:S', now())
        );
        $l = new log_bd($valor_log);
        $l->save();

        if ($envia_email) {
            $mensagem = "O artigo " . $p->artigo_nome() . " do pedido #" . $p->id . " foi reprogramado para " . data_br($ap->data_reprogramacao) . "<br />";
            $mensagem .= "<a href='" . site_url() . "/usuarios/login/0/" . $p->visualizar . "' >Visualize pelo sistema</a>.";

            $email_to = array();
            $u = new Usuario();
            if ($this->session->userdata('tipo') != USUARIO_CURTUME_COMERCIAL) {
                $usuario = $u->where(array('tipo' => 'CCM', 'invisivel' => '0', 'receber_email' => '1'))->get_by_entidade_id($p->fornecedor_id)->all;
                foreach ($usuario as $u)
                    array_push($email_to, $u->email);
            }
            $u = new Usuario();
            $usuario = $u->where(array('invisivel' => '0', 'tipo' => 'ADM', 'receber_email' => '1'))->get()->all;
            foreach ($usuario as $u)
                array_push($email_to, $u->email);
            enviar_email($email_to, "Sistema de Pedidos - Pedido reprogramado", $mensagem);
        }

        echo $this->input->post('data_reprogramacao');
    }

    function finalizar_programacao($id) {
        $ap = new Artigo_pedido();
        $ap->get_by_id($id);
        $old_valor = $ap->programacao_finalizada;
        $ap->programacao_finalizada = 1;
        $ap->save();

        $valor_log = array(
            'tabela_id' => $ap->id,
            'tabela_nome' => 'artigos_pedidos',
            'campo_nome' => 'programacao_finalizada',
            'campo_old' => $old_valor,
            'campo_new' => $ap->programacao_finalizada,
            'usuario_id' => $this->session->userdata('id'),
            'data_hora' => date('Y-m-d H:M:S', now())
        );
        $l = new log_bd($valor_log);
        $l->save();

        redirect('pedidos_programacao/listar' . LISTAGEM_PADRAO . keep_current_gets($this->uri) . $this->configfilter->get_artigo_in_URL() . $this->configfilter->get_artigo_not_in_URL());
    }

}

?>
