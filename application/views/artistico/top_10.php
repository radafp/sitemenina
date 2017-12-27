<div class='programacao'>
    <div class='programacoes'>
        <h2>TOP 10</h2><br><br>
        <div id='prog'>
            <?php foreach($top_10 as $info):?>
                <div id='esquerda'>
                    <h3><?php echo $info['titulo']?></h3>
                    <p><?php echo $info['link']?></p>
                    <!-- <span><?php echo 'Início:'.$info['dataInicio']. "<br>Fim:". $info['dataFim']?></span><br> -->
                </div>
            <?php endforeach?>
        </div>
    </div>

</div><br><br><br>