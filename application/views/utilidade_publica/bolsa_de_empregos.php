<script type="text/javascript">
     $(document).ready(function(){


        var content = $('#content');
        $('.paginacao_empregos, .link_descricao').click(function( e ){
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
                        if(href != 'http://www.novomenina.web7097.uni5.net/balneario-camboriu'){
                            $('html,body').animate({ scrollTop: $("#anc").offset().top },'slow');
                        }
                    },100);
                }
            });

            window.history.pushState(null, 'Home', $(this).attr('href'));
        });
        $(".registra_click_publicidade").click(function(e) {
        
            _obj = $(this);
            _codPublicidade = _obj.attr('rel');
            
            $.ajax(
            {
                type: "POST",
                async: false,
                url: "<?=base_url('/assets/ajax/publicidade.php');?>",
                data:
                {
                    cod: _codPublicidade
                },
                dataType: "json"
            })
            .done(function(_json)
            { 
                
            });
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
                            <a class="link_descricao" href="<?php echo base_url($_SESSION['city'].'/descricao-bolsa-de-empregos/'.$info['cod']);?>">
                                <div class="foto">
                                    <img src="<?php echo base_url('/assets/arquivos/empregos/'.$info['arquivo'])?>" alt="">
                                </div>
                                <h3><?php echo $info['titulo']?></h3>
                                <!-- <p><?php echo date_format($info['dataPublicacao'], 'd-m-Y')?></p> -->
                            </a>
                        </div>
                    <?php endforeach?>

                </div>   
                <div class="paginacao">
                    <?php
                    
                    if(isset($paginas)) {
                        $p = $paginas;
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
                            <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/') .$anterior;?>"><</a>
                        </div>
                        <div class='pagina'>
                            <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/') .$anterior;?>"><?=$anterior;?></a>
                        </div>    
                        <?php endif?>
                        <div class='pagina paginahover'>
                            <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/') .$p;?>"><?=$p;?></a>
                        </div>
                        
                        <?php if($pHome+10 <= $count):?>
                            <div class='pagina'>
                                <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/') .$proxima;?>"><?=$proxima;?></a>
                            </div>
                            <div class='pagina paginahover'>
                                <a class='paginacao_empregos' href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/') .$proxima;?>">></a>
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

    