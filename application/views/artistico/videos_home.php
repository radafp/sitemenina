<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
<!-- <script src="<?php base_url('/assets/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?php base_url('/assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
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

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>Videos</span>
                </h1>
                <div id='prog'>

                    <?php foreach($videos as $info): ?>
                        <div style="width:45%;float:left">
                            <iframe style="width: 100%; max-height:250px" src="<?=$info['link']?>" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>          
                            <p><?php echo $info["titulo"];?></p>
                        </div>
                    <?php endforeach; ?> 

                </div>

            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
                Publicidade 
            </div> <!-- contRight -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 