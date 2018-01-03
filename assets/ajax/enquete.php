<?php
//if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
////{

    try
    {
        $conn = new PDO('mysql:host=mysql03-farm70.uni5.net;dbname=novomenina', 'novomenina', 'agEncia445');
    }
    catch ( PDOException $e )
    {
        echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
    }
    
    $cod = isset($_POST['cod']) ? $_POST['cod'] : 19;
    
    $datacadastro = date('Y-m-d');
    $ip = $_SERVER["REMOTE_ADDR"];

    // CRIAR SELECT PRA PEGAR CÓDIGO DA PERGUNTA 



    //CRIAR SELECR PARA INSERIR VALORES NA TABELA enquetesStatus

    
    
//}
?>