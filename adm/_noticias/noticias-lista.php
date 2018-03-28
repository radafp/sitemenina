<?php
if(!verifica_permissao($cod_user, $nivel, 'jornalismo'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_PATH."_noticias/inc/topo-noticias-lista.php";
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
            url: "http://"+ADMIN_URL+"/_noticias/ajax/ajaxMostrarLista.php", //URL de destino
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

    $(".destaque").click(function()
    {
        _obj = $(this);
        _destaque = _obj.is(':checked') ? '1' : '0';
        _cod = _obj.val();
        _obj.hide();
        _obj.parent().prepend("<img class='imgLoad' title='Carregando' src='http://"+ADMIN_URL+"/img/base/conteudo/load.gif' />");
        
        $.ajax(
        {
            type: "POST",
            async: false,
            url: "http://"+ADMIN_URL+"/_noticias/ajax/ajaxDestaqueLista.php", //URL de destino
            data:
            {
                cod: _cod,
                destaque: _destaque
            },
            dataType: "json"
        })
        .done(function(_json)
        { //Se ocorrer tudo certo
            
            if(_json.erro != 0)
            {
                _valor = _destaque == 1 ? 0 : 1;
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
        <div class="divTd">Data</div>
        <div class="divTd">Categoria</div>
        <div class="divTd">Título</div>
        <div class="divTd">Fotos</div>
        <div class="divTd">Destaque</div>
        <div class="divTd">Mostrar</div>
    </div>
    <?
    $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';

    if(isset($_GET['p'])) {
        $pg = $_GET['p'];
    }else{
        $pg = 0;
    }

    $pag = ($pg - 1) * 30;
    if($pag < 0) {
        $pag = 0;
    }    

    $limit_por_pag = 30;

    if($categoria != ''):
        $parametro = " AND codCategoria = '{$categoria}' ";
    else:
        $parametro = "";
    endif;

    $q = mysql_query("SELECT * FROM noticias WHERE regiao = '{$regiao}' ".$parametro."  ORDER BY data DESC, cod DESC LIMIT $pag, $limit_por_pag", $conexao);
    
    $rows = mysql_query("SELECT * FROM noticias WHERE regiao = '{$regiao}' ".$parametro." ", $conexao);
    //echo mysql_error();
    $count_registros = mysql_num_rows($rows);
    $paginas = ceil($count_registros / $limit_por_pag);

    if ($count_registros>0)
    {
    	while($tp = mysql_fetch_assoc($q))
    	{
            $qCategoria = mysql_query("SELECT cod, categoriaPt FROM categorias WHERE cod = '{$tp['codCategoria']}' ORDER BY categoriaPt DESC", $conexao);
            $tpCategoria = mysql_fetch_assoc($qCategoria);

            $qFotos = mysql_query("SELECT cod FROM arquivos WHERE codReferencia = '{$tp['cod']}' AND tipo = '2' AND referencia = 'noticias'");
            $nFotos = mysql_num_rows($qFotos);
            ?>
            <div class="divTr">
                <div class="divTd">
                    <input class="checks" name="cod[]" value="<?=$tp['cod'];?>" type="checkbox" />
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=dataBr($tp['data']);?>
                    </a>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=$tpCategoria['categoriaPt'];?>
                    </a>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=$tp['tituloPt'];?>
                    </a>
                </div>
                <div class="divTd">
                    <?
                    if($nFotos > 0)
                    {
                    ?>
                        <a class="link" href="<?=ssl().ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=6&cod=<?=$tp['cod'];?>">
                            Ordenar
                        </a>
                    <?
                    }
                    else
                        echo '-';
                    ?>
                </div>
                <div class="divTd">
                    <input type="checkbox" class="destaque" value="<?=$tp['cod'];?>" <?=$tp['destaque'] == 1 ? "checked='checked'" : "";?> />
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
        <div>
            Nenhum Registro Encontrado.
        </div>
    <?
    }
    ?>
</div>

<div class="divTableLista clear">
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
    ?>
    <?php if($count_registros > $limit_por_pag):?>
        <div class="divTr">
            <div class="divTd">
                
                    <?php if($p > 1):?>
                        <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$anterior;?>">Anterior</a>
                        <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$anterior;?>"><?=$anterior;?></a>
                    <?php endif?>
                    
                        <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$p;?>"><?=$p;?></a>

                    <?php if($pag+10 <= $count_registros):?>
                        <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$proxima;?>"><?=$proxima;?></a>
                        <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$proxima;?>">Proximo</a>
                    <?php endif?>
                            
            </div>
        </div>
    <?php endif;?> 
    <div class="divTr">
        <div class="divTd">
            Total de Páginas: <?=$paginas;?>
        </div>
    </div>
    <div class="divTr">
        <div class="divTd">
            Número de registros: <?=$count_registros;?>
        </div>
    </div>
</div>
