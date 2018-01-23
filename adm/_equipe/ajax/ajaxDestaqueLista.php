<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
{
    require_once $_SERVER['DOCUMENT_ROOT'].'/configRoot.php';
    $json = array();
    $json['erro'] = 1;
    
    $cod = isset($_POST['cod']) ? $_POST['cod'] : '';
    $destaque = isset($_POST['destaque']) ? $_POST['destaque'] : '';
    $sql = "UPDATE equipe SET destaque = '$destaque' WHERE cod = '$cod'";
    $query = mysql_query($sql);
    if($query)
    {
        $json['erro'] = 0;
    }
    die(json_encode($json));
}
?>