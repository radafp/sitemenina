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
?>
<script>
$(document).ready(function()
{
    $(".drag").sortable();
    
    $("#salvar").click(function()
    {
		ordem = new Array();
		$(".drag").children().each(function()
        {
			ordem.push($(this).data("cod"));
		});	
        
        $.ajax(
        {
            type: "POST",
            async: false,
            url: "http://"+ADMIN_URL+"/_top10/ajax/ajaxOrdena.php", //URL de destino
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
        <div class="divTd">Título</div>
        <div class="divTd">Ordem</div>
    </div>
</div>
<div class="divTableLista clear drag" style="margin-top: 0;">
    <?
    $q = mysql_query("SELECT * FROM top10 ORDER BY ordem", $conexao);
    //echo mysql_error();
    $n = mysql_num_rows($q);
    if($n>0)
    {
    	while($tp = mysql_fetch_assoc($q))
    	{
        ?>
            <div class="divTr" style="cursor: move;" data-cod="<?=$tp['cod'];?>">
                <div class="divTd">
                    <img src="<?=ssl().ADMIN_URL;?>/img/base/conteudo/ico-ordenacao.png" />
                </div>
                <div class="divTd">
                    <?=$tp['tituloPt'];?>
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