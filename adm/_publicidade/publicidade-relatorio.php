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
    echo $cod;

<<<<<<< HEAD
    $qRelatoriostipo = mysql_query(
        "SELECT
            publicidadeStats.tipo,
            COUNT(publicidadeStats.codPublicidade) AS cliques,
            publicidadeStats.codPublicidade,
            publicidadeStats.pagina,	
            publicidadeImpressoes.nImpressoes,
            publicidadeStats.codCliente
        FROM publicidadeStats, publicidadeImpressoes
            WHERE publicidadeStats.codCliente = '$cod'
            AND publicidadeStats.codPublicidade = publicidadeImpressoes.codPublicidade
            GROUP BY publicidadeStats.tipo;"
    );
    $nRelatoriostipo = mysql_num_rows($qRelatoriostipo);
    $tpRelatoriostipo = mysql_fetch_assoc($qRelatoriostipo);

    $codPublicidade = $tpRelatoriostipo['codPublicidade'];
    
    if(isset($codPublicidade) && !empty($codPublicidade)) {
        $qRelatoriosPagina = mysql_query(
            "SELECT Distinct publicidadeStats.pagina
            FROM publicidadeStats, publicidadeImpressoes
                WHERE publicidadeStats.codPublicidade = $codPublicidade
                GROUP BY publicidadeStats.pagina;"
        );
        $nRelatoriosPagina = mysql_num_rows($qRelatoriosPagina);
        $tpRelatorioPagianas = mysql_fetch_assoc($qRelatoriosPagina);
    }
    
=======
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
>>>>>>> 772edf64c293185450ed63cac6a5e70d34788ffa
}
?>
<div class="divTableLista clear">
    <br><br>
<<<<<<< HEAD
    
    <?php
        for($c1 = 0; $c1 < $nRelatoriostipo; $c1++) {
            echo '<br> Pagina: '. $tpRelatorioPagianas['pagina'] . '<hr>';
            // $tpRelatoriostipo1 = mysql_fetch_assoc($qRelatoriostipo);
            echo '<br>'.$tpRelatoriostipo['tipo']. ' --> ' . $tpRelatoriostipo['nImpressoes'] . ' impressões e '. $tpRelatoriostipo['cliques']. ' cliques '.'codPublicidade: '.$tpRelatoriostipo['codPublicidade']. ' COdCLIENTE: '. $tpRelatoriostipo['codCliente'].'<br>';
        }
        // $array = array(10, 30, 10, 40, 40);
        // $copia = array_unique($array);
        // if(count($copia) != count($array)) {
        //     echo "existem valores duplicados";
        // } else {
        //     echo "não existem valores duplicados";
        // }
        // echo '<br><br><pre>';
        // var_dump($tpRelatorioPagianas);
        // echo '</pre>';
            
        // echo '<br><br><pre>';
        // var_dump($tpRelatoriostipo);
        // echo '</pre>';
    ?>

    <br><br>
=======
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
>>>>>>> 772edf64c293185450ed63cac6a5e70d34788ffa
