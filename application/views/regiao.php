<div class="container">
    <div class="row destaques">
        <?php 
        $x=0; 
        foreach($noticias_em_destaque as $info):
            $x = $x+1;
            if($x==1){
                $classe = "noticiaPrincipal";
                $classeInf = "infPrincipal"; 
            }else{ 
                $classe = "noticia";
                $classeInf = "inf";
            }
            if($x==1){ echo'<div class="col-xs-12 col-md-8 destaquePrincipal">';}
            if($x==2){ echo'<div class="col-xs-12 col-md-4 destaque">';} 
            ?>
            <div class="<?=$classe;?> <?=$x==3 ? 'ultima' : '';?>" style="background: url(<?=base_url('/assets/arquivos/noticias/'.$info['arquivo']);?>) no-repeat center center; background-size: 100%;">
                
                <a class="link_descricao" href="<?=base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']));?>">
                    <div class="fundoFoto">
                        <div class="<?=$classeInf;?>" >
                            <h3><?=$info['tituloPt'];?></h3>
                            <h1 class="categoria" style="background-color: #<?=$info['cor'];?>; color: <?=isset($info['corTexto']) != '' ? $info['corTexto'] : '#ffffff';?>"><?=$info['categoriaPt'];?></h1>
                            <p><?= date('d/m/Y', strtotime($info['data']));?></p>
                        </div>
                    </div> 
                </a>

            </div>
            <?php 
            if($x==1) {echo'</div>';}
            if($x==3) {echo'</div>';} 
        endforeach;
        ?>
    </div> <!-- row -->

    <div class="row outrasNoticias">
        <h1 class="tituloPadrao1">
            <span>Últimas novidades</span>
        </h1>
        <?php foreach($ultimas_noticias as $info):?>

            <div class='col-xs-12 col-md-4 noticia'>
                <a class="link_descricao" href="<?=base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']));?>">
                    <div class="wrapCategoria">
                        <span class="categoria" style="background-color:#<?=$info['cor'];?>; color:<?=isset($info['corTexto']) != '' ? $info['corTexto'] : '#ffffff';?>"><?=$info['categoriaPt'];?></span>
                    </div>
                    <h2><?=$info['tituloPt'];?></h2>
                    <p><?=$info['subtitulo'];?></p>
                    <p class="dataNoticia"><?=date('d/m/Y', strtotime($info['data']));?></p>
                </a>
            </div>

        <?php endforeach; ?>
    </div> <!-- row -->

</div> <!-- container -->

<div class="container">
    <div class="row publicidade">
        <img src="<?=base_url('/assets/img/temp/banner_home1.jpg');?>" title="Publicidade">       
    </div>
</div> <!-- container -->

<div class="promocoesEventos promocoesEventos_<?=$_SESSION['regiao'];?>">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                
                <h1 class="tituloPadrao2">
                    <span>Promoções</span>
                </h1>
                <?php foreach($promocoes_home as $info): ?>
                <div class='promocaoEvento'>
                    <a class="link_descricao" href="<?=base_url('home/descricao_promocoes?id='.$info['cod']);?>">
                        <? if($info['arquivo']!='') { ?>
                            <div class="wrapFoto">
                                <div class="foto">
                                    <img src="<?=base_url('/assets/arquivos/promocoes/'.$info['arquivo']);?>" alt="">
                                </div>
                            </div>
                        <? } ?>    
                        <h3><?=$info['tituloPt']?></h3>
                        <?=isset($info['dataInicio']) ? '<p>Inicio: '. date('d/m/Y', strtotime($info['dataInicio'])).'</p>' : '';?>
                        <?=isset($info['dataFim']) ? '<p>Fim: '. date('d/m/Y', strtotime($info['dataFim'])).'</p>' : '';?>
                    </a>
                </div>
                <?php endforeach; ?>
                <a href="/home/promocoes">Ver mais promoções</a>
                
            </div>
            <div class="col-xs-12 col-md-6">
                <h1 class="tituloPadrao2">
                    <span>Eventos</span>
                </h1>
                <?php foreach($eventos_home as $info): ?>
                <div class='promocaoEvento'>
                    <a class="link_descricao" href="<?=base_url('home/descricao_eventos?id='.$info['cod']);?>">
                        <? if($info['arquivo']!=''){ ?>
                            <div class="wrapFoto">
                                <div class="foto">
                                    <img src="<?=base_url('/assets/arquivos/eventos/'.$info['arquivo']);?>" alt="">
                                </div>
                            </div>
                        <? } ?> 
                        <h3><?=$info['tituloPt'];?></h3>
                        <?=isset($info['dataInicio']) ? '<p>Inicio: '. date('d/m/Y', strtotime($info['dataInicio'])).'</p>' : '';?>
                        <?=isset($info['dataFim']) ? '<p>Fim: '. date('d/m/Y', strtotime($info['dataFim'])).'</p>' : '';?>
                    </a>
                </div>
                <?php endforeach; ?>
                <a href="/home/eventos">Ver mais eventos</a>
            </div>

        </div> <!-- row -->
    </div> <!-- container -->

</div> <!-- promoções e eventos --> 

<div class="container">
    <div class="row publicidade">
        <div class="col-xs-12 col-md-6">
            <img src="<?=base_url('/assets/img/temp/banner_home2.jpg');?>" title="Publicidade">  
        </div>    
        <div class="col-xs-12 col-md-6">
            <img src="<?=base_url('/assets/img/temp/banner_home2.jpg');?>" title="Publicidade">  
        </div>
    </div>
</div> <!-- container -->

<div class="container progEnqMsg">
    <div class="row">
            <div class='col-xs-12 col-md-4'>
                <h1 class="tituloPadrao3">
                    <span>Programação</span>
                </h1>
                <div class="wrapProgramacao">
                    <?php foreach($programacao_home as $info):?>
                    <a class='link_programacao' href="<?php echo base_url('home/descricao_programacao?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                            <div class='programacao'>
                                <div class="foto">
                                    <img src="<?php echo base_url('/assets/arquivos/programacao/'.$info['arquivo'])?>" alt="">
                                </div>    
                                <h3><?php echo $info['cleanTitle']?></h3>
                                <p><?php echo $info['programacao'].' '. $info['horario']?></p><br><br>
                            </div>
                        </a>
                    <?php endforeach;?> 
                </div>
                <a href="/home/programacao">Ver mais</a>
            </div>
            <div class='col-xs-12 col-md-4'>
                <h1 class="tituloPadrao3">
                    <span>Enquete</span>
                </h1>
                <form action="/action_page.php">
                    <input type="checkbox" name="vehicle" value="Bike"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.<br><br><br>
                    <input type="checkbox" name="vehicle" value="Car" checked>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's<br><br><br>
                    <input type="checkbox" name="vehicle" value="Car" checked>simply dummy text of theypesetting industry.he industry's<br><br><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
            <div class='col-xs-12 col-md-4'>
                <h1 class="tituloPadrao3">
                    <span>Mensagem do Dia</span>
                </h1>
                <?php foreach($videos as $info):?>
                    <iframe style="width: 100%; max-height:250px" src="https://www.youtube.com/embed/fV67QiJnoqY" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                <?php endforeach?>
            </div>
    </div> <!-- row -->

</div> <!-- container -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        var content = $('#content');

        $('.link_descricao').click(function( e ){
            e.preventDefault();

            var href = $( this ).attr('href');
            $.ajax({
                url: href,
                success: function( response ){
                    //forçando o parser
                    var data = $( '<div>'+response+'</div>' ).find('#content').html();

                    //apenas atrasando a troca, para mostrarmos o loading
                    window.setTimeout( function(){
                        content.fadeOut('fast', function(){
                            content.html( data ).fadeIn();
                        });
                    },100);
                }
            });

        });
    })
</script> 