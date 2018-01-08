<script type="text/javascript">
     $(document).ready(function(){


        var content = $('#content');
        $('.paginacao_empregos').click(function( e ){
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
                    <span>Bolsa de empregos</span>
                </h1>

                <div class="blocoBolsaDeEmpregos">

                    <?php foreach($empregos as $info):?>
                        <div class='bolsaDeEmpregos'>
                            <div class="foto">
                                <img src="<?php echo base_url('/assets/arquivos/empregos/'.$info['arquivo'])?>" alt="">
                            </div>
                            <h3><?php echo $info['descricao']?></h3>
                            <p><?php echo $info['telefone']?></p>
                        </div>
                    <?php endforeach?>

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
                    <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/?p=').$anterior;?>">Anterior</a>
                    <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/?p=').$anterior;?>"><?=$anterior;?></a>
                <?php endif?>

                <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/?p=') .$p;?>"><?=$p;?></a>

                <?php if($pHome+10 <= $count):?>
                    <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/?p=').$proxima;?>"><?=$proxima;?></a>
                    <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/?p=').$proxima;?>">Proximo</a>
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

    