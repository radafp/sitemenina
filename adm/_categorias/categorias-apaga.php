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
require_once ADMIN_PATH."/_categorias/func/funcoes.php";

$cods = isset($_GET['cod']) ? $_GET['cod'] : '';

if($cods != '')
{
    $cods = is_array($cods) ? $cods : array($cods);
    $erros = 0;
    foreach($cods as $k => $codCategoria)
    {
        $qCategorias = mysql_query("SELECT * FROM categorias WHERE cod = '{$codCategoria}'");
        while($tpCategorias = mysql_fetch_assoc($qCategorias))
        {
            
            /** EXCLUIR CATEGORIA */
            $sqlDelCategoria = "DELETE FROM categorias WHERE cod = '{$tpCategorias['cod']}' LIMIT 1";
            for($a=0;$a<5;$a++)
            {
                $qDelCategoria = mysql_query($sqlDelCategoria);
                if($qDelCategoria)
                {
                    break;
                }
            }
            if(!$qDelCategoria)
            {
                $erros++;
            }
            /** FIM - EXCLUIR CATEGORIA */                    
        }
            
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