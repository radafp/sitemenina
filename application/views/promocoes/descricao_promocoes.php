<div class="container">
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>Promoções</span>
                </h1>
                <div class='blocoPromocoesDescricao'>
                    <?php foreach($descricao_promocoes as $info):?>
                        <div class='promocao'>
                            <div class="foto">
                                <img src="<?php echo base_url('/assets/arquivos/promocoes/'.$info['arquivo']);?>" alt="">
                            </div>
                            <h3><?php echo $info['tituloPt'];?></h3>
                            <p><?php echo $info['descricaoPt'];?></p>
                            <p><?php echo 'Início: '.date('d/m/Y', strtotime($info['dataInicio'])). "<br>Fim: ". date('d/m/Y', strtotime($info['dataFim']))?></p>
                            <!--
                                <button>REGULAMENTO</button>
                                <BUtton>QUERO PARTICIPAR</BUtton>
                            -->
                        </div>
                    <?php endforeach?>
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
