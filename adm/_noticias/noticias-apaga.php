<?php
if(!verifica_permissao($cod_user, $nivel, 'jornalismo'))
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
    foreach($cods as $k => $codNoticia)
    {
        /** EXCLUIR ARQUIVOS - NOTICIAS */
        $qNoticias = mysql_query("SELECT * FROM noticias WHERE cod = '{$codNoticia}'");
        while($tpNoticias = mysql_fetch_assoc($qNoticias))
        {
            $qArquivosNoticias = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '{$tpNoticias['cod']}' AND referencia = 'noticias'");
            while($tpArquivosNoticias = mysql_fetch_assoc($qArquivosNoticias))
            {
                for($a=0;$a<5;$a++)
                {
                    $unlink = @unlink(PROJECT_PATH."arquivos/noticias/".$tpArquivosNoticias['arquivo']);
                    if($unlink)
                    {
                        break;
                    }
                }
                $sqlDelArquivosNoticias = "DELETE FROM arquivos WHERE cod = '{$tpArquivosNoticias['cod']}'";
                for($a=0;$a<5;$a++)
                {
                    $qDelArquivosNoticias = mysql_query($sqlDelArquivosNoticias);
                    if($qDelArquivosNoticias)
                    {
                        break;
                    }
                }
            }
            $sqlDelNoticias = "DELETE FROM noticias WHERE cod = '{$tpNoticias['cod']}'";
            for($a=0;$a<5;$a++)
            {
                $qDelNoticias = mysql_query($sqlDelNoticias);
                if($qDelNoticias)
                {
                    break;
                }
            }
            if(!$qDelNoticias)
            {
                $erros++;
            }
        }
        /** FIM - EXCLUIR ARQUIVOS - NOTICIAS */
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
        atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Novidades', 'Removeu', $_SESSION[ADMIN_SESSION_NAME.'_regiao'], $count);
        
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