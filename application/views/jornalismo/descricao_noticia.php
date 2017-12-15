<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript">
 $(document).ready(function(){
                $('#noticia2').DataTable();
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
                <img src="<?php echo base_url('/assets/img/logoTVMocinha.png')?>" alt="">
                <p><?php echo $info['descricaoPt']?></p>
            </div>
            <?php endforeach?>
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
</div><br><br><br>
<?php 