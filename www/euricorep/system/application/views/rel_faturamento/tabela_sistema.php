<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/resumo.css" />
<script type="text/javascript" >

    var campo = null;
    var valor = null;
    
    function editar(id,form_id) {
        if(confirm("Tem certeza que deseja editar este registro?")) {
            $.post(getBaseURL()+'index.php/rel_faturamento/editar/'+id, $("#"+form_id).serialize() ,function(data) {alert('Editado com sucesso');});
        }
    }

    function excluir(selector,id) {
        if(confirm("Tem certeza que deseja excluir este registro?")) {
            $(selector).qtip('destroy');
            $(selector).parent().parent().remove();
            $.post(getBaseURL()+'index.php/rel_faturamento/excluir/'+id,{},function(data) {alert('Excluido com sucesso');});
        }
    }


    function entra() {
        alert('entrei');
    }

    function sai() {
        alert('sai');
    }

    $('#TB_window img[title],#TB_window a[title],#TB_window span[title]').qtip({
       style: { border:{color:'#A9A9A9'}, name: 'light',tip:true },
       show: 'mouseover',
       hide: 'mouseout',
       fixed:true,
       onHide: function(){
            $(this).qtip('destroy');
       }
    });
</script>
<div class="resumo_pedido">
    <ul class="imagens">
        <li class="risco_fechar"><img src='<?php echo base_url() ?>assets/img/resumo_fechar.gif' onclick="tb_remove()" alt='' title="fechar" /></li>
    </ul>
    <ul style="padding-top:10px;">
        <table style="padding:2px; width:100%;">
            <thead>
                <tr>
                    <th>Artigo</th>
                    <th>OC</th>
                    <th>OI</th>
                    <th>Qtd.</th>
                    <th>Vlr. Unit.</th>
                    <th><!-- editar excluir --></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach($faturado as $f):
                    echo form_open("rel_faturamento/editar","id='faturamento".$i."'");
                ?>
                <tr>
                    <td width="60%"><?php echo form_input("faturamento[nome_artigo]", $f->nome_artigo,"style='width:100%'"); ?></td>
                    <td width="10%"><?php echo form_input("faturamento[oc]",$f->oc,"style='width:100%' onFocus='entra()'"); ?></td>
                    <td width="10%"><?php echo form_input("faturamento[oi]",$f->oi,"style='width:100%'"); ?></td>
                    <td width="8%"><?php echo form_input("faturamento[qtd]",$f->qtd,"style='width:100%'"); ?></td>
                    <td width="8%"><?php echo form_input("faturamento[valor]",  $f->valor,"style='width:100%'"); ?></td>
                    <td width="2%"><img style='cursor:pointer;padding-left:5px;' src='<?php echo base_url().'assets/img/lapis.png' ?>' onclick="editar(<?php echo $f->id ?>,'<?php echo "faturamento".$i; ?>')" title='editar' /></td>
                    <td width="2%"><?php echo "<img style='cursor:pointer;padding-left:5px;' src='".base_url().'assets/img/resumo_excluir_obs.gif'."'onclick='excluir(this,".$f->id.")' title='excluir' />";  ?></td>
                </tr>
                <?php
                    $i++;
                    echo form_close();
                endforeach;
                ?>
            </tbody>
        </table>
    </ul>
</div>