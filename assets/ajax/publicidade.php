
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

    // CRIAR SELECT PRA PEGAR CÓDIGO DA PERGUNTA 
    $array = array();
    $query = $conn->query(
        "SELECT publicidades.empresa,
                publicidades.dataInicio,
                publicidades.dataFim,
                publicidades.regiao,
                publicidades.codTipo
            FROM `publicidades`
            WHERE publicidades.cod = $cod"
    );
    $array = $query->fetchAll(\PDO::FETCH_ASSOC);
    

    foreach($array as $info) {
        $empresa = $info['empresa'];
        $dataInicio = $info['dataInicio'];
        $dataFim = $info['dataFim'];
        $regiao = $info['regiao '];
        $codTipo = $info['codTipo'];
        
        try{
            $stmt = $conn->prepare(
                "INSERT INTO publicidadeStats 
                (dataCadastro, codPublicidade, codTipo, ip, empresa, dataInicio, dataFim, regiao) VALUES 
                ('$datacadastro', '$cod', '$codTipo', '$ip', '$empresa', '$dataInicio', '$dataFim', '$regiao')"
            );
            $stmt->execute();
        }catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    die(json_encode($json));
}
?>