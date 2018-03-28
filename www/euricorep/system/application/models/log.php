<?php
    Class Log extends DataMapper {

        var $table = 'logs';
        var $titulo = "Diário de visitas";
        var $created_field = "created_at";
        var $has_many = array('cliente','pedido','usuario');

        var $validation = array(
            array (
                'field' => 'msg',
                'label' => 'Mensagem',
                'rules' => array('trim','required')
            ),
            array (
                'field' => 'relation_id',
                'label' => 'Cliente',
                'rules' => array('trim','required')
            )
        );

        function log($data=null) {
            parent::DataMapper($data);
        }

        function cliente_nome() {
            $c = new Cliente();
            $c->get_by_id($this->relation_id);
            return $c->nome;
        }

        function usuario_nome() {
            $u = new Usuario();
            $u->get_by_id($this->usuario_id);
            return $u->nome;
        }

        function filtrar() {
            $this->where('relation_table','entidades');
            if (!empty($_GET['cliente_id']))
                $this->where('relation_id',$_GET['cliente_id']);
            if (!empty($_GET['usuario_id']))
                $this->where('usuario_id',$_GET['usuario_id']);
            if (!empty($_GET['criado_ini'])) {
                if (empty($_GET['criado_fim'])) {
                    $_GET['criado_fim'] = $_GET['criado_ini'];
                }
                $this->where('created_at >=',data_mysql(trim($_GET['criado_ini'])).' 00:00:00');
                $this->where('created_at <=',data_mysql(trim($_GET['criado_fim'])).' 23:59:59');
            }
            $this->order_by('created_at desc');
        }
    }
?>
