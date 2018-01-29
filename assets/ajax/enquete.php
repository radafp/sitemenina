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
    
    $codPergunta = isset($_POST['codPergunta']) ? $_POST['codPergunta'] : '';
    $codResposta = isset($_POST['codResposta']) ? $_POST['codResposta'] : '';
    $datacadastro = date('Y-m-d');
    $ip = $_SERVER["REMOTE_ADDR"];
    
    try{
        $stmt = $conn->prepare(
            "INSERT INTO enquetesStatus 
            (dataCadastro, ip, codPergunta, codResposta) VALUES 
            ('$datacadastro', '$ip', '$codPergunta', '$codResposta')"
        );
        $stmt->execute();

        // verifica quantas respostas no total teve a pergunta
        $queryNEnqueteStats = $conn->query(
            "SELECT * FROM `enquetesStatus`  
            WHERE codPergunta = $codPergunta"
        );
        $resultadoNEnqueteStats = $queryNEnqueteStats->fetchAll(\PDO::FETCH_ASSOC);
        $totalRespostasPergunta = count($resultadoNEnqueteStats);

        // seleciona e lista as respostas para a pergunta
        $queryEnqueteRespostas = $conn->query(
            "SELECT * FROM `enquetesRespostas` 
            WHERE codPergunta = $codPergunta"
        );
        $resultadoEnqueteRespostas = $queryEnqueteRespostas->fetchAll(\PDO::FETCH_ASSOC);

        $retorno = "";
        //$retorno .= "Total de respostas para a pergunta:". $totalRespostasPergunta."<br>";
        
        foreach($resultadoEnqueteRespostas as $respostas) {
            
            //seleciona pra pegar a quantidade de cliques por resposta
            $queryEnqueteStats = $conn->query(
                "SELECT * FROM `enquetesStatus` 
                WHERE codResposta = '{$respostas['cod']}'"
            );
            $resultadoEnqueteStats = $queryEnqueteStats->fetchAll(\PDO::FETCH_ASSOC);
            
            $nStatsPorResposta = count($resultadoEnqueteStats);
            //$retorno .= "Votos por resposta:". $nStatsPorResposta."<br>";

            if($totalRespostasPergunta>0){
                $porcentagem = round(($nStatsPorResposta*100)/$totalRespostasPergunta);
            }else{
                $porcentagem = 0;
            }
            $retorno .= "<div>".$respostas['resposta'].": ".$porcentagem ." %</div>";
        }

    }catch(PDOException $e) {
        die($e->getMessage());
    }
    die(json_encode($retorno));
}
?>