<script type="text/javascript">
     $(document).ready(function(){

        var content = $('#content');
        $('.paginacao_noticias, .link_descricao').click(function( e ){
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
                    <span>Notícias</span>
                </h1>
                <div class="blocoNoticias">
                    <?php foreach($jornalismo as $info):?>
                    <div class="noticia">
                        <a class="link_descricao" href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']))?>">
                            <div class="foto">
                                <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo'])?>" alt="">
                            </div>
                            <h3><?php echo $info['tituloPt']?></h3>
                            <span class="categoria" style="background-color:#<?=$info['cor'];?>; color:<?=(isset($info['corTexto']) != '') ? $info['corTexto'] : '#ffffff';?>"><?=$info['categoriaPt'];?></span>
                            <p><?=date('d/m/Y', strtotime($info['data']));?></p>
                        </a>
                    </div> 
                    <?php endforeach?>    
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

                    <?php 
                    //  echo '<br>$$total_registros: '.$total_registros;

                    // echo '<br>categoria: '. $categoria;
                    // echo '<br>$pHome: '.$pHome;
                    // echo '<br>$count: '.$count . '<br>';
                    
                    ?>

                    <?php if($count > $total_registros):?>
                        <?php if($p > 1):?>
                        <div class='pagina paginahover'>
                            <a class='paginacao_noticias' href="<?php echo base_url($_SESSION['city'].'/noticias?categoria='.$categoria.'&p=' .$anterior);?>"><</a>
                        </div>
                        <div class='pagina'>
                            <a class='paginacao_noticias' href="<?php echo base_url($_SESSION['city'].'/noticias?categoria='.$categoria.'&p=' .$anterior);?>"><?=$anterior;?></a>
                        </div>    
                        <?php endif?>
                        
                        <div class='pagina paginahover'>
                            <a class='paginacao_noticias' href="<?php echo base_url($_SESSION['city'].'/noticias?categoria='.$categoria.'&p=') .$p;?>"><?=$p;?></a>
                        </div>
                        
                        <?php if($pHome+15 <= $count):?>
                            <div class='pagina'>
                                <a class='paginacao_noticias' href="<?php echo base_url($_SESSION['city'].'/noticias?categoria='.$categoria.'&p=' .$proxima);?>"><?=$proxima;?></a>
                            </div>
                            <div class='pagina paginahover'>
                                <a class='paginacao_noticias' href="<?php echo base_url($_SESSION['city'].'/noticias?categoria='.$categoria.'&p=' .$proxima);?>">></a>
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
                            if($numeroListagem == 1)
                            {  
                                $bannerPrincipalCod = $banners[$rand_keys]['cod'];
                                $bannerPrincipalLink = $banners[$rand_keys]['link'];
                                $bannerPrincipalArquivo = $banners[$rand_keys]['arquivo'];
                                $bannerPrincipalTarget = $banners[$rand_keys]['linkTarget'];
                            }else{
                                $bannerPrincipalCod = $banners[$rand_keys[$i]]['cod'];
                                $bannerPrincipalLink = $banners[$rand_keys[$i]]['link'];
                                $bannerPrincipalArquivo = $banners[$rand_keys[$i]]['arquivo'];
                                $bannerPrincipalTarget = $banners[$rand_keys[$i]]['linkTarget'];
                            }
                            $_SESSION['cod_banner'] = $bannerPrincipalCod;
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
                <div class="blocoMaisLidas">
                    <h1 class="tituloPadrao3">
                        <span>As mais lidas</span>
                    </h1>
                    <?php foreach($mais_lidas as $info):?>
                    <div class="noticia">
                        <a class="link_descricao" href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']))?>">
                            <div class="foto">
                                <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo'])?>" alt="">
                            </div>
                            <span class="categoria" style="background-color:#<?=$info['cor'];?>; color:<?=(isset($info['corTexto']) != '') ? $info['corTexto'] : '#ffffff';?>"><?=$info['categoriaPt'];?></span>
                            <h3><?php echo $info['tituloPt']?></h3>
                        </a> 
                    </div>
                    <?php endforeach?> 
                </div>

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

