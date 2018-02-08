<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript">
    $(document).ready(function(){

        var content = $('#content');
        $('.link_descricao').click(function( e ){
            e.preventDefault();

            // var href = $( this ).attr('href');
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
                    <span>Notícias</span>
                </h1>

                <div class='blocoNoticiaDescricao'> 
                    
                    <?php foreach($descricao_noticia as $info):?>
        
                        <div class="headDescNoticia">
                            <span class="categoria" style="background-color:#<?=$info['cor'];?>; color:<?=(isset($info['corTexto']) != '') ? $info['corTexto'] : '#ffffff';?>"><?=$info['categoriaPt'];?></span>
                            <p><?=date('d/m/Y', strtotime($info['data']));?></p>
                        </div>
                        <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                        <div class="foto">
                            <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo']);?>" alt="">
                        </div>
                        <p><?php echo $info['descricaoPt']?></p>

                    <?php endforeach?>

                    <?php
                    switch($_SESSION['regiao']){
                        case 'bc':
                            $linkPluginFace = 'https://www.facebook.com/radiomeninabc';
                            break;
                        case 'bl':
                            $linkPluginFace = 'https://www.facebook.com/radiomeninablu';
                            break;
                        case 'lg':
                            $linkPluginFace = 'https://www.facebook.com/meninafmlages'; 
                            break;
                    }
                    ?>

                    <!-- <div class="fb-comments" data-href="<?=$linkPluginFace;?>" data-numposts="4"  data-width="100%"></div> -->

                </div>
                
            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
            <?php $nbanner_tipo3 = count($banner_tipo3); ?>   
            <?php if($nbanner_tipo3 >0) :?>
            <?PHP $cod = array();?>
            <?php foreach($banner_tipo3 as $key=>$info):?>
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
                    <?php
                    /* 
                        if($nbanner_tipo3  >= 2):
                            if($key==1):
                            ?>
                                <div class="blocoMaisLidas">
                                    <h1 class="tituloPadrao3">
                                        <span>As mais lidas</span>
                                    </h1>
                                    <?php foreach($mais_lidas as $info):?>
                                    <div class="noticia">
                                        <a class="link_descricao" href="<?php echo base_url($_SESSION['city'].'/descricao_noticia/'.$info['categoria'].'/'.$info['cleanTitlePt'])?>">
                                            <div class="foto">
                                                <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo'])?>" alt="">
                                            </div>
                                            <span class="categoria" style="background-color:#<?=$info['cor'];?>; color:<?=(isset($info['corTexto']) != '') ? $info['corTexto'] : '#ffffff';?>"><?=$info['categoriaPt'];?></span>
                                            <h3><?php echo $info['tituloPt']?></h3>
                                        </a> 
                                    </div>
                                    <?php endforeach?> 
                                </div>
                            <?php
                            endif;
                        endif;
                        */
                    ?>
                <?php endforeach;
                //echo count($banner_tipo3);
                /*if($nbanner_tipo3 <2):
                ?>
                <div class="blocoMaisLidas">
                    <h1 class="tituloPadrao3">
                        <span>As mais lidas</span>
                    </h1>
                    <?php foreach($mais_lidas as $info):?>
                    <div class="noticia">
                        <a class="link_descricao" href="<?php echo base_url($_SESSION['city'].'/descricao_noticia/'.$info['categoria'].'/'.$info['cleanTitlePt'])?>">
                            <div class="foto">
                                <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo'])?>" alt="">
                            </div>
                            <span class="categoria" style="background-color:#<?=$info['cor'];?>; color:<?=(isset($info['corTexto']) != '') ? $info['corTexto'] : '#ffffff';?>"><?=$info['categoriaPt'];?></span>
                            <h3><?php echo $info['tituloPt']?></h3>
                        </a> 
                    </div>
                    <?php endforeach?> 
                </div>
                <?php
                endif;
                */
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
    
    