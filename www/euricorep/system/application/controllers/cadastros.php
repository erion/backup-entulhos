<?php    class Cadastros extends Controller {        function cadastros() {            parent::Controller();            $this->data['usuario_logado'] = $this->session->userdata('nome');            $this->data['titulo'] = "Cadastros diversos";            $this->data['tipo_usuario'] = $this->session->userdata('tipo');            verificar_permissao($this->session->userdata('tipo'),array('SAD','ADM'));            seleciona_menu($this,'cadastro_menu');        }        function listar() {            $this->view->load('layout/cadastros',$this->data);        }            }?>