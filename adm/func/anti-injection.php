<?php
function anti_injection() 
{

	global $_GET, $_POST;

	foreach ($_POST as $key => $value)
    {
		if(!is_array($value))
        {
            $val = escape($value);
    		$_POST[$key] = $val;
        }
	}

	foreach ($_GET as $key => $value)
    {
		if(!is_array($value))
        {
            $val = escape($value);
    		$_GET[$key] = $val;
        }
	}
}
?>