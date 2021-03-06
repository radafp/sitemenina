
<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
{

    try
    {
        $conn = new PDO('mysql:host=mysql03-farm70.uni5.net;dbname=novomenina', 'novomenina', 'agEncia445');
    }
    catch ( PDOException $e )
    {
        echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
    }
    
    $cod = isset($_POST['cod']) ? $_POST['cod'] : '';
    $datacadastro = date('Y-m-d');
    $ip = $_SERVER["REMOTE_ADDR"];
    echo "<script>console.log( 'Debug Objects: " . $cod . "' );</script>";
    // CRIAR SELECT PRA PEGAR CÓDIGO DA PERGUNTA 
    $array = array();
    $query = $conn->query(
        // "SELECT *
        //   FROM publicidades
        // WHERE cod = $cod"
        "SELECT 
            publicidades.*,
            publiTipos.tipo,
            publiPaginas.pagina
        FROM publicidades, publiTipos, publiPaginas
        WHERE publicidades.cod = $cod
        and publicidades.codTipo = publiTipos.cod
        AND publicidades.codPagina = publiPaginas.cod"
    );
    $array = $query->fetchAll(\PDO::FETCH_ASSOC);
    

    foreach($array as $info) {
        $empresa = $info['empresa'];
        $codPagina = $info['codPagina'];
        $codCliente = $info['codCliente'];
        $dataInicio = $info['dataInicio'];
        $tipo = $info['tipo'];
        $pagina = $info['pagina'];
        $dataFim = $info['dataFim'];
        $regiao = $info['regiao'];
        $codTipo = $info['codTipo'];
        
        try{
            $stmt = $conn->prepare(
                "INSERT INTO publicidadeStats 
                (dataCadastro, codPublicidade, codTipo, ip, codCliente, empresa, tipo, pagina, codPagina, dataInicio, dataFim, regiao) VALUES 
                ('$datacadastro', '$cod', '$codTipo', '$ip', '$codCliente', '$empresa', '$tipo', '$pagina', '$codPagina', '$dataInicio', '$dataFim', '$regiao')"
            );
            $stmt->execute();
        }catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    die(json_encode($json));
}
?>