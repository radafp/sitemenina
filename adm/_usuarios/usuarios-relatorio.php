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
$dataInicio = isset($_GET['dataInicio']) ? $_GET['dataInicio'] : '';
$dataFim = isset($_GET['dataFim']) ? $_GET['dataFim'] : '';

// formatando o valor que vem do input
$dI1 = substr($dataInicio, 0, 10);
$dI2 = substr($dataInicio, 11);
$dataInicio = $dI1 . ' ' . $dI2 . ':00';

$dF1 = substr($dataFim, 0, 10);
$dF2 = substr($dataFim, 11);
$dataFim = $dF1 . ' ' . $dF2 . ':00';



require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_INC_PATH."modulos.php";
require_once ADMIN_PATH."_usuarios/inc/topo-usuarios-relatorio.php";


if($usuario) 
{
    $cod = $usuario;

	$conn = new PDO('mysql:host=mysql03-farm70.uni5.net;dbname=novomenina', 'novomenina', 'agEncia445');
	
	if(isset($dataInicio) && $dataInicio != ':00' && $dataInicio != '2018-01-01 08:30:00' && isset($dataFim) && $dataFim != ':00' && $dataFim != '2018-01-01 08:30:00') {
		$dataconsulta = "And usuariosStats.dataCadastro BETWEEN '$dataInicio' AND '$dataFim' ";

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
	}elseif(isset($dataInicio) && $dataInicio != ':00' && $dataInicio != '2018-01-01 08:30:00') {
		$dataconsulta = "And usuariosStats.dataCadastro >= '$dataInicio' ";

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
	}elseif(isset($dataFim) && $dataFim != ':00' && $dataFim != '2018-01-01 08:30:00') {
		$dataconsulta = "And usuariosStats.dataCadastro <= '$dataFim' ";

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