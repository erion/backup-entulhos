<?php
    class Pedidos_comercial extends Controller {

        function Pedidos_comercial() {
            parent::Controller();
            $this->data['usuario_logado'] = $this->session->userdata('nome');   
            $this->data['tipo_usuario'] = $this->session->userdata('tipo');
			if($this->input->get('projecao')) {
				$this->data['titulo'] = "Projeções";
				seleciona_menu($this,'projecao_menu');
			} else {
				$this->data['titulo'] = "Pedidos";
				seleciona_menu($this,'pedidos_menu');
			}
			verificar_permissao($this->session->userdata('tipo'),array('CCM'));
        }

        function listar() {
            $p = new Pedido();

            $cont = new Pedido();
            $sql = "";
            $num_reg = "";
            if($this->input->get('artigos_pedidos') == 'artigos') {
                $p->set_sql($sql, USUARIO_CURTUME_PROGRAMACAO,$this->session->userdata('empresa'));
                $p->filtrar($sql,USUARIO_CURTUME_PROGRAMACAO);
                $cont->set_sql_count($num_reg,USUARIO_CURTUME_PROGRAMACAO,$this->session->userdata('empresa'));
                $cont->filtrar($num_reg,USUARIO_CURTUME_PROGRAMACAO,true);
            } else {
				$p->set_sql($sql, USUARIO_CURTUME_COMERCIAL,$this->session->userdata('empresa'));
				$p->filtrar($sql);
                $cont->set_sql_count($num_reg,USUARIO_CURTUME_COMERCIAL,$this->session->userdata('empresa'));
                $cont->filtrar($num_reg,USUARIO_CURTUME_COMERCIAL,true);
            }
            $contador = $cont->query($num_reg);
            if(count($contador) > 0)
                $contador = $contador[0]->total;
            else
                $contador = 0;
            if(!$this->input->get('imprimir'))
                $p->paginacao($sql,$this->input->get('per_page'),$this);
            else
                $this->data['p'] = $p->query($sql);

			$pedido = $this->data['p'];
			if($this->input->get('buscar') && $contador == 1)
				redirect("pedidos/visualizar_resumo/".$pedido[0]->visualizar);

            $c = new Cliente();
            $this->data['clientes'] = $c->get_dropdown();

            $a = new Artigo();
            $this->data['artigos'] = $a->get_dropdown();

            $lp = new Linhas_producoe();
            $this->data['linha_producao'] = $lp->get_dropdown();

            $this->data['status'] = $this->config->item('status');
            $this->data['amostra'] = $this->config->item('amostra');
			
            //$this->data['jsatual'] = array('pedido_listar');

            if(!$this->input->get('imprimir')) {
                $this->load->library('pagination');
                $this->pagination->initialize(config_pagination('pedidos_comercial/listar',$contador,'per_page'));
            } else {
                $this->data['custom_css'] = array('imprimir_pedidos' => 'all');
				$this->data['printable'] = true;
            }

			$config['item'] = $this->session->userdata('tipo');
			$config['form_location'] = 'filter_builder/pedido/';
			$config['form_action'] = null;
			$this->load->library('FilterBuilder');
			$this->filterbuilder->initialize($config);

            if($this->input->get('artigos_pedidos') == 'artigos') {
				$this->data['abertos'] = true;
                $this->view->load('pedido/listar_programacao',$this->data);
			} else
                $this->view->load('pedido/listar_comercial',$this->data);
        }

        function editar($id,$artigo_pedido_id = null,$pag=null) {
            $ap = new Artigo_pedido();
            $this->data['ap'] = $ap->get_by_pedido_id($id)->all;

            $p = new Pedido();
            $p->get_by_id($id);

            $this->data['titulo'] = "Pedido #".$p->id."<br /><br />".$p->artigo_nome()." - ".$p->materia_prima_nome();
            $this->data['unidade_medida'] = $p->unidade_medida;
            $this->data['fat'] = $ap->get_faturamento($id);
            $this->data['pedido_id'] = $id;
            $this->data['jsatual'] = array('pedido_cadastrar_comercial');
			if ($artigo_pedido_id > 0 && $artigo_pedido_id != null)
				$this->data['abre_artigo'] = $artigo_pedido_id;
			else
				$this->data['abre_artigo'] = 0;

            $post = $this->input->post('valor_alterado');
            if (!empty($post)) {
                $log_post = $this->input->post('msg');
                if(!empty($log_post)) {
					foreach($log_post as $k => $v) {
						$l = new Log();
						$l->usuario_id = $this->session->userdata('id');
						$l->msg = $v;
						$l->relation_table = 'artigos_pedidos';
						$l->relation_id = $k;
						$l->save();
					}
                }
                $total_artigos = count($this->input->post('valor_alterado'));
                $valor_corrigido = $this->input->post('valor_alterado');
                $oi_curtume = $this->input->post('oi_curtume');
                $artigo_pedido_id = $this->input->post('artigo_pedido_id');

                $fat_id = $this->input->post('faturamento_id');
                $nf = $this->input->post('nota_fiscal');
                $qtd = $this->input->post('qtd');
                $data = $this->input->post('data');
				$valor_total = 0;
                for($i=0;$i<$total_artigos;$i++) {
                    $ap = new Artigo_pedido();
                    $ap->get_by_id($artigo_pedido_id[$i]);
					
					if(trim($ap->oi_curtume) != trim($oi_curtume[$i])) {
						$valor_log = array(
							'tabela_id'  => $artigo_pedido_id[$i],
							'tabela_nome'=> 'artigos_pedidos',
							'campo_nome' => 'oi_curtume',
							'campo_old'  => $ap->oi_curtume,
							'campo_new'  => trim($oi_curtume[$i]),
							'usuario_id' => $this->session->userdata('id'),
							'data_hora'  => date('Y-m-d H:M:S',now())
						);
						$l = new log_bd($valor_log);
						$l->save();
					}
					if(trim($ap->valor_unitario_corrigido) != trim(double_mysql($valor_corrigido[$i]))) {
						$valor_log = array(
							'tabela_id'  => $artigo_pedido_id[$i],
							'tabela_nome'=> 'artigos_pedidos',
							'campo_nome' => 'valor_unitario_corrigido',
							'campo_old'  => $ap->valor_unitario_corrigido,
							'campo_new'  => trim(double_mysql($valor_corrigido[$i])),
							'usuario_id' => $this->session->userdata('id'),
							'data_hora'  => date('Y-m-d H:M:S',now())
						);
						$l = new log_bd($valor_log);
						$l->save();
					}

                    $ap->oi_curtume = $oi_curtume[$i];
                    $valor_total += $ap->valor_unitario_corrigido = double_mysql($valor_corrigido[$i]);
                    $ap->save();
                    for($j=0;$j<count($nf[$artigo_pedido_id[$i]]);$j++) {
                        $f = new Faturamento();
                        $f->get_by_id($fat_id[$artigo_pedido_id[$i]][$j]);
                        $f->artigos_pedidos_id = $artigo_pedido_id[$i];
                        $f->nota_fiscal = $nf[$artigo_pedido_id[$i]][$j];
                        $f->qtd = double_mysql($qtd[$artigo_pedido_id[$i]][$j]);
                        $f->data = data_mysql($data[$artigo_pedido_id[$i]][$j]);
                        $f->save();

						$valor_log = array(
							'tabela_id'  => $f->id,
							'tabela_nome'=> 'faturamento',
							'campo_nome' => '',
							'campo_old'  => '',
							'campo_new'  => '',
							'usuario_id' => $this->session->userdata('id'),
							'data_hora'  => date('Y-m-d H:M:S',now())
						);
						$l = new log_bd($valor_log);
						$l->save();
                    }
                }
				$p->valor_total = $valor_total;
				$p->save();
                //envia email
                $p = new Pedido();
                $p->get_by_id($id);
                $mensagem = "Pedido #".$p->id." alterado.<br/><a href='".site_url()."/usuarios/login/0/".$p->visualizar."' >Clique aqui</a> para ver os detalhes.";
                $u = new Usuario();
                $email_to = array();
                $u->where('id',$p->created_by);
                $usuario = $u->where(array('invisivel'=>'0','tipo'=>'ADM','receber_email' => '1'))->get()->all;
                foreach($usuario as $u)
                    array_push($email_to,$u->email);
                enviar_email($email_to,"Sistema de Pedidos - Alteração comercial",$mensagem);
                redirect('pedidos_comercial/listar'.LISTAGEM_PADRAO.'&per_page='.$pag.$this->configfilter->get_artigo_in_URL().$this->configfilter->get_artigo_not_in_URL());
            }
            $this->view->load('pedido/form_comercial',$this->data);
        }
    }
?>
