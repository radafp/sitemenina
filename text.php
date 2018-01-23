for($c1 = 0; $c1 < $nRelatoriosPagina; $c1++) {
            // $tpRelatoriostipo1 = mysql_fetch_assoc($qRelatoriostipo);
            $qRelatoriosPagina1 = mysql_fetch_assoc($qRelatoriosPagina);
            Página: echo $qRelatoriosPagina1['pagina'] . '<br><hr>';

            
        }



        $qRelatoriostipo = mysql_query(

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
    publicidadeImpressoes.codPublicidade,
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
$tpRelatoriostipo1 = mysql_fetch_assoc($qRelatoriostipo);

$codPublicidade = $tpRelatoriostipo1['codPublicidade'];
$qRelatoriosPagina = mysql_query(
"SELECT Distinct publicidadeStats.pagina
FROM publicidadeStats, publicidadeImpressoes
    WHERE publicidadeStats.codPublicidade = $codPublicidade
    GROUP BY publicidadeStats.pagina;"
);
$nRelatoriosPagina = mysql_num_rows($qRelatoriosPagina);

