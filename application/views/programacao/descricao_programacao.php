<div class='programacao'>
    <div class='programacoes'>
        <h2>Descrição da Notícia</h2><br>
        <div id='prog'>
            <?php foreach($descricao_programacao as $info):?>
            <div id='esquerda'>
                <img src="<?php echo base_url('assets/arquivos/programacao/'.$info["arquivo"])?>" alt="">
                <h3><?php echo $info['titulo']?></h3>
                <p><?php echo $info['descricao']?></p>
                <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span>
            </div>
            <?php endforeach?>
        </div>
    </div>

</div><br><br><br>
<?php 