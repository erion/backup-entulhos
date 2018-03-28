<?php
    class Linhas_producoe extends DataMapper {

        function linhas_producoe() {
            parent::DataMapper();
        }

        function get_dropdown() {
            $this->select('id,nome');
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
