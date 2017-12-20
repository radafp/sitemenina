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
        <?php endforeach?>n
    </div> <!-- row -->

    <div class="row outrasNoticias">
        <h1><span>Últimas novidades</span></h1>
        <?php foreach($ultimas_noticias as $info):?>
        <div class='col-xs-12 col-md-3 noticia'>
            <div class="categoria">
            <a href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']))?>">
                <span><?php echo $info['categoriaPt'];?></span>
            </div>
        <?php endforeach?>
    </div> <!-- row -->

</div> <!-- container -->
<!-- <?php var_dump($promocoes)?> -->
<div class='promocoes_eventos'>
    <div id='programacoes'>
        <h2>Promoções</h2>
        <a href="/home/promocoes">Ver mais</a>
        <?php foreach($promocoes_home as $info):?>
        <a href="<?php echo base_url('home/descricao_promocoes?id='.$info['cod'])?>">
            <img src="<?php echo base_url('/assets/arquivos/programacao/'.$info['arquivo'])?>" alt="">
            <h3><?php echo $info['tituloPt']?></h3>
            <p><?php echo 'inicio: '. date('d/m/Y', strtotime($info['dataInicio']))?></p>
            <p>Fim: <?php echo date('d/m/Y', strtotime($info['dataFim']))?></p>
        </a>
        <?php endforeach?>

        
    </div>

    <div id='eventos'>
        <h2>Eventos</h2><br>
        <a href="/home/eventos">Ver mais</a>
        <?php foreach($eventos_home as $info):?>
            <a href="<?php echo base_url('home/descricao_eventos?id='.$info['cod'])?>">
                <img src="<?php echo base_url('/assets/arquivos/eventos/'.$info['arquivo'])?>" alt="">
                <span><?php echo $info['mapa'];?></span> 
                <h3><?php echo $info['tituloPt']?></h3>
                <p><?php echo 'inicio: '. date('d/m/Y', strtotime($info['dataInicio']))?></p>
                <p>Fim: <?php echo date('d/m/Y', strtotime($info['dataFim']))?></p>
            </a>
        <?php endforeach?>
    </div><br>
    
</div><br><br>

<div class='programacao_enquete'>
    <div id='programacao'>
        <h2>Programação</h2><br><br>
        <a href="/home/programacao">Ver mais</a>
        <?php foreach($programacao_home as $info):?>
            <a href="<?php echo base_url('home/descricao_programacao?id='.$info['cod'])?>">
                <div id='programacao1'>
                    <img src="<?php echo base_url('/assets/arquivos/programacao/'.$info['arquivo'])?>" alt="">
                    <h3><?php echo $info['cleanTitle']?></h3>
                    <p><?php echo $info['programacao'].' '. $info['horario']?></p><br><br>
                </div>
            </a>
        <?php endforeach?>
        </
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