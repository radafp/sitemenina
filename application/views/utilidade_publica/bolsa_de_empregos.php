<script src="<?php echo base_url('/assets/js/popper.min.js')?>"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript">
     $(document).ready(function(){
        $('.noticia').DataTable();
        $('.mais_lidas').DataTable();
        $(".dataTables_length").hide();
        $("#DataTables_Table_0_filter").hide();
        $("thead").hide();
        $(".dataTables_info").hide();
        $("#registros_filter").hide();
        $("#registros_info").hide();
        
        var count = $("#count_dados").html();
        if(count < 10) {
            $('#DataTables_Table_0_paginate').hide();
        } 
    });
</script>
<div class='programacao'>
    <div class='programacoes'>
        <h2>Empregos</h2><br><br>
        <div id='prog'>
            <table class='noticia' data-page-length='10' class="table table-striped table-bordered" cellspacing="0" width="20%">
                <thead>
                    <tr>
                        <td>.</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($empregos as $info):?>
                    <tr>
                        <td>
                            <div id='esquerda'>
                                <img src="<?php echo base_url('/assets/arquivos/empregos/'.$info['arquivo'])?>" alt="">
                                <h3><?php echo $info['descricao']?></h3>
                                <p><?php echo $info['telefone']?></p>
                                <span><?php echo 'Publicado :'.$info['dataPublicacao'];?></span><br>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody> 
            </table>
        </div>
    </div>

</div><br><br><br>