<?php

    Class Usuarios extends Controller {

        function Usuarios() {
            parent::Controller();
            $this->load->model('usuario');
            $this->data['titulo'] = $this->usuario->titulo;
            $this->data['usuario_logado'] = $this->session->userdata('nome');
            $this->data['tipo_usuario'] = $this->session->userdata('tipo');
            $this->data['empresa'] = $this->session->userdata('empresa');
            $this->data['v_pedido'] = null;

            if ($this->session->userdata('tipo') == 'SAD') {
                $this->data['user_tipo'] = array('' => '','SAD'=>'Super Administrador','ADM'=>'Administrador','CCM'=>'Curtume Comercial','CPR'=>'Curtume Programação');
            } elseif ($this->session->userdata('tipo') == 'ADM') {
                $this->data['user_tipo'] = array('' => '','ADM'=>'Administrador','CCM'=>'Curtume Comercial','CPR'=>'Curtume Programação');
            } elseif($this->session->userdata('tipo') == 'CCM') {
                $this->data['user_tipo'] = array('' => '','CCM'=>'Curtume Comercial','CPR'=>'Curtume Programação');
            } elseif($this->session->userdata('tipo') == 'CPR') {
                $this->data['user_tipo'] = array('CPR'=>'Curtume Programação');
            }

            seleciona_menu($this,'cadastro_menu');
        }

        function excluir_contato($email) {
            $u = new Usuario();
            $u->get_by_email($email)->all;
            if(!empty($u->id)) {
                $u->receber_email = '0';
            }
            $u->save();
        }

        function cadastrar() {
            verificar_permissao($this->session->userdata('tipo'),array('SAD','ADM','CCM'));
            $post = $this->input->post('usuario');
            $e = new Entidade();
            $this->data['entidades'] = $e->get_dropdown();
            if (empty($post)) {
                $this->data['usuario'] = $u = new Usuario();
                $this->view->load('usuario/form',$this->data);
            } else {
                $entidade_logada = new Usuario();
                $entidade_logada->get_by_id($this->session->userdata('id'));
                $this->data['usuario'] = $u = new Usuario($post);
                $u->senha_automatica = $u->get_senha();
		$u->representante = (empty($post['representante']))?'0':$post['representante'];
                $u->receber_email = (empty($post['receber_email']))?'0':$post['receber_email'];
                if(isset($post['senha']))
                    $u->senha = $post['senha'];
                else
                    $u->senha = $u->senha_automatica;
                if($this->data['tipo_usuario'] != 'ADM' || $this->data['tipo_usuario'] != 'SAD')
                    $u->entidade_id = $entidade_logada->entidade_id;
                if ($u->save()) {
                    $email_to = $u->email;
                    enviar_email($email_to,"Bem vindo ao Sistema EuricoRep", $this->usuario->boas_vindas($u->tipo,$u));
                    redirect('usuarios/listar');
                }
                $this->view->load('usuario/form',$this->data);
            }
        }

        function listar() {
            verificar_permissao($this->session->userdata('tipo'),array('SAD','ADM','CCM'));
            $u = new Usuario();
            $u->order_by('nome');
            if ($this->session->userdata('tipo') == 'CPR') {
                redirect('pedidos_programacao/listar');
            }
            if ($this->session->userdata('tipo') != 'SAD') {
                if ($this->session->userdata('tipo') != 'ADM') {
                    $contador = $u->where('invisivel','0')->where('tipo <>','ADM')->where('tipo <>','SAD')->where('entidade_id',$this->session->userdata('empresa'))->count();
                    $u->where('invisivel','0')->where('tipo <>','ADM')->where('tipo <>','SAD')->where('entidade_id',$this->session->userdata('empresa'));
                } else {
                    $contador = $u->where('invisivel','0')->where('tipo <>','SAD')->count();
                    $u->where('invisivel','0')->where('tipo <>','SAD');
                }
            } else $contador = $u->count();

            $CI = &get_instance();
            $por_pagina = $CI->config->item('pedidos_por_pagina');
            
            if($this->input->get('order')) {
                $u->order_by($this->input->get('campo'),$this->input->get('order'));
            } else $u->order_by('nome');
            $this->data['u'] = $u->get($por_pagina,$this->input->get('per_page'))->all;

            $this->load->library('pagination');
            $this->pagination->initialize(config_pagination("usuarios/listar",$contador,'per_page'));

            $this->view->load('usuario/listar',$this->data);
        }

        function detalhes($id,$pag = null) {
            verificar_permissao($this->session->userdata('tipo'),array('SAD','ADM','CCM','CPR'));
            $post = $this->input->post('usuario');
            
            $e = new Entidade();
            $this->data['entidades'] = $e->get_dropdown();
            if (empty($post)) {
                $u = new Usuario();
                $this->data['usuario'] = $u->get_by_id($id);
                $this->view->load('usuario/form',$this->data);
            } else {
                $this->data['usuario'] = $u = new Usuario();
                $u->get_by_id($id);
                $u->nome = $post['nome'];
                $u->email = $post['email'];
                if($post['senha'] != null)
                    $u->senha = $post['senha'];
                $u->tipo = $post['tipo'];
                $u->entidade_id = $post['entidade_id'];
		$u->representante = (empty($post['representante']))?'0':$post['representante'];
                $u->receber_email = (empty($post['receber_email']))?'0':$post['receber_email'];
		$u->invisivel = (empty($post['invisivel']))?'0':$post['invisivel'];
		$u->ver_todos_pedidos = (empty($post['ver_todos_pedidos']))?'0':$post['ver_todos_pedidos'];
                if ($u->save()) {
                    if ($id == $this->session->userdata('id')) {
                        $this->session->sess_destroy();
						$e = new Entidade();
						$e->get_by_id($u->entidade_id);
                        $u->set_session($this,$u->id, $u->nome, $u->email, $u->tipo, $u->ver_todos_pedidos, $u->entidade_id,$u->representante,$e->caminho_logo);
                    }
                    if($this->session->userdata('tipo') == 'CPR') {
                        redirect('pedidos_programacao/listar');
                    } else {
                        $uri = 'usuarios/listar?per_page='.$pag;
                        redirect($uri);
                    }
                }
                $this->view->load('usuario/form',$this->data);
            }
        }

        function login($out = 0,$pedido_visualizar = 0) {
            if ($out == 1) {
                $this->session->sess_destroy();
                redirect('usuarios/login');
            }
            $post = $this->input->post('login');
            if($pedido_visualizar != null || $this->data['v_pedido'] != null) {
                $user_id = $this->session->userdata('id');
                ($pedido_visualizar == null) ? $pedido_visualizar = $this->data['v_pedido'] : $this->data['v_pedido'] = $pedido_visualizar;
                if(!empty($user_id)) {
                    redirect('pedidos/visualizar_resumo/'.$pedido_visualizar);
                } else {
                    if (empty($post)){
                        $this->usuario->mostra_login('',$this);
                    } else {
                        $u = new Usuario();
                        $u->email = $this->input->post('nome');
                        $u->senha = $this->input->post('senha');
                        if ($u->login($u->senha)) {
                            $u->get_by_email($this->input->post('nome'));
                            $u->last_login = date('Y-d-m',time());
                            $u->save();
							$e = new Entidade();
							$e->get_by_id($u->entidade_id);
                            $u->set_session($this,$u->id, $u->nome, $u->email, $u->tipo, $u->ver_todos_pedidos, $u->entidade_id,$u->representante,$e->caminho_logo);
                            $this->data['usuario'] = $u->nome;
                            $this->data['tipo_usuario'] = $u->tipo;
                            redirect('pedidos/visualizar_resumo/'.$pedido_visualizar);
                        } else {
                            $this->usuario->mostra_login("Usuário ou login inválido.",$this);
                        }
                    }
                }
            } else {
                if (empty($post)){
                    $this->usuario->mostra_login("",$this);
                } else {
                    $u = new Usuario();
                    $u->email = $this->input->post('nome');
                    $u->senha = $this->input->post('senha');
                    if ($u->login($u->senha)) {
                        $u->get_by_email($this->input->post('nome'));
                        $u->last_login = date('Y-d-m',time());
                        $u->save();
						$e = new Entidade();
						$e->get_by_id($u->entidade_id);
                        $u->set_session($this,$u->id, $u->nome, $u->email, $u->tipo, $u->ver_todos_pedidos, $u->entidade_id,$u->representante,$e->caminho_logo);
                        $this->data['usuario'] = $u->nome;
                        $this->data['tipo_usuario'] = $u->tipo;
                        if ($this->session->userdata('tipo') == 'ADM' || $this->session->userdata('tipo') == 'SAD') {
                            redirect('pedidos/listar'.LISTAGEM_PADRAO.$this->configfilter->get_artigo_in_URL().$this->configfilter->get_artigo_not_in_URL());
                        } elseif ($this->session->userdata('tipo') == 'CCM') {
                            redirect('pedidos_comercial/listar'.LISTAGEM_PADRAO.$this->configfilter->get_artigo_in_URL().$this->configfilter->get_artigo_not_in_URL());
                        } elseif ($this->session->userdata('tipo') == 'CPR') {
                            redirect('pedidos_programacao/listar'.LISTAGEM_PADRAO.$this->configfilter->get_artigo_in_URL().$this->configfilter->get_artigo_not_in_URL());
                        } else {
                            $this->usuario->mostra_login("Ocorreu um erro, tente novamente mais tarde.",$this);
                        }
                    } else {
                        $this->usuario->mostra_login("Usuário ou login inválido.",$this);
                    }
                }
            }
        }

        function programacao() {
            $this->detalhes($this->session->userdata('id'));
        }

        function excluir($id,$pag = null) {
            verificar_permissao($this->session->userdata('tipo'),array('SAD','ADM','CCM'));
            $u = new Usuario();
            $u->get_by_id($id);
            $u->invisivel = 1;
            $u->save();
            $uri = 'usuarios/listar/'.$pag;
            redirect($uri);
        }

    }
?>