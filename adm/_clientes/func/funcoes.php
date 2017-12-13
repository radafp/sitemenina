<?
function reordenarClientes()
{
    $qOrdem = mysql_query("SELECT cod FROM clientes ORDER BY ordem ASC");
	$nOrdem = mysql_num_rows($qOrdem);
    if ($nOrdem > 0)
    {
        for ($n=0;$n<$nOrdem;$n++) 
        {
            $tpOrdem = mysql_fetch_assoc($qOrdem);
            $ordem = $n+1;
            $sqlNewOrdem = "UPDATE clientes SET ordem = '{$ordem}' WHERE cod = '{$tpOrdem['cod']}'";
            for($c=0;$c<5;$c++)
            {
                $qNewOrdem = mysql_query($sqlNewOrdem);
                if($qNewOrdem)
                {
                    break;
                }
            }
        }
    }	
    return $nOrdem+1;
}

function reordenarClientesFotos($codProduto)
{
    $qOrdem = mysql_query("SELECT codigo FROM arquivos WHERE codReferencia = '$codProduto' AND tipo = '1' AND referencia = 'clientes' ORDER BY ordem ASC, cod ASC");
	$nOrdem = mysql_num_rows($qOrdem);
    if ($nOrdem > 0)
    {
        for ($n=0;$n<$nOrdem;$n++) 
        {
            $tpOrdem = mysql_fetch_assoc($qOrdem);
            $ordem = $n+1;
            $sqlNewOrdem = "UPDATE arquivos SET ordem = '{$ordem}' WHERE codigo = '{$tpOrdem['codigo']}'";
            for($c=0;$c<5;$c++)
            {
                $qNewOrdem = mysql_query($sqlNewOrdem);
                if($qNewOrdem)
                {
                    break;
                }
            }
        }
    }	
    return $nOrdem+1;
}
?>