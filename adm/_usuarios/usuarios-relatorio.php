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
<<<<<<< HEAD
=======
$dataInicio = isset($_GET['dataInicio']) ? $_GET['dataInicio'] : '';
$dataFim = isset($_GET['dataFim']) ? $_GET['dataFim'] : '';

// formatando o valor que vem do input
// $dI1 = substr($dataInicio, 0, 10);
// $dI2 = substr($dataInicio, 11);
// $dataInicio = $dI1 . ' ' . $dI2 . ':00';

// $dF1 = substr($dataFim, 0, 10);
// $dF2 = substr($dataFim, 11);
// $dataFim = $dF1 . ' ' . $dF2 . ':00';


>>>>>>> 23890a1a6a75460b2be75e0ff0a36ce3b8c19cb4

require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_INC_PATH."modulos.php";
require_once ADMIN_PATH."_usuarios/inc/topo-usuarios-relatorio.php";


if($usuario) 
{
<<<<<<< HEAD
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
=======
    $cod = $usuario;

	$conn = new PDO('mysql:host=mysql03-farm70.uni5.net;dbname=novomenina', 'novomenina', 'agEncia445');
	
	if(isset($dataInicio) && !empty($dataInicio) && isset($dataFim) && !empty($dataFim)) {
		$dataInicio .= ' 00:00:00';
		$dataFim 	.= ' 23:59:59';
		$dataconsulta = "And usuariosStats.dataCadastro BETWEEN '$dataInicio' AND '$dataFim' ";
		// echo '<br>BT: ' . $dataInicio . ' -- ' . $dataFim;
		
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
				and usuariosStats.codUsuario = $cod " . $dataconsulta
		);
  
	// se for setado somente a data inicial na pesquisa
	}elseif(isset($dataInicio) && !empty($dataInicio)) {
		$dataInicio .= ' 00:00:00';
		$dataconsulta = "And usuariosStats.dataCadastro >= '$dataInicio' ";
		// echo '<br>DI: ' . $dataInicio;
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
				and usuariosStats.codUsuario = $cod " . $dataconsulta
		);	

	// se for setado somente a data Final na pesquisa
	}elseif(isset($dataFim) && !empty($dataFim)) {
		$dataFim 	.= ' 23:59:59';
		$dataconsulta = "And usuariosStats.dataCadastro <= '$dataFim' ";
		// echo '<br>DF: '.$dataFim;
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
				and usuariosStats.codUsuario = $cod " . $dataconsulta
		);
	}

	// echo '<br><br><br>disemnada:'.$dataInicio;

	// query trazendo tudo do usuario selecionado
	if(empty($dataInicio) && empty($dataFim)) {
		// echo 'vazio';
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
				and usuariosStats.codUsuario = $cod "
		);
	}
	
>>>>>>> 23890a1a6a75460b2be75e0ff0a36ce3b8c19cb4
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