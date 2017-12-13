<?php 

function redireciona1($URL)
{	
	echo " <script>
            document.location.replace('$URL');
	       </script>";
    die();
}

function redireciona2($URL)
{	
	echo " <script language=\"JavaScript1.2\"> \n";
	echo " <!-- \n";
	echo " open('{$URL}', '_parent')\n";
	echo " //--> \n";
	echo " </script> \n";
    die();
}

?>



