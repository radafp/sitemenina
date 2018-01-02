<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
{
    $json = array();
    $json['erro'] = 1;
    
    $codResposta = isset($_POST['codResposta']) ? $_POST['codResposta'] : '';
    $mostrar = isset($_POST['mostrar']) ? $_POST['mostrar'] : '';

    $sql = $this->db->query("INSERT INTO enquetesStatus SET 
        (date, ip, codPergunta, codReposta) VALUES 
        ('curdate()', $ip, $codPergunta, $codResposta)"
    );

    // $query = mysql_query($sql);
    if($sql)
    {
        $json['erro'] = 0;
    }
    die(json_encode($json));
}
?>