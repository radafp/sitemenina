<?
function reordenarTop10()
{
    $qOrdem = mysql_query("SELECT cod FROM top10 ORDER BY ordem ASC");
	$nOrdem = mysql_num_rows($qOrdem);
    if ($nOrdem > 0)
    {
        for ($n=0;$n<$nOrdem;$n++) 
        {
            $tpOrdem = mysql_fetch_assoc($qOrdem);
            $ordem = $n+1;
            $sqlNewOrdem = "UPDATE top10 SET ordem = '{$ordem}' WHERE cod = '{$tpOrdem['cod']}'";
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