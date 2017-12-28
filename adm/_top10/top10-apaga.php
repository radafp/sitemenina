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
require_once ADMIN_PATH."/_top10/func/funcoes.php";

$cods = isset($_GET['cod']) ? $_GET['cod'] : '';
if($cods != '')
{
    $cods = is_array($cods) ? $cods : array($cods);
    $erros = 0;
    foreach($cods as $k => $codVideo)
    {
        $q = mysql_query("SELECT * FROM top10 WHERE cod = '$codVideo'");
        while($tp = mysql_fetch_assoc($q))
        {
                    
            /** EXCLUIR */
            $sqlDel = "DELETE FROM top10 WHERE cod = '{$tp['cod']}' LIMIT 1";
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
            /** FIM - EXCLUIR */
        }
    }
    reordenarTop10();
    if($erros > 0)
    {
        ?>
        <script>
            alert("Erro ao excluir <?=$erros;?> ite<?=$erros > 1 ? "ns" : "m";?>!")
            document.location.replace("http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1");
        </script>
        <?php
        die();
    }
    else
    {
        ?>
        <script>
            alert("Registro(s) excluído(s) com sucesso!");
            document.location.replace("http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1");
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
            document.location.replace("http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1");
        </script>
        <?php
        die();
}
?>