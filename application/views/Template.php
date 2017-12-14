<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Agência Set - Criação de Sites - Santa Catarina - Balneário Camboriú - Agência Digital">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Nova Menina</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/webfontkit/stylesheet.css')?>">

        <!-- Custom styles for this template -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('/assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('/assets/css/base.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('/assets/css/template.css')?>" rel="stylesheet">
        
        <!-- icone -->
        <!-- <link rel="icon" href="<?php echo base_url('/assets/img/base/favicon.png')?>"> -->

        <!-- for Facebook -->          
        <meta property="og:url" content="<?php echo base_url();?>" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?=isset($title) ? $title : PROJECT_TITLE;?>" />
        <meta property="og:description" content="<?=isset($description) ? $description : PROJECT_DESCRIPTION;?>" />
        <meta property="og:image" content="<?=isset($imagemFb) ? $imagemFb : base_url('/assets/img/logo-jm-fb.png');?>" />

    </head>
    <body>

        <header>
        
            <div class="container-fluid topo_<?php $_SESSION['regiao'];?>">

                <div class="container">
                    <!-- Topo -->
                    <div class="row topo">

                        <div class="col-lg-4">
                            <p>
                                <span>Nome do programa</span>
                                <br>Sorry Not Sorry - Demi Lovato
                            </p>
                        </div>
                        
                        <div class="col-lg-4">
                            <iframe name="playcolor"  src="http://painelstream.com/mini-player/7038" frameborder="0" width="300" height="60" scrolling="no" noresize></iframe>
                        </div>
                        
                        <div class="col-lg-4">
                            <button>Tv Mocinha</button>
                        </div>
                    </div>
            
                </div> 
        
            </div>

        </header>

        <main>
            
            <div class="<?php echo 'redes_'.$_SESSION['regiao'];?>">
                <div class="container">
                    <div class="row">
                        <img class="logo_menina" src="<?php echo base_url('/assets/img/logoMeninaBC.png')?>" alt="logomeninaBC"><br>
                        <h3>+ DE UM MILHÂO DE AMIGOS</h3><br>
                    </div> <!-- row -->
                    <hr>

                    <div class='menu'>
                        <ul id="menu">
                            <li><a href="regiao">Home</a></li>
                            <li><a href="programacao">Programação</a></li>
                            <li>Jornalismo 
                                <ul id="submenu">
                                    <?php foreach($titulo_jornalismo as $info):?>
                                    <li><a href="<?php echo base_url('home/noticia?categoria='.strtolower($info['categoriaPt']))?>"><?php echo $info['categoriaPt']?></a></li>
                                    <?php endforeach?>
                                </ul>
                            </li>
                            <li><a href="artistico">Artistico</a></li>
                            <li><a href="promocoes">Promoções</a></li>
                            <li><a href="eventos">Eventos</a></li>
                            <li><a href="utilidade_publica">Utilidade Pública</a></li>
                            <li><a href="quem_somos">Quem Somos</a></li>
                            <li>Comercial</li>
                            <li>Contato</li>
                        </ul>
                    </div>
                </div> <!-- container -->
            </div>
            <!-- /.container fluid -->
            <!-- <iframe name="playcolor" src="http://painelstream.com/mini-player/7038" frameborder="0" width="300" height="60" scrolling="no" noresize></iframe> -->
            <!-- <ul id="menu">
                <li><a href="home">Home</a></li>
                <li><a href="programacao">Programação</a></li>
                <li><a href="contato.html">Contato</a></li>
            </ul> -->

            <div id="content">
                <?php $this->load->view($viewName); echo $_SESSION['regiao'] ?>
            </div>

            <div class='rede_social'> 
                <div class='face'><img src="<?php echo base_url('/assets/img/ima.png')?>" alt=""></div>
                <div class='youtube'>d</div>
                <div class='foto1'>1</div>
                <div class='foto2'>2</div>
                <div class='foto3'>3</div>
                <div class='foto4'>4</div>
            </div>
            
            <div class="unidades">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-3">
                            <img src="<?php echo base_url('assets/img/logoMeninaBC.png')?>" title="Balneário Camboriú">
                            <h3>Balneário Camboriú</h3>
                            <p> 
                                Av. do Estado, 1555 - Edif. Work Center<br>
                                Pioneiros - Balneário Camboriú - SC<br>
                                CEP: 88331-900<br><br>
                                (47) 2103.6000
                            </p>
                        </div>
                        
                        <div class="col-sm-3">
                            <img src="<?php echo base_url('assets/img/logoMeninaBL.png')?>" title="Blumenau">
                            <h3>Blumenau</h3>
                            <p>
                                Rua 7 de Setembro, 473<br>
                                Boa Vista - Blumenau - SC<br>
                                CEP: 89010-002<br><br>
                                (47) 2102.6500
                            </p>
                        </div>
                        
                        <div class="col-sm-3">
                            <img src="<?php echo base_url('assets/img/logoMeninaLG.png')?>" title="Lages">
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


        <footer class="rodapeBg_<?php $_SESSION['regiao'];?>">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-center">©2017 Copyright - Rádio Menina FM - Todos direitos reservados</p>		        
                    </div>
                </div>
            </div>
        </footer>
    </body>

    <script src="<?php echo base_url('/assets/js/popper.min.js')?>"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            var content = $('#content');

            $('#menu a').click(function( e ){
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
            $('#submenu a').live('click', function( e ){
                e.preventDefault();
                content.html( '<img src="loading.gif" />' );

                var href = $( this ).attr('href');
                $.ajax({
                    url: href,
                    success: function( response ){
                        //forçando o parser
                        var data = $( '<div>'+response+'</div>' ).find('#content').html();

                        //apenas atrasando a troca, para mostrarmos o loading
                        window.setTimeout( function(){
                            content.fadeOut('slow', function(){
                                content.html( data ).fadeIn();
                            });
                        }, 200 );
                    }
                });
            });
        });
	</script>
</html>	