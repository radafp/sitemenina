<?php
if(!verifica_permissao($cod_user, $nivel, 'publicidade'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}

$cliente = isset($_GET['cliente']) ? $_GET['cliente'] : '';

require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_INC_PATH."modulos.php";
require_once ADMIN_PATH."_publicidade/inc/topo-publicidade-relatorio.php";

if($cliente) 
{
    $cod = $cliente;

    $conn = new PDO('mysql:host=mysql03-farm70.uni5.net;dbname=novomenina', 'novomenina', 'agEncia445');
    
    $data = $conn->query(
        "SELECT DISTINCT publicidadeStats.pagina, 
				publicidadeStats.tipo, 
				publicidadeImpressoes.nImpressoes,
				publicidadeImpressoes.codPublicidade,
                (SELECT COUNT(publicidadeStats.codPublicidade) AS cliques
				FROM publicidadeStats
                        where publicidadeStats.codPublicidade = publicidadeImpressoes.codPublicidade) as Cliques
            FROM publicidadeStats
        inner join publicidadeImpressoes
            on publicidadeImpressoes.codPublicidade = publicidadeStats.codPublicidade
            and publicidadeStats.codCliente = $cod"
    );
    $countData = count($data);
    echo $countData;
}
?>
<div class="divTableLista clear">
    <br><br>
    <?php
        if(isset($data)) {
            $pagina = array();
            foreach($data as $info) {

                if(!in_array(utf8_encode($info['pagina']), $pagina)) {
                    array_push($pagina, utf8_encode($info['pagina']));
                    echo '<br> Pagina: '. utf8_encode($info['pagina']) . '<hr>';
                }               
                echo '<br>'.utf8_encode($info['tipo']). ' --> ' . utf8_encode($info['nImpressoes']) . ' impressões e '. utf8_encode($info['Cliques']). ' cliques<br>';
            }
        }

        

            
        
        


    ?>

<br><br>
