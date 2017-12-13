<div class='programacao'>
<div class='programacoes'>
    <h2>Ultimas noticias</h2><br>
    <div id='prog'>
        <?php foreach($jornalismo_impar as $info):?>
            <div id='esquerda'>
                <a href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']))?>">
                    <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                    <h3><?php echo $info['tituloPt']?></h3>
                    <p><?php echo $info['categoriaPt'] . ' ' . date('d/m/Y', strtotime($info['data']))?></p>
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