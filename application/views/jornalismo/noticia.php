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
});
</script>
<div class='programacao'>
    <div class='programacoes'>
        <h2>Ultimas noticias</h2><br>
        <div id='prog'>
            <div id='esquerda'>
                <table class='noticia' data-page-length='2' class="table table-striped table-bordered" cellspacing="0" width="20%">
                    <thead>
                        <tr>
                            <td>.</td>
                        </tr>
                    </thead>
        
                    <tbody>
                    <?php foreach($jornalismo as $info):?>
                    <?php foreach($qFotosNoticias as $info):?>
                        <td>
                            <a href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']))?>">
                            <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                            <h3><?php echo $info['tituloPt']?></h3>
                            <p><?php echo $info['categoriaPt'] . ' ' . date('d/m/Y', strtotime($info['data']))?></p>
                            </a> 
                        </td>
                    </tr>
                    <?php endforeach?>    
                    </tbody> 
                </table>
            </div>  
        </div>
    </div>

<div class='playlist'><br><br>
    <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="" width='300'>
    <h2>As mais lidas</h2>
    
    <div id='direita'>
        <table class='mais_lidas' data-page-length='4' class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td>.</td>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($mais_lidas as $info):?>
                <tr>
                    <td>
                        <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                        <p><?php echo $info['categoriaPt']?></p>
                        <h3><?php echo $info['tituloPt']?></h3>
                    </td>
                </tr>
            <?php endforeach?>    
            </tbody>
        </table>
    </div>
</div>
</div><br><br><br>
