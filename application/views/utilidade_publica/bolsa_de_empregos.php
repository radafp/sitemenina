<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
<!-- <script src="<?php base_url('/assets/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?php base_url('/assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function(){

        // var content = $('#content');
        // $('.link_programacao').click(function( e ){
        //     e.preventDefault();

        //     var href = $( this ).attr('href');
        //     $.ajax({
        //         url: href,
        //         success: function( response ){
        //             //forçando o parser
        //             var data = $( '<div>'+response+'</div>' ).find('#content').html();

        //             //apenas atrasando a troca, para mostrarmos o loading
        //             window.setTimeout( function(){
        //                 content.fadeOut('fast', function(){
        //                     content.html( data ).fadeIn();
        //                 });
        //             },100);
        //         }
        //     });
        // });
        $('.noticia').DataTable();
        $('.mais_lidas').DataTable();
        $(".dataTables_length").hide();
        $("#DataTables_Table_0_filter").hide();
        $("thead").hide();
        $(".dataTables_info").hide();
        $("#registros_filter").hide();
        $("#registros_info").hide();  
    });
    
</script>
<div class="container">  
    <div class="blocoConteudo">
        <div class="row">

            <h1 class="tituloPadrao1">
                <span>Bolsa de empregos</span>
            </h1>

            <div class="col-xs-12 col-md-8 contLeft">

                <div id='prog'>
                    <?php foreach($empregos as $info):?>
                        <div id='esquerda'>
                            <img src="<?php echo base_url('/assets/arquivos/empregos/'.$info['arquivo'])?>" alt="">
                            <h3><?php echo $info['descricao']?></h3>
                            <p><?php echo $info['telefone']?></p>
                            <span><?php echo 'Publicado :'.$info['dataPublicacao'];?></span><br>
                        </div>
                    <?php endforeach?>
                </div>       

            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
                Publicidade 
            </div> <!-- contRight -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 
    