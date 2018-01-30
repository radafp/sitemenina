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
require_once ADMIN_PATH."_publicidade/inc/topo-publicidade-lista.php";

if($cliente) 
{
    $cod = $cliente;
    echo $cod;

    $qRelatoriostipo = mysql_query(
        "SELECT
            publicidadeStats.tipo,
            COUNT(publicidadeStats.codPublicidade) AS cliques,
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
    $qRelatoriosPagina = mysql_query(
    "SELECT Distinct publicidadeStats.pagina
    FROM publicidadeStats, publicidadeImpressoes
        WHERE publicidadeStats.codPublicidade = $codPublicidade
        GROUP BY publicidadeStats.pagina;"
    );
    $nRelatoriosPagina = mysql_num_rows($qRelatoriosPagina);
?>
<div class="divTableLista clear">
    <br><br>
    <?php
         for($i = 0; $i < $nPublicidadeStatsPaginas; $i++) 
         {
             $tpPublicidadeStatsPaginas = mysql_fetch_assoc($qPublicidadeStatsPaginas);
             ?>
             
             <div style="margin-top:25px;width: 100%">
                 
                 <div style="width:100%; float:left">
                     <?=$tpPublicidadeStatsPaginas['pagina'];?>
                 </div>
                 <div style="width:100%; float:left">
                     <?php
                     $qPublicidadeStatsPaginasDetalhe = mysql_query("SELECT * FROM publicidadeStats WHERE codCliente = '{$cliente}' AND codPagina = '{$tpPublicidadeStatsPaginas['codPagina']}' GROUP BY codPublicidade");
                     $nPublicidadeStatsPaginasDetalhe = mysql_num_rows($qPublicidadeStatsPaginasDetalhe);
     
                     for($j=0;$j<$nPublicidadeStatsPaginasDetalhe;$j++)
                     {
                         $tpPublicidadeStatsPaginasDetalhe = mysql_fetch_assoc($qPublicidadeStatsPaginasDetalhe);
     
                         $qNImpressoes = mysql_query("SELECT cod FROM publicidadeStats WHERE codPublicidade = '{$tpPublicidadeStatsPaginasDetalhe['cod']}'" );
                         $nImpressoes = mysql_num_rows($qNImpressoes);
                     ?>
                         <div style="width:100%; float:left">CodPublicidade: <?=$tpPublicidadeStatsPaginasDetalhe['codPublicidade'];?> - <?=$tpPublicidadeStatsPaginasDetalhe['tipo'];?> - <?=$nImpressoes;?> Impressões e <?=$nPublicidadeStatsPaginasDetalhe;?> cliques </div>
                         <div style="width:50%; float:left"></div>
                     <?
                     }
                     ?>
                 </div>
             
             </div>
             <!-- <?php
         }
     }
     ?>
        for($c1 = 0; $c1 < $nRelatoriostipo; $c1++) {
            $tpRelatoriostipo1 = mysql_fetch_assoc($qRelatoriostipo);
            echo '<br>'.$tpRelatoriostipo1['tipo']. ' --> ' . $tpRelatoriostipo1['nImpressoes'] . ' impressões e '. $tpRelatoriostipo1['cliques']. ' cliques';
        }
        // $array = array(10, 30, 10, 40, 40);
        // $copia = array_unique($array);
        // if(count($copia) != count($array)) {
        //     echo "existem valores duplicados";
        // } else {
        //     echo "não existem valores duplicados";
        // }
        // var_dump($titulo);
        
    ?>
    <br><br> -->
