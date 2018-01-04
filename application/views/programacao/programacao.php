<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?php base_url('/assets/vendor/jquery/jquery.min.js')?>"></script> -->
<!-- <script src="<?php base_url('/assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->

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

            <div class="col-xs-12 col-md-8 contLeft">

                <h1 class="tituloPadrao1">
                    <span>Programação</span>
                </h1>
                <?php
                $menuAtivoProgramacao =  isset($_SESSION['menuAtivoProgramacao']) ? $_SESSION['menuAtivoProgramacao'] : 'Semanal';
                //echo $menuAtivoProgramacao;
                ?>
                <div class="blocoMenuProgramacao">
                    <ul class="menuProgramacao">
                        <li class="semanal<?=($menuAtivoProgramacao == 'Semanal') ? ' ativo' : '';?>">
                            <a class='link_programacao' href="<?php echo base_url('home/programacao?programacao=Semanal')?>">SEMANAL</a>
                        </li>
                        <li class="sabado<?=($menuAtivoProgramacao == 'Sabado') ? ' ativo' : '';?>">
                            <a class='link_programacao' href="<?php echo base_url('home/programacao?programacao=Sabado')?>">SÁBADO</a>
                        </li>
                        <li class="domingo<?=($menuAtivoProgramacao == 'Domingo') ? ' ativo' : '';?>">
                            <a class='link_programacao' href="<?php echo base_url('home/programacao?programacao=Domingo')?>">DOMINGO</a>
                        </li>
                    </ul>
                </div>
                <div class="blocoProgramacao">
                    <?php 
                    $i=0;
                    foreach($programacao_impar as $info):
                        $classeAdicionalPrograma = (($i%2) == 0) ? '' : ' programaRight';
                        $classeAdicionalConexaoPrograma = (($i%2) == 0) ? '' : ' conexaoProgramaRight';
                        ?>
                            
                        <div class="linhaPrograma">
                            <div class="programa<?=$classeAdicionalPrograma;?>">        
                                <a class='link_programacao' href="<?php echo base_url('home/descricao_programacao?id='.$info['cod'].'&regiao='.strtolower($info['regiao']))?>">  
                                    <div class="foto">
                                        <img src="<?php echo base_url('assets/arquivos/programacao/'.$info["arquivo"])?>" alt="">
                                    </div>
                                    <h3><?php echo $info['titulo']?></h3>
                                    <div class="infos">
                                        <p><?php echo 'HORÁRIO: '.$info['horario'];?></p>
                                        <p><?php echo 'APRESENTADOR: '. $info['apresentador'];?></p>
                                    </div>
                                </a>
                            </div>
                            <div class="conexaoPrograma<?=$classeAdicionalConexaoPrograma;?>">
                                <img src="<?php echo base_url('assets/img/conexaoProgramas.png');?>" alt="">
                            </div>
                        </div>
                        
                        <?php 
                        $i = $i + 1;
                    endforeach;
                    ?>
                    <?php foreach($banner_tipo3 as $info):?>
                        <a href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                    <?php endforeach?>
                </div>
                <?php foreach($banner_tipo2 as $info):?>
                    <a href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach?>

            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-4 contRight">
                <?php foreach($banner_tipo2 as $info):?>
                    <a href=<?= $info['link']?> target='__blank'><img src=<?= base_url('/assets/arquivos/publicidade/'.$info['arquivo'])?> title="Publicidade"></a>
                <?php endforeach?>
                <h1 class="tituloPadrao3">
                    <span>Playlist Radio Menina</span>
                    aqui
                </h1>

                

            </div> <!-- contRight -->

        
        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 
