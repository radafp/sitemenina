<div class="container">  
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>TOP 10</span>
                </h1>
                <div>
                    <?php foreach($top_10 as $info):?>
                        <div id='esquerda' style="width:70%; float:left">
                            <h3><?php echo $info['titulo']?></h3>
                            <p>Artista<?//php echo $info['link']?></p>
                        </div>
                        <div id='direita' style="width:30%; float:right">
                           <img src="<?php echo base_url('/assets/img/play-top10.png')?>" title="">
                           <span style="display:block; float:left">Ouvir</span>
                        </div>
                    <?php endforeach?>
                </div>
                <?php foreach($banner_tipo2 as $info):?>
                    <a href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach?>

            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
                <?php foreach($banner_tipo3 as $info):?>
                    <a href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach?>
                Publicidade 
            </div> <!-- contRight -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 

