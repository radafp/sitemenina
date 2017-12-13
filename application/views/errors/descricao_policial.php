<div class='programacao'>
    <div class='programacoes'>
        <h2>descricao do Policial</h2><br>
        <div id='prog'>
            <?php foreach($descricao_noticia as $info):?>
            <div id='esquerda'>
                <p><?php echo $info['categoriaPt']. ' '. $info['data']. '<br><br>'?></p>
                    <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                    <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                    <p><?php echo $info['descricaoPt']?></p>
                </a> 
            </div>
            <?php endforeach?>
        </div>
    </div>

    <div class='playlist'><br><br>
        <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="" width='300'>
        <h2>As mais lidas</h2>
        <?php foreach($mais_lidas as $info):?>
                <div id='direita'>
                    <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                    <p><?php echo $info['categoriaPt']?></p>
                    <h3><?php echo $info['tituloPt']?></h3>
                </div>
            <?php endforeach?>
    </div>
</div><br><br><br>
<?php 