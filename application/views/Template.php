<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <meta name="author" content="Agência Set - Criação de Sites - Santa Catarina - Balneário Camboriú - Agência Digital">
        
        <title>Radio Menina FM - A mais gosotosa de ouvir</title>

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

        <!-- <script type="text/javascript">
        $(document).ready(function(){
                        
                    });
        </script> -->
    </head>
    <body class="backgroundBody_<?=$_SESSION['regiao'];?>">

        <header>
        
            <!-- Content Topo -->
            <div class="container-fluid mainTopo topo_<?=$_SESSION['regiao'];?>">

                <div class="container">

                    <!-- Topo -->
                    <div class="row topo">

                        <div class="col-6 col-lg-4">
                            <p>
                                <span>Nome do programa</span>
                                <br>Sorry Not Sorry - Demi Lovato
                            </p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <iframe name="playcolor" src="http://painelstream.com/mini-player/7038" frameborder="0" width="300" height="60" scrolling="no" noresize></iframe>
                        </div>
                        <div class="col-lg-4 tvMocinha">
                            <button>Tv Mocinha</button>
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

                        <div class="col-md-2 col-sm-4 btm-30 logo">
                            <a id='logo' href="<?php echo base_url($_SESSION['city'])?>"> <img src="<?php echo base_url('/assets/img/logoMenina'.$_SESSION['regiao'].'.png');?>" title="Rádio Menina"></a>
                        </div>
                        <div class="col-md-4 col-sm-4 btm-30 slogam">
                            <h1><?=$_SESSION['slogam'];?></h1>
                        </div>
                        <div class="col-md-3 col-sm-4 btm-30 selRegiao">
                            <form action="" id="formRegiao" method='POST'>
                                <select name="selectRegiao" form="form" id='regiao'>
                                    <option value="/balneario-camboriu" <?=$_SESSION['regiao'] == 'bc' ? 'selected' : '';?> >Balneário Camboriú</option>
                                    <option value="/blumenal" <?=$_SESSION['regiao'] == 'bl' ? 'selected' : '';?> >Blumenau</option>
                                    <option value="/lages" <?=$_SESSION['regiao'] == 'lg' ? 'selected' : '';?> >Lages</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-md-3 col-sm-4 btm-30 topoRedes">
                            <ul class="list-inline social">
                                <li><a class="face" href="<?=$_SESSION['socialFace'];?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="insta" href="<?=$_SESSION['socialInsta'];?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                <li><a class="youtube" href="<?=$_SESSION['socialYoutube'];?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            </ul>   
                        </div>

                    </div>
                    <!-- /.row -->
                    <hr>               
                    <!-- Navigation -->
                    <nav class="navbar navbar-expand-lg navbar-default">
                        <div class="container">
                            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
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
                                            <?php foreach($titulo_jornalismo as $info):?>
                                                <a class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/noticias?categoria='.$info['categoriaPt'])?>"><?php echo $info['categoriaPt']?></a>
                                            <?php endforeach?>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                    <li class="nav-item dropdown">
                                        <div class="nav-link dropdown-toggle" style="cursor:pointer" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Artístico
                                        </div>
                                        <div id='link_artistico' class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                                            <a  class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/top-10')?>">Top 10</a>
                                            <a  class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/videos')?>">Vídeos</a>
                                        </div>
                                    </li>
                                    </li>
                                    <li class="nav-item">
                                        <a id='link_promocoes' class="nav-link" href="<?php echo base_url($_SESSION['city'].'/promocoes')?>">Promoções</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id='link_eventos' class="nav-link" href="<?php echo base_url($_SESSION['city'].'/eventos')?>">Eventos</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <div class="nav-link dropdown-toggle" style="cursor:pointer" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Utilidade pública
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                                            <a id='link_bolsa_de_emprego' class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/bolsa-de-empregos')?>">Bolsa de empregos</a>
                                            <a id='link_documentos_perdidos' class="dropdown-item" href="<?php echo base_url($_SESSION['city'].'/documentos-perdidos')?>">Documentos Perdidos</a>
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
                                    </div>
                                    </li>
                                    <li class="nav-item">
                                        <a id='link_contato' class="nav-link" href="<?php echo base_url($_SESSION['city'].'/contato')?>">Contato</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                </div><!-- fin blocoMenu -->
            </div>

        </header>

        <main>

            <div id="content" class="conteudo">
                <?php $this->load->view($viewName);?>
            </div>
            
            <div class="redes redes_<?=$_SESSION['regiao'];?>">

                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class='face'>
                                <a class="link_descricao" href="<?=$_SESSION['socialFace'];?>" target="_blank">
                                    <img src="<?php echo base_url('/assets/img/linkFaceRodape.png')?>" alt="Curta nossa Fanpage">
                                </a>
                            </div>
                            <div class='youtube'>
                                <a class="link_descricao" href="<?=$_SESSION['socialYoutube'];?>" target="_blank">
                                    <img src="<?php echo base_url('/assets/img/linkYoutubeRodape.png')?>" alt="Inscreva-se no nosso canal">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            
                        </div>

                    </div> <!-- row -->
                </div> <!-- container -->

            </div>

            <div class="unidades">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-3">
                            <img src="<?php echo base_url('assets/img/logoMeninabc.png')?>" title="Balneário Camboriú">
                            <h3>Balneário Camboriú</h3>
                            <p> 
                                Av. do Estado, 1555 - Edif. Work Center<br>
                                Pioneiros - Balneário Camboriú - SC<br>
                                CEP: 88331-900<br><br>
                                (47) 2103.6000
                            </p>
                        </div>
                        
                        <div class="col-sm-3">
                            <img src="<?php echo base_url('assets/img/logoMeninabl.png')?>" title="Blumenau">
                            <h3>Blumenau</h3>
                            <p>
                                Rua 7 de Setembro, 473<br>
                                Boa Vista - Blumenau - SC<br>
                                CEP: 89010-002<br><br>
                                (47) 2102.6500
                            </p>
                        </div>
                        
                        <div class="col-sm-3">
                            <img src="<?php echo base_url('assets/img/logoMeninalg.png')?>" title="Lages">
                            <h3>Lages</h3>
                            <p>
                                Av. Luís de Camões, 1370<br>
                                Coral - Lages - SC<br>
                                CEP: 88523-000<br><br>
                                (49) 3222.8222
                            </p>
                        </div>
                        
                        <div class="col-sm-3">
                            <img src="<?php echo base_url('assets/img/logoTVMocinha.png')?>" title="TV Mocinha">
                            <h3>TV Mocinha Balneário Camboriú</h3>
                            <p>
                                Av. do Estado, 1555 - Edif. Work Center<br>
                                Pioneiros - Balneário Camboriú - SC<br>
                                CEP: 88331-900<br><br>
                                (47) 2103.6020
                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
    
        </main>


        <footer class="rodapeBg_<?=$_SESSION['regiao'];?>">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="link_descricao" class="text-center">©2017 Copyright - Rádio Menina FM - Todos direitos reservados</p>		        
                    </div>
                </div>
            </div>
        </footer>
    </body>

    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            var content = $('#content');
            var logo = document.querySelector('#logo');
            $('#menu a,  #logo').click(function( e ){
                
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
        
        document.getElementById('formRegiao').onchange = function(e){
            var regiao = document.querySelector('#regiao');
            window.location = regiao.value;              
        }
    
	</script>
</html>	