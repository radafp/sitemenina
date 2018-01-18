<?php
if(!verifica_permissao($cod_user, $nivel, 'usuarios'))
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
    $data = date('Y-m-d');
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
    $bc = isset($_POST['bc']) ? $_POST['bc'] : 0;
    $bl = isset($_POST['bl']) ? $_POST['bl'] : 0;
    $lg = isset($_POST['lg']) ? $_POST['lg'] : 0;
    
    $md5 = new md5;
    $senha =  isset($_POST['senha']) ? $_POST['senha'] : "";
	$senha_cript =  isset($_POST['senha']) ? $md5->code($_POST['senha']) : "";
    $erro = 0;
    
    if($subid == 2) //insert
    {
    	$qUsuarios = mysql_query("INSERT INTO usuarios (dataCadastro, nome, email, login, senha, bc, bl, lg)
                                VALUES
                                ('{$data}','{$nome}','{$email}','{$usuario}','{$senha_cript}','{$bc}','{$bl}','{$lg}')", $conexao);
    
        if($qUsuarios)
    	{
            atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Usuarios', 'Inseriu', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
            
    		echo "<script>
    		          alert('Cadastrado efetuado com sucesso.');
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
        $qUsuarios = mysql_query("UPDATE `usuarios`
                                  SET
                                    `dataAlteracao` = '{$data}',
                                    `nome` = '{$nome}',
                                    `email` = '{$email}',
                                    `login` = '{$usuario}',
                                    `senha` = '{$senha_cript}',
                                    `bc` = '{$bc}',
                                    `bl` = '{$bl}',
                                    `lg` = '{$lg}'
                                  WHERE
                                    `cod` = $cod", $conexao); 
                                    
        if($qUsuarios)
    	{
            atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Usuarios', 'Alterou', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
            
    		echo "<script>
    		          alert('Cadastrado editado com sucesso.');
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
    
}
else
{
    if($subid == 3)
    {
        $qUsuario = mysql_query("SELECT * FROM usuarios WHERE cod = $cod",$conexao);
        $tpUsuario = mysql_fetch_assoc($qUsuario);
        
        $nome = $tpUsuario['nome'];
        $email = $tpUsuario['email'];
        $usuario = $tpUsuario['login'];
        $bc = $tpUsuario['bc'];
        $bl = $tpUsuario['bl'];
        $lg = $tpUsuario['lg'];
    }
    else
    {
        $nome = '';
        $email = '';
        $usuario = '';
        $bc = 0;
        $bl = 0;
        $lg = 0;
    }
}
?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">      
        <div class="divTr">
            <div class="divTd">
                <label>Nome: </label>
            </div>
            <div class="divTd">
                <input type="text" class="campoG" name="nome" id="nome" value="<?=$nome;?>" title="Nome"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>E-mail: </label>
            </div>
            <div class="divTd">
                <input type="text" class="campoG" name="email" id="email" value="<?=$email;?>" title="E-mail"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Usuário:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="usuario" id="usuario" value="<?=$usuario;?>" title="Usuário"/>
            </div>
        </div>
        <?
        if($subid == 2)
        {
        ?>
            <div class="divTr">
                <div class="divTd">
                    <label>Senha: </label>
                </div>
                <div class="divTd">
                    <input type="password" class="campoP" name="senha" id="senha" value="" title="Senha"/>
                </div>
            </div>
            <div class="divTr">
                <div class="divTd">
                    <label>Confirmar senha: </label>
                </div>
                <div class="divTd">
                    <input type="password" class="campoP" name="confSenha" id="confSenha" value="" title="Confirmar senha"/>
                </div>
            </div>
        <?
        }
        elseif($subid == 3){
        ?>
            <div class="divTr">
                <div class="divTd">
                    <label></label>
                </div>
                <div class="divTd">
                    Trocar senha<input type="checkbox" name="trocaSenha" id="trocaSenha" value="" style="float: left; margin-top: 4px; margin-right: 10px;"/>
                </div>
            </div>
            <div class="divTr senha" style="display: none">
                <div class="divTd">
                    <label>Senha: </label>
                </div>
                <div class="divTd">
                    <input type="password" class="campoP" name="senha" id="senha" value="" title="Senha" />
                </div>
            </div>
            <div class="divTr confirmaSenha" style="display: none">
                <div class="divTd">
                    <label>Confirmar senha: </label>
                </div>
                <div class="divTd">
                    <input type="password" class="campoP" name="confSenha" id="confSenha" value="" title="Confirmar senha"/>
                </div>
            </div>
        <?
        }
        ?>
        <div class="divTr">
            <div class="divTd">
                <label></label>
            </div>
            <div class="divTd">
                Este usuário poderá editar conteúdos nas seguintes regiões:
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label></label>
            </div>
            <div class="divTd">
                <div style="margin-right: 20px;">
                    Balneário Camboriú<input type="checkbox" name="bc" id="bc" value="1" <?=$bc == '1' ? 'checked' : '';?> style="float: left; margin-top: 4px; margin-right: 10px;"/>
                </div>
                <div style="margin-right: 20px;">
                    Blumenau<input type="checkbox" name="bl" id="bl" value="1" <?=$bl == '1' ? 'checked' : '';?> style="float: left; margin-top: 4px; margin-right: 10px;"/>
                </div>
                <div style="margin-right: 20px;">
                    Lages<input type="checkbox" name="lg" id="lg" value="1" <?=$lg == '1' ? 'checked' : '';?> style="float: left; margin-top: 4px; margin-right: 10px;"/>
                </div>
            </div>
        </div>
    </div>
    <div class="divTr">
        <div class="divTd">&nbsp;</div>
        <div class="divTd">
            <input type="submit" value="Salvar" name="submit" class="salvar" />
        </div>
    </div>
</form>
<script type="text/javascript">

	//<![CDATA[
		objValidadorCadastro = new xform('#cadastro');
		objValidadorCadastro . adicionar('#nome', 'nome');
        objValidadorCadastro . adicionar('#email', 'email');
		objValidadorCadastro . adicionar('#usuario');

        <?
        if($subid == 2)
        {
            ?>
            objValidadorCadastro . adicionar('#senha');
            objValidadorCadastro . adicionar('#confSenha');
            <?
        }
        ?>


        $("#trocaSenha").unbind("click").bind("click", function()
        {
            if($(this).is(":checked"))
            {
                $("div.senha").fadeIn(200);
                $("div.confirmaSenha").fadeIn(200);
                objValidadorCadastro . adicionar('#senha');
                objValidadorCadastro . adicionar('#confSenha');
            }
            else
            {
                $("div.senha").fadeOut(200);
                $("div.confirmaSenha").fadeOut(200);
                objValidadorCadastro . remover('#senha');
                objValidadorCadastro . remover('#confSenha');
            }
        });


        
	//]]>
</script>