<script src="<?php echo base_url('/assets/js/popper.min.js')?>"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
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
<div class='programacao'>
    <div class='programacoes'>
        <h2>Descrição da Notícia</h2><br>
        <div id='prog'>
            <?php foreach($descricao_noticia as $info):?>
            <div id='esquerda'>
                <p><?php echo $info['categoriaPt']. ' '. date('d/m/Y', strtotime($info['data'])). '<br><br>'?></p>
                <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                <img src="<?php if(isset($info['arquivo'])) {echo base_url('/assets/arquivos/noticias/'.$info['arquivo']);}?>" alt="">
                <p><?php echo $info['descricaoPt']?></p>
            </div>
            <?php endforeach?>
        </div>
    </div>

    <div class='playlist'><br><br>
        <h2>As mais lidas</h2>
        <div id='direita'>
        <table class='noticia' data-page-length='4' class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td>.</td>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($mais_lidas as $info):?>
                <tr>
                    <td>
                    <a class="link_descricao" href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']))?>">
                        <p><?php echo $info['categoriaPt']. ' '. date('d/m/Y', strtotime($info['data'])). '<br><br>'?></p>
                        <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                        <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo'])?>" alt="">
                    </a>
                        <!-- <p><?php echo $info['descricaoPt']?></p> -->
                    </td>
                </tr>
            <?php endforeach?>    
            </tbody>
        </table>
    </div>
</div><br><br><br>
