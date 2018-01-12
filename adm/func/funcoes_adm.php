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

function atualiza_usuarios_stats($cod_usuario, $nome_usuario, $nome_menu, $acao, $regiao)
{
    require_once '../configRoot.php';
    $conexao = conexao(); 

    $qVerificaRegiao = mysql_query("INSERT INTO usuariosStats 
        (dataCadastro, codUsuario, nomeUsuario, nomeMenu, acao) VALUES
        (now(), $cod_usuario, '$nome_usuario', '$nome_menu', '$acao', '$regiao')",$conexao
    );

}
?>