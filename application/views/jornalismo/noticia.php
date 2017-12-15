
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript">
 $(document).ready(function(){
                $('#noticia').DataTable();
                $('#noticia2').DataTable();
            });
</script>
<div class='programacao'>
    <div class='programacoes'>
        <h2>Ultimas noticias</h2><br>
        <div id='prog'>
            <div id='esquerda'>
                <table id='noticia' data-page-length='2' class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <td>.</td>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach($jornalismo as $info):?>
                    <tr> 
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
        <table id='noticia2' data-page-length='4' class="table table-striped table-bordered" cellspacing="0" width="100%">
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
