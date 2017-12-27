<?
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
{   
    require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."configRoot.php";
	
    $json = array();
    $json['erro'] = 0;
	$ordem = isset($_POST['ordem']) ? $_POST['ordem'] : '';
	for ($x=0;$x<count($ordem);$x++)
    {
		$i = $x+1;
		$cod = $ordem[$x];
		$sqlOrdem = "UPDATE videos SET ordem = '$i' WHERE cod = '$cod'";
        
        for($a=0;$a<5;$a++)
        {
            $qOrdem = mysql_query($sqlOrdem);    
            if($qOrdem)
            {                        
                break;
            }
        }  
        if(!$qOrdem)
        {
            $json['erro'] = 1;
        }
	}			
	die(json_encode($json));
}
?>