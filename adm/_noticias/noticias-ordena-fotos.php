<?php
if(!verifica_permissao($cod_user, $nivel, 'produtos-ordena'))
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
		_codReferencia = $("#codReferencia").val();
        ordem = new Array();
		$(".drag").children().each(function()
        {
			ordem.push($(this).data("cod"));
		});	
        
        $.ajax(
        {
            type: "POST",
            async: false,
            url: "http://"+ADMIN_URL+"/_noticias/ajax/ajaxOrdenaFotos.php", //URL de destino
            data:
            {
                ordem : ordem,
                codReferencia : _codReferencia
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
<!--<br class="clear" />-->
<div style="float: right !important;">
    <input type="hidden" id="codReferencia" value="<?=$cod;?>" />
    <input type="submit" value="Salvar ordem" id="salvar" class="salvar" />
</div>
<div class="divTableLista clear">
    <div class="divTr head">
        <div class="divTd">&nbsp;</div>
        <div class="divTd">Imagem</div>
        <div class="divTd">capa</div>
        <div class="divTd">ordem</div>
    </div>
</div>
<div class="divTableLista clear drag" style="margin-top: 0;">
    <?
    $q = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '$cod' AND tipo = '2' AND referencia = 'noticias' ORDER BY ordem ASC", $conexao);
    //echo mysql_error();
    $n = mysql_num_rows($q);
    if($n>0)
    {
        
    	while($tp = mysql_fetch_assoc($q))
    	{
            
    	?>
            <div class="divTr" style="cursor: all-scroll;" data-cod="<?=$tp['codigo'];?>">
                <div class="divTd">
                    <img src="<?=ssl().ADMIN_URL;?>/img/base/conteudo/ico-ordenacao.png" />
                </div>
                <div class="divTd">
                    <img src="<?=ssl().PROJECT_URL.'/assets/arquivos/noticias/'.$tp['arquivo'];?>" title="<?=$tp['legenda'];?>" style="max-width: 150px;" />
                </div>
                <div class="divTd">
                    <?=$tp['capa'] == 1 ? 'SIM' : 'NÃO';?>
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