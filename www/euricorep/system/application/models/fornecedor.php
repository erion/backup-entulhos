<?php

    class Fornecedor extends Entidade {

        var $tipo = 'FORNECEDOR';
        var $table = 'entidades';
        var $has_one = array('pedido');

        function Fornecedor($data = null){
            parent::Entidade($data);
        }

        function get_dropdown(){
            $this->select('id,nome');
            $this->where('invisivel','0')->where('tipo','FORNECEDOR');
            $this->order_by('nome');
            $dropdown = array();
            $dropdown[""] = "";
            foreach (parent::get()->all as $idnome){
                $dropdown[$idnome->id] = $idnome->nome;
            }
            return $dropdown;
        }
    }
?>
