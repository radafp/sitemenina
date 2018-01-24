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
<<<<<<< HEAD
    $cod = $cliente;
    echo $cod;

    $qRelatoriostipo1 = mysql_query(

        // "SELECT 
        //     publicidades.cod,
        //     clientes.razaoSocial,
        //     publiTipos.tipo,
        //     (SELECT COUNT(publicidadeStats.codPublicidade) FROM publicidadeStats WHERE publicidadeStats.codPublicidade = publicidades.cod) as cliques,
        //     nImpressoes
        // FROM publicidades, clientes, publiTipos, publicidadeStats, publicidadeImpressoes
        //     WHERE clientes.cod = publicidades.codCliente
        //     AND publicidades.codTipo = publiTipos.cod
        //     AND clientes.cod = $cod
        //     GROUP BY clientes.cod"

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
    $nRelatoriostipo1 = mysql_num_rows($qRelatoriostipo1);
    echo ($nRelatoriostipo1);
    // $qRelatoriostipo2 = mysql_query(
    //     "SELECT 
    //     publicidades.cod,
    //     clientes.razaoSocial,
    //     publiTipos.tipo,
    //     (SELECT COUNT(publicidadeStats.codPublicidade) FROM publicidadeStats WHERE publicidadeStats.codPublicidade = publicidades.cod) as cliques,
    //     nImpressoes
    // FROM publicidades, clientes, publiTipos, publicidadeStats, publicidadeImpressoes
    //     WHERE clientes.cod = publicidades.codCliente
    //     AND publicidades.codTipo = publiTipos.cod
    //     AND clientes.cod = 1
    //     AND publicidades.codTipo  = 2
    //     GROUP BY clientes.cod"
    // );
    // $nRelatoriostipo2 = mysql_num_rows($qRelatoriostipo2);

    // $qRelatoriostipo3 = mysql_query(
    //     "SELECT 
    //     publicidades.cod,
    //     clientes.razaoSocial,
    //     publiTipos.tipo,
    //     (SELECT COUNT(publicidadeStats.codPublicidade) FROM publicidadeStats WHERE publicidadeStats.codPublicidade = publicidades.cod) as cliques,
    //     nImpressoes
    // FROM publicidades, clientes, publiTipos, publicidadeStats, publicidadeImpressoes
    //     WHERE clientes.cod = publicidades.codCliente
    //     AND publicidades.codTipo = publiTipos.cod
    //     AND clientes.cod = 1
    //     AND publicidades.codTipo  = 3
    //     GROUP BY clientes.cod"
    // );
    // $nRelatoriostipo3 = mysql_num_rows($qRelatoriostipo3);

?>
<div class="divTableLista clear">
    <br><br>
    <?php
    
        for($c = 0; $c < $nRelatoriostipo1; $c++) {
        $tpRelatoriostipo1 = mysql_fetch_assoc($qRelatoriostipo1);
        
        Página: echo $tpRelatoriostipo1['pagina'] . '<br>';
       
        echo $tpRelatoriostipo1['tipo']. ' --> ' . $tpRelatoriostipo1['nImpressoes'] . ' impressões e '. $tpRelatoriostipo1['cliques']. ' cliques';
        echo '<hr>';
        
        
            // echo '<br><br><br>'.$tpRelatoriostipo1['tipo'];
        }
    ?>
    <br><br>
    <!-- Página:<hr><br> -->
    <?php 

        // $tpRelatoriostipo2 = mysql_fetch_assoc($qRelatoriostipo2);
        // echo $tpRelatoriostipo2['tipo']. ' --> ' . $tpRelatoriostipo2['nImpressoes'] . ' impressões e '. (($tpRelatoriostipo2['cliques'] > 1)? $tpRelatoriostipo2['cliques']. ' cliques': $tpRelatoriostipo2['cliques']. ' clique');

    ?>
    <br>
    <?php 

        // $tpRelatoriostipo3 = mysql_fetch_assoc($qRelatoriostipo3);
        // echo $tpRelatoriostipo3['tipo']. ' --> ' . $tpRelatoriostipo3['nImpressoes'] . ' impressões e '. $tpRelatoriostipo3['cliques']. ' cliques';

}

    // ?>
    <!-- SELECT publiTipos.tipo,
		COUNT(publicidadeStats.codPublicidade) as Clicks, 
		publicidadeImpressoes.`nImpressoes` as Impressões
	FROM publiTipos
INNER JOIN publicidades
	ON publicidades.codTipo = publiTipos.cod
INNER JOIN publicidadeStats, publicidadeImpressoes
	WHERE publicidadeStats.codPublicidade = 5
	AND publicidadeImpressoes.codPublicidade = 5;
 -->

    <!-- SELECT (publicidadeStats.codPublicidade) as Clicks,
	publiTipos.tipo,
	publicidadeImpressoes.`nImpressoes` as Impressões
FROM publicidadeStats, publiTipos, publicidadeImpressoes
	WHERE publicidadeStats.codPublicidade = 5
	GROUP BY publicidadeStats.codPublicidade -->

<!-- comentado até o final 

                    <div class="divTr head">
                    <div class="divTd">&nbsp;</div>
                    <div class="divTd">Cliente</div>
                    <div class="divTd">Página</div>
                    <div class="divTd">Posição</div>
                    <div class="divTd">Data início</div>
                    <div class="divTd">Data fim</div>
                    <div class="divTd">Mostrar</div>
                </div>
                <?

                $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';
=======
>>>>>>> 5e86d70f138bc53556208f59743ac4bc638c5716

    $cod = $cliente;

    $qPublicidadeStatsPaginas = mysql_query("SELECT * FROM publicidadeStats WHERE codCliente = '{$cliente}'");

 
    $qPublicidadeStatsPaginas = mysql_query("SELECT codPagina,pagina FROM publicidadeStats WHERE codCliente = '{$cliente}' GROUP BY codPagina" );

    $nPublicidadeStatsPaginas = mysql_num_rows($qPublicidadeStatsPaginas);

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
        <?php
    }
}
?>
