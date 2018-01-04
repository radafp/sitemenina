<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
{
    require_once $_SERVER['DOCUMENT_ROOT'].'/configRoot.php';
    $json = array();
    $json['erro'] = 1;
    
    $cod = isset($_POST['cod']) ? $_POST['cod'] : '';
    $mostrar = isset($_POST['mostrar']) ? $_POST['mostrar'] : '';
    $sql = "UPDATE publicidades SET mostrar = '$mostrar' WHERE cod = '$cod'";
    $query = mysql_query($sql);
    if($query)
    {
        $json['erro'] = 0;
    }
    die(json_encode($json));
}
?>