<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
<!-- <script src="<?php base_url('/assets/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?php base_url('/assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">
     $(document).ready(function(){


        var content = $('#content');
        $('.link_eventos').click(function( e ){
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
                <span>Eventos</span>
            </h1>
            <div class="blocoEventos">
                <?php foreach($eventos as $info):?>
                    <div class="evento">
                        <a class='link_eventos' href="<?php echo base_url('home/descricao_eventos?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                            <img src="<?php echo base_url('/assets/arquivos/evetos/'.$info['arquivo'])?>" alt="">
                            <h3><?php echo $info['tituloPt']?></h3>
                            <span><?php echo 'HORÀRIO:'.date('d/m/Y', strtotime($info['dataInicio']))?></span>
                        </a>
                        <?php
                            $proximo = 4;
                            $anterior = -4;
                        ?>
                    </div>
                <?php 
                endforeach;

                    ?>
                    <a href="<?php echo base_url('/balneario-camboriu/eventos/p='.$p = $proximo);?>">Proximo</a>
                </div>
                <?php
                  
                    if(isset($_GET['p'])) {
                        $p = $_GET['p'];
                    }else{
                        $p = 0;
                    }
                
                    if($p >= 0) {
                        $anterior = $p - 4;
                        // $dados['anterior'] = $anterior;
                    }
                    if($p <= $count) {
                        $proxima = $p + 4;
                        // $dados['proxima'] = $proxima;
                    }
                    
                    if($anterior <= 0) {
                        $anterior = 0;
                    }
                    if($proxima >= $count){
                        $proxima = $count;
                    }
                    
                ?>

                <?php if($anterior > 0):?>
                    <a class='link_eventos' href="<?php echo base_url('/balneario-camboriu/eventos/?p='.$anterior);?>">Anterior</a>
                <?php endif?>

                <?php if($proxima+4 <= $count):?>
                    <a class='link_eventos paginacao' href="<?php echo base_url('/balneario-camboriu/eventos/?p='.$proxima);?>">Proximo</a>
                <?php endif?>
                
                <?= '<br>Total de Páginas: '. $paginas?>

                <?php foreach($banner_tipo2 as $info):?>
                    <a class='registra_click_publicidade' codPublicidade="<?= $info['cod'];?>" href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach;?>
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

