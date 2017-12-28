<?php
if(!verifica_permissao($cod_user, $nivel, 'utilidadePublica'))
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
        /** EXCLUIR ARQUIVOS  */
        $q = mysql_query("SELECT * FROM empregos WHERE cod = '{$cod}'");
        while($tp = mysql_fetch_assoc($q))
        {
            $qArquivos = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '{$tp['cod']}' AND referencia = 'empregos'");
            while($tpArquivos = mysql_fetch_assoc($qArquivos))
            {
                for($a=0;$a<5;$a++)
                {
                    $unlink = @unlink(PROJECT_PATH."assets/arquivos/empregos/".$tpArquivos['arquivo']);
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
            $sqlDel = "DELETE FROM empregos WHERE cod = '{$tp['cod']}'";
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