<div class='programacao'>
    <div class='programacoes'>
        <h2>Descrição da Notícia</h2><br>
        <div id='prog'>
            <?php foreach($descricao_evento as $info):?>
            <div id='esquerda'>
                <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                <p><?php echo 'Início: '. date('d/m/Y', strtotime($info['dataInicio'])). '<br>' . $info['descricaoPt'].'<br>'.$info['mapa']?></p>
            </div>
            <?php endforeach?>
        </div>
    </div>

</div><br><br><br>
<?php 