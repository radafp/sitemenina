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
    $nRelatoriostipo = mysql_num_rows($qRelatoriostipo);

    // $qRelatoriosPagina = mysql_query(
    //     "SELECT pagina 
    //         FROM publicidadeStats, publicidadeImpressoes
    //         WHERE publicidadeStats.codPublicidade =publicidadeImpressoes.codPublicidade
    //         AND publicidadeStats.codCliente = '$cod';
    //     "

    // echo ($nRelatoriostipo1);
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
    
        for($c = 0; $c < $nRelatoriostipo; $c++) {
        $tpRelatoriostipo = mysql_fetch_assoc($qRelatoriostipo);
        
        Página: echo $tpRelatoriostipo['pagina'] . '<br>';
       
        echo $tpRelatoriostipo['tipo']. ' --> ' . $tpRelatoriostipo['nImpressoes'] . ' impressões e '. $tpRelatoriostipo['cliques']. ' cliques';
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

                // $q = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
                //                 INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                //                 INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                //                 WHERE p.regiao = '$regiao'
                //                 ORDER BY p.codPagina, pt.cod");
                // $n = mysql_num_rows($q);

                // //echo mysql_error();

                // if ($n>0)

                if(isset($_GET['p'])) {
                    $pg = $_GET['p'];
                }else{
                    $pg = 0;
                }

                $pag = ($pg - 1) * 30;
                if($pag < 0) {
                    $pag = 0;
                }    

                $limit_por_pag = 30;
                $q = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
                                INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                                INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                                WHERE p.regiao = '$regiao'
                                ORDER BY p.codPagina, pt.cod LIMIT $pag, $limit_por_pag", $conexao);
                
                $rows = mysql_query("SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
                                INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                                INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                                WHERE p.regiao = '$regiao'", $conexao);

                $count_registros = mysql_num_rows($rows);
                $paginas = ceil($count_registros / $limit_por_pag);

                if ($count_registros>0)
                {
                    while($tp = mysql_fetch_assoc($q))
                    {
                        $qClientes = mysql_query("SELECT * FROM clientes WHERE cod = '{$tp['codCliente']}'");
                        $nClientes = mysql_num_rows($qClientes);
                        ?>
                        <div class="divTr">
                            <div class="divTd">
                                <input class="checks" name="cod[]" value="<?=$tp['cod'];?>" type="checkbox" />
                            </div>
                            <div class="divTd">                
                                <?
                                if($nClientes>0) 
                                {
                                    $tpCliente = mysql_fetch_assoc($qClientes)
                                    ?>
                                    <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                                        <?
                                        if($tpCliente['tipoPessoa'] == 'j'){
                                            echo $tpCliente['razaoSocial'];
                                        }elseif($tpCliente['tipoPessoa'] == 'f'){
                                            echo $tpCliente['nome']." ".$tpCliente['sobrenome'];;
                                        }
                                        ?>
                                    </a>
                                    <?
                                }
                                ?>
                            </div>
                            <div class="divTd">
                                <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                                    <?=$tp['pagina'];?>
                                </a>
                            </div>
                            <div class="divTd">
                                <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                                    <?=$tp['tipo'];?>
                                </a>
                            </div>
                            <div class="divTd">
                                <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                                    <?=dataBr($tp['dataInicio']);?>
                                </a>
                            </div>
                            <div class="divTd">
                                <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=3&cod=<?=$tp['cod'];?>">
                                    <?=dataBr($tp['dataFim']);?>
                                </a>
                            </div>
                            <div class="divTd">
                                <input type="checkbox" class="mostrar" value="<?=$tp['cod'];?>" <?=$tp['mostrar'] == 1 ? "checked='checked'" : "";?> />
                            </div>
                        </div>
                    <?
                    }
                }
                else
                {
                ?>
                </div>    
                <div>
                    Nenhum Registro Encontrado.
                <?php
                }
                ?>
            </div>

            <div class="divTableLista clear">
                <div class="divTr">
                    <div class="divTd">

                        <?php
                        if(isset($_GET['p'])) {
                                $p = $_GET['p'];
                            }else{
                                $p = 1;
                            }

                            if($p >= 1) {
                                $anterior = $p - 1;
                            }
                            if($p <= $count_registros) {
                                $proxima = $p + 1;
                            }
                            
                            if($anterior <= 0) {
                                $anterior = 0;
                            }
                            if(isset($proxima) && $proxima >= $count_registros){
                                $proxima = $count_registros;
                            }
                            // echo '<br>cont de registros: '.$count_registros;
                            // echo '<br>limit por paginas: '.$limit_por_pag;
                            // echo '<br><br>';
                            // echo '<br>p: '. $p;
                            // echo '<br>$pag: '.$pag;
                        ?><br><br>

                            
                        <?php if($count_registros > $limit_por_pag):?>
                            <?php if($p > 1):?>
                                <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$anterior;?>">Anterior</a>
                                <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$anterior;?>"><?=$anterior;?></a>
                            <?php endif?>
                            
                                <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$p;?>"><?=$p;?></a>

                            <?php if($pag+10 <= $count_registros):?>
                                <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$proxima;?>"><?=$proxima;?></a>
                                <a href="http://<?=ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=1&p=<?=$proxima;?>">Proximo</a>
                            <?php endif?>
                        <?php endif;?>              

                        
                        <?= '<br>Total de Páginas: '. $paginas?>
                            
                    </div>
                </div>
    -->
</div>