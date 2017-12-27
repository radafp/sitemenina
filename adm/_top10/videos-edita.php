<?php
$acessoLiberado = false;
if(!isset($acesso))
{
    $acesso = "artistico-edita";
    if(verifica_permissao($cod_user, $nivel, $acesso))
    {
        $acessoLiberado = true;
    }
    elseif(verifica_permissao($cod_user, $nivel, "artistico-visualiza"))
    {
        $acessoLiberado = true;
    }
}
else
{
    if(verifica_permissao($cod_user, $nivel, $acesso))
    {
        $acessoLiberado = true;
    }
}
if(!$acessoLiberado)
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_PATH."_videos/func/funcoes.php";

$submit = isset($_POST['submit']) ? $_POST['submit'] : '';

if($submit != '')
{
    if(!verifica_permissao($cod_user, $nivel, $acesso))
    {
    	echo "<script>
    	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
    	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
    	echo " </script>";
    	die();
    }
    
    $data = date('Y-m-d');
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $cleanTitle = cleanTitle($titulo);

    $link = isset($_POST['link']) ? $_POST['link'] : '';

    $regiao = $_SESSION[ADMIN_SESSION_NAME.'_regiao'];
   
    $mostrar = isset($_POST['mostrar']) ? $_POST['mostrar'] : 0;
    $msg = array();
    $erro = 0;
    
    if($erro == 0)
    {
        if($subid == 2) //insert
        {
        	$q = mysql_query("INSERT INTO videos 
                            (dataCadastro, titulo, link, regiao, mostrar)
                            VALUES
                            ('{$data}', '{$titulo}', '{$link}', '{$regiao}', '{$mostrar}')");
        	
            if($q)
        	{

                $cod = mysql_insert_id();

                $cleanTitle = $cleanTitle.'-'.$cod;

                $qClean = mysql_query("UPDATE videos SET
                                cleanTitle = '{$cleanTitle}'
                                WHERE cod = {$cod}"); 

        	    reordenarVideos();
                
        		echo "<script>
        		          alert('Cadastro efetuado com sucesso.');
        		          document.location.replace('http://".ADMIN_URL."/principal.php?id=$id&subid=1')
        		      </script>";
                die();
        	}	
        	else
        	{
        		echo "<script>
        		          alert('Erro ao cadastrar.');
                      </script>"; 
        	} 
        }
        elseif($subid == 3) //update
        {
            $cleanTitle = $cleanTitle.'-'.$cod;

            $q = mysql_query("UPDATE videos SET
                                dataAlteracao = '{$data}',
                                titulo = '{$titulo}',
                                link = '{$link}',
                                cleanTitle = '{$cleanTitle}',
                                mostrar = '{$mostrar}'
                                WHERE cod = {$cod}"); 
                                        
            if($q)
        	{
        		echo "<script>
        		          alert('Cadastro atualizado com sucesso.');
        		          document.location.replace('http://".ADMIN_URL."/principal.php?id=$id&subid=1')
        		      </script>";
                die();
        	}	
        	else
        	{
        		echo "<script>
        		          alert('Erro ao atualizar cadastro.');
                      </script>"; 
        	}   
        }
    }
    else
    {
        echo "<script>
		          alert('".implode("\\n",$msg)."');
              </script>"; 
    }
    
    
}
else
{
    if($subid == 3)
    {
        $q = mysql_query("SELECT * FROM videos WHERE cod = $cod LIMIT 1",$conexao);
        $n = mysql_num_rows($q);
        if($n > 0)
        {
            $tp = mysql_fetch_assoc($q);
            $titulo = $tp['titulo'];
            $link = $tp['link'];
            $mostrar = $tp['mostrar'];
        }
        else
        {
            echo "<script>
    		          alert('Registro não encontrado.');
    		          document.location.replace('http://".ADMIN_URL."/principal.php?id=$id&subid=1')
    		      </script>";
            die();
        }
    }
    else
    {
        $titulo = '';
        $link = '';
        $mostrar = 0;
    }
}
?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">
        <div class="divTr">
            <div class="divTd">
                <label>Título:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoG" name="titulo" id="titulo" value="<?=$titulo;?>" title="Título"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Link do Vídeo:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoG" name="link" id="link" value="<?=$link;?>" title="Link"/>
                <!--<textarea class="campoG" id="link" name="link" title="Link Vídeo"><?=$link;?></textarea>-->
            </div>
        </div> 
        <?
        if($subid == 3)
        {
        ?>
            <div class="divTr">
                <div class="divTd">
                    <label>Vídeo Atual</label>
                </div>
                <div class="divTd">
                    <? 
                    $imagemCapa = '';                
                    $output = array();
                    $url = $link;
                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $output);
                    $imagemCapa = ssl().'img.youtube.com/vi/' . $output[0] . '/0.jpg';
                    ?>
                    <img src="<?=$imagemCapa;?>" style="max-width:200px">
                </div>
            </div>    
        <?
        }
        ?>
        <div class="divTr">
            <div class="divTd">
            </div>
            <div class="divTd">
                <input type="checkbox" name="mostrar" id="mostrar" value="1" <?=$mostrar == 1 || $subid == 2 ? "checked='1'" : '';?>/>
                <span>Mostrar</span>
            </div>
        </div>
    </div>
    <?
    if(verifica_permissao($cod_user, $nivel, $acesso))
    {
    ?>
        <div class="divTr">
            <div class="divTd">&nbsp;</div>
            <div class="divTd">
                <input type="submit" value="Salvar" name="submit" class="salvar" />
            </div>
        </div>
    <?
    }
    ?>
    
</form>
<script type="text/javascript">
	$(document).ready(function()
    {
        //<![CDATA[
    	objValidadorCadastro = new xform('#cadastro');
    	objValidadorCadastro . adicionar('#titulo');
        objValidadorCadastro . adicionar('#link');
        //]]>
    });
</script>