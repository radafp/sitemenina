<?php
$acessoLiberado = false;
if(!isset($acesso))
{
    $acesso = "categorias-edita";
    if(verifica_permissao($cod_user, $nivel, $acesso))
    {
        $acessoLiberado = true;
    }
    elseif(verifica_permissao($cod_user, $nivel, "categorias-visualiza"))
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
require_once ADMIN_PATH."func/fotos.php";
require_once ADMIN_PATH."_categorias/func/funcoes.php";

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
    $categoriaPt = isset($_POST['categoriaPt']) ? $_POST['categoriaPt'] : '';
    //$categoriaEn = isset($_POST['categoriaEn']) ? $_POST['categoriaEn'] : '';
    $cleanTitlePt = cleanTitle($categoriaPt);
    //$cleanTitleEn = cleanTitle($categoriaEn);
    $regiao = $_SESSION[ADMIN_SESSION_NAME.'_regiao'];
    $mostrar = isset($_POST['mostrar']) ? $_POST['mostrar'] : 0;

    $msg = array();
    $erro = 0;
    

    $pasta = PROJECT_PATH."arquivos/categorias";
    
    if($subid == 2) //insert
    {
    	$q = mysql_query("INSERT INTO categorias 
                        (dataCadastro, categoriaPt, cleanTitlePt, regiao, mostrar)
                        VALUES
                        ('{$data}', '{$categoriaPt}', '{$cleanTitlePt}', '{$regiao}', '{$mostrar}')");
    	
        if($q)
    	{
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
        $q = mysql_query("UPDATE categorias SET
                            dataAlteracao = '{$data}',
                            categoriaPt = '{$categoriaPt}',
                            cleanTitlePt = '{$cleanTitlePt}',
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
    if($subid == 3)
    {
        $q = mysql_query("SELECT * FROM categorias WHERE cod = $cod LIMIT 1",$conexao);
        $n = mysql_num_rows($q);
        if($n > 0)
        {
            $tp = mysql_fetch_assoc($q);
            $categoriaPt = $tp['categoriaPt'];
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
        $categoriaPt = '';
        $mostrar = 0;
    }
}
?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">
        
        <div class="divTr">
            <div class="divTd">
                <label>Categoria:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoG" name="categoriaPt" id="categoriaPt" value="<?=$categoriaPt;?>" title="Categoria (Pt)"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
            </div>
            <div class="divTd">
                <input type="checkbox" name="mostrar" id="mostrar" value="1" <?=$mostrar == 1 || $mostrar == 0 ? "checked='1'" : '';?>/>
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
        objValidadorCadastro . adicionar('#categoriaPt');
        //]]>
    });
</script>