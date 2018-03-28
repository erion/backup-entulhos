<?php
    Class Pedidos_comercio extends DataMapper {

        var $titulo = 'Pedidos';
        var $has_one = array('cliente','fornecedor','materia_prima');
        var $has_many = array('artigo','log','artigo_pedido');
        var $created_field = 'created_at';
        var $updated_field = 'updated_at';
        var $table = 'pedidos';

        var $validation = array(
            array(
                'field'=>'cliente_id',
                'label'=>'Cliente',
                'rules'=>array('required','trim'),
            ),
            array(
                'field'=>'fornecedor_id',
                'label'=>'Fornecedor',
                'rules'=>array('required','trim')
            )
        );

        function pedidos_comercio($data = null) {
            parent::DataMapper($data);
        }

        function cliente_nome() {
            $c = new Cliente();
            $c->get_by_id($this->cliente_id);
            return $c->nome;
        }

        function artigo_nome() {
            if(!empty($this->artigo_id)) {
                $a = new Artigo();
                $a->get_by_id($this->artigo_id);
                return $a->nome;
            } else return null;
        }
    }
?>
