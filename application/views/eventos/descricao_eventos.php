<div class='programacao'>
    <div class='programacoes'>
        <h2>Descrição da Notícia</h2><br>
        <div id='prog'>
            <?php foreach($descricao_eventos as $info):?>
            <div id='esquerda'>
                <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                <p><?php echo 'Início: '. date('d/m/Y', strtotime($info['dataInicio'])). '<br>' . $info['descricaoPt'].'<br>'.$info['mapa']?></p>
            </div>
            <?php endforeach?>
        </div>
    </div>

</div><br><br><br>
<?php 