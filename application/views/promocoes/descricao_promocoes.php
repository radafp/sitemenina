<div class="container">
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>Promoções</span>
                </h1>
                <div id='prog'>
                    <?php foreach($descricao_promocoes as $info):?>
                    <div id='esquerda'><br>
                        <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                        <p><?php echo $info['descricaoPt']?></p>
                        <p><?php echo 'Início: '. date('d/m/Y', strtotime($info['dataInicio'])). '<br>' . $info['descricaoPt'].'<br>'?></p>
                        <button>REGULAMENTO</button>
                        <BUtton>QUERO PARTICIPAR</BUtton>
                    </div>
                    <?php endforeach?>
                </div>
                <?php foreach($banner_tipo2 as $info):?>
                    <a class='registra_click_publicidade' codPublicidade="<?= $info['cod'];?>" href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach?>
            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
                <?php foreach($banner_tipo3 as $info):?>
                    <a class='registra_click_publicidade' codPublicidade="<?= $info['cod'];?>" href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach?>
                Publicidade 
            </div> <!-- contRight -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 