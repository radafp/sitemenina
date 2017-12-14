<div class='programacao'>
    <div class='programacoes'>
        <h2>Eventos</h2><br>
        <div id='prog'>
            <?php foreach($evento_impar as $info):?>
                <div id='esquerda'>
                    <a href="<?php echo base_url('home/descricao_evento?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                        <br><br><img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                        <h3><?php echo $info['tituloPt']?></h3>
                        <p><?php echo $info['descricaoPt']?></p>
                        <span><?php echo 'HORÀRIO:'.$info['dataInicio']?></span>
                    </a> 
                </div>
            <?php endforeach?>
        </div>
    </div>
    <div id='direita' >
                    <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                </div>
    <div id='comentario'>
        
    </div>
</div><br><br><br>
