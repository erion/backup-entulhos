<?php
    class Perfis_cliente extends DataMapper {

        var $titulo = "Interesses de clientes";
        var $has_one = array('cliente','artigo');
        var $created_field = 'created_at';

        var $validation = array(
            array(
                'field' => 'cliente_id',
                'label' => 'Cliente',
                'rules' => array('required')
            ),
            array(
                'field' => 'artigo_id',
                'label' => 'Artigo',
                'rules' => array('required')
            )
        );

        function Perfis_cliente($data = null) {
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
