<?php

    Class Usuario extends DataMapper {

        var $titulo = 'Usuários';
        var $created_field = 'created_at';
        var $updated_field = 'updated_at';
        var $has_many = array('log');
        var $CI;

        var $validation = array(
            array(
                'field'=>'nome',
                'label'=>'Nome',
                'rules'=>array('required','trim')
            ),
            array(
                'field'=>'email',
                'label'=>'E-mail',
                'rules'=>array('required','unique','trim','valid_email')
            ),
            array(
                'field'=>'senha',
                'label'=>'Senha',
                'rules'=>array('required','min_length'=> 4,'max_length'=>40,'encrypt','trim')
            ),
            array(
                'field'=>'tipo',
                'label'=>'Tipo Usuário',
                'rules'=>array('required','trim')
            ),
            array(
                'field'=>'confirma_senha',
                'label'=>'Confirmar Senha',
                'rules'=>array('encrypt','matches'=>'senha')
            )
        );

        function Usuario($data=null) {
            parent::DataMapper($data);
        }

        function _encrypt($field) {
            if (!empty($this->{$field})) {
                $this->{$field} = sha1($this->salt.$this->{$field});
            }
        }

        function do_encrypt($field) {
            if (!empty($field)) {
                return $field = sha1($this->salt.$field);
            }
        }

        function login($senha) {
            $u = new Usuario();
            $u->where('invisivel','0')->where('email', $this->email)->get();
            //$this->validate()->get();
            if ($u->senha == $this->do_encrypt($senha)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        function get_dropdown() {
            $this->select('id,nome')->where('tipo','ADM');
            $this->order_by('nome');
            $dropdown = array();
            $dropdown[""] = "";
            foreach($this->get()->all as $idnome) {
                $dropdown[$idnome->id] = $idnome->nome;
            }
            return $dropdown;
        }

		function get_dropdown_representante() {
            $this->select('id,nome')->where('tipo','ADM')->where('representante','1');
            $this->order_by('nome');
            $dropdown = array();
            $dropdown[""] = "";
            foreach($this->get()->all as $idnome) {
                $dropdown[$idnome->id] = $idnome->nome;
            }
            return $dropdown;
		}

        function get_senha() {
            $senha = null;
            for ($i=0;$i<=6;$i++) {
                $nmr = rand(65,90);
                $senha .= chr($nmr);
            }
            return $senha;
        }

        function mostra_login($erro,$controller) {
            $controller->data['erro'] = $erro;
            $controller->load->view('login/header',$controller->data);
            $controller->load->view('login/login',$controller->data);
            $controller->load->view('login/footer');
        }

        function boas_vindas($tipo_usuario,$data_mapper) {
            $conteudo = "Bem vindo ".$data_mapper->nome.".<br />".
                        "Acesse o sistema de pedidos através deste link: <a href='".site_url()."' >".site_url()."</a><br />".
                        "Seu login é <b>".$data_mapper->email."</b> e sua senha é <b>".$data_mapper->senha_automatica."</b><br /><br />";
            if($tipo_usuario == USUARIO_ADMINISTRADOR) {
                $conteudo .= "Você pode alterar a sua senha acessando o menu Cadastros -> Usuário,".
                             "localize seu nome e altere seus dados.<br />".
                             "O e-mail cadastrado será o seu login e será o e-mail utilizado para as comunicações do sistema.";
            }
            if($tipo_usuario == USUARIO_CURTUME_COMERCIAL) {
                $conteudo .= "Você pode alterar a sua senha acessando o menu Usuários,".
                             "localize seu nome e altere seus dados.<br />".
                             "O e-mail cadastrado será o seu login e será o e-mail utilizado para as comunicações do sistema.";
            }
            if($tipo_usuario == USUARIO_CURTUME_PROGRAMACAO) {
                $conteudo .= "Você pode alterar a sua senha acessando o menu Meus dados.<br />".
                             "O e-mail cadastrado será o seu login e será o e-mail utilizado para as comunicações do sistema.";
            }
            return $conteudo;
        }

		function verificar_e_cadastrar($tipo_usuario, $entidade_id = null,$email = null,$invisivel = '1') {
			if (!$this->email) {
				die('Usuario::verificar_e_cadastrar => Você precisa especificar o email do usuário para poder utilizar esta função.');
			}
			$cadastrado = false;
			
			$u = new Usuario();
			$u = $u->where('entidade_id', $entidade_id)->get_by_email($email);
			if (empty($u->id)) {
                                $u->senha_automatica = $this->get_senha();
                                $u->senha = $this->senha_automatica;
                                $u->entidade_id = $entidade_id;
                                //$u->invisivel = $invisivel;
                                $u->tipo = $tipo_usuario;
				$u->save();
				if ($tipo_usuario != USUARIO_CLIENTE) {
					enviar_email($this->email,"Bem vindo ao Sistema EuricoRep", $this->boas_vindas($tipo_usuario, $this));
				}
				$cadastrado = true;
			} else {
                            $u->receber_email = '1';
                            $u->invisivel = '0';
                            $u->save();
                        }
			return $cadastrado;
		}

        function set_session($controller,$id,$nome,$email,$tipo,$ver_todos_pedidos,$entidade_id,$representante,$logo) {
            $dados_usuario = array(
                'id' => $id,
                'nome' => $nome,
                'email' => $email,
                'tipo' => $tipo,
				'ver_pedidos' => $ver_todos_pedidos,
                'empresa' => $entidade_id,
				'representante' => $representante,
				'logo' => $logo
            );
            $controller->session->set_userdata($dados_usuario);
        }

        function get_nome($id) {
            $this->get_by_id($id);
            return $this->nome;
        }

    }
?>
