<script type="text/javascript">
     $(document).ready(function(){

        var content = $('#content');
        $('.paginacao_videos').click(function( e ){
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

            window.history.pushState(null, 'Home', $(this).attr('href'));
        });
    });
</script>
<div class="container">
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>Videos</span>
                </h1>
                <div class="blocoVideos">

                    <?php
                    $nVideos = count($videos_videos);
                    $i=0;
                    ?>

                    <?php foreach($videos_videos as $info):?>
                    <?php
                        
                        if($i%2 == 0) {
                            $classeAdicional = '';
                        }else{
                            $classeAdicional = ' ultimo';
                        }
                    ?>
                    <div class="video <?=$classeAdicional;?>">
                    
                    <?php
                        $codVideo = explode('=',$info['link']);
                        if($codVideo[1] != ''):  
                            $imagemCapa = '';                
                            $output = array();
                            $url = $info['link'];
                            preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $output);
                            $imagemCapa = 'https://img.youtube.com/vi/' . $output[0] . '/0.jpg';
                        ?>
                        <a href="https://www.youtube.com/embed/<?=$codVideo[1];?>" data-toggle="lightbox" data-width="695" data-height="440">
                            <img src="<?=$imagemCapa;?>" style="max-width:100%">  
                            <div class="btPlayYoutube">
                                <img src="<?php echo base_url('/assets/img/playYoutube.png');?>">
                            </div>
                        </a> 
                        <?php endif ?>
                        <p><?php echo $info["titulo"];?></p>
                        </div>
                    <?php 
                    $i++;
                    endforeach; 
                    ?> 
                </div>
                <div class="paginacao">
                    <?php
                    
                    if(isset($_GET['p'])) {
                        $p = $_GET['p'];
                    }else{
                        $p = 0;
                    }

                    $_SESSION['p'] = 0;
                    if($p >= 0) {
                        $anterior = $p - 1;
                        $_SESSION['p'] = $anterior;
                    }
                    if($p <= $count) {
                        $proxima = $p + 1;
                        $_SESSION['p'] = $proxima;
                    }
                    
                    if($anterior <= 0) {
                        $anterior = 0;
                    }
                    if(isset($proxima) && $proxima >= $count){
                        $proxima = $count;
                    }
                    ?>
                    <?php if($count > $total_registros):?>
                        <?php if($p > 1):?>
                        <div class='pagina paginahover'>
                            <a class='paginacao_videos' href="<?php echo base_url($_SESSION['city'].'/videos/?p=') .$anterior;?>"><</a>
                        </div>
                        <div class='pagina'>
                            <a class='paginacao_videos' href="<?php echo base_url($_SESSION['city'].'/videos/?p=') .$anterior;?>"><?=$anterior;?></a>
                        </div>    
                        <?php endif?>
                        <div class='pagina paginahover'>
                            <a class='paginacao_videos' href="<?php echo base_url($_SESSION['city'].'/videos/?p=') .$p;?>"><?=$p;?></a>
                        </div>
                        
                        <?php if($pHome+10 <= $count):?>
                            <div class='pagina'>
                                <a class='paginacao_videos' href="<?php echo base_url($_SESSION['city'].'/videos/?p=') .$proxima;?>"><?=$proxima;?></a>
                            </div>
                            <div class='pagina paginahover'>
                                <a class='paginacao_videos' href="<?php echo base_url($_SESSION['city'].'/videos/?p=') .$proxima;?>">></a>
                            </div>
                        <?php endif?>
                    <?php endif;?>
                </div>

            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
                
            <?php if(count($banner_tipo3)>0) :?>
            <?PHP $cod = array();?>
            <?php foreach($banner_tipo3 as $info):?>
                    <?php array_push($cod, $info['cod']); ?>
                    <div class="wrapBanner">
                        <?php if($info['link'] != ''): ?>
                            <a class='registra_click_publicidade' href="<?=($info['link'] != '') ? $info['link']  : '';?>" target="<?=$info['linkTarget'];?>" rel="<?=$info['cod'];?>">
                        <?php endif; ?>
                                <img src="<?=base_url('/assets/arquivos/publicidade/'.$info['arquivo']);?>" title="Publicidade">
                        <?php if($info['link'] != ''): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach;
                    // var_dump($cod);
                switch(count($cod)) {
                    case 4:
                        $_SESSION['cod_banner_tipo3_1'] = $cod[0]; 
                        $_SESSION['cod_banner_tipo3_2'] = $cod[1];
                        $_SESSION['cod_banner_tipo3_3'] = $cod[2]; 
                        $_SESSION['cod_banner_tipo3_4'] = $cod[3];
                        break;
                    case 3:
                        $_SESSION['cod_banner_tipo3_1'] = $cod[0]; 
                        $_SESSION['cod_banner_tipo3_2'] = $cod[1];
                        $_SESSION['cod_banner_tipo3_3'] = $cod[2]; 
                        break;
                    case 2:
                        $_SESSION['cod_banner_tipo3_1'] = $cod[0]; 
                        $_SESSION['cod_banner_tipo3_2'] = $cod[1];
                        break;
                    case 1:
                        $_SESSION['cod_banner_tipo3_1'] = $cod[0]; 
                        break;
                }endif;?>
            </div> <!-- contRight -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 
<div class="container">
    <div class="row publicidade">
        
    <?php if(count($banner_tipo2)>0) :?>
        <?PHP $cod = array();?>
        <?php foreach($banner_tipo2 as $info):?>
            <?php array_push($cod, $info['cod']); ?>
            <div class="wrapBanner">
            <?php if($info['link'] != ''): ?>
                <a class='registra_click_publicidade' href="<?=($info['link'] != '') ? $info['link']  : '';?>" target="<?=$info['linkTarget'];?>" rel="<?=$info['cod'];?>">
            <?php endif; ?>
                    <img src="<?=base_url('/assets/arquivos/publicidade/'.$info['arquivo']);?>" title="Publicidade">
            <?php if($info['link'] != ''): ?>
                </a>
            <?php endif; ?>
            </div>
        <?php  endforeach;?> 
        <?php 
            // var_dump($cod);
            if(count($cod) > 1) {
                $_SESSION['cod_banner_tipo2_1'] = $cod[0]; 
                $_SESSION['cod_banner_tipo2_2'] = $cod[1];
            }else{
                $_SESSION['cod_banner_tipo2_1'] = $cod[0]; 
            }
           
        ?>
    <?php endif; ?> 
    </div>
</div> <!-- container -->

