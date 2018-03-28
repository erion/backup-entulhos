<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/resumo.css" />
<div class="resumo_pedido">
    <?php if(!$artigo_id): ?>
    <ul class="imagens">
        <li class="risco_fechar"><a class="thickbox" href='<?php echo keep_current_gets(site_url()."/resumos/resumo_pedido/".$pedido->id."?height=469&width=620&modal=true&amostrav=2") ?>'><img src='<?php echo base_url() ?>assets/img/resumo_fechar.gif' alt='' title="voltar" /></a></li>
    </ul>
        <h4>Histórico do pedido <?php echo $pedido->id." (".$pedido->cliente_nome().")"; ?></h4></br></br>
        <h5>Cores</h5></br>
        <?php
            foreach($artigos as $ap) {
                echo "<h5>".$ap->cor."</h5>";
                echo "<table width='80%'><tr><td>Campo</td><td>Valor anterior</td><td>Novo valor</td><td>Data modificação</td><td>Usuário</td></tr>";
                if(empty($reprogramacao[$ap->id])) {
                    echo "<tr><td>-----</td><td>-----</td><td>-----</td><td>-----</td><td>-----</td></tr>";
                } else {
                    foreach($reprogramacao[$ap->id] as $r)
                        echo "<tr><td>Data</td><td>".data_br($r->campo_old)."</td><td>".data_br($r->campo_new)."</td><td>".data_br($r->data_hora)."</td><td>".$usuario->get_nome($r->usuario_id)."</td></tr>";
                }
                echo "</table>";
            }
         ?>
    <?php else: ?>
        <h4>Histórico do pedido <?php echo $pedido->id." (".$pedido->cliente_nome().")"; ?></h4></br></br>
        <h5>Cores</h5></br>
        <?php
            echo "<h5>".$artigos->cor."</h5>";
            echo "<table width='80%'><tr><td>Campo</td><td>Valor anterior</td><td>Novo valor</td><td>Data modificação</td><td>Usuário</td></tr>";
            if(empty($reprogramacao)) {
                echo "<tr><td>-----</td><td>-----</td><td>-----</td><td>-----</td><td>-----</td></tr>";
            } else {
                foreach($reprogramacao as $r)
                    echo "<tr><td>Data</td><td>".data_br($r->campo_old)."</td><td>".data_br($r->campo_new)."</td><td>".data_br($r->data_hora)."</td><td>".$usuario->get_nome($r->usuario_id)."</td></tr>";
            }
            echo "</table>";
         ?>
    <?php endif; ?>
</div>