<?php
if(!verifica_permissao($cod_user, $nivel, 'artistico'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_PATH."_videos/inc/topo-videos-lista.php";
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
        _obj.parent().append("<img class='imgLoad' title='Carregando' src='http://"+ADMIN_URL+"/img/base/conteudo/load.gif' />");
        
        $.ajax(
        {
            type: "POST",
            async: false,
            url: "http://"+ADMIN_URL+"/_videos/ajax/ajaxMostrarLista.php", //URL de destino
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
        <div class="divTd">Thumbnail</div>
        <div class="divTd">Titulo</div>
        <!--<div class="divTd">Ordem</div>-->
        <div class="divTd">Mostrar</div>
    </div>
    <?

    $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';

    $q = mysql_query("SELECT * FROM videos WHERE regiao = '{$regiao}' ORDER BY cod desc", $conexao);
    $n = mysql_num_rows($q);

    if ($n>0)
    {
    	while($tp = mysql_fetch_assoc($q))
    	{
    	?>
            <div class="divTr">
                <div class="divTd">
                    <input class="checks" name="cod[]" value="<?=$tp['cod'];?>" type="checkbox" />
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <? 
                        $imagemCapa = '';                
                        $output = array();
                        $url = $tp['link'];
                        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $output);
                        $imagemCapa = ssl().'img.youtube.com/vi/' . $output[0] . '/0.jpg';
                        ?>
                        <img src="<?=$imagemCapa;?>" style="max-width:100px">
                    </a>
                </div>
                <div class="divTd">
                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                        <?=$tp['titulo'];?>
                    </a>
                </div>
                <!--
                <div class="divTd">
                    <?=$tp['ordem'];?>
                </div>
                -->
                <div class="divTd">
                    <input type="checkbox" class="mostrar" value="<?=$tp['cod'];?>" <?=$tp['mostrar'] == 1 || $subid == 2 ? "checked='checked'" : "";?> />
                </div>
            </div>
        <?
        }
        ?>

    <?
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