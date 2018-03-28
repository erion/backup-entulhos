<?php

class Pedidos extends Controller {

    function Pedidos() {
        parent::Controller();
        $this->load->model('pedido');
        $this->data['usuario_logado'] = $this->session->userdata('nome');
        $this->data['tipo_usuario'] = $this->session->userdata('tipo');
        $this->data['abertos'] = true; //programacao buscar
        if ($this->input->get('projecao')) {
            $this->data['titulo'] = "Projeções";
            seleciona_menu($this, 'projecao_menu');
        } else {
            $this->data['titulo'] = $this->pedido->titulo;
            seleciona_menu($this, 'pedidos_menu');
        }
    }

    function index() {
        $this->listar();
    }

    function enviar_notificacao_pendentes() {
        $this->load->view('resumo/nao_reprogramados');
    }

    function listar() {
        if ($this->input->get('projecao'))
            $this->data['add_button'] = 'Nova projeção';
        else
            $this->data['add_button'] = 'Novo pedido';
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM', 'CCM', 'CPR'));
        $sql = '';
        if (!empty($_GET)) {
            if (!empty($_GET['buscar'])) // && $this->session->userdata('tipo') != 'CPR'
                $_GET['amostrav'] = '2';
            if ($this->input->get('artigos_pedidos') == 'artigos') {
                $p = new Pedido();
                $p->set_sql($sql, USUARIO_CURTUME_PROGRAMACAO, $this->session->userdata('empresa'));
                $cont = new Pedido();
                $num_reg = "";
                $p->filtrar($sql, USUARIO_CURTUME_PROGRAMACAO);
                $cont->set_sql_count($num_reg, USUARIO_CURTUME_PROGRAMACAO, $this->session->userdata('empresa'));
                $cont->filtrar($num_reg, USUARIO_CURTUME_PROGRAMACAO, true);
                $contador = $cont->query($num_reg);
            } else {
                $p = new Pedido();
                $p->set_sql($sql, $this->session->userdata('tipo'), $this->session->userdata('empresa'));
                $cont = new Pedido();
                $num_reg = "";
                $p->filtrar($sql, $this->session->userdata('tipo'));
                $cont->set_sql_count($num_reg, $this->session->userdata('tipo'), $this->session->userdata('empresa'));
                $cont->filtrar($num_reg, $this->session->userdata('tipo'), true);
                $contador = $cont->query($num_reg);
            }
            if (count($contador) > 0)
                $contador = $contador[0]->total;
            else
                $contador = 0;
            $x = new Pedido();
            if (!$this->input->get('imprimir')) {
                $x->paginacao($sql, $this->input->get('per_page'), $this);
                $pedido = $this->data['p'];
                if ($this->input->get('buscar') && $contador == 1)
                    redirect("pedidos/visualizar_resumo/" . $pedido[0]->visualizar);
            } else {
                $this->data['p'] = $p->query($sql);
            }
        } else {
            $p = new Pedido();
            $p->set_sql($sql, $this->session->userdata('tipo'), $this->session->userdata('empresa'));
            $sql .= " GROUP BY pedidos.id" .
                    " ORDER BY pedidos.id DESC";
            $cont = new Pedido();
            $cont->set_sql_count($num_reg, $this->session->userdata('tipo'), $this->session->userdata('empresa'));
            $cont->filtrar($num_reg, $this->session->userdata('tipo'), true);
            $contador = $cont->query($num_reg);
            if (count($contador) > 0)
                $contador = $contador[0]->total;
            else
                $contador = 0;
            if (!$this->input->get('imprimir'))
                $p->paginacao($sql, $this->input->get('per_page'), $this);
            else
                $this->data['p'] = $p->query($sql);
        }

        $c = new Cliente();
        $this->data['clientes'] = $c->get_dropdown();

        $f = new Fornecedor();
        $this->data['fornecedores'] = $f->get_dropdown();

        $a = new Artigo();
        $this->data['artigos'] = $a->get_dropdown();

        $lp = new Linhas_producoe();
        $this->data['linha_producao'] = $lp->get_dropdown();

        $this->data['status'] = $this->config->item('status');
        $this->data['amostra'] = $this->config->item('amostra');

        //$this->data['jsatual'] = array('pedido_listar');

        $listar = array(
            USUARIO_SUPER_ADMINISTRADOR => 'listar',
            USUARIO_ADMINISTRADOR => 'listar',
            USUARIO_CURTUME_COMERCIAL => 'listar_comercial',
            USUARIO_CURTUME_PROGRAMACAO => 'listar_programacao'
        );
        $listar_pedidos = $this->config->item('listar_pedidos');

        if (!$this->input->get('imprimir')) {
            $this->load->library('pagination');
            $this->pagination->initialize(config_pagination($listar_pedidos[$this->session->userdata('tipo')] . '/' . $listar[$this->session->userdata('tipo')], $contador, 'per_page'));
        } else {
            $this->data['custom_css'] = array('imprimir_pedidos' => 'all');
            $this->data['printable'] = true;
        }

        $config['item'] = $this->session->userdata('tipo');
        $config['form_location'] = 'filter_builder/pedido/';
        $config['form_action'] = null;
        $this->load->library('FilterBuilder');
        $this->filterbuilder->initialize($config);

        if ($this->input->get('artigos_pedidos') == 'artigos')
            $this->view->load('pedido/listar_programacao', $this->data);
        else
            $this->view->load('pedido/' . $listar[$this->session->userdata('tipo')], $this->data);
    }

    function cadastrar() {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));

        $post = $this->input->post('pedido');
        $this->data['jsatual'] = array('pedido_cadastrar', 'ajaxfileupload');

        $this->dados_form();

        if (empty($post)) {
            $this->data['pedido'] = $p = new Pedido();
            $p->linha_producao_id = 1; //calçado
            $this->view->load('pedido/form', $this->data);
        } else {
            $this->data['pedido'] = $p = new Pedido($this->input->post('pedido'));
            $p->data_entrega = data_mysql($p->data_entrega);
            $p->oferta = 0;
            $this->data['artigo_pedido_cor'] = $apc = $this->input->post('artigo_pedido_cor');
            $this->data['artigo_pedido_quantidade'] = $apq = $this->input->post('artigo_pedido_quantidade');
            $this->data['artigo_pedido_valor'] = $apv = $this->input->post('artigo_pedido_valor');
            $this->data['artigo_pedido_amostra'] = $apa = $this->input->post('artigo_pedido_amostra');
            $p->artigo_id = $p->salvar_artigo($p->artigo_id);
            $p->linha_producao_id = $p->salvar_linha_producao($p->linha_producao_id);
            $p->materia_prima_id = $p->salvar_materia_prima($p->materia_prima_id);
            $p->visualizar = md5(rand(0, 100) . time());
            $p->created_by = $this->session->userdata('id');
            $p->created_at = date('Y-m-d', now());
            if ((int) $p->projecao_id > 0 && $p->projecao == '1') {
                $p->projecao = '0'; //projecao filhas identificadas apenas com projecao_id
            }
            $uri = "";
            if ($p->projecao == '1')
                $uri = "&projecao=1";
            if ($p->save()) {
                $l = new Log();
                $l->usuario_id = $this->session->userdata('id');
                $l->msg = $this->input->post('msg');
                $l->relation_table = 'pedidos';
                $l->relation_id = $p->id;
                $l->save();
                for ($i = 0; $i < count($apc); $i++) {
                    $ap = new Artigo_pedido();
                    $ap->pedido_id = $p->id;
                    $ap->cor = ucfirst($apc[$i]);
                    $qtd_total += $ap->quantidade = double_mysql($apq[$i]);
                    $ap->amostra = $apa[$i];
                    $ap->valor_unitario = double_mysql($apv[$i]);
                    $ap->valor_unitario_corrigido = $ap->valor_unitario;
                    $valor_total += $ap->valor_unitario * $ap->quantidade;
                    $ap->save();
                }
                redirect('pedidos/listar' . LISTAGEM_PADRAO . $uri);
            }
            $this->view->load('pedido/form', $this->data);
        }
    }

    function detalhes($id, $pag = null) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $post = $this->input->post('pedido');
        $this->data['jsatual'] = array('pedido_cadastrar');
        $this->dados_form();
        $ap = new Artigo_pedido();
        $this->data['ap'] = $ap->get_by_pedido_id($id)->all;
        unset($ap);

        if (empty($post)) {
            $p = new Pedido();
            $this->data['pedido'] = $p->get_by_id($id);
            unset($p);
            $this->view->load('pedido/form', $this->data);
        } else {
            $this->data['pedido'] = $p = new Pedido($this->input->post('pedido'));
            $p->id = $id;
            $p->oferta = 0;
            $p->data_entrega = data_mysql($p->data_entrega);
            $this->data['artigo_pedido_cor'] = $apc = $this->input->post('artigo_pedido_cor');
            $this->data['artigo_pedido_quantidade'] = $apq = $this->input->post('artigo_pedido_quantidade');
            $this->data['artigo_pedido_valor'] = $apv = $this->input->post('artigo_pedido_valor');
            $this->data['artigo_pedido_amostra'] = $apa = $this->input->post('artigo_pedido_amostra');
            $apr = $this->input->post('artigo_pedido_remover');
            $apid = $this->input->post('artigo_pedido_id');
            $p->artigo_id = $p->salvar_artigo($p->artigo_id);
            $p->linha_producao_id = $p->salvar_linha_producao($p->linha_producao_id);
            $p->materia_prima_id = $p->salvar_materia_prima($p->materia_prima_id);
            $p->updated_at = date('Y-m-d', now());
            if ((int) $p->projecao_id > 0 && $p->projecao == '1') {
                $p->projecao = '0'; //projecao filhas identificadas apenas com projecao_id
            }
            $uri = LISTAGEM_PADRAO;
            if ($p->projecao == '1')
                $uri .= "&projecao=1";
            if ($p->save()) {
                if ($apr) {
                    for ($i = 0; $i < count($apr); $i++) {//caso alguma cor tenha sido removida
                        $ap = new Artigo_pedido();
                        $ap->get_by_id($apr[$i]);
                        $ap->delete();
                        unset($ap);
                    }
                }
                $valor_total = '';
                for ($i = 0; $i < count($apc); $i++) {
                    $ap = new Artigo_pedido();
                    if (!empty($apid[$i]))
                        $ap->get_by_id($apid[$i]);
                    $ap->pedido_id = $p->id;
                    $ap->cor = ucfirst($apc[$i]);
                    $ap->quantidade = double_mysql($apq[$i]);
                    $ap->amostra = $apa[$i];
                    $ap->valor_unitario = double_mysql($apv[$i]);
                    $ap->valor_unitario_corrigido = $ap->valor_unitario;
                    $valor_total += $ap->valor_unitario * $ap->quantidade;
                    $ap->save();
                    unset($ap);
                }
                $l = new Log();
                $l->relation_table = 'pedidos';
                $l->relation_id = $id;
                $l->usuario_id = $this->session->userdata('id');
                $l->msg = $this->input->post('msg');
                $l->save();
                unset($l);
                $uri = 'pedidos/listar/' . $uri . "&per_page=" . $pag;
                redirect($uri);
            }
            $this->view->load('pedido/form', $this->data);
        }
    }

    function detalhes_json($id) {
        $dados = array('pedido' => array(), 'artigo_pedido' => array());
        $p = new Pedido();
        $dados['pedido'] = $p->get_campos_cadastro($id);

        $dado_1 = array("chave" => "valor", "chave2" => "valueu 2");
        $dados = array();
        array_push($dados, $dados_1);

        $ap = new Artigo_pedido();
        $ap = $ap->get_by_pedido_id($id)->all;
        foreach ($ap as $artigo_pedido) {
            $artigo_pedido->valor_unitario_corrigido = double_br($artigo_pedido->valor_unitario_corrigido);
            $dados['artigo_pedido'][$artigo_pedido->id] = $artigo_pedido->_to_array();
        }
        echo json_encode($dados);
    }

    function excluir($id, $pag = null) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $p = new Pedido();
        $p->get_by_id($id);
        $p->cancelado = 1;
        $p->save();
        $uri = 'pedidos/listar/' . LISTAGEM_PADRAO . "&per_page=" . $pag;
        redirect($uri);
    }

    function reativar($id) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $p = new Pedido();
        $p->get_by_id($id);
        $p->updated_at = date('Y-m-d', now());
        $p->fechado = 0;
        $p->cancelado = 0;
        $p->save();
        $ap = new Artigo_pedido();
        $artigos = $ap->get_by_pedido_id($id)->all();
        foreach($artigos as $a) {
            $a->fechado = 0;
            $a->save();
        }
        redirect('pedidos/listar/' . LISTAGEM_PADRAO);
    }

    function finalizar($id) {//true=finalizado false=ativo
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $p = new Pedido();
        $p->get_by_id($id);
        $p->updated_at = date('Y-m-d', now());
        $p->fechado = 1;
        $p->save();
        $ap = new Artigo_pedido();
        $artigos = $ap->get_by_pedido_id($id)->all();
        foreach($artigos as $a) $this->finalizar_artigo ($a->id);
        redirect('pedidos/listar/' . LISTAGEM_PADRAO);
    }

    function finalizar_artigo($id) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $ap = new Artigo_pedido();
        $ap->get_by_id($id);
        $ap->fechado = 1;
        $ap->save();
    }

    function cancelar_artigo($id) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $ap = new Artigo_pedido();
        $ap->get_by_id($id);
        $ap->delete();
    }

    function observacao($id, $tabela) {
        $usuario = $this->session->userdata('tipo');
        verificar_permissao($usuario, array('SAD','ADM', 'CCM', 'CPR'));
        $post = $this->input->post('log');
        $p = new Pedido();
        $this->data['tabela'] = $tabela;
        if ($tabela == 'artigos_pedidos') {
            $this->data['artigo_pedido_id'] = $id;
            $ap = new Artigo_pedido();
            $ap->get_by_id($id);
            $this->data['pedido'] = $p->get_by_id($ap->pedido_id);
            $assunto = 'Pedido:' . $p->id . '(' . $p->artigo_nome() . ')' . ' novo comentário no artigo:' . $ap->cor . " (" . $p->cliente_nome() . ")";
        } else {
            $this->data['pedido'] = $p->get_by_id($id);
            $assunto = 'Pedido:' . $p->id . '(' . $p->artigo_nome() . ')' . ' novo comentário (' . $p->cliente_nome() . ")";
        }
        if (empty($post)) {
            $l = new Log();
            $u = new Usuario();
            $this->data['log'] = $l->where('relation_table', $tabela)->order_by('created_at', 'desc')->get_by_relation_id($id)->all;
            $this->data['contatos'] = $u->where(array('tipo <>' => USUARIO_ADMINISTRADOR,'tipo <>' => USUARIO_SUPER_ADMINISTRADOR,'receber_email' => '1','invisivel' => '0'))->get_by_entidade_id($p->fornecedor_id)->all;
            $this->load->view('pedido/add_observacao', $this->data);
        } else {
            $l = new Log($post);
            $l->usuario_id = $this->session->userdata('id');
            $l->relation_table = $tabela;
            if ($l->save()) {
                if ($tabela == 'pedidos') {
                    $p->get_by_id($id);
                    $p->updated_at = date('Y-m-d', now());
                    $p->save();
                    $p->get_by_id($id);
                }
                $u = new Usuario();
                $mensagem = $post['msg'];
                $u->where('id <>', $this->session->userdata('id'));
                if($usuario == USUARIO_ADMINISTRADOR || $usuario == USUARIO_SUPER_ADMINISTRADOR) {
                    $nomes = $this->input->post('contato_nomes');
                    $emails = $this->input->post('contato_emails');
                    $enviar_para = $this->input->post('selecao_email');
                    // percorre os contatos para o envio do email
                    $email_to = array();
                    foreach ($enviar_para as $email_idx) {
                        $email_to[] = $emails[$email_idx];
                    }
                } else { //super administrador não recebe email
                    $emails = $u->where(array('tipo =' => USUARIO_ADMINISTRADOR,'receber_email' => '1','invisivel' => '0','id' => $p->created_by))->get()->all;
                    foreach($emails as $u)
                        $email_to[] = $u->email;
                }
                /*
                for ($i = 0; $i < count($nomes); $i++) {
                    $u = new Usuario(array('nome' => $nomes[$i], 'email' => $emails[$i]));
                    $tipo_usuario = $u->tipo;
                    $u->verificar_e_cadastrar($tipo_usuario, $p->{$entidade . '_id'});
                }*/
                $mensagem .= "<br /><br /><a href='" . site_url() . "/usuarios/login/0/" . $p->visualizar . "' >Visualize pelo sistema</a>.";
                enviar_email($email_to, $assunto, $mensagem);
            }
        }
    }

    function excluir_obs($id) {
        $l = new Log();
        $l->get_by_id($id);
        $l->delete();
    }

    function visualizar_resumo($md5) {
        $this->data['modal'] = false;
        $_GET['amostrav'] = '2';
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM', 'CCM', 'CPR'));
        //$mes_passado = date('Y-m-d', time() - (30 * 24 * 60 * 60));
        $p = new Pedido();
        $this->data['pedido'] = $p->get_by_visualizar($md5);

        $ap = new Artigo_pedido();
        $this->data['artigo_pedido'] = $ap->get_by_pedido_id($p->id)->all;

        $this->data = array_merge($this->data, $p->get_dados_resumo($p->id));

        //$l = new Log();
        //$this->data['observacao'] = $l->where('relation_table','pedidos')->order_by('created_at','desc')->get_by_relation_id($p->id)->all;

        $this->data['titulo'] = '';
        seleciona_menu($this, ''); //nenhum menu selecionado

        $this->view->load('resumo/pedido', $this->data);
    }

    function historico($pedido_id,$artigo_pedido_id = false) {
        verificar_permissao($this->session->userdata('tipo'), array('SAD','ADM'));
        $p = new Pedido();
        $this->data['pedido'] = $p->get_by_id($pedido_id);
        $ap = new Artigo_pedido();
        $l = new Log_bd();
        $this->data['artigo_id'] = $artigo_pedido_id;
        $this->data['usuario'] = $u = new Usuario();
        if(!$artigo_pedido_id) {
            $this->data['artigos'] = $artigos = $ap->get_by_pedido_id($pedido_id)->all;
            foreach($artigos as $ap) {
                $reprogramacao[$ap->id] = $l->where(array('tabela_id' => $ap->id,'tabela_nome' => 'artigos_pedidos','campo_nome' => 'data_reprogramacao'))->get()->all;
                //$faturamento[$ap->id] = $l->where(array('tabela_id' => $ap->id,'campo_nome' => 'faturamento'))->get()->all;
            }
            $this->data['reprogramacao'] = $reprogramacao;
            //$this->data['faturamento'] = $faturamento;
        } else {
            $this->data['artigos'] = $ap->get_by_id($artigo_pedido_id);
            $this->data['reprogramacao'] = $l->where(array('tabela_id' => $ap->id,'tabela_nome' => 'artigos_pedidos','campo_nome' => 'data_reprogramacao'))->get()->all;
            //$this->data['faturamento'] = $l->where(array('tabela_id' => $ap->id,'campo_nome' => 'faturamento'))->get()->all;
        }
        $this->load->view('pedido/historico',$this->data);
    }


    function imprimir($id) {
        $p = new Pedido();
        $p->get_by_id($id);
        if ($this->session->userdata('tipo') == USUARIO_ADMINISTRADOR || $this->session->userdata('tipo') == USUARIO_SUPER_ADMINISTRADOR)
            $p->impresso_adm = 1;
        else
            $p->impresso_curtume = 1;
        $p->save();
    }

    function imprimir_analise($id, $financeiro = false, $artigo_id = null) {
        $this->data['usuario'] = $usuario = $this->session->userdata('tipo');
        verificar_permissao($usuario, array('SAD','ADM', 'CCM', 'CPR'));

        if($usuario == USUARIO_ADMINISTRADOR || $usuario == USUARIO_SUPER_ADMINISTRADOR) $financeiro = true;
        $this->data['financeiro'] = $financeiro;
        //1- Dados de Entrada
        $p = new Pedido();
        $this->data['pedido'] = $p->get_by_id($id);

        $l = new Log();
        $this->data['observacoes'] = $l->where(array('relation_table' => 'pedidos', 'relation_id' => $id))->order_by('created_at', 'desc')->get()->all;

        $mobilia = $automotivo = $calcado = $aeronautico = $artefatos = null;
        if (strtolower($p->linha_producao_nome()) == 'mobília')
            $mobilia = 'X';
        if (strtolower($p->linha_producao_nome()) == 'estofamento') // estofamento = automotivo
            $automotivo = 'X';
        if (strtolower($p->linha_producao_nome()) == 'calçado')
            $calcado = 'X';
        if (strtolower($p->linha_producao_nome()) == 'aeronautico')
            $aeronautico = 'X';
        else
            $artefatos = 'X';
        $this->data['mobilia'] = $mobilia;
        $this->data['automotivo'] = $automotivo;
        $this->data['aeronautico'] = $aeronautico;
        $this->data['calcado'] = $calcado;
        $this->data['artefatos'] = $artefatos;


        $c = new Cliente();
        $this->data['cliente'] = $c->get_by_id($p->cliente_id);

        $ap = new Artigo_pedido();
        if ($artigo_id == null) {
            $this->data['artigos'] = $artigos = $ap->get_by_pedido_id($id)->all;
            $producao = $amostra = 0;
            foreach($artigos as $ap) {
                if($ap->amostra == '1')
                    $amostra++;
                else
                    $producao++;
                $preco_venda = (!empty($ap->valor_unitario_corrigido)) ? $ap->valor_unitario_corrigido : $ap->valor_unitario;
            }
            $this->data['pedido_amostra'] = ($amostra > $producao)?true:false;
            $this->data['total_artigos'] = count($artigos);
            $this->data['preco_venda'] = $preco_venda;
        } else {
            $this->data['artigos'] = $ap->get_by_id($artigo_id)->all;
            $preco_venda = (!empty($ap->valor_unitario_corrigido)) ? $ap->valor_unitario_corrigido : $ap->valor_unitario;
            $this->data['preco_venda'] = $preco_venda;
            $this->data['total_artigos'] = 1;
        }

        //2,3 Dados preenchidos à mão
        $this->load->view('pedido/analise_critica', $this->data);
    }

    function financeiro($acao = 'listar',$var_listar = null) { //var_listar utilizado em case tabela e listar, mes da navegacao
        verificar_permissao($this->session->userdata('tipo'), array(USUARIO_SUPER_ADMINISTRADOR));
        $this->data['jsatual'] = array('pedido_financeiro','ajaxfileupload');
        seleciona_menu($this, 'financeiro_menu');
        switch ($acao) {
            case 'listar':
                if ($var_listar == null) {
                    $var_listar = $current_month = strftime("%m");
                    $this->data['current_month'] = $current_month = strftime("%m");
                } else {
                    $this->data['current_month'] = $current_month = $var_listar;
                }
                $this->data['titulo'] = "Pedidos - ".$current_month." - ".get_month_name($current_month,true);
                $this->view->load('pedido/financeiro',$this->data);
            break;
            case 'upload':
                $agora =  now();
                if (!@opendir('precos/')) {
                    if (!mkdir('precos/'))
                        echo "Erro ao criar diretório.";
                }  else {
                    foreach (glob("precos/*.{pdf,xls,text,html}", GLOB_BRACE) as $filename) {//somente um logo por empresa
                        unlink($filename);
                    }
                }

                $config['upload_path'] = 'precos/';
                $config['allowed_types'] = 'pdf|xls|html|text';
                $config['max_size'] = '0'; //unlimited
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['file_name'] = 'preco';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('tabela_financeira')) {
                    $error = array('error' => $this->upload->display_errors());
                    echo $this->upload->display_errors();
                } else {
                    $fInfo = $this->upload->data();
                    $data = array('tabela_financeira' => $this->upload->data());
                }

                $caminho = $data['tabela_financeira']['full_path'];

                foreach (glob("precos/*.{txt}", GLOB_BRACE) as $filename) //somente um logo por empresa
                    unlink($filename);

                $this->load->library('pdfConvert');
                $pdf = new pdfConvert();
                $pdf->setFilename($caminho);
                $pdf->decodePDF();

                $pdf->createMyDocument($caminho."copy.txt");

                $rf = new Rel_faturamento_model();
                $rf->sortData($caminho."copy.txt");

                echo "<script type='text/javascript'>alert('Arquivo enviado com sucesso');</script>";
            break;
            case 'tabela':
                $rf = new Rel_faturamento_model();
                //$this->data['faturado'] = $rf->where('month(data_processamento) = month(now())')->get()->all;
                $this->data['faturado'] = $rf->where("month(data_processamento) = '".$var_listar."'")->get()->all;
                $this->data['mes'] = $var_listar;
                $this->load->view('rel_faturamento/tabela_sistema',$this->data);
            break;
        }          
    }

    function dados_form() {
        $c = new Cliente();
        $this->data['clientes'] = $c->get_dropdown();

        $f = new Fornecedor();
        $this->data['fornecedores'] = $f->get_dropdown();

        $a = new Artigo();
        $this->data['artigos'] = $a->get_dropdown();

        $mp = new Materia_prima();
        $this->data['mat_primas'] = $mp->get_dropdown();

        $lp = new Linhas_producoe();
        $this->data['linhas_producao'] = $lp->get_dropdown();

        $u = new Usuario();
        $this->data['representante'] = $u->get_dropdown_representante();

        $p = new Pedido();
        $this->data['projecoes'] = $p->get_dropdown_projecao();

        $this->data['log'] = $l = new Log();
    }

    /* 		function pendencias() {
      $dois_meses_passados = date('Y-m-d', time() - (60 * 24 * 60 * 60));
      $p = new Pedido();
      $p->where('created_at >=',$dois_meses_passados)->order_by('created_at');
      $pedidos = $p->get()->all;
      $pedido_id = 0;
      foreach($pedidos as $pe) {
      $ape = new Artigo_pedido();
      $artigo_pedido = $ape->get_by_pedido_id($pe->id)->all;
      foreach($artigo_pedido as $ap) {
      echo "<table>";
      if($ap->amostra == '1' && trim($ap->data_reprogramacao) == '' && $ap->fechado != '1') {
      if($pedido_id != $pe->id) {
      $pedido_id = $pe->id;
      echo "<tr><td colspan='4'><b>Pedido: ".$pe->id."</b> ".data_br($pe->created_at)."</td></tr>";
      }
      echo "<tr>";
      echo "<td>".$ap->cor."</td><td>".$ap->quantidade."</td><td><b>O.I. Curtume:</b> ".$ap->oi_curtume."</td><td><b>Vlr Corrigido:</b> ".$ap->valor_unitario_corrigido."</td>";
      echo "</tr>";
      }
      echo "</table>";
      }
      }
      }
     * 
     */
}

?>