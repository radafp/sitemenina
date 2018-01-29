<div class="container">  
    <div class="blocoConteudo"> 
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>TOP 10</span>
                </h1>
                <div class="blocoTop10">

                    <?php 
                    if(count($top_10)>0):
                        foreach($top_10 as $info): ?>
                            <div class="top10">
                                <div class="esquerda">
                                    <?php 
                                    $codVideo = explode('=',$info['link']);
                                    if($codVideo[1] != ''):
                                    
                                        $imagemCapa = '';                
                                        $output = array();
                                        $url = $info['link'];
                                        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $output);
                                        $imagemCapa = 'https://img.youtube.com/vi/' . $output[0] . '/0.jpg';
                                        ?>

                                        <div class="foto">
                                            <a href="https://www.youtube.com/embed/<?=$codVideo[1];?>" data-toggle="lightbox" data-width="695" data-height="445">
                                                <img src="<?=$imagemCapa;?>" style="max-width:100%">  
                                                <div class="btPlayYoutube">
                                                    <img src="<?php echo base_url('/assets/img/playYoutube.png');?>">
                                                </div>
                                            </a>
                                        </div> 
                                        <a href="https://www.youtube.com/embed/<?=$codVideo[1];?>" data-toggle="lightbox" data-width="695" data-height="445">
                                            <h3><?php echo $info['titulo']?></h3>
                                        </a>
                                        <!-- <p><?//php echo $info['link']?></p> -->
                                        <?php endif ?>
                                </div>
                                <div class="direita">
                                    <a href="https://www.youtube.com/embed/<?=$codVideo[1];?>" data-toggle="lightbox" data-width="695" data-height="445">
                                        <img src="<?php echo base_url('/assets/img/play-top10.png')?>" title="">
                                    </a>
                                </div>
                            </div>
                            <?php 
                        endforeach; 
                    endif;
                    ?>
                </div>

            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
            <?php 
                if(count($banner_tipo3)>0) :
                    $cod = array();
                    
                    foreach($banner_tipo3 as $info):
                        array_push($cod, $info['cod']); 
                    ?>
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
                    endforeach;
                    
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
                    }
                endif;
            ?>
                
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

