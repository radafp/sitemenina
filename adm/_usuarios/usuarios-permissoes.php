<?php
$acesso = isset($acesso) ? $acesso : "usuarios-permissoes";
if(!verifica_permissao($cod_user, $nivel, $acesso))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}
require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";

$submit = isset($_POST['submit']) ? $_POST['submit'] : '';

if($submit != '')
{
    $msg = array();
    $erro = 0;
    $permissoes = isset($_POST['permissoes']) ? $_POST['permissoes'] : array();
    $perm = count($permissoes) > 0 ? implode(" ", $permissoes) : '';
    
    if($erro == 0)
    {
        $q = mysql_query("UPDATE usuarios SET
                            permissoes = '{$perm}'
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
    else
    {
        echo "<script>
		          alert('".implode("\\n",$msg)."');
              </script>"; 
    }
    
    
}
else
{
    $q = mysql_query("SELECT permissoes FROM usuarios WHERE cod = '$cod' LIMIT 1",$conexao);
    $n = mysql_num_rows($q);
    if($n > 0)
    {
        $tp = mysql_fetch_assoc($q);
        $permissoes = explode(" ", $tp['permissoes']);
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
?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableFormPermissoes clear">      
        <?php
        $aux = 0;
        $qPermissoes = mysql_query("SELECT * FROM tabelas GROUP BY id ORDER BY nome",$conexao);
        while($tpPermissoes = mysql_fetch_assoc($qPermissoes))
        {
            $aux++;
            $titulo = explode("-", $tpPermissoes['nome']);
            $titulo = trim($titulo[0]);
        ?>
            <div class="boxPermissao">
                <h4><?=$titulo;?></h4>
                <?
                $qPermissoesModulos = mysql_query("SELECT * FROM tabelas WHERE id = '{$tpPermissoes['id']}' ORDER BY nome",$conexao);
                while($tpPermissoesModulos = mysql_fetch_assoc($qPermissoesModulos))
                {
                ?>
                    <div class="divTr">
                        <div class="divTd">
                            <input <?=in_array($tpPermissoesModulos['tabela'], $permissoes) ? "checked='true'" : '';?> type="checkbox" name="permissoes[]" value="<?=$tpPermissoesModulos['tabela'];?>" />
                        </div>
                        <div class="divTd">
                            <label><?=$tpPermissoesModulos['nome'];?></label>
                        </div>
                    </div>
                    
        <?php
                }
        ?>
            </div>
        <?
            if($aux == 3)
            {
                $aux = 0;
                echo "<br style='clear: both;' />";
            }
        }
        ?>
    </div>    
    <div class="divTr">
        <div class="divTd">
            &nbsp;
        </div>
        <div class="divTd">
            <input type="submit" value="Salvar" name="submit" class="salvar" />
        </div>
    </div>
    
</form>