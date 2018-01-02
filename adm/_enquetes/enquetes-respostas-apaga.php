<?php
if(!verifica_permissao($cod_user, $nivel, 'enquetes'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_PATH."/_enquetes/func/funcoes.php";

$codPergunta = isset($_GET['codPergunta']) ? $_GET['codPergunta'] : '';
$codResposta = isset($_GET['codResposta']) ? $_GET['codResposta'] : '';

if($codResposta != '')
{
    $erros = 0;

    /** EXCLUIR CATEGORIA */
    $sqlDel = "DELETE FROM enquetesRespostas WHERE cod = '{$codResposta}' LIMIT 1";
    for($a=0;$a<5;$a++)
    {
        $qDel = mysql_query($sqlDel);
        if($qDel)
        {
            break;
        }
    }
    if(!$qDel)
    {
        $erros++;
    }
    /** FIM - EXCLUIR CATEGORIA */                    

    if($erros > 0)
    {
    ?>
        <script>
            alert("Erro ao excluir <?=$erros;?> ite<?=$erros > 1 ? "ns" : "m";?>!")
            document.location.replace("http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$codPergunta;?>");
        </script>
    <?php
    die();
    }
    else
    {
    ?>
        <script>
            alert("Registro(s) excluído(s) com sucesso!");
            document.location.replace("http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$codPergunta;?>");
        </script>
    <?php
    die();
    }
}
else
{
    ?>
        <script>
            alert("Nenhum registro selecionado!");
            document.location.replace("http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$codPergunta;?>");
        </script>
    <?php
    die();
}
?>