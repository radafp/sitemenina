<?php
if(!verifica_permissao($cod_user, $nivel, 'usuarios'))
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
    foreach($cods as $k => $codUsuario)
    {

        $sqlDelUsuarios = "DELETE FROM usuarios WHERE cod = '{$codUsuario}'";
        for($a=0;$a<5;$a++)
        {
            $qDelUsuarios = mysql_query($sqlDelUsuarios);
            if($qDelUsuarios)
            {
                break;
            }
        }
        if(!$qDelUsuarios)
        {
            $erros++;
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
        $count = count($cods);
        atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Usuarios', 'Removeu', $_SESSION[ADMIN_SESSION_NAME.'_regiao'], $count);
        
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