<?php

    class Cliente extends Entidade {

        var $tipo = 'cliente';
        var $table = 'entidades';
        var $has_many = array('pedido','log','perfis_cliente');

        function Cliente($data = null){
            parent::Entidade($data);
        }

        function get_dropdown() {
            $this->select('id,nome');
            $this->where('invisivel','0')->where('tipo','CLIENTE');
            $this->order_by('nome');
            $dropdown = array();
            $dropdown[""] = "";
            foreach (parent::get()->all as $idnome) {
                $dropdown[$idnome->id] = $idnome->nome;
            }
            return $dropdown;
        }
    }
?>
