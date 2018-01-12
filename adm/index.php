<?php
require_once '../configRoot.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns:fb="http://ogp.me/ns/fb#" xmlns="http://www.w3.org/1999/xhtml">
	<head>
    	
        <title><?=ADMIN_TITLE;?></title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="http://<?=ADMIN_CSS_URL;?>/webfontkit/stylesheet.css" />
        <link href="http://<?=ADMIN_CSS_URL;?>/base.css" rel="stylesheet" type="text/css"/>
        <link href="http://<?=ADMIN_CSS_URL;?>/login.css" rel="stylesheet" type="text/css"/>
        
        <?
        require_once ADMIN_FUNC_PATH.'verifica.php';
        require_once ADMIN_FUNC_PATH.'funcoes_adm.php';
        require_once ADMIN_FUNC_PATH.'redireciona.php';
        
        $submit = isset($_POST['submit']) ? $_POST['submit'] : '';
        
        if($submit != "")
        {
        	$usuario = isset($_POST['user']) ? $_POST['user'] : '';
            $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

            //echo $usuario."<br>";
            //echo $senha."<br>";
            
            $conexao = conexao(); 
            
        	$resultado = mysql_query("SELECT * FROM usuarios WHERE login = '{$usuario}'",$conexao);
        	$linhas = mysql_num_rows($resultado);
        	//echo mysql_errno() . ": " . mysql_error() . "\n";
        	

            if($linhas > 0) 
        	{
                
                $recoba = mysql_fetch_assoc($resultado);
                
                $regiao = isset($_POST['regiao']) ? $_POST['regiao'] : '';
                $liberaRegiao = verifica_regiao($usuario,$regiao);
                //echo $liberaRegiao;
                //die();
                if($liberaRegiao == 1)
                {
            		$fuyutsuki = $senha;
            		$nedved = $recoba['senha'];
            		$md5 = new md5;
            		$arshavin = $md5->decode($nedved);
            		$uia_master = date('h:i:s-d/m/Y').$recoba['cod'];
            		$uia_master_cript = $md5->code($uia_master);
            	    
            		if($arshavin == $fuyutsuki)
            		{	
            			$_SESSION[ADMIN_SESSION_NAME.'_cod_user'] = $recoba['cod'];	
                        $_SESSION[ADMIN_SESSION_NAME.'_user'] = $_POST['user'];
                        $_SESSION[ADMIN_SESSION_NAME.'_nome'] = $_POST['nome'];
                        $_SESSION[ADMIN_SESSION_NAME.'_nome'] = $recoba['nome'];                        
            			$_SESSION[ADMIN_SESSION_NAME.'_time'] = date('d-m-Y');
            			$_SESSION[ADMIN_SESSION_NAME.'_nivel'] = $recoba['nivel'];
                        $_SESSION[ADMIN_SESSION_NAME.'_regiao'] = $regiao;
            			
            			//$_SESSION['token_'.$nome_site] = $uia_master_cript;
            			//$verifica = mysql_query("UPDATE usuarios SET token = '".$uia_master_cript."' WHERE cod = ".$recoba['cod']);
                        /*
                        echo "<pre>";
                            print_r($_SESSION);
                        echo "</pre>";
                        */
                        
                        //redireciona1("http://".ADMIN_URL."/teste.php");
            			
                        redireciona1("http://".ADMIN_URL."/principal.php");
            		}
            		else 
            		{
                        echo "<script>
                               alert('Senha inválida.')";
                        echo " </script>";
                        redireciona1("index.php?erro=1");
                        die();
            			
            		}
                }
                else{
                    echo "<script>
                           alert('Você não tem permissão para editar conteúdos desta região. Contate o administrador.')";
                    echo " </script>";
                    redireciona1("index.php?erro=1");
                    die();
                }		
        	}
        	else 
        	{
                echo "<script>
                       alert('Usuário não encontrado.')";
                echo " </script>";
                redireciona1("index.php?erro=2");
                die();
        	}
        }
        ?>
	</head>
	<body>
		<div class="mestre">
        
            <div class="boxLogin">
                <div class="logo">
                    <img src="<?=ssl().ADMIN_URL;?>/img/base/topo/logoCliente.png" alt="<?=NOME_CLIENTE;?>" />
    			</div>
    			<div class="form-login">
    				<p>
    				   Por favor, digite seus dados.
    			    </p>
                    <form id="news" name="login" method="post" action="">
                        <div class="inputbloco"> 
                            <label>Usuário: </label>
        					<input type="text" name="user" id="user" title="Usuário" />
                        </div>
                        <div class="inputbloco">
                            <label>Senha: </label>
        					<input type="password" name="senha" id="senha" title="Senha" />
                        </div>
                        <div class="inputbloco">
                            <label>Região: </label>
                            <select id="regiao" name="regiao" class="campoM" title="Região">
                                <option value="bc">Balneário Camboriú</option>
                                <option value="bl">Blumenal</option>
                                <option value="lg">Lages</option>
                            </select>
                        </div>
                        <div class="submitbloco">
        					<input name="submit" type="submit" value="Enviar" />
                        </div>
    				</form>
    			</div>
    			
    			<div class="desenvolvedor">
    				<p>
    					Gerenciador de Conteúdo desenvolvido por:
    				</p>
    				<a href="http://www.agenciaset.com.br" target="_blank">
                        <img src="<?=ssl().ADMIN_URL;?>/img/base/topo/logoAgencia.png" alt="<?=PROJECT_DEV_NOME;?>" />
                    </a>
    			</div>
    		</div>
            
		</div>
	</body>
</html>