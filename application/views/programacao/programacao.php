
<div class='programacao'>
<div class='programacoes'>
    <h2>Programações</h2>
    <div class='menu'>
        <a href="<?php echo base_url('home/programacao?programacao=Semanal')?>">SEMANAL</a>
        <a href="<?php echo base_url('home/programacao?programacao=Sabado')?>">SÁBADO</a>
        <a href="<?php echo base_url('home/programacao?programacao=Domingo')?>">DOMINGO<br><br></a>
    </div>
    <div id='prog'>
        <?php foreach($programacao_impar as $info):?>
            <div id='esquerda'>
            <a href="<?php echo base_url('home/descricao_programacao?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                <h1><?= 'ATENCÂO!!!!!'. $info['programacao']?></hi>
                <img src="<?php echo base_url('assets/arquivos/programacao/'.$info["arquivo"])?>" alt="">
                <h3><?php echo $info['titulo']?></h3>
                <p><?php echo $info['descricao']?></p>
                <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span>
                <p>------------------------------------------------------------</p>
            </a>
            </div>
        <?php endforeach?>

        <!-- <?php foreach($programacao_par as $info):?> -->
            <div id='direita'>
            <!-- <a href="<?php echo base_url('home/descricao_programacao?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                <h3><?php echo $info['titulo']?></h3>
                <p><?php echo $info['descricao']?></p>
                <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span> -->
            </div>
        <!-- <?php endforeach?> -->
    </div>
</div>

<div class='playlist'>
    <h2>playlist Radio Menina</h2>
</div>
</div><br><br><br>