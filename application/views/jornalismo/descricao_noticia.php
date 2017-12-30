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
    });
</script>
<div class="container">
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-xs-12 col-md-8 contLeft">

                <div id='prog'>
                    <?php foreach($descricao_noticia as $info):?>
                    <div id='esquerda'>
                        <p><?php echo $info['categoriaPt']. ' '. date('d/m/Y', strtotime($info['data'])). '<br><br>'?></p>
                        <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                        <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo']);?>" alt="">
                        <p><?php echo $info['descricaoPt']?></p>
                    </div>
                    <?php endforeach?>
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
    
    