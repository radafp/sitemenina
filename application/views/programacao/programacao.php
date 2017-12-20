
<div class='programacao'>
<div class='programacoes'>
    <h2>Programações</h2>
    <button>SEMANAL</button>
    <button>SÁBADO</button>
    <button>DOMINGO</button><br><br>
    <div id='prog'>
        <?php foreach($programacao_impar as $info):?>
            <div id='esquerda'>
            <a href="<?php echo base_url('home/descricao_programacao?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                <img src="<?php echo base_url('assets/arquivos/programacao/'.$info["arquivo"])?>" alt="">
                <h3><?php echo $info['titulo']?></h3>
                <p><?php echo $info['descricao']?></p>
                <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span>
            </a>
            </div>
        <?php endforeach?>

        <?php foreach($programacao_par as $info):?>
            <div id='direita'>
            <!-- <img src="<?php echo base_url('/assets/arquivos/programacao/'.$info['arguivo'])?>" alt=""> -->
                <h3><?php echo $info['titulo']?></h3>
                <p><?php echo $info['descricao']?></p>
                <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span>
            </div>
        <?php endforeach?>
    </div>
</div>

<div class='playlist'>
    <h2>playlist Radio Menina</h2>
</div>
</div><br><br><br>