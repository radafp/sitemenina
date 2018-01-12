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
require_once ADMIN_PATH."/_categorias/func/funcoes.php";

$cods = isset($_GET['cod']) ? $_GET['cod'] : '';

if($cods != '')
{
    $cods = is_array($cods) ? $cods : array($cods);
    $erros = 0;
    foreach($cods as $k => $cod)
    {
        $q = mysql_query("SELECT * FROM enquetesPerguntas WHERE cod = '{$cod}'");

        while($tp = mysql_fetch_assoc($q))
        {
            $qRespostas = mysql_query("SELECT * FROM enquetesRespostas WHERE codPergunta = '{$tp['cod']}'");
            $nDelRespostas = mysql_num_rows($qRespostas);
            if($nDelRespostas>0)
            {
                for($i=0;$i<$nDelRespostas;$i++)
                {
                    $sqlDelRespostas =  "DELETE FROM enquetesRespostas WHERE codPergunta = '{$tp['cod']}' LIMIT 1";
                    for($a=0;$a<5;$a++)
                    {
                        $qDelRespostas = mysql_query($sqlDelRespostas);
                        if($qDelRespostas)
                        {
                            break;
                        }
                    }
                }
            }
             
            /** EXCLUIR CATEGORIA */
            $sqlDel = "DELETE FROM enquetesPerguntas WHERE cod = '{$tp['cod']}'";
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
        }
            
    }
    if($erros > 0)
    {
        ?>
        <script>
            alert("Erro ao excluir")
            document.location.replace("http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1");
        </script>
        <?php
        die();
    }
    else
    {
        $count = count($cods);
        atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Enquetes', 'Removeu', $_SESSION[ADMIN_SESSION_NAME.'_regiao'], $count);
        
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