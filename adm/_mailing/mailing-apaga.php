<?php
if(!verifica_permissao($cod_user, $nivel, 'mailing-apaga'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_PATH."/_mailing/func/funcoes.php";

$cods = isset($_GET['cod']) ? $_GET['cod'] : '';

if($cods != '')
{
    $cods = is_array($cods) ? $cods : array($cods);
    $erros = 0;
    foreach($cods as $k => $codMailing)
    {
        /** EXCLUIR ARQUIVOS - MAILING */
        $qMailing = mysql_query("SELECT * FROM mailing WHERE cod = '{$codMailing}'");
        while($tpMailing = mysql_fetch_assoc($qMailing))
        {
            $qArquivosMailing = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '{$tpMailing['cod']}' AND referencia = 'mailing'");
            while($tpArquivosMailing = mysql_fetch_assoc($qArquivosMailing))
            {
                for($a=0;$a<5;$a++)
                {
                    $unlink = @unlink(PROJECT_PATH."arquivos/mailing/".$tpArquivosMailing['arquivo']);
                    if($unlink)
                    {
                        break;
                    }
                }
                $sqlDelArquivosMailing = "DELETE FROM arquivos WHERE cod = '{$tpArquivosMailing['cod']}'";
                for($a=0;$a<5;$a++)
                {
                    $qDelArquivosMailing = mysql_query($sqlDelArquivosMailing);
                    if($qDelArquivosMailing)
                    {
                        break;
                    }
                }
            }
            $sqlDelMailing = "DELETE FROM mailing WHERE cod = '{$tpMailing['cod']}'";
            for($a=0;$a<5;$a++)
            {
                $qDelMailing = mysql_query($sqlDelMailing);
                if($qDelMailing)
                {
                    break;
                }
            }
            if(!$qDelMailing)
            {
                $erros++;
            }
        }
        /** FIM - EXCLUIR ARQUIVOS - Mailing */
    }
    reordenarMailing();
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