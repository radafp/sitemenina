<script type="text/javascript">
     $(document).ready(function(){


        var content = $('#content');
        $('.paginacao_promocoes, .link_descricao').click(function( e ){
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
                    <span>Promoções</span>
                </h1>
                <div class='blocoPromocoes'>
                    <?php 
                    $nPromos = count($promocoes_promocoes);
                    $i=0;
                    foreach($promocoes_promocoes as $info):
                        if($i%2 == 0)
                            $classeAdicional = '';
                        else
                            $classeAdicional = ' ultimo';
                        ?>
                            <div class="promocao <?=$classeAdicional;?>">
                                <a class='link_descricao' href="<?php echo base_url('home/descricao_promocoes?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                                    <div class="foto">
                                        <img src="<?php echo base_url('assets/arquivos/promocoes/'.$info["arquivo"])?>" alt="" width='680px'>
                                    </div>
                                    <h3><?php echo $info['tituloPt']?></h3>
                                    <span><?php echo 'Início: '.date('d/m/Y', strtotime($info['dataInicio'])). "<br>Fim: ". date('d/m/Y', strtotime($info['dataFim']))?></span>
                                    <!--<button>Participar</button>-->
                                </a>
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
                            <a class='paginacao_promocoes' href="<?php echo base_url($_SESSION['city'].'/promocoes/?p=') .$anterior;?>"><</a>
                        </div>
                        <div class='pagina'>
                            <a class='paginacao_promocoes' href="<?php echo base_url($_SESSION['city'].'/promocoes/?p=') .$anterior;?>"><?=$anterior;?></a>
                        </div>    
                        <?php endif?>
                        <div class='pagina paginahover'>
                            <a class='paginacao_promocoes' href="<?php echo base_url($_SESSION['city'].'/promocoes/?p=') .$p;?>"><?=$p;?></a>
                        </div>
                        
                        <?php if($pHome+10 <= $count):?>
                            <div class='pagina'>
                                <a class='paginacao_promocoes' href="<?php echo base_url($_SESSION['city'].'/promocoes/?p=') .$proxima;?>"><?=$proxima;?></a>
                            </div>
                            <div class='pagina paginahover'>
                                <a class='paginacao_promocoes' href="<?php echo base_url($_SESSION['city'].'/promocoes/?p=') .$proxima;?>">></a>
                            </div>
                        <?php endif?>
                    <?php endif;?>
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
