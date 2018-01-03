teste


<?php
echo 'post vindo: ';
var_dump($_POST);
echo '<br>';
$conn = new PDO('mysql:host=mysql03-farm70.uni5.net;dbname=novomenina', 'novomenina', 'agEncia445');

if($conn) {
    echo 'logado';
}else{
    echo 'nao';
}

$codResposta = isset($_POST['cod']) ? $_POST['cod'] : 'Vazio';
echo $codResposta;
$query = $conn->query(
    "SELECT enquetesPerguntas.cod as cod_perg,
            enquetesRespostas.cod as cod_resp
        from enquetesPerguntas
    INNER JOIN enquetesRespostas
        WHERE enquetesPerguntas.cod = enquetesRespostas.codPergunta
        AND enquetesRespostas.cod = $codResposta
");

foreach($query as $info) {
    $codPergunta = $info['cod_perg'];
    echo $codPergunta;
}


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
{
    $json = array();
    $json['erro'] = 1;
    
    $codResposta = isset($_POST['codResposta']) ? $_POST['codResposta'] : '';
    $mostrar = isset($_POST['mostrar']) ? $_POST['mostrar'] : '';

    $query = $this->db->quert(
        "SELECT enquetesPerguntas.cod as cod_perg,
                enquetesRespostas.cod as cod_resp
            from enquetesPerguntas
        INNER JOIN enquetesRespostas
            WHERE enquetesPerguntas.cod = enquetesRespostas.codPergunta
            AND enquetesRespostas.cod = '$codResposta'
    ");

    foreach($query as $info) {
        $codPergunta = $info['cod_perg']; 
    }

    $sql = $this->db->query("INSERT INTO enquetesStatus
        (data, ip, codPergunta, codResposta) VALUES 
        (curdate(), 'dasddasd', '$codPergunta', '$codResposta')"
    );

    // $query = mysql_query($sql);
    if($sql)
    {
        $json['erro'] = 0;
    }
    die(json_encode($json));
}
?>