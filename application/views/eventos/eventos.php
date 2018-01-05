<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
<!-- <script src="<?php base_url('/assets/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?php base_url('/assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">
     $(document).ready(function(){


        var content = $('#content');
        $('.link_eventos').click(function( e ){
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

        $('.noticia').DataTable();
        $('.mais_lidas').DataTable();
        $(".dataTables_length").hide();
        $("#DataTables_Table_0_filter").hide();
        $("thead").hide();
        $(".dataTables_info").hide();
        $("#registros_filter").hide();
        $("#registros_info").hide();
        
        var count = $("#count_dados").html();
        if(count < 10) {
            $('#DataTables_Table_0_paginate').hide();
        } 
    });
</script>
<div class="container">
<div class="blocoConteudo">
    <div class="row">

        <div class="col-xs-12 col-md-8 contLeft">

            <h1 class="tituloPadrao1">
                <span>Eventos</span>
            </h1>
            <div id='prog'>
                <!-- <table class='noticia' data-page-length='10' class="table table-striped table-bordered" cellspacing="0" width="20%">
                    <thead>
                        <tr>
                            <td>.</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($eventos as $info):?>
                        <tr>
                            <td>
                                <div id='esquerda'>
                                    <a class='link_eventos' href="<?php echo base_url('home/descricao_eventos?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                                        <img src="<?php echo base_url('/assets/arquivos/evetos/'.$info['arquivo'])?>" alt="">
                                        <h3><?php echo $info['tituloPt']?></h3>
                                        <!-- <p><?php echo $info['descricaoPt']?></p> -->
                                        <!-- <span><?php echo 'HORÀRIO:'.date('d/m/Y', strtotime($info['dataInicio']))?></span> -->
                                    <!-- </a>  -->
                                <!-- </div>
                            </td>
                        </tr>
                        <?php endforeach?>
                    </tbody> 
                </table> -->
                
                <?php foreach($eventos as $info):?>
                <div id='esquerda'>
                    <a class='link_eventos' href="<?php echo base_url('home/descricao_eventos?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                        <img src="<?php echo base_url('/assets/arquivos/evetos/'.$info['arquivo'])?>" alt="">
                        <h3><?php echo $info['tituloPt']?></h3>
                        <!-- <p><?php echo $info['descricaoPt']?></p> -->
                        <span><?php echo 'HORÀRIO:'.date('d/m/Y', strtotime($info['dataInicio']))?></span>
                    </a>
                    
                    
                </div>
                <?php endforeach?>
                <?php
                    
                    echo '$p: '.$p;
                    echo '<br>count: '.$count;
                    

                    echo '<br>GET:' . $_GET['p'];

                    $_SESSION['pag'] = $_GET['p'];
                        if($p >= 0) {
                            $anterior = $p - 4;
                            // $dados['anterior'] = $anterior;
                        }
                        if($p <= $count) {
                            $proxima = $p + 4;
                            // $dados['proxima'] = $proxima;
                        }
                        
                        if($anterior <= 0) {
                            $anterior = 0;
                        }
                        if($proxima >= $count){
                            $proxima = $count;
                        }
                        
                    
                    

                    
                    echo '<br>proc: '.$proxima;
                ?>
                <br><br>
                <a class='link_eventos' href="<?php echo base_url('/balneario-camboriu/eventos/?p='.$anterior);?>">Anterior</a>
                <a class='link_eventos' href="<?php echo base_url('/balneario-camboriu/eventos/')?>">Googler</a>
                <a class='link_eventos paginacao' href="<?php echo base_url('/balneario-camboriu/eventos/?p='.$proxima);?>">Proximo</a>
                <?= '<br>Total de Páginas: '. $paginas?>



                <?php foreach($banner_tipo2 as $info):?>
                    <a class='registra_click_publicidade' codPublicidade="<?= $info['cod'];?>" href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach?>
            </div>
            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
                <?php foreach($banner_tipo3 as $info):?>
                    <a class='registra_click_publicidade' codPublicidade="<?= $info['cod'];?>" href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach?>
                Publicidade 
            </div> <!-- contRight -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 
