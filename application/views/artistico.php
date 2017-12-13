<div class='programacao'>
    <div class='programacoes'>
        <h2>Top 10</h2>
        <div id='prog'>
            <?php foreach($programacao_impar as $info):?>
                <div id='esquerda'>
                    <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                    <h3><?php echo $info['titulo']?></h3>
                    <p><?php echo $info['descricao']?></p>
                    <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span>
                </div>
            <?php endforeach?>

            <?php foreach($programacao_par as $info):?>
                <div id='direita'>
                    <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                    <h3><?php echo $info['titulo']?></h3>
                    <p><?php echo $info['descricao']?></p>
                    <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span>
                </div>
            <?php endforeach?>
        </div>
    </div>

</div><br><br><br>