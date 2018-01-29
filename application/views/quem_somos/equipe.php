<script type="text/javascript">
     $(document).ready(function(){

        var content = $('#content');
        $('.paginacao_equipe, .link_descricao').click(function( e ){
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

            window.history.pushState(null, 'Home', $(this).attr('href'));
        });
    });
</script>

<div class="container">  
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-12 contLeftRight">
                <h1 class="tituloPadrao1">
                    <span>Equipe</span>
                </h1>
            </div>
        </div>
        <div class="blocoEquipe">
            <div class="row">
                <div class="fotoEquipe">
                    <img src="<?=base_url('/assets/img/equipe_'.$_SESSION['regiao'].'.png');?>" alt="">
                </div> 
                <div class="col-12 contLeftRight">
                    <h1 class="tituloPadrao1">
                        <span>Locutores</span>
                    </h1>
                </div>
                <?php foreach($equipe as $info):?>
                    <div class="col-md-3">
                        <a class="link_descricao" href="<?php echo base_url('home/descricao_equipe?id='.$info['cod']);?>">
                            <div style="text-align:center">
                                <img style="max-width:80%; text-align:center" src="<?php echo base_url('/assets/arquivos/equipe/'.$info['arquivo'])?>" alt="">
                            </div>
                            <p style="margin-top:20px; text-align:center"><?= $info['tituloPt'];?></p>
                        </a>
                    </div>
                <?php endforeach;?>
            </div>  <!-- row --> 
        </div>
    </div>
</div> <!-- container --> 
