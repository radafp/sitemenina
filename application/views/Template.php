<!DOCTYPE html>
<html lang="pt-br">
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <meta name="author" content="Agência Set - Criação de Sites - Santa Catarina - Balneário Camboriú - Agência Digital">
        
        <title>Radio Menina FM - A mais gosotosa de ouvir</title>

        <?
            if(!isset($_SESSION['regiao'])){
                header("Location: http://www.radiomenina.com.br");
            }
        ?>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/webfontkit/stylesheet.css')?>">

        <!-- Custom styles for this template -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

        <!-- custom style icon - fontawesome -->
        <script src="https://use.fontawesome.com/de47a2b5b4.js"></script>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('/assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('/assets/css/base.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('/assets/css/template.css')?>" rel="stylesheet">
        
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

        <!-- icone -->
        <!-- <link rel="icon" href="<?php echo base_url('/assets/img/base/favicon.png')?>"> -->

        <!-- for Facebook -->          
        <meta property="og:url" content="<?php echo base_url();?>" />
        <meta property="og:type" content="website" /> 
        <meta property="og:title" content="<?=isset($title) ? $title : '';?>" />
        <meta property="og:description" content="<?=isset($description) ? $description : '';?>" />
        <meta property="og:image" content="<?=isset($imagemFb) ? $imagemFb : base_url('/assets/img/logo-jm-fb.png');?>" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">

        <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
        <!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->

        <!--cantact form script-->
        <script src="<?php echo base_url('assets/js/contact_me.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/jqBootstrapValidation.js');?>" type="text/javascript"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){

                var content = $('#content');
                var logo = document.querySelector('#logo');
                $('#menu a,  #logo, .busca').click(function( e ){
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
                                console.log('ok');
                                $(".navbar-toggler").addClass("collapsed");
                                $('.navbar-toggler').attr({'aria-expanded': 'false'}); 
                                $(".navbar-collapse").removeClass("show");

                                if(href != 'http://www.portalmenina.com.br/balneario-camboriu'){
                                    $('html,body').animate({ scrollTop: $("#anc").offset().top },'slow');
                                }
                                //setAttribute("aria-expanded", "false")
                            },100);
                            
                            //$("p:first").addClass("intro"); 
                        }
                    });
                    
                    window.history.pushState(null, 'Home', $(this).attr('href'));
                });
                
                $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox();
                });
                
                document.getElementById('formRegiao').onchange = function(e){
                    var regiao = document.querySelector('#regiao');
                    window.location = regiao.value;              
                };

                var buscaNoticia1 = document.querySelector('#buscaNoticia1 button');
                buscaNoticia1.addEventListener('click', function() {
                    var palabra_busca1 = document.querySelector('#buscaNoticia1 input');
                    // alert(palabra_busca.value);
                    // var link = document.querySelector('.busca').href += palabra_busca.value+'&p=1';

                    var link = document.querySelector('#buscaNoticia1 .busca').href = '/balneario-camboriu/noticias?busca='+palabra_busca1.value+'&p=1';
                    // alert(link);
                    //window.location = "/balneario-camboriu/noticias?categoria=Busca&p=1";
                    window.history.pushState(null, 'Home', $(this).attr('href'));
                });

                var buscaNoticia2 = document.querySelector('#buscaNoticia2 button');
                buscaNoticia2.addEventListener('click', function() {
                    var palabra_busca2 = document.querySelector('#buscaNoticia2 .inputBusca');

                    var link = document.querySelector('#buscaNoticia2 .busca').href = '/balneario-camboriu/noticias?busca='+palabra_busca2.value+'&p=1';
        
                    window.history.pushState(null, 'Home', $(this).attr('href'));
                })

                /* Whatsapp */
                /* jQuery("a.whatsapp").unbind("click").bind("click", function()
                {
                    jQuery("div.whatsappBox").fadeIn();
                });
                $("div.btFechar").unbind("click").bind("click", function()
                {
                    jQuery("div.whatsappBox").fadeOut();
                }); */
                
                /*var pr =  $('.playerRadio').contents();
                pr.find('html').css('background', 'red') {
                    alert('test');
                });
                 
                var x = $(".playerRadio").css("color", 'blue');
                */
            });
        </script>
        
    </head>
    <body class="backgroundBody_<?=$_SESSION['regiao'];?>">

        <header>
        
            <!-- Content Topo -->
            <div class="container-fluid mainTopo topo_<?=$_SESSION['regiao'];?>">

                <div class="container">

                    <!-- Topo -->
                    <div class="row topo">

                        <!--<div class="col-6 col-lg-4">
                            
                                <p>
                                <span>Nome do programa</span>
                                <br>Sorry Not Sorry - Demi Lovato
                            </p>
                            
                        </div>-->
                        <?php
                            switch($_SESSION['regiao']){
                                case 'bc':
                                    $codRadio = '7544';
                                    break;
                                case 'bl':
                                    $codRadio = '7854';
                                    break;
                                case 'lg':
                                    $codRadio = '7674'; 
                                    break;
                            }
                            ?>
                        <div class="col-12 col-lg-6">
                            <iframe class="playerRadio" name="playcolor" src="http://painelstream.com/mini-player/<?=$codRadio;?>" frameborder="0" width="300" height="60" scrolling="no" noresize></iframe>
                        </div>
                        <div class="col-lg-6 tvMocinha">
                            <?php if($_SESSION['regiao'] == ''): ?>
                                <a class="btTvMocinha" href="http://radiomeninabc.portalmenina.com.br/ao-vivo/tv-mocinha-balneario-camboriu" data-toggle="lightbox" data-width="695" data-height="445">Tv Mocinha</a>
                            <?php endif; ?>
                        </div>
                    
                    </div>
                    <!-- /.row -->

                </div> 
                <!-- /.container -->

            </div>
            <!-- /.container fluid -->

            <div class="container">
                <div class="blocoMenu">

                    <div class="row lsbr">

                        <div class="col-xs-12 col-md-2 btm-30 logo">
                            <a id='logo' href="<?php echo base_url($_SESSION['city']);?>"> <img src="<?php echo base_url('/assets/img/logoMenina'.$_SESSION['regiao'].'.png');?>" title="Rádio Menina"></a>
                        </div>
                        <div class="col-xs-12 col-md-4 btm-30 slogam">
                            <span><?=$_SESSION['slogam'];?></span>
                        </div>
                        <div class="col-xs-12 col-md-3 btm-30 selRegiao">
                            <div class="wrapFormRegiao">
                                <form action="" id="formRegiao" method='POST'>
                                    <select name="selectRegiao" id='regiao'>
                                        <option value="/balneario-camboriu" <?=$_SESSION['regiao'] == 'bc' ? 'selected' : '';?> >Balneário Camboriú</option>
                                        <option value="/blumenau" <?=$_SESSION['regiao'] == 'bl' ? 'selected' : '';?> >Blumenau</option>
                                        <option value="/lages" <?=$_SESSION['regiao'] == 'lg' ? 'selected' : '';?> >Lages</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3 btm-30 topoRedes">
                            <ul class="list-inline social">
                                <li><a class="face" href="<?=$_SESSION['socialFace'];?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="insta" href="<?=$_SESSION['socialInsta'];?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                <li><a class="youtube" href="<?=$_SESSION['socialYoutube'];?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                <li ><a class="whatsapp" href="<?php echo base_url($_SESSION['city'].'/contato')?>"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>
                            
                        </div>

                    </div>
                    <!-- /.row -->
                    <hr>               
                    <!-- Navigation -->
                    <nav class="navbar navbar-expand-lg navbar-default">
                        <div class="container">
                            <div class="wrap-navBar-toggle">
                                <button style="border-color: #c2c2c2;cursor: pointer;float: left;margin-right: 10px;" class="navbar-toggler navbar-light navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <!-- <form class="formBusca-toggler" id='buscaNoticia' name='busca1' action="busca_noticia" method='POST'>
                                    <input class="inputBusca" placeholder="Buscar por ... " type="text" name='busca'>
                                    <span class="input-group-btn">
                                        <a class='busca' href="<?php echo base_url($_SESSION['city'].'/noticias?categoria=&p='. 1)?>">
                                            <button style="padding: 4px 5px;border-top-left-radius: 0;border-bottom-left-radius: 0;margin-left: -1px;cursor: pointer;height: 32px;" class="btn btn-secondary" type="button">Buscar</button>
                                        </a>
                                    </span>
                                </form> -->
                                <form class="formBusca-toggler" id='buscaNoticia1' name='busca1' action="busca_noticia" method='POST'>
                                <input class="inputBusca" placeholder="Buscar por ... " type="text" name='busca'>
                                <span class="input-group-btn">
                                    <a class='busca' href="<?php echo base_url($_SESSION['city'].'/noticias?categoria=&p='. 1)?>">
                                        <button style="padding: 4px 5px;border-top-left-radius: 0;border-bottom-left-radius: 0;margin-left: -1px;cursor: pointer;height: 32px;" class="btn btn-secondary" type="button">Buscar</button>
                                    </a>
                                </span>
                            </form>
                            </div>
                            <div class="collapse navbar-collapse" id="navbarResponsive">
                                <ul id="menu" class="navbar-nav">
                                    <li class="nav-item">
                                        <a id='link_programacao' class="nav-link" href="<?php echo base_url($_SESSION['city'].'/programacao')?>">Programação</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <div class="nav-link dropdown-toggle" style="cursor:pointer" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Jornalismo
                                        </div>
                                        <div id='link_jornalismo' class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                                            <a class="dropdown-item" style="border-bottom:1px #cccccc dashed;" href="<?php echo base_url($_SESSION['city'].'/noticias/todas/'. 1)?>">Ver todas</a>
                                            <?php foreach($titulo_jornalismo as $info):?>
                                                <a class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/noticias/'.$info['categoriaPt'].'/'. 1)?>"><?php echo $info['categoriaPt']?></a>
                                            <?php endforeach?>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <div class="nav-link dropdown-toggle" style="cursor:pointer" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Artístico
                                        </div>
                                        <div id='link_artistico' class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                                            <a  class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/top-10')?>">Top 10</a>
                                            <a  class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/videos/?p='). 1?>">Vídeos</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a id='link_promocoes' class="nav-link" href="<?php echo base_url($_SESSION['city'].'/promocoes/?p='). 1?>">Promoções</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id='link_eventos' class="nav-link" href="<?php echo base_url($_SESSION['city'].'/agenda/?p='). 1?>">Agenda</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <div class="nav-link dropdown-toggle" style="cursor:pointer" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Utilidade pública
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                                            <a id='link_bolsa_de_emprego' class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos/?p='). 1?>">Bolsa de empregos</a>
                                            <a id='link_documentos_perdidos' class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/documentos-perdidos/?p='). 1?>">Documentos Perdidos</a>
                                            <!-- <a id='link_campanhas' class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/campanhas')?>">Campanhas</a> -->
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                    <div class="nav-link dropdown-toggle" style="cursor:pointer" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Quem somos
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                                        <a id='link_historia' class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/historia')?>">História</a>
                                        <a id='link_equipe' class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/equipe')?>">Equipe</a>
                                        <a id='link_equipe' class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/midia')?>">Comercial</a>
                                    </div>
                                    </li>
                                    <li class="nav-item">
                                        <a id='link_contato' class="nav-link" href="<?php echo base_url($_SESSION['city'].'/contato')?>">Contato</a>
                                    </li>
                                </ul>
                            </div>
                            <form class="formBusca" id='buscaNoticia2' name='busca2' action="busca_noticia" method='POST'>
                                <input class="inputBusca" placeholder="Buscar por ... " type="text" name='busca'>
                                <span class="input-group-btn">
                                    <a class='busca' href="<?php echo base_url($_SESSION['city'].'/noticias?categoria=&p='. 1)?>">
                                        <button style="padding: 4px 5px;border-top-left-radius: 0;border-bottom-left-radius: 0;margin-left: -1px;cursor: pointer;height: 32px;" class="btn btn-secondary" type="button">Buscar</button>
                                    </a>
                                </span>
                            </form>
                        </div>
                    </nav>

                </div><!-- fin blocoMenu -->
            </div>

        </header>

        <main>
            <div class="anc" id="anc">&nbsp;</div>
            <div id="content">
                
                <?php $this->load->view($viewName);?>
            </div>
            
           <div class="redes redes_<?=$_SESSION['regiao'];?>">

                <div class="container">
                    <!-- 
                        <div class="row envieNoticia">
                        <h2>Envie sua notícia</h2>
                        <a id='link_contato' class="btEnvieConteudo" href="<?php echo base_url($_SESSION['city'].'/contato')?>">Quero participar</a>
                        <hr style="width: 100%;padding: 20px 0;">
                    </div>
                        -->
                    <div class="row">
                        
                        <div class="col-xs-12 col-md-4">
                            <div class='face'>
                                <a  href="<?=$_SESSION['socialFace'];?>" target="_blank">
                                    <img src="<?php echo base_url('/assets/img/linkFaceRodape.png')?>" alt="Curta nossa Fanpage">
                                </a>
                            </div>
                            <div class='youtube'>
                                <a href="<?=$_SESSION['socialYoutube'];?>" target="_blank">
                                    <img src="<?php echo base_url('/assets/img/linkYoutubeRodape.png')?>" alt="Inscreva-se no nosso canal">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8 insta">
                            <div class="wrapFotoTipo1">
                                <img src="<?php echo base_url('/assets/img/temp/insta1_'.$_SESSION['regiao']).'.jpg';?>" alt="">
                            </div>
                            <div class="wrapFotoTipo2">
                                <div class="fotoTipo2">
                                    <img src="<?php echo base_url('/assets/img/temp/insta2_'.$_SESSION['regiao']).'.jpg';?>" alt="">
                                </div>
                                <div class="fotoTipo2">
                                    <img src="<?php echo base_url('/assets/img/temp/insta3_'.$_SESSION['regiao']).'.jpg';?>" alt="">
                                </div>
                            </div>
                            <div class="wrapFotoTipo1">
                                <img src="<?php echo base_url('/assets/img/temp/insta4_'.$_SESSION['regiao']).'.jpg';?>" alt="">
                            </div>
                            <?php 
                            /* switch(isset($_SESSION['regiao'])){
                                case 'bc':
                                    $userid = "1261127122";
                                    $accessToken = "1261127122.6d7beb5.c32b85c115d240eeb11e6ed048e9c61f";
                                    $url = "https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}";
                                    $result = file_get_contents($url);
                                    $result = json_decode($result);
                                    break;
                            }
                            for($i=0;$i<4;$i++)
                            {
                                $foto = $result->data[$i];
                            ?>
                                <?php if($i==0): ?>
                                <div class="wrapFotoTipo1">
                                    <img src="<?php echo $foto->images->thumbnail->url ?>" alt="<?php echo $foto->caption->text ?>" />
                                </div>
                                <?php endif; ?>
                                <div class="wrapFotoTipo2">
                                    <?php if($i==1): ?>
                                    <div class="fotoTipo2">
                                    <img src="<?php echo $foto->images->thumbnail->url ?>" alt="<?php echo $foto->caption->text ?>" />
                                    </div>
                                    <?php 
                                        endif; 
                                        if($i==2):
                                    ?>
                                    <div class="fotoTipo2">
                                    <img src="<?php echo $foto->images->thumbnail->url ?>" alt="<?php echo $foto->caption->text ?>" />
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php if($i==3): ?>
                                <div class="wrapFotoTipo1">
                                <img src="<?php echo $foto->images->thumbnail->url ?>" alt="<?php echo $foto->caption->text ?>" />
                                </div>
                                <?php endif; ?>
                            <?php }  */?> 
                        </div>

                    </div> <!-- row -->
                </div> <!-- container -->

            </div>

            <div class="unidades">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-xs-12 col-md-3 unidade">
                            <img src="<?php echo base_url('assets/img/logoMeninabc.png')?>" title="Balneário Camboriú">
                            <h3>Balneário Camboriú</h3>
                            <p class="pEndereco"> 
                                Av. do Estado, 1555<br> 
                                Camboriú Work Center<br>
                                Pioneiros - Balneário Camboriú/SC<br>
                                CEP: 88331-900
                            </p>
                            <p>
                                (47) 2103.6000
                            </p>
                            
                        </div>
                        
                        <div class="col-xs-12 col-md-3 unidade">
                            <img src="<?php echo base_url('assets/img/logoMeninabl.png')?>" title="Blumenau">
                            <h3>Blumenau</h3>
                            <p class="pEndereco">
                                Rua 7 de Setembro, 473<br>
                                Centro - Blumenau/SC<br>
                                CEP: 89010-201
                            </p>
                            <p>
                                (47) 2102.6500
                            </p>
                        </div>
                        
                        <div class="col-xs-12 col-md-3 unidade">
                            <img src="<?php echo base_url('assets/img/logoMeninalg.png')?>" title="Lages">
                            <h3>Lages</h3>
                            <p class="pEndereco">
                                Av. Luís de Camões, 1370<br>
                                Coral - Lages/SC<br>
                                CEP: 88523-000
                            </p>
                            <p>
                                (49) 3229.2363 
                            </p>
                        </div>
                        
                        <div class="col-xs-12 col-md-3 unidade">
                            <img src="<?php echo base_url('assets/img/logoTVMocinha.png')?>" title="TV Mocinha">
                            <h3>TV Mocinha Balneário Camboriú</h3>
                            <p class="pEndereco">
                                Av. do Estado, 1555<br> 
                                Camboriú Work Center<br>
                                Pioneiros - Balneário Camboriú/SC<br>
                                CEP: 88331-900
                            </p>
                            <p>
                                (47) 2103.6020
                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
    
        </main> 
        <?php
        switch($_SESSION['regiao']){
            case 'bc':
                $regiaoAlterna = 'lg';
                break;
            case 'bl':
                $regiaoAlterna = 'bc';
                break;
            case 'lg':
                $regiaoAlterna = 'bl'; 
                break;
        }
        ?>

        <footer class="rodapeBg_<?=$regiaoAlterna;?>">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="link_descricao" class="text-center">©2017 Copyright - Rádio Menina FM - Todos direitos reservados</p>		        
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>	