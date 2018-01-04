<div class="container">
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>Programação</span>
                </h1>
                <div class="blocoProgramacaoDescricao">
                    
                    <?php foreach($descricao_programacao as $info):?>
                        <div id='esquerda'>
                            <div class="foto">
                                <img src="<?php echo base_url('assets/arquivos/programacao/'.$info["arquivo"])?>" alt="">
                            </div>
                            <h3><?php echo $info['titulo']?></h3>
                            <p><?php echo $info['descricao']?></p>
                            <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span>
                        </div>
                    <?php endforeach?>
                    <?php foreach($banner_tipo2 as $info):?>
                        <a href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                    <?php endforeach?>
                </div>

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