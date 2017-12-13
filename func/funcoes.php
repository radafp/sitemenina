<?php
function ssl()
{
    $prot = '';
    if($_SERVER['SERVER_PORT'] == 80)
    {
        $prot = "http://";
    }
    elseif($_SERVER['SERVER_PORT'] == 443)
    {
        $prot = "http://";
    }
    return $prot;
}

function sslRedir()
{
    global $restrita;
    
    $protRedir = '';
    if($restrita == 1)
    {
        $protRedir = "http://";
    }
    else
    {
        if($_SERVER['SERVER_PORT'] == 80)
        {
            $protRedir = "http://";
        }
        elseif($_SERVER['SERVER_PORT'] == 443)
        {
            $protRedir = "http://";
        }
    }
    return $protRedir;
}

function erro404()
{
    @header("HTTP/1.0 404 Not found");
    require_once PROJECT_PATH."erros/404.html";
    die();
}

function dataBr($dataEn)
{
    if($dataEn != '')
    {
        $dataBr_inicial = explode('-', $dataEn);
        $dataBr = $dataBr_inicial[2].'/'.$dataBr_inicial[1].'/'.$dataBr_inicial[0];
        return $dataBr;
    }
}
function dataBrTime($dataEn)
{
    if($dataEn != '')
    {
        $dataBr_inicial = explode('-', $dataEn);
        $diaBrTemp = explode(' ', $dataBr_inicial[2]);
        $dataBr = $diaBrTemp[0].'/'.$dataBr_inicial[1].'/'.$dataBr_inicial[0];

        $hora = explode(' ', $dataEn);
        return $dataBr.' - '.$hora[1];
    }
}

function dataEn($dataBr)
{
    if($dataBr != '')
    {
        $dataEn_inicial = explode('/', $dataBr);
        $dataEn = $dataEn_inicial[2].'-'.$dataEn_inicial[1].'-'.$dataEn_inicial[0];
        return $dataEn;
    } 
}

function escape($string)
{
    global $conexao;
    return mysql_real_escape_string($string, $conexao);
}
function unescape($string)
{
    return stripslashes($string);
}

function html_encode($string)
{
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    return $string;
}

// registra cliques únicos verificando o dia e IP
function registrarStatsClickImovel($codImovel = 0)
{
    global $conexao;

    $hoje = date('Y-m-d');
    $ip = $_SERVER['REMOTE_ADDR'];
    $q = mysql_query("SELECT cod, dataClick, nClicks FROM statsImoveis WHERE dataClick = '$hoje' AND codImovel = '$codImovel' AND ip = '$ip'",$conexao);
    $n = mysql_num_rows($q);
    
    if($n < 1)
    {
        $sql = "INSERT INTO statsImoveis (codImovel, dataClick, ip, nClicks) VALUES ('$codImovel', '$hoje', '$ip', '1')";
        for($a=0;$a<5;$a++)
        {
            $insert = mysql_query($sql,$conexao);
            if($insert)
                break;
        }
    }
    else
    {
        $tpStats = mysql_fetch_assoc($q);
        $nClicks = $tpStats['nClicks'] + 1;
        $sql = "UPDATE statsImoveis SET nClicks = '$nClicks' WHERE cod = {$cod}";

        $update = mysql_query($sql,$conexao);
        if($update)
            break;
    }
}
?>