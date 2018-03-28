<?php

class Resumos extends Controller {

    function Resumos() {
        parent::Controller();
        $this->data['titulo'] = "Resumo geral";
        $this->data['usuario_logado'] = $this->session->userdata('nome');
        $this->data['tipo_usuario'] = $this->session->userdata('tipo');

        seleciona_menu($this, 'resumo_menu');
    }

    function listar() {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM', 'CCM'));
        $u = new Usuario();
        $u->get_by_id($this->session->userdata('id'));
//            $ultimo_log = $u->last_login;
        $mes_passado = date('Y-m-d', time() - (7 * 24 * 60 * 60));
        $p = new Pedido();

//            $o = new Oferta();
//            $this->data['o'] = $o->where('created_at >=',$ultimo_log)->get()->all;

        $log_where = array('created_at >=' => $mes_passado, 'relation_table' => 'entidades');
        $l = new Log();

        if ($this->session->userdata('tipo') == 'ADM' || $this->session->userdata('tipo') == 'SAD' ) {
            $p = new Pedido();
            $p->set_sql($sql, USUARIO_CURTUME_PROGRAMACAO, $this->session->userdata('empresa'));
            $sql .= " AND ((SELECT SUM(qtd) FROM faturamento WHERE artigos_pedidos.id = faturamento.artigos_pedidos_id GROUP BY artigos_pedidos.id)) >= (artigos_pedidos.quantidade * 0.9)" .
                    " AND artigos_pedidos.fechado = 0";
            if($this->session->userdata('tipo') == 'ADM')
                $sql .= " AND pedidos.created_by =".$this->session->userdata('id');
            $sql .= " GROUP BY artigos_pedidos.id ORDER BY pedidos.id ASC";
            $this->data['p'] = $p->query($sql);
            $this->data['l'] = $l->order_by('created_at ASC')->get_where($log_where)->all;
            $this->view->load('resumo/listar', $this->data);
        } else {
            //$log_where = array('oi_curtume' => '','relation_table' => 'entidades','relation_id' => $this->session->userdata('empresa'));
            $sql1 = "SELECT pedidos.id,artigos_pedidos.oi_curtume, pedidos.cliente_id," .
                    " pedidos.ordem_servico,pedidos.artigo_id,pedidos.updated_at," .
                    " entidades.nome as cliente, artigos.nome as artigo,artigos_pedidos.valor_unitario_corrigido," .
                    " SUM(artigos_pedidos.quantidade) as qtd_total,pedidos.cancelado," .
                    " (artigos_pedidos.valor_unitario_corrigido * SUM(artigos_pedidos.quantidade)) as total_pedido," .
                    " artigos_pedidos.valor_unitario,pedidos.data_entrega,pedidos.moeda" .
                    " FROM pedidos, artigos_pedidos, entidades, artigos" .
                    " WHERE pedidos.id = artigos_pedidos.pedido_id" .
                    " AND pedidos.cliente_id = entidades.id" .
                    " AND pedidos.artigo_id = artigos.id" .
                    " AND pedidos.cancelado = 0" . //n cancelado
                    " AND pedidos.fechado = 0" . //n fechado
                    " AND pedidos.created_at >='".$mes_passado."'".
                    " AND pedidos.fornecedor_id = " . $this->session->userdata('empresa');
            $sql2 = $sql1;
            $sql1 .=" AND (TRIM(artigos_pedidos.oi_curtume) <> '' AND TRIM(artigos_pedidos.oi_curtume) IS NOT NULL)" .
                    " GROUP BY pedidos.id";
            $sql2 .= " AND (TRIM(artigos_pedidos.oi_curtume) = '' OR TRIM(artigos_pedidos.oi_curtume) IS NULL)" .
                    " GROUP BY pedidos.id";
            if (!empty($_GET['order'])) {
                switch ($_GET['campo']) {
                    case 'pedido':
                        $sql1.=" ORDER BY pedidos.id " . $_GET['order'];
                        $sql2.=" ORDER BY pedidos.id " . $_GET['order'];
                        break;
                    case 'cliente':
                        $sql1.=" ORDER BY entidades.nome " . $_GET['order'];
                        $sql2.=" ORDER BY entidades.nome " . $_GET['order'];
                        break;
                    case 'qtd':
                        $sql1.=" ORDER BY SUM(artigos_pedidos.quantidade) " . $_GET['order'];
                        $sql2.=" ORDER BY SUM(artigos_pedidos.quantidade) " . $_GET['order'];
                        break;
                    case 'artigo':
                        $sql1.=" ORDER BY artigos.nome " . $_GET['order'];
                        $sql2.=" ORDER BY artigos.nome " . $_GET['order'];
                        break;
                    case 'ordem_compra':
                        $sql1.=" ORDER BY pedidos.ordem_servico " . $_GET['order'];
                        $sql2.=" ORDER BY pedidos.ordem_servico " . $_GET['order'];
                        break;
                    case 'total':
                        $sql1.=" ORDER BY SUM((artigos_pedidos.valor_unitario_corrigido * artigos_pedidos.quantidade)) " . $_GET['order'];
                        $sql2.=" ORDER BY SUM((artigos_pedidos.valor_unitario_corrigido * artigos_pedidos.quantidade)) " . $_GET['order'];
                        break;
                    case 'entrega':
                        $sql1.=" ORDER BY pedidos.data_entrega " . $_GET['order'];
                        $sql2.=" ORDER BY pedidos.data_entrega " . $_GET['order'];
                        break;
                }
            } else {
                $sql1.=" ORDER BY pedidos.updated_at DESC";
                $sql2.=" ORDER BY pedidos.updated_at DESC";
            }

            $this->data['p'] = $p->query($sql2);
            $p = new Pedido();
            $this->data['p_recente'] = $p->query($sql1);
            $this->data['l'] = $l->get_where($log_where)->all;
            $this->view->load('resumo/listar_comercial', $this->data);
        }
    }

    function email($id, $entidade) {
        verificar_permissao($this->session->userdata('tipo'), array(USUARIO_SUPER_ADMINISTRADOR,USUARIO_ADMINISTRADOR));
        $this->data['modal'] = false;
        $post = $this->input->post('contato');
        $p = new Pedido();
        $this->data['pedido'] = $p->get_by_id($id);
        $entidade = trim(strtolower($entidade));

        if (!empty($post)) {
            //$novo_conteudo = preg_replace("/<a.*>(.*?)<\/a>/i","\$1",$post['conteudo_email']);
            $novo_conteudo = preg_replace("/<[a][^>]+\>/i", "\$1", $post['conteudo_email']); //remove <a> tags
            $post['conteudo_email'] = "<style type='text/css'>" . file_get_contents("assets/css/resumo.css") . "img{visibility:hidden;}a{text-decoration:none !important;}</style>" . $novo_conteudo;
            if ($entidade == 'fornecedor') //se fornecedor envia link para o sistema
                $post['conteudo_email'] .= "<p><a href='" . site_url() . "/usuarios/login/0/" . $p->visualizar . "'>Visualize pelo sistema</a></p>";
            $nomes = $this->input->post('contato_nomes');
            $emails = $this->input->post('contato_emails');
            $enviar_para = $this->input->post('selecao_email');
            // percorre os contatos para o envio do email
            $email_to = array();
            if(!empty($enviar_para)) {
                foreach ($enviar_para as $email_idx) {
                    $email_to[] = $emails[$email_idx];
                }
            }
            // percorre os contatos e verifica se precisa criar um novo usuário
            for ($i = 0; $i < count($nomes); $i++) {
                $u = new Usuario(array('nome' => $nomes[$i], 'email' => $emails[$i]));
                $tipo_usuario = ($entidade == 'cliente') ? USUARIO_CLIENTE : USUARIO_CURTUME_COMERCIAL;
                $u->verificar_e_cadastrar($tipo_usuario, $p->{$entidade . '_id'},$emails[$i]);
            }
            $p->{'email_enviado_' . $entidade} = 1;
            $p->save();
            enviar_email($email_to, $post['assunto'], $post['conteudo_email']);
        } else {
            //dados para email padrão
            $c = new Cliente();
            $this->data['dados_cliente'] = $c->get_by_id($p->cliente_id);
            $ap = new Artigo_pedido();
            $this->data['cor_quantidade'] = $ap->get_by_pedido_id($p->id)->all;
            $this->data['artigo'] = $p->artigo_nome();
            $this->data['mat_prima'] = $p->materia_prima_nome();
            //fim dados email
            $u = new Usuario();
            if ($entidade == 'cliente') {
                $this->data['entidade'] = $p->cliente_nome();
                $this->data['contatos'] = $u->get_by_entidade_id($p->cliente_id)->all;
            } else {
                $this->data['email'] = true;
                $this->data['entidade'] = $p->fornecedor_nome();
                $this->data['contatos'] = $u->where(array('tipo' => USUARIO_CURTUME_COMERCIAL,'receber_email' => '1','invisivel' => '0'))->get_by_entidade_id($p->fornecedor_id)->all;
                $this->data['conteudo'] = $this->load->view('resumo/pedido', array_merge($this->data, $p->get_dados_resumo($id)), true);
            }
            $this->data['tipo_entidade'] = $entidade;
            $this->load->view('resumo/email', $this->data);
        }
    }

    function resumo_pedido($id, $artigo_pedido_id = null) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD',USUARIO_ADMINISTRADOR, USUARIO_CURTUME_COMERCIAL, USUARIO_CURTUME_PROGRAMACAO));
        $p = new Pedido();
        $this->data = array_merge($this->data, $p->get_dados_resumo($id, $artigo_pedido_id));
        $this->data['modal'] = true;
        if ($artigo_pedido_id == null)
            $this->load->view('resumo/pedido', $this->data);
        else {
            $this->data['artigo_pedido_id'] = $artigo_pedido_id;
            $this->load->view('resumo/pedido_artigos', $this->data);
        }
    }

    function cliente_nome() {
        $c = new Cliente();
        $c->get_by_id($this->relation_id);
        return $c->nome;
    }

}

?>
