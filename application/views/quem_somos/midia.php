<script type="text/javascript">
    $(document).ready(function(){

        var content = $('#content');
        $('.link_contato').click(function( e ){
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
    });
</script>
<div class="container">
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>Comercial</span>
                </h1>
                <div class="blocoMidia">
                   <p>
                    Na era da informação - interatividade, agilidade e mobilidade estão presentes na rádio. A força desta mídia, indispensável e insubstituível, está justamente ligada à sua linguagem e tecnologia. A rádio é a única mídia que supera a audiência da televisão, tratando a prestação de serviço público como diferencial competitivo.
                    89% da população brasileira é ouvinte de rádio, tornando este veículo de indiscutível relevância, grande geradora de negócios.
                    </p>
                    <p>
                    Anuncie na rádio. Clique <a class='link_contato' href="<?php echo base_url($_SESSION['city'].'/contato')?>">aqui</a> e solicite mais informações.
                    </p>
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
                            $_SESSION['cod_banner'] = $bannerPrincipalCod;
                            ?>
                            <div class="wrapBanner">
                                <a class='registra_click_publicidade' href="<?=($bannerPrincipalLink != '') ? $bannerPrincipalLink  : '';?>" target="<?=$bannerPrincipalTarget;?>" rel="<?=$bannerPrincipalCod;?>">
                                    <img src=<?=base_url('/assets/arquivos/publicidade/'.$bannerPrincipalArquivo);?> title="Publicidade">
                                </a>
                            </div>
                            <?php 
                        }
                    echo '</div>';
                } 
                ?>
                
            </div> <!-- contRight -->

        
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
                $_SESSION['cod_banner'] = $bannerPrincipalCod;
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
