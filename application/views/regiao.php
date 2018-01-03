<div class="container">
    <div class="row destaques">
        <?php 
        $x=0; 
        foreach($noticias_em_destaque as $info):
            $x = $x+1;
            if($x==1){
                $classe = "noticiaPrincipal";
                $classeInf = "infPrincipal"; 
            }else{ 
                $classe = "noticia";
                $classeInf = "inf";
            }
            if($x==1){ echo'<div class="col-xs-12 col-md-8 destaquePrincipal">';}
            if($x==2){ echo'<div class="col-xs-12 col-md-4 destaque">';} 
            ?>
            <div class="<?=$classe;?> <?=$x==3 ? 'ultima' : '';?>" style="background: url(<?=base_url('/assets/arquivos/noticias/'.$info['arquivo']);?>) no-repeat center center; background-size: 100%;">
                
                <a class="link_descricao" href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']));?>">
                    <div class="fundoFoto">
                        <div class="<?=$classeInf;?>" >
                            <h3><?=$info['tituloPt'];?></h3>
                            <h1 class="categoria" style="background-color: #<?=$info['cor'];?>; color: <?=isset($info['corTexto']) != '' ? $info['corTexto'] : '#ffffff';?>"><?=$info['categoriaPt'];?></h1>
                            <p><?= date('d/m/Y', strtotime($info['data']));?></p>
                        </div>
                    </div> 
                </a>

            </div>
            <?php 
            if($x==1) {echo'</div>';}
            if($x==3) {echo'</div>';} 
        endforeach;
        ?>
    </div> <!-- row -->

    <div class="row outrasNoticias">
        <h1 class="tituloPadrao1">
            <span>Últimas novidades</span>
        </h1>
        <?php foreach($ultimas_noticias as $info):?>

            <div class='col-xs-12 col-md-4 noticia'>
                <a class="link_descricao" href="<?=base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']));?>">
                    <div class="wrapCategoria">
                        <span class="categoria" style="background-color:#<?=$info['cor'];?>; color:<?=isset($info['corTexto']) != '' ? $info['corTexto'] : '#ffffff';?>"><?=$info['categoriaPt'];?></span>
                    </div>
                    <h2><?=$info['tituloPt'];?></h2>
                    <p><?=$info['subtitulo'];?></p>
                    <p class="dataNoticia"><?=date('d/m/Y', strtotime($info['data']));?></p>
                </a>
            </div>

        <?php endforeach; ?>
    </div> <!-- row -->

</div> <!-- container -->

<div class="container">
    <div class="row publicidade">
        <img src="<?=base_url('/assets/img/temp/banner_home1.jpg');?>" title="Publicidade">       
    </div>
</div> <!-- container -->

<div class="promocoesEventos promocoesEventos_<?=$_SESSION['regiao'];?>">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                
                <h1 class="tituloPadrao2">
                    <span>Promoções</span>
                </h1>
                <?php foreach($promocoes_home as $info): ?>
                <div class='promocaoEvento'>
                    <a class="link_descricao" href="<?=base_url('home/descricao_promocoes?id='.$info['cod']);?>">
                        <? if($info['arquivo']!='') { ?>
                            <div class="wrapFoto">
                                <div class="foto">
                                    <img src="<?=base_url('/assets/arquivos/promocoes/'.$info['arquivo']);?>" alt="">
                                </div>
                            </div>
                        <? } ?>    
                        <h3><?=$info['tituloPt']?></h3>
                        <?=isset($info['dataInicio']) ? '<p>Inicio: '. date('d/m/Y', strtotime($info['dataInicio'])).'</p>' : '';?>
                        <?=isset($info['dataFim']) ? '<p>Fim: '. date('d/m/Y', strtotime($info['dataFim'])).'</p>' : '';?>
                    </a>
                </div>
                <?php endforeach; ?>
                <a href="/home/promocoes">Ver mais promoções</a>
                
            </div>
            <div class="col-xs-12 col-md-6">
                <h1 class="tituloPadrao2">
                    <span>Eventos</span>
                </h1>
                <?php foreach($eventos_home as $info): ?>
                <div class='promocaoEvento'>
                    <a class="link_descricao" href="<?=base_url('home/descricao_eventos?id='.$info['cod']);?>">
                        <? if($info['arquivo']!=''){ ?>
                            <div class="wrapFoto">
                                <div class="foto">
                                    <img src="<?=base_url('/assets/arquivos/eventos/'.$info['arquivo']);?>" alt="">
                                </div>
                            </div>
                        <? } ?> 
                        <h3><?=$info['tituloPt'];?></h3>
                        <?=isset($info['dataInicio']) ? '<p>Inicio: '. date('d/m/Y', strtotime($info['dataInicio'])).'</p>' : '';?>
                        <?=isset($info['dataFim']) ? '<p>Fim: '. date('d/m/Y', strtotime($info['dataFim'])).'</p>' : '';?>
                    </a>
                </div>
                <?php endforeach; ?>
                <a href="/home/eventos">Ver mais eventos</a>
            </div>

        </div> <!-- row -->
    </div> <!-- container -->

</div> <!-- promoções e eventos --> 

<div class="container">
    <div class="row publicidade">
        <div class="col-xs-12 col-md-6">
            <img src="<?=base_url('/assets/img/temp/banner_home2.jpg');?>" title="Publicidade">  
        </div>    
        <div class="col-xs-12 col-md-6">
            <img src="<?=base_url('/assets/img/temp/banner_home2.jpg');?>" title="Publicidade">  
        </div>
    </div>
</div> <!-- container -->

<div class="container progEnqMsg">
    <div class="row">
            <div class='col-xs-12 col-md-4'>
                <h1 class="tituloPadrao3">
                    <span>Programação</span>
                </h1>
                <div class="wrapProgramacao">
                    <?php foreach($programacao_home as $info):?>
                        <a class='link_descricao' href="<?=base_url('home/descricao_programacao?id='.$info['cod'].'&regiao='.strtolower($info['regiao']));?>">
                            <div class='programacao'>
                                <div class="foto">
                                    <img src="<?=base_url('/assets/arquivos/programacao/'.$info['arquivo']);?>" alt="">
                                </div>    
                                <h3><?=$info['titulo'];?></h3>
                                <p><?=$info['horario'];?></p>
                            </div>
                        </a>
                    <?php endforeach;?> 
                </div>
                <a id="link_descricao" class="btVerMais" href="<?php echo base_url($_SESSION['city'].'/programacao')?>">Ver a programação completa</a>
            </div>
            <div class='col-xs-12 col-md-4'>
                <h1 class="tituloPadrao3">
                    <span>Enquete</span>
<<<<<<< HEAD
                    <!-- <?php echo $count?> -->
=======
>>>>>>> 7d21c49e3229b62dadf686f80f6bdbfc52a2cf0e
                    <!-- pegar a pergunta sem repetir  -->
                    <?php foreach($enquetes as $info):?>
                    <?php $pergunta = $info['pergunta']?>
                    <?php endforeach?>

                    <h3><?= $pergunta?></h3>
                    
                    <form class='form_enquete' role='form' action="<?php base_url();?>/home/enquete_dados" method='POST'>
                        <?php foreach($enquetes as $info):?>
                            <div class="respostas">
                                <input class='resposta' type="radio" name="resposta" value="<?= $info['cod_resp']?>"><p><?= $info['resposta']?></p>    
                            </div>
                        <?php endforeach?>
<<<<<<< HEAD
                        <a id='enviar_resp' href="" value="Submit">Enviar</a>
=======
                        <a id='enviar_resp' value="Submit">Enviar</a>
>>>>>>> 7d21c49e3229b62dadf686f80f6bdbfc52a2cf0e
                    </form>
                </h1>

                    
               
            </div>
            <div class='col-xs-12 col-md-4'>
                <h1 class="tituloPadrao3">
                    <span>Mensagem do Dia</span>
                </h1>
                <?php foreach($videos_home as $info):?>
                    <iframe style="width: 100%; max-height:250px" src="https://www.youtube.com/embed/fV67QiJnoqY" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                <?php endforeach?>
            </div>
    </div> <!-- row -->

</div> <!-- container -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        var content = $('#content');

        $('.link_descricao').click(function( e ){
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

      
        $("#enviar_resp").click(function(e) {
            _obj = $('.resposta');
            // _mostrar = _obj.is(':checked') ? '1' : '0';
            
            _codResposta = _obj.val();
            alert(_codResposta);
            e.preventDefault();
            $.ajax( {
                url: $('.form_enquete').attr('action'),
                type: "POST",
                // async: false,
                // data: {
                //     cod: _codResposta
                // },
                data : $('.form_enquete').serialize(),
                success: function(resp) {
                    alert(resp);
                }
                
            })
            .done(function(_json)
            { //Se ocorrer tudo certo
                
                alert($_POST['cod']);
            });

            // var request = $.ajax({
            //     method : "POST",
            //     // url : "http://localhost:8080/home/ajax/enquete.php",
            //     url : 'http://localhost:8080/home/enquete_dados';
            //     data:{
            //         // variavel recebendo o valor de name que esta no form
            //         _codResposta = $("input[name='resposta']:checked").val();
            //     }
            //     dataType : "json",
            //     success: function(resp) {
            //         alert(resp);
            //     }
            // })

            // request.done(function(e) {
            //     console.log(e);
            //     for(var info in e) {
            //         $(":input[name=" + info + "]").val(e[info]);
            //     }
            // })
        }); 
    })
</script> 