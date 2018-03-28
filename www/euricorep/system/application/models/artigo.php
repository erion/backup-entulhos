	<?php

    Class Artigo extends DataMapper {

        var $titulo = 'Artigos';
        var $has_many = array('pedido','perfis_cliente');
        var $created_field = 'created_at';
        var $updated_field = 'updated_at';

        var $validation = array(
            array(
                'field'=>'nome',
                'label'=>'Nome',
                'rules'=>array('required','trim')
            )
        );

        function Artigo($data = null) {
            parent::DataMapper($data);
        }

        function get_dropdown() {
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
