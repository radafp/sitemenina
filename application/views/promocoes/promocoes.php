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

<div class='programacao'>
    <div class='programacoes'>
        <h2>Promoções</h2><br><br>
        <div id='prog'>
            <?php foreach($promocoes_impar as $info):?>
                <div id='esquerda'>
                <a class='link_descricao' href="<?php echo base_url('home/descricao_promocoes?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                <img src="<?php echo base_url('assets/arquivos/programacao/'.$info["arquivo"])?>" alt="" width='680px'>
                    <h3><?php echo $info['tituloPt']?></h3>
                    <!-- <p><?php echo $info['descricao']?></p> -->
                    <span><?php echo 'Início:'.$info['dataInicio']. "<br>Fim:". $info['dataFim']?></span><br>
                    <button>Participar</button>
                </div>
            <?php endforeach?>
        </div>
    </div>

</div><br><br><br>