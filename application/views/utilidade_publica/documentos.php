<div class='programacao'>
    <div class='programacoes'>
        <h2>Empregos</h2><br><br>
        <div id='prog'>
            <?php foreach($documentos_impar as $info):?>
                <div id='esquerda'>
                <a href="<?php echo base_url('home/descricao_utilidade?id='.$info['cod'].'&regiao='.strtolower($info['regiao'])).'&categoria='.$info['categoria']?>">
                    <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="" width='680px'>
                    <h3><?php echo $info['tituloPt']?></h3>
                    <!-- <p><?php echo $info['descricao']?></p> -->
                    <span><?php echo 'Início:'.$info['dataInicio']. "<br>Fim:". $info['dataFim']?></span><br>
                </div>
            <?php endforeach?>
        </div>
    </div>

</div><br><br><br>