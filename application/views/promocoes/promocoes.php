<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
<!-- <script src="<?php base_url('/assets/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?php base_url('/assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
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

                <h1 class="tituloPadrao1">
                    <span>Promoções</span>
                </h1>
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
                <?php foreach($banner_tipo2 as $info):?>
                    <a class='registra_click_publicidade' codPublicidade="<?= $info['cod'];?>" href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach?>
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