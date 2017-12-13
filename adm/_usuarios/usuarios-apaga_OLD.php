<?php
if(!verifica_permissao($cod_user, $nivel, 'usuarios-apaga'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";


$resultado2 = mysql_query("DELETE FROM usuarios WHERE cod ='{$cod}' ",$conexao);

echo mysql_error();

if($resultado2)
{	
	echo "<script>
              alert('Registro excluído com sucesso.');
              document.location.replace('http://".ADMIN_URL."/principal.php?id=$id&subid=1')
          </script>";
    die();
}
else
{
	echo "<script>
	          alert('Erro ao excluir.');
	          document.location.replace('http://".ADMIN_URL."/principal.php?id=$id&subid=1')
	      </script>";
    die();
}
?>