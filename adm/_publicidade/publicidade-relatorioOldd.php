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
