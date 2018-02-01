<?php
if(!verifica_permissao($cod_user, $nivel, 'publicidade'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}

$cliente = isset($_GET['cliente']) ? $_GET['cliente'] : '';
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_PATH."_publicidade/inc/topo-publicidade-lista.php";

?>
<script>
    
$(document).ready(function()
{
    $(".mostrar").click(function()
    {
        _obj = $(this);
        _mostrar = _obj.is(':checked') ? '1' : '0';
        _cod = _obj.val();
        _obj.hide();
        _obj.parent().prepend("<img class='imgLoad' title='Carregando' src='http://"+ADMIN_URL+"/img/base/conteudo/load.gif' />");
        
        $.ajax(
        {
            type: "POST",
            async: false,
            url: "http://"+ADMIN_URL+"/_publicidade/ajax/ajaxMostrarLista.php", //URL de destino
            data:
            {
                cod: _cod,
                mostrar: _mostrar
            },
            dataType: "json"
        })
        .done(function(_json)
        { //Se ocorrer tudo certo
            
            if(_json.erro != 0)
            {
                _valor = _mostrar == 1 ? 0 : 1;
                if(_valor == 0)
                {
                    _obj.removeAttr("checked");
                }
                else
                {
                    _obj.attr("checked","true");
                }
            }
            _obj.parent().find('.imgLoad').remove();
            _obj.show();
        });
    }); 
    
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
        <div class="divTd">Cliente</div>
        <div class="divTd">Página</div>
        <div class="divTd">Posição</div>
        <div class="divTd">Data início</div>
        <div class="divTd">Data fim</div>
        <div class="divTd">Mostrar</div>
    </div>
    <?

    $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';

    // $q = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
    //                 INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
    //                 INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
    //                 WHERE p.regiao = '$regiao'
    //                 ORDER BY p.codPagina, pt.cod");
    // $n = mysql_num_rows($q);

    // //echo mysql_error();

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

    if(isset($_GET['banner'])) {
        $codBanner = $_GET['banner'];
        $q = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
<<<<<<< HEAD
                     INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                     INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                     WHERE p.regiao = '$regiao'
                     AND p.codCliente = $codBanner
                     ORDER BY p.codPagina", $conexao);

        $rows = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
                INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                WHERE p.regiao = '$regiao'", $conexao);

        $count_registros = mysql_num_rows($rows);

    }else{


    $limit_por_pag = 30;
    $q = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
=======
>>>>>>> 772edf64c293185450ed63cac6a5e70d34788ffa
                     INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                     INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                     WHERE p.regiao = '$regiao'
                     AND p.codCliente = $codBanner
                     ORDER BY p.codPagina", $conexao);

        $rows = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
                INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                WHERE p.regiao = '$regiao'", $conexao);

        $count_registros = mysql_num_rows($rows);

<<<<<<< HEAD
=======
    }else{


        $limit_por_pag = 30;
        $q = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
                        INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                        INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                        WHERE p.regiao = '$regiao'
                        ORDER BY p.codPagina, pt.cod LIMIT $pag, $limit_por_pag", $conexao);
        
        $rows = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
                        INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                        INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                        WHERE p.regiao = '$regiao'", $conexao);

        $count_registros = mysql_num_rows($rows);
        $paginas = ceil($count_registros / $limit_por_pag);

>>>>>>> 772edf64c293185450ed63cac6a5e70d34788ffa
    }
    
    if ($count_registros>0)
    {
    	while($tp = mysql_fetch_assoc($q))
    	{
            $qClientes = mysql_query("SELECT * FROM clientes WHERE cod = '{$tp['codCliente']}'");
            $nClientes = mysql_num_rows($qClientes);
    	    ?>
            <div class="divTr">
                <div class="divTd">
                    <input class="checks" name="cod[]" value="<?=$tp['cod'];?>" type="checkbox" />
                </div>
                <div class="divTd">                
                    <?
                    if($nClientes>0) 
                    {
                        $tpCliente = mysql_fetch_assoc($qClientes)
                        ?>
                        <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                            <?
                            if($tpCliente['tipoPessoa'] == 'j'){
                                echo $tpCliente['razaoSocial'];
                            }elseif($tpCliente['tipoPessoa'] == 'f'){
                                echo $tpCliente['nome']." ".$tpCliente['sobrenome'];;
                            }
                            ?>
                        </a>
                        <?
                    }
                    ?>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=$tp['pagina'];?>
                    </a>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=$tp['tipo'];?>
                    </a>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=dataBr($tp['dataInicio']);?>
                    </a>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=dataBr($tp['dataFim']);?>
                    </a>
                </div>
                <div class="divTd">
                    <input type="checkbox" class="mostrar" value="<?=$tp['cod'];?>" <?=$tp['mostrar'] == 1 ? "checked='checked'" : "";?> />
                </div>
            </div>
        <?
        }
    }
    else
    {
    ?>
    </div>    
    <div>
        Nenhum Registro Encontrado.
    <?php
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

            
            <?php if(isset($limit_por_pag) && $count_registros > $limit_por_pag):?>
                <?php if($p > 1):?>
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$anterior;?>">Anterior</a>
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$anterior;?>"><?=$anterior;?></a>
                <?php endif?>
                
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$p;?>"><?=$p;?></a>

                <?php if($pag+10 <= $count_registros):?>
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$proxima;?>"><?=$proxima;?></a>
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$proxima;?>">Proximo</a>
                <?php endif?>
                <?= '<br>Total de Páginas: '. $paginas?>
            <?php endif;?>              

            
            
                
        </div>
    </div>
</div>