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
                    <a href="<?php echo base_url('home/descricao_noticia?id='.$info['cod'].'&categoria='.strtolower($info['categoriaPt']))?>">
                        <p><?php echo $info['categoriaPt']. ' '. date('d/m/Y', strtotime($info['data'])). '<br><br>'?></p>
                        <h3><?php echo $info['tituloPt'].'<br>'?></h3>
                        <img src="<?php echo base_url('/assets/arquivos/noticias/'.$info['arquivo'])?>" alt="">
                    </a>
                        <p><?php echo $info['descricaoPt']?></p>
                    </td>
                </tr>
            <?php endforeach?>    
            </tbody>
        </table>
    </div>
</div><br><br><br>
