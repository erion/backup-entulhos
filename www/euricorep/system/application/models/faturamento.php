<?php
    class Faturamento extends DataMapper {

        var $titulo = 'Pedidos';
        var $table = 'faturamento';
        //var $has_many = array('artigo_pedido');
        var $created_field = 'created_at';
        var $updated_field = 'updated_at';

        function Faturamento($data = null) {
            parent::DataMapper($data);
        }

    }
?>