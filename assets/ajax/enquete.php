
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
        "SELECT enquetesPerguntas.cod as cod_perg 
            FROM `enquetesPerguntas` 
        INNER JOIN enquetesRespostas
            WHERE enquetesRespostas.codPergunta = enquetesPerguntas.cod
            AND enquetesRespostas.cod = $cod"
    );
    $array = $query->fetchAll(\PDO::FETCH_ASSOC);
    

    foreach($array as $info) {
        $cod_perg = $info['cod_perg'];
        try{
            $stmt = $conn->prepare(
                "INSERT INTO enquetesStatus 
                (dataCadastro, ip, codPergunta, codResposta) VALUES 
                ('$datacadastro', '$ip', '$cod_perg', '$cod')"
            );
            $stmt->execute();
        }catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    die(json_encode($json));
}
?>