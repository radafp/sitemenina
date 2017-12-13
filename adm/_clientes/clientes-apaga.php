<?php
if(!verifica_permissao($cod_user, $nivel, 'artistas-apaga'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_PATH."/_artistas/func/funcoes.php";

$cods = isset($_GET['cod']) ? $_GET['cod'] : '';
if($cods != '')
{
    $cods = is_array($cods) ? $cods : array($cods);
    $erros = 0;
    foreach($cods as $k => $codArtista)
    {
        /** EXCLUIR ARQUIVOS - ARTISTAS */
        $qArtistas = mysql_query("SELECT * FROM artistas WHERE cod = '{$codArtista}'");
        while($tpArtistas = mysql_fetch_assoc($qArtistas))
        {
            $qArquivosArtistas = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '{$tpArtistas['cod']}' AND referencia = 'artistas'");
            while($tpArquivosArtistas = mysql_fetch_assoc($qArquivosArtistas))
            {
                for($a=0;$a<5;$a++)
                {
                    $unlink = @unlink(PROJECT_PATH."arquivos/artistas/".$tpArquivosArtistas['arquivo']);
                    if($unlink)
                    {
                        break;
                    }
                }
                $sqlDelArquivosArtistas = "DELETE FROM arquivos WHERE cod = '{$tpArquivosArtistas['cod']}'";
                for($a=0;$a<5;$a++)
                {
                    $qDelArquivosArtistas = mysql_query($sqlDelArquivosArtistas);
                    if($qDelArquivosArtistas)
                    {
                        break;
                    }
                }
            }
            $sqlDelArtistas = "DELETE FROM artistas WHERE cod = '{$tpArtistas['cod']}'";
            for($a=0;$a<5;$a++)
            {
                $qDelArtistas = mysql_query($sqlDelArtistas);
                if($qDelArtistas)
                {
                    break;
                }
            }
            if(!$qDelArtistas)
            {
                $erros++;
            }
        }
        /** FIM - EXCLUIR ARQUIVOS - ARTISTAS */
    }
    reordenarArtistas();
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