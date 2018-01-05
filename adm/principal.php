<?php 
require_once '../configRoot.php';

require_once ADMIN_FUNC_PATH.'redireciona.php';
require_once ADMIN_FUNC_PATH.'sessao_verifica.php';
require_once ADMIN_FUNC_PATH.'verifica.php';
require_once ADMIN_FUNC_PATH.'permissoes.php';
require_once ADMIN_FUNC_PATH.'anti-injection.php';

anti_injection();

$cod_user = isset($_SESSION[ADMIN_SESSION_NAME.'_cod_user']) ? $_SESSION[ADMIN_SESSION_NAME.'_cod_user'] : '';	
$user = isset($_SESSION[ADMIN_SESSION_NAME.'_user']) ? $_SESSION[ADMIN_SESSION_NAME.'_user'] : '';
$nivel = isset($_SESSION[ADMIN_SESSION_NAME.'_nivel']) ? $_SESSION[ADMIN_SESSION_NAME.'_nivel'] : '';

$regiao = isset($_GET['regiao']) ? $_GET['regiao'] : $_SESSION[ADMIN_SESSION_NAME.'_regiao'];
$_SESSION[ADMIN_SESSION_NAME.'_regiao'] = $regiao;

switch($_SESSION[ADMIN_SESSION_NAME.'_regiao']){
    case 'bc':
        $corSecao = '#42A3CD';
        break;
    case 'bl':
        $corSecao = '#fbb247';
        break;
    case 'lg':
        $corSecao = '#6dc551';
        break;
}

$id = (isset($_GET['id'])) ? $_GET['id'] : '' ;
$subid = (isset($_GET['subid'])) ? $_GET['subid'] : '' ;
$cod = (isset($_GET['cod'])) ? $_GET['cod'] : '' ;
echo $cod;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns:fb="http://ogp.me/ns/fb#" xmlns="http://www.w3.org/1999/xhtml">
    <head>    
    	<?php
        require_once ADMIN_INC_PATH.'modulos.php';
        require_once ADMIN_INC_PATH.'head.php';    
        ?>
    </head>
    <body>
        <div class="mestre">
            <?php
            require_once ADMIN_INC_PATH."topo.php";
		    require_once ADMIN_INC_PATH."menu.php";
            require_once ADMIN_FUNC_PATH."formatting.php";
            //require_once "../func/funcoes.php";
            ?>
            <div class="conteudo">
                <div class="centro">
                    <div class="pagina">
                        <?php
                        if(isset($modulos[$id][$subid]['include']))// && file_exists($modulos[$id][$subid]['include'])
                        {
                            require_once $modulos[$id][$subid]['include'];
                        }
                        else
                        {
                            require_once "home.php";                       
                        }
                        ?>    
                    </div>
                </div>
            </div>
            <?php
            require_once ADMIN_INC_PATH."rodape.php";
            ?>
        </div>
    </body>
</html>