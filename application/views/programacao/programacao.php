<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?php base_url('/assets/vendor/jquery/jquery.min.js')?>"></script> -->
<!-- <script src="<?php base_url('/assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->

<script type="text/javascript">
    $(document).ready(function(){

        var content = $('#content');
        $('.link_programacao').click(function( e ){
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
                    <span>Programação</span>
                </h1>
                <?php
                $menuAtivoProgramacao =  isset($_SESSION['menuAtivoProgramacao']) ? $_SESSION['menuAtivoProgramacao'] : 'Semanal';
                //echo $menuAtivoProgramacao;
                ?>
                <div class="blocoMenuProgramacao">
                    <ul class="menuProgramacao">
                        <li class="semanal<?=($menuAtivoProgramacao == 'Semanal') ? ' ativo' : '';?>">
                            <a class='link_programacao' href="<?php echo base_url('home/programacao?programacao=Semanal')?>">SEMANAL</a>
                        </li>
                        <li class="sabado<?=($menuAtivoProgramacao == 'Sabado') ? ' ativo' : '';?>">
                            <a class='link_programacao' href="<?php echo base_url('home/programacao?programacao=Sabado')?>">SÁBADO</a>
                        </li>
                        <li class="domingo<?=($menuAtivoProgramacao == 'Domingo') ? ' ativo' : '';?>">
                            <a class='link_programacao' href="<?php echo base_url('home/programacao?programacao=Domingo')?>">DOMINGO</a>
                        </li>
                    </ul>
                </div>
                <div class="blocoProgramacao">
                    <?php 
                    $i=0;
                    $nProgramas = count($programacao_impar);
                    foreach($programacao_impar as $key=>$info):
                        $classeAdicionalPrograma = (($i%2) == 0) ? '' : ' programaRight';
                        $classeAdicionalConexaoPrograma = (($i%2) == 0) ? '' : ' conexaoProgramaRight';
                        ?>
                            
                        <div class="linhaPrograma">
                            <div class="programa<?=$classeAdicionalPrograma;?>">        
                                <a class='link_programacao' href="<?php echo base_url('home/descricao_programacao?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">  
                                    <div class="foto">
                                        <img src="<?php echo base_url('assets/arquivos/programacao/'.$info["arquivo"])?>" alt="">
                                    </div>
                                    <!--<h3><?php echo $info['titulo']?></h3>-->
                                    <div class="infos">
                                        <p><?php echo 'Das '.date('H:i', strtotime($info['inicio'])).' às '.date('H:i', strtotime($info['fim']));?></p>
                                        <p><?php echo 'Apresentador: '. $info['apresentador'];?></p>
                                    </div>
                                </a>
                            </div> 
                            <?php 
                            if($nProgramas!=($key+1)): 
                            ?>
                                <div class="conexaoPrograma<?=$classeAdicionalConexaoPrograma;?>">
                                    <img src="<?php echo base_url('assets/img/conexaoProgramas.png');?>" alt="">
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php 
                        $i = $i + 1;
                    endforeach;
                    ?>
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
                }endif;
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
