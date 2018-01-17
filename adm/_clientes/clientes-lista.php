<?php
if(!verifica_permissao($cod_user, $nivel, 'publicidade'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
?>
<script>
$(document).ready(function()
{
    $('.apagarTodos > a').click(function()
    {
        _link = $(this).data('link');
        _gets = new Array();
        $('input.checks:checked').each(function()
        {
            _name = $(this).attr('name');
            _value = $(this).val();
            _gets.push(_name+'='+_value); 
        });
        if(_gets.length > 0)
        {
            _confirm = confirm('Tem certeza que deseja excluir o(s) registro(s) selecionado(s)?');
            if(_confirm)
            {
                _url = _link+'&'+_gets.join('&');
                document.location.replace(_url);
            }
        }
        else
        {
            alert('Nenhum registro selecionado!');
        }
        return false;
    });
    $(".selecionarTodos > input[type='checkbox']").change(function()
    {
        if($(this).is(':checked'))
        {
            $('input.checks').attr('checked', 'true');
        }
        else
        {
            $('input.checks').removeAttr('checked');
        }
    })
});
</script>
<div class="divTableLista clear">
    <div class="divTr head">
        <div class="divTd">&nbsp;</div>
        <div class="divTd">Cód. Cliente</div>
        <div class="divTd">Nome</div>
        <div class="divTd">Telefone</div>
        <div class="divTd">Celular</div>
        <div class="divTd">Whatsapp</div>
    </div>
    <?
    // $q = mysql_query("SELECT * FROM clientes ORDER BY nome, razaoSocial ASC", $conexao);
    // $n = mysql_num_rows($q);

    // if ($n>0)
    if(isset($_GET['p'])) {
        $pg = $_GET['p'];
    }else{
        $pg = 0;
    }

    $pag = ($pg - 1) * 30;
    if($pag < 0) {
        $pag = 0;
    }
    // echo $pag;

    $limit_por_pag = 30;
    $q = mysql_query("SELECT * FROM clientes ORDER BY clientes.nome, clientes.razaoSocial ASC LIMIT $pag, $limit_por_pag", $conexao);
    
    $rows = mysql_query("SELECT * FROM clientes", $conexao);

    $count_registros = mysql_num_rows($rows);
    $paginas = ceil($count_registros / $limit_por_pag);

    if ($count_registros>0)
    {
        for($i=0;$i<$count_registros;$i++)
        {
            $tp = mysql_fetch_assoc($q);
        	?>
            <div class="divTr">
                <div class="divTd">
                    <input class="checks" name="cod[]" value="<?=$tp['cod'];?>" type="checkbox" />
                </div>
                <div class="divTd">
                    <?=$tp['cod'];?>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?php 
                        if($tp['tipoPessoa'] == "f"){
                            echo $tp['nome']." ".$tp['sobrenome'];
                        }
                        elseif($tp['tipoPessoa'] == "j"){
                            echo $tp['razaoSocial'];
                        }
                        ?>
                    </a>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=$tp['telefone'];?>
                    </a>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=$tp['celular'];?>
                    </a>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=$tp['whatsapp'];?>
                    </a>
                </div>
            </div>
            <?
        }
    }
    else
    {
    ?>
    <div style="width:100%">
        Nenhum Registro Encontrado.
    </div>
    <?
    }
    ?>
</div>

<div class="divTableLista clear">
    <div class="divTr">
        <div class="divTd">
            <!-- <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$p;?>">Anterior</a> -->

            <?php
            if(isset($_GET['p'])) {
                    $p = $_GET['p'];
                }else{
                    $p = 1;
                }

                if($p >= 1) {
                    $anterior = $p - 1;
                }
                if($p <= $count_registros) {
                    $proxima = $p + 1;
                }
                
                if($anterior <= 0) {
                    $anterior = 0;
                }
                if(isset($proxima) && $proxima >= $count_registros){
                    $proxima = $count_registros;
                }
                // echo '<br>cont de registros: '.$count_registros;
                // echo '<br>limit por paginas: '.$limit_por_pag;
                // echo '<br><br>';
                // echo '<br>p: '. $p;
                // echo '<br>$pag: '.$pag;
            ?><br><br>

                
            <?php if($count_registros > $limit_por_pag):?>
                <?php if($p > 1):?>
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$anterior;?>">Anterior</a>
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$anterior;?>"><?=$anterior;?></a>
                <?php endif?>
                
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$p;?>"><?=$p;?></a>

                <?php if($pag+10 <= $count_registros):?>
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$proxima;?>"><?=$proxima;?></a>
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$proxima;?>">Proximo</a>
                <?php endif?>
            <?php endif;?>              

            
            <?= '<br>Total de Páginas: '. $paginas?>
                
        </div>
    </div>
</div>