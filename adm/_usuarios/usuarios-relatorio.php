<?php
if(!verifica_permissao($cod_user, $nivel, 'publicidade'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}

$usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';

require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_INC_PATH."modulos.php";
require_once ADMIN_PATH."_usuarios/inc/topo-usuarios-relatorio.php";


if($usuario) 
{
	echo 'sim';
    $cod = $usuario;

    $conn = new PDO('mysql:host=mysql03-farm70.uni5.net;dbname=novomenina', 'novomenina', 'agEncia445');
  
    $data = $conn->query(
        "SELECT usuariosStats.dataCadastro, 
				usuariosStats.acao,
				usuariosStats.nomeMenu,
				(SELECT COUNT(usuariosStats.acao) AS countAcao
				FROM usuariosStats
						where usuariosStats.codUsuario = usuarios.cod) as countAcao
			FROM usuariosStats
		inner join usuarios
			on usuarios.cod = usuariosStats.codUsuario
			and usuariosStats.codUsuario = $cod"
    );
}
?>
<div class="divTableLista clear">
    <br><br>
    <?php
        if(isset($data)) {
            $pagina = array();
            foreach($data as $info) {

                if(!in_array(utf8_encode($info['nomeMenu']), $pagina)) {
                    array_push($pagina, utf8_encode($info['nomeMenu']));
                    echo '<br><br><br> Pagina: '. utf8_encode($info['nomeMenu']) . '<hr>';
                }
                $data = new Datetime($info['dataCadastro']);
				echo '<br>'.$data->format('d/m/Y H:i:s'). ' ------------------------ ' . utf8_encode($info['acao']) .'<br>';
				
			}       
		}
    ?>

<br><br>