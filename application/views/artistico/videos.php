<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
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
<div class='programacao'>
    <div class='programacoes'>
        <h2>Videos</h2><br><br>
        <div id='prog'>
            <div id='esquerda'>
                <table class='noticia' data-page-length='2' class="table table-striped table-bordered" cellspacing="0" width="20%">
                    <thead>
                        <tr>
                            <td>.</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($videos as $info):?>
                        <tr>
                            <td>
                                <p><?php echo $info["titulo"].'<br>'. $info['link']?></p>
                            </td>
                        </tr>
                        <?php endforeach?>    
                    </tbody> 
                </table>
            </div>
        </div>
    </div>

</div><br><br><br>
</div>