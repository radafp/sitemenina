<!-- <script src="<?php base_url('/assets/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?php base_url('/assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script> -->

<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
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


        $('.noticia').DataTable();
        $('.mais_lidas').DataTable();
        $(".dataTables_length").hide();
        $("#DataTables_Table_0_filter").hide();
        $("thead").hide();
        $(".dataTables_info").hide();
        $("#registros_filter").hide();
        $("#registros_info").hide(); 
        var count_dados = document.querySelector('#count_dados').innerHTML;

        if(count_dados < 10) {
            $("#DataTables_Table_0_paginate").hide(); 
        }
    });
    
</script>
<div class="container">
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>Notícias</span>
                </h1>
                <div id='prog'>
                    <div id='esquerda'>
                        <table class='noticia' data-page-length='10' class="table table-striped table-bordered" cellspacing="0" width="20%">
                            <thead>
                                <tr>
                                    <td>.</td>
                                </tr>
                            </thead>
                            <tbody class="link_descricao">
                            <div id='count_dados' style="display:none"><?php echo $count;?></div>
                            <?php foreach($jornalismo as $info):?>
                                <tr>
                                    <td>
                                    <a class="link_programacao" href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']))?>">
                                        <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo'])?>" alt="">
                                        <h3><?php echo $info['tituloPt']?></h3>
                                        <p><?php echo $info['categoriaPt'] . ' ' . date('d/m/Y', strtotime($info['data']))?></p>
                                    </a> 
                                    </td>
                                </tr>
                            <?php endforeach?>    
                            </tbody> 
                        </table>
                    </div>  
                </div>

            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
                <?php foreach($mais_lidas as $info):?>

                    <a class="link_descricao" href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']))?>">
                        <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo'])?>" alt="">
                        <p><?php echo $info['categoriaPt']?></p>
                        <h3><?php echo $info['tituloPt']?></h3>
                    </a> 

                <?php endforeach?>    
            </div> <!-- contRight -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 

