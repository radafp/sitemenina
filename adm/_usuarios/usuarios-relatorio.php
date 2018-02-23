<?php
if(!verifica_permissao($cod_user, $nivel, 'publicidade'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}

// require_once ADMIN_INC_PATH."bread.php";
// require_once ADMIN_INC_PATH."topoModulo.php";
// require_once ADMIN_INC_PATH."modulos.php";
// require_once ADMIN_PATH."_publicidade/inc/topo-publicidade-relatorio.php";
