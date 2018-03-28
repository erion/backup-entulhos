<?php
    class Oferta extends DataMapper {

        var $titulo = 'Ofertas';
        var $created_field = 'created_at';
        var $has_one = array('usuario','cliente');
        var $validation = array(
            array(
                'field'=>'usuario_id',
                'label'=>'Usuário',
                'rules'=>array('required')
            ),
            array(
                'field'=>'cliente_id',
                'label'=>'Cliente',
                'rules'=>array('required')
            ),
            array(
                'field'=>'email',
                'label'=>'Conteúdo',
                'rules'=>array('required')
            )
        );

        function Oferta($data = null) {
            parent::DataMapper($data);
        }

        function cliente_nome() {
            $c = new Cliente();
            $c->get_by_id($this->cliente_id);
            return $c->nome;
        }

        function usuario_nome() {
            $u = new Usuario();
            $u->get_by_id($this->usuario_id);
            return $u->nome;
        }

        function filtrar() {
            if (!empty($_GET['cliente_id'])) {
                $this->where('cliente_id',$_GET['cliente_id']);
            }
            if (!empty($_GET['usuario_id'])) {
                $this->where('usuario_id',$_GET['usuario_id']);
            }
            if (!empty($_GET['criado_ini'])) {
                $this->where('created_at >=',data_mysql(trim($_GET['criado_ini'])));
                $this->where('created_at <=',data_mysql(trim($_GET['criado_fim'])));
            }
            if (!empty($_GET['texto'])) {
                $this->like('email',$_GET['texto']);
            }
            $this->order_by('created_at desc');
        }
    }
?>
