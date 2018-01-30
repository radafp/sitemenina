<div class="container">
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>Equipe</span>
                </h1>
                <div class="blocoProgramacaoDescricao">
                    
                    <?php foreach($descricao_programacao as $info):?>
                        <div id='esquerda'>
                            <div class="foto">
                                <img src="<?php echo base_url('assets/arquivos/equipe/'.$info["arquivo"])?>" alt="">
                            </div>
                            <h3><?php echo $info['tituloPt']?></h3>
                            <p><?php echo $info['descricaoPt']?></p>
                            <div class="infos">
                            </div>
                        </div>
                    <?php endforeach?>

                </div>

            </div> <!-- contLeft -->

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
