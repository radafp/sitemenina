<div class='programacao'>
    <div class='programacoes'>
        <h2>Descrição da Eventoso</h2><br>
        <div id='prog'>
            <?php foreach($descricao_eventos as $info):?>
                <div id='esquerda'><br>
                    <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                    <p><?php echo $info['descricaoPt']?></p>
                    <p><?php echo 'Início: '. date('d/m/Y', strtotime($info['dataInicio']))?></p>
                    <button>REGULAMENTO</button>
                    <BUtton>QUERO PARTICIPAR</BUtton>
                </div>
            <?php endforeach?>
        </div>
    </div>

</div><br><br><br>
<?php 

// echo '<pre>';
// var_dump($descricao_eventos);
// echo '</pre>';