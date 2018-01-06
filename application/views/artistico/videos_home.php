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

            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
                
                <?php
                $nbanners = count($banner_tipo3);
                if($nbanners>0)
                {
                    echo '<div class="publicidade">';
                        $banners = array();
                        foreach($banner_tipo3 as $info):
                            $banners[] = array(
                                "cod" => isset($info['cod']) ? $info['cod'] : '',
                                "link" => isset($info['link']) ? $info['link'] : '',
                                "arquivo" => isset($info['arquivo']) ? $info['arquivo'] : '',
                                "linkTarget" => isset($info['linkTarget']) ? $info['linkTarget'] : '',
                            );
                        endforeach;
                        /*
                        echo "<pre>";
                            var_dump($banners);
                        echo "</pre>";
                        */
                        if($nbanners<4){
                            $numeroListagem = $nbanners;
                        }
                        else{
                            $numeroListagem = 4;
                        }
                        $rand_keys = array_rand($banners, $numeroListagem);
                        for($i=0;$i<2;$i++)
                        {
                            $bannerPrincipalCod = $banners[$rand_keys[$i]]['cod'];
                            $bannerPrincipalLink = $banners[$rand_keys[$i]]['link'];
                            $bannerPrincipalArquivo = $banners[$rand_keys[$i]]['arquivo'];
                            $bannerPrincipalTarget = $banners[$rand_keys[$i]]['linkTarget'];
                            ?>
                            <div class="wrapBanner">
                                <a class='registra_click_publicidade' href="<?=($bannerPrincipalLink != '') ? $bannerPrincipalLink  : '';?>" target="<?=$bannerPrincipalTarget;?>" rel="<?=$bannerPrincipalCod;?>">
                                    <img src=<?= base_url('/assets/arquivos/publicidade/'.$bannerPrincipalArquivo)?> title="Publicidade">
                                </a>
                            </div>
                            <?php 
                        }
                    echo '</div>';
                } 
                ?>
                <!--
                <h1 class="tituloPadrao3">
                    <span>Playlist Radio Menina</span>
                    aqui
                </h1>
                -->
                
            </div> <!-- contRight -->

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
              ?><br><br>
              <?php if($count > $total_registros):?>
                  <?php if($p > 1):?>
                      <a class='paginacao_videos' href="<?php echo base_url($_SESSION['city'].'/videos/?p=') .$anterior;?>">Anterior</a>
                  <?php endif?>

                  <?php if($pHome+10 <= $count):?>
                      <a class='paginacao_videos' href="<?php echo base_url($_SESSION['city'].'/videos/?p=') .$proxima;?>">Proximo</a>
                  <?php endif?>
              <?php endif;?>
              
              
              <?= '<br>Total de Páginas: '. $paginas?>
                 

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 
<div class="container">
    <div class="row publicidade">
        
        <?php
        if(count($banner_tipo2)>0)
        {
            $banners = array();
            foreach($banner_tipo2 as $info):
                $banners[] = array(
                    "cod" => isset($info['cod']) ? $info['cod'] : '',
                    "link" => isset($info['link']) ? $info['link'] : '',
                    "arquivo" => isset($info['arquivo']) ? $info['arquivo'] : '',
                    "linkTarget" => isset($info['linkTarget']) ? $info['linkTarget'] : '',
                );
            endforeach;
            /*
            echo "<pre>";
                var_dump($banners);
            echo "</pre>";
            */

            $rand_keys = array_rand($banners, 2);
            for($i=0;$i<2;$i++)
            {
                $bannerPrincipalCod = $banners[$rand_keys[$i]]['cod'];
                $bannerPrincipalLink = $banners[$rand_keys[$i]]['link'];
                $bannerPrincipalArquivo = $banners[$rand_keys[$i]]['arquivo'];
                $bannerPrincipalTarget = $banners[$rand_keys[$i]]['linkTarget'];
                ?>
                <div class="col-xs-12 col-md-6">
                    <div class="wrapBanner">
                        <a class='registra_click_publicidade' href="<?=($bannerPrincipalLink != '') ? $bannerPrincipalLink  : '';?>" target="<?=$bannerPrincipalTarget;?>" rel="<?=$bannerPrincipalCod;?>">
                            <img src=<?= base_url('/assets/arquivos/publicidade/'.$bannerPrincipalArquivo)?> title="Publicidade">
                        </a>
                    </div>
                </div> 
                <?php 
            }
        } 
        ?>
           
    </div>
</div> <!-- container -->

