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

$cods = isset($_GET['cod']) ? $_GET['cod'] : '';
if($cods != '')
{
    $cods = is_array($cods) ? $cods : array($cods);
    $erros = 0;
    foreach($cods as $k => $cod)
    {
        /** EXCLUIR ARQUIVOS */
        $q = mysql_query("SELECT * FROM publicidades WHERE cod = '{$cod}'");
        while($tp = mysql_fetch_assoc($q))
        {
            $qArquivos = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '{$tp['cod']}' AND referencia = 'publicidade'");
            while($tpArquivos = mysql_fetch_assoc($qArquivos))
            {
                for($a=0;$a<5;$a++)
                {
                    $unlink = @unlink(PROJECT_PATH."assets/arquivos/publicidade/".$tpArquivos['arquivo']);
                    if($unlink)
                    {
                        break;
                    }
                }
                $sqlDelArquivos = "DELETE FROM arquivos WHERE cod = '{$tpArquivos['cod']}'";
                for($a=0;$a<5;$a++)
                {
                    $qDelArquivos = mysql_query($sqlDelArquivos);
                    if($qDelArquivos)
                    {
                        break;
                    }
                }
            }
            $sqlDel = "DELETE FROM publicidades WHERE cod = '{$tp['cod']}'";
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
            /*
            $sqlDelPublicidadeImpressoes = "DELETE FROM publicidadeImpressoes WHERE codPublicidade = '{$tp['cod']}'";
            for($a=0;$a<5;$a++)
            {
                $qDel = mysql_query($sqlDelPublicidadeImpressoes);
                if($qDel)
                {
                    break;
                }
            }
            $sqlDelPublicidadeStats = "DELETE FROM publicidadeStats WHERE codPublicidade = '{$tp['cod']}'";
            for($a=0;$a<5;$a++)
            {
                $qDel = mysql_query($sqlDelPublicidadeStats);
                if($qDel)
                {
                    break;
                }
            }
            */
        }
        /** FIM - EXCLUIR ARQUIVOS */
    }
    
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
        $count = count($cods);
        atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Publicidade', 'Removeu', $_SESSION[ADMIN_SESSION_NAME.'_regiao'], $count);
        
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