<?php
if(!verifica_permissao($cod_user, $nivel, 'programacao'))
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
    foreach($cods as $k => $codProgramacao)
    {
        /** EXCLUIR ARQUIVOS - Programacao */
        $qProgramacao = mysql_query("SELECT * FROM programacao WHERE cod = '{$codProgramacao}'");
        while($tpProgramacao = mysql_fetch_assoc($qProgramacao))
        {
            $qArquivosProgramacao = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '{$tpProgramacao['cod']}' AND referencia = 'programacao'");
            while($tpArquivosProgramacao = mysql_fetch_assoc($qArquivosProgramacao))
            {
                for($a=0;$a<5;$a++)
                {
                    $unlink = @unlink(PROJECT_PATH."arquivos/programacao/".$tpArquivosProgramacao['arquivo']);
                    if($unlink)
                    {
                        break;
                    }
                }
                $sqlDelArquivosProgramacao = "DELETE FROM arquivos WHERE cod = '{$tpArquivosProgramacao['cod']}'";
                for($a=0;$a<5;$a++)
                {
                    $qDelArquivosProgramacao = mysql_query($sqlDelArquivosProgramacao);
                    if($qDelArquivosProgramacao)
                    {
                        break;
                    }
                }
            }
            $sqlDelProgramacao = "DELETE FROM programacao WHERE cod = '{$tpProgramacao['cod']}'";
            for($a=0;$a<5;$a++)
            {
                $qDelProgramacao = mysql_query($sqlDelProgramacao);
                if($qDelProgramacao)
                {
                    break;
                }
            }
            if(!$qDelProgramacao)
            {
                $erros++;
            }
        }
        /** FIM - EXCLUIR ARQUIVOS - Programacao */
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