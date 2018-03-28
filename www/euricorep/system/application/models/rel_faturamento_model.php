<?php
class Rel_faturamento_model extends DataMapper {

        var $titulo = 'Faturamento';
        var $table = 'rel_financeiro';
        //var $created_field = 'data_processamento';

        function Rel_faturamento_model($data = null) {
            parent::DataMapper($data);
        }

        function sortData($filename) {
            $dados = file_get_contents($filename);
            $registros = explode(';',$dados);
//var_dump($registros);
            foreach($registros as $r) {
                $rf = new Rel_faturamento_model();
                $row = explode('|',$r);
                $rf->cadastrar($row);
            }
        }

        function OCOI($dados) {
            $d = $dados;
            $oc = explode('OC',$dados);
            $oc[1] = str_replace('OI','', $oc[1]);
            $oc[1] = str_replace('-','', $oc[1]);
            $oi = explode('OI',$d);
            $oi[1] = str_replace('-','', $oi[1]);
            $this->oc = trim($oc[1]);
            $this->oi = trim($oi[1]);
        }

        function cadastrar($dados) {
//var_dump($dados);exit;
            $dados[0] = trim(substr($dados[0],8,strlen($dados[0])));//remove códigos dos artigos
            $this->nome_artigo = $dados[0];
            $this->qtd = $dados[2];
            $this->valor = $dados[3];
            $this->OCOI($dados[1]);
            $this->data_processamento = date('Y-m-d',now());
            $this->save();
        }
}
?>
