<?php
if(!verifica_permissao($cod_user, $nivel, 'banners-apaga'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_PATH."/_banners/func/funcoes.php";

$cods = isset($_GET['cod']) ? $_GET['cod'] : '';
if($cods != '')
{
    $cods = is_array($cods) ? $cods : array($cods);
    $erros = 0;
    foreach($cods as $k => $codBanner)
    {
        /** EXCLUIR ARQUIVOS - BANNER */
        $qBanners = mysql_query("SELECT * FROM banners WHERE cod = '{$codBanner}'");
        while($tpBanners = mysql_fetch_assoc($qBanners))
        {
            $qArquivosBanners = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '{$tpBanners['cod']}' AND referencia = 'banners'");
            while($tpArquivosBanners = mysql_fetch_assoc($qArquivosBanners))
            {
                for($a=0;$a<5;$a++)
                {
                    $unlink = @unlink(PROJECT_PATH."arquivos/banners/".$tpArquivosBanners['arquivo']);
                    if($unlink)
                    {
                        break;
                    }
                }
                $sqlDelArquivosBanners = "DELETE FROM arquivos WHERE cod = '{$tpArquivosBanners['cod']}'";
                for($a=0;$a<5;$a++)
                {
                    $qDelArquivosBanners = mysql_query($sqlDelArquivosBanners);
                    if($qDelArquivosBanners)
                    {
                        break;
                    }
                }
            }
            $sqlDelBanners = "DELETE FROM banners WHERE cod = '{$tpBanners['cod']}'";
            for($a=0;$a<5;$a++)
            {
                $qDelBanners = mysql_query($sqlDelBanners);
                if($qDelBanners)
                {
                    break;
                }
            }
            if(!$qDelBanners)
            {
                $erros++;
            }
        }
        /** FIM - EXCLUIR ARQUIVOS - BANNER */
    }
    reordenarBanners();
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