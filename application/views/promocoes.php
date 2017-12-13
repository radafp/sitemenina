<div class='programacao'>
    <div class='programacoes'>
        <h2>Promoções</h2>
        <div id='prog'>
            <?php foreach($promocoes_impar as $info):?>
                <div id='esquerda'>
                    <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                    <h3><?php echo $info['tituloPt']?></h3>
                    <p><?php echo $info['descricao']?></p>
                    <span><?php echo 'Início:'.$info['dataInicio']. "<br>Fim:". $info['dataFim']?></span>
                    <button>Participar</button>
                </div>
            <?php endforeach?>

            <?php foreach($programacao_par as $info):?>
                <div id='direita'>
                    
                </div>
            <?php endforeach?>
        </div>
    </div>

    <div id='comentario'>
        <form action="">
        <img src="<?php echo base_url('/assets/img/avatar.jpg')?>" alt="" width='40'>
        <textarea name="comentario" id="comentario" cols="40" rows="3" placeholder='Add a comment...'></textarea>
        </form>
        
        
    </div>
</div><br><br><br>