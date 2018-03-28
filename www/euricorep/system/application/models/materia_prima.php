<?php

    Class Materia_prima extends DataMapper {

        var $titulo = 'Matérias primas';
        var $table = 'materias_primas';
        var $has_one = array('pedido');
        var $created_field = 'created_at';
        var $updated_field = 'updated_at';

        var $validation = array(
            array(
                'field'=>'nome',
                'label'=>'Nome',
                'rules'=>array('required','trim')
            )
        );

        function Materia_prima($data = null) {
            parent::DataMapper($data);
        }

        function get_dropdown(){
            $this->select('id,nome');
            $this->where('invisivel','0');
            $this->order_by('nome');
            $dropdown = array();
            $dropdown[""] = "";
            foreach($this->get()->all as $idnome){
                $dropdown[$idnome->id] = $idnome->nome;
            }
            return $dropdown;
        }
    }

?>
