<div class='programacao'>
<div class='programacoes'>
    <h2>Descrição da Promoção</h2><br>
    <div id='prog'>
        <?php foreach($descricao_promocoes as $info):?>
        <div id='esquerda'><br>
            <h3><?php echo $info['tituloPt'].'<br>'?></h3>
            <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
            <p><?php echo 'Início: '. date('d/m/Y', strtotime($info['dataInicio'])). '<br>' . $info['descricaoPt'].'<br>'?></p>
        </div>
        <?php endforeach?>
    </div>
</div>

</div><br><br><br>
<?php 