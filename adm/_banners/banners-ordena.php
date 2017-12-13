<?php
if(!verifica_permissao($cod_user, $nivel, 'banners-ordena'))
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
    $(".drag").sortable();
    
    $("#salvar").click(function()
    {
		_tipo = $("#tipo").val();
        ordem = new Array();
		$(".drag").children().each(function()
        {
			ordem.push($(this).data("cod"));
		});	
        
        $.ajax(
        {
            type: "POST",
            async: false,
            url: "http://"+ADMIN_URL+"/_banners/ajax/ajaxOrdena.php", //URL de destino
            data:
            {
                ordem : ordem
            },
            dataType: "json"
        })
        .done(function(_json)
        { //Se ocorrer tudo certo
            
            if(_json.erro == 0)
            {
                alert("Ordenação efetuada com sucesso!");
                document.location.reload();
            }
            else
            {
                alert("Erro ao efetuar ordenação!");
            }
            
        });
    });
});
</script>
<div style="float: right !important;">
    <input type="submit" value="Salvar ordem" id="salvar" class="salvar" />
</div>
<div class="divTableLista clear">
    <div class="divTr head">
        <div class="divTd">&nbsp;</div>
        <div class="divTd">Banner</div>
        <div class="divTd">Lingua</div>
    </div>
</div>
<div class="divTableLista clear drag" style="margin-top: 0;">
    <?
    $q = mysql_query("SELECT * FROM banners ORDER BY ordem", $conexao);
    $n = mysql_num_rows($q);

    if ($n>0)
    {
    	while($tp = mysql_fetch_assoc($q))
    	{
            $qFotos = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '{$tp['cod']}' AND tipo = '2' AND referencia = 'banners' ORDER BY cod ASC LIMIT 1");
            $nFotos = mysql_num_rows($qFotos);
    	?>
            <div class="divTr" style="cursor: all-scroll;" data-cod="<?=$tp['cod'];?>">
                <div class="divTd">
                    <img src="<?=ssl().ADMIN_URL;?>/img/base/conteudo/ico-ordenacao.png" />
                </div>
                <div class="divTd">
                    <?
                    while($tpFotos = mysql_fetch_assoc($qFotos))
                    {
                    ?>
                        <img style="width: 300px;" src="http://<?=PROJECT_URL.'/arquivos/banners/'.$tpFotos['arquivo'];?>" title="<?=$tpFotos['legenda'];?>" />
                    <?
                    }
                    ?>  
                </div>
                <div class="divTd">
                    <?=$tp['ordem'];?> 
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