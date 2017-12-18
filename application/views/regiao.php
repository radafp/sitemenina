<div class="container">

    <div class="row destaques">
        <?php foreach($titulo as $info):?>
            <div class="col-xs-6 col-md-4">
                <a href="#" class="">
                    <div class="">
                        <figure class="" style="background-image:url(<?php echo base_url('/assets/img/temp/001.jpg');?>);"></figure>
                    </div>
                    <div class="">
                        <h4 class="">Geral</h4>
                        <h3 class="">titulo da notícia</h3>
                    </div>
                </a>
            </div>
        <?php endforeach?>
    </div> <!-- row -->

    <div class="row outrasNoticias">
        <h1><span>Últimas novidades</span></h1>
        <?php foreach($outras_noticias as $info):?>
            <div class='col-xs-12 col-md-3 noticia'>
                <div class="categoria">
                    <span><?php echo $info['categoriaPt'];?></span>
                </div>
                <h2><?php echo $info['tituloPt'];?></h2>
                <p><?php echo date('d/m/Y', strtotime($info['data']));?></p>
            </div>
        <?php endforeach?>
    </div> <!-- row -->

</div> <!-- container -->

<!--
    <div class='noticias_principais'>
    <?php foreach($titulo as $info):?>
        <div class='turismo'>
        
            <h2><?php echo $info['tituloPt'];?></h2>
            <p><?php echo date('d/m/Y', strtotime($info['dataCadastro']));?></p>
        
        </div>
    <?php endforeach?>
</div><br><br><br>
-->

<div class='promocoes_eventos'>
    <div id='programacoes'>
        <h2>Promoções</h2>
        <img src="" alt="">
        <h3>Titulo Promoção</h3>
    </div>

    <div id='eventos'>
        <h2>Eventos</h2><br>
        <?php foreach($eventos as $info):?>
        <span><?php echo $info['mapa'];?></span> 
        <h3><?php echo $info['tituloPt']?></h3>
        <p><?php echo 'inicio: '. date('d/m/Y', strtotime($info['dataInicio']))?></p>
        <p>Fim: <?php echo date('d/m/Y', strtotime($info['dataFim']))?></p>
        <?php endforeach?>
    </div><br>
    
</div><br><br>

<div class='programacao_enquete'>
    <div id='programacao'>
        <h2>Programação</h2><br><br>
        <?php foreach($programacao as $info):?>
        <div id='programacao1'>
            <img src="<?php echo base_url('/assets/img/logoMeninaBC.png')?>" alt="">
            <h3><?php echo $info['cleanTitle']?></h3>
            <p><?php echo $info['programacao'].' '. $info['horario']?></p><br><br>
        </div>
        <?php endforeach?>
    </div>
    
    <div id='enquetes'>
        <h2>Enquetes</h2><br><br>
        <form action="/action_page.php">
            <input type="checkbox" name="vehicle" value="Bike"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.<br><br><br>
            <input type="checkbox" name="vehicle" value="Car" checked>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's<br><br><br>
            <input type="checkbox" name="vehicle" value="Car" checked>simply dummy text of theypesetting industry.he industry's<br><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    
    <div id='mensagem_dia'>
        <h2>Mensagem do dia</h2><br><br>
        <?php foreach($videos as $info):?>
        
        <iframe width="560" height="315" src="https://www.youtube.com/embed/fV67QiJnoqY" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
        <?php endforeach?>
    </div>
</div><br><br>