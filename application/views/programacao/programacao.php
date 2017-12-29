<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
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
    });
</script>
<div class="container">
    <div class="blocoConteudo">
        <div class="row">
        
            <div class="col-xs-12 col-md-9">
                <div class='programacao'>
                    <div class='programacoes'>
                        <h1 class="tituloPadrao1">
                            <span>Programações</span>
                        </h1>
                        <ul>
                            <li>
                                <a class='link_descricao' href="<?php echo base_url('home/programacao?programacao=Semanal')?>">SEMANAL</a>
                            </li>
                            <li>
                                <a class='link_descricao' href="<?php echo base_url('home/programacao?programacao=Sabado')?>">SÁBADO</a>
                            </li>
                            <li>
                                <a class='link_descricao' href="<?php echo base_url('home/programacao?programacao=Domingo')?>">DOMINGO</a>
                            </li>
                        </ul>   
                        <div id='prog'>
                            <?php foreach($programacao_impar as $info):?>
                                <div id='esquerda'>
                                <a class='link_programacao' href="<?php echo base_url('home/descricao_programacao?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                                
                                    <img src="<?php echo base_url('assets/arquivos/programacao/'.$info["arquivo"])?>" alt="">
                                    <h3><?php echo $info['titulo']?></h3>
                                    <p><?php echo $info['descricao']?></p>
                                    <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span>
                                    <p><?= 'ATENCÂO!!!!!'. $info['programacao']?></p>
                                    <p>------------------------------------------------------------</p>
                                </a>
                                </div>
                            <?php endforeach?>

                            <!-- <?php foreach($programacao_par as $info):?> -->
                                <div id='direita'>
                                <!-- <a href="<?php echo base_url('home/descricao_programacao?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">
                                    <h3><?php echo $info['titulo']?></h3>
                                    <p><?php echo $info['descricao']?></p>
                                    <span><?php echo 'HORÀRIO:'.$info['horario'].'<br>APRESENTADOR:'. $info['apresentador']?></span> -->
                                </div>
                            <!-- <?php endforeach?> -->
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-xs-12 col-md-3">
                <div class='playlist'>
                    <h2>Playlist Radio Menina</h2>
                </div>
            </div> 

        
        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 
