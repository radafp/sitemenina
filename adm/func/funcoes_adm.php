<?
function verifica_regiao($usuario,$regiao)
{
    require_once '../configRoot.php';
    $conexao = conexao(); 

    $qVerificaRegiao = mysql_query("SELECT bc,bl,lg FROM usuarios WHERE login = '{$usuario}'",$conexao);
    $tpVerificaRegiao = mysql_fetch_assoc($qVerificaRegiao);
    
    $libera = 0;
 
    if($regiao == 'bc'){
        if($tpVerificaRegiao['bc']==1){
            $libera = 1;
        } 
    }
    if($regiao == 'bl'){
        if($tpVerificaRegiao['bl']==1){
            $libera = 1;
        } 
    }
    if($regiao == 'lg'){
        if($tpVerificaRegiao['lg']==1){
            $libera = 1;
        } 
    }
    return $libera;
}

function remEscape($string)
{
    return stripcslashes($string);
}

function escape($string)
{
    global $conexao;
    if(!get_magic_quotes_gpc())
    {
        if (function_exists('mysql_real_escape_string'))
        {
            return mysql_real_escape_string($string, $conexao);
        }
        elseif(function_exists('mysql_escape_string'))
        {
            return mysql_escape_string($string);
        }
        return addslashes($string);
    }
    else
    {
        return $string;
    }
}
?>