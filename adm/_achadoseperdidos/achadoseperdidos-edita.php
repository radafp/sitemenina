<?php
if(!verifica_permissao($cod_user, $nivel, 'utilidadePublica'))
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
require_once ADMIN_PATH."func/imprimeTinymce.php";

$submit = isset($_POST['submit']) ? $_POST['submit'] : '';

if($submit != '')
{
    $data = date('Y-m-d');
    $dataPublicacao = isset($_POST['dataPublicacao']) ? dataEn($_POST['dataPublicacao']) : '';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';
    $mostrar = isset($_POST['mostrar']) ? 1 : 0;
    
    $msg = array();
    $erro = 0;
    
    if($erro == 0)
    {
        $pasta = PROJECT_PATH."assets/arquivos/achadoseperdidos";
        
        if($subid == 2) //insert
        {
        	$q = mysql_query("INSERT INTO achadoseperdidos 
                            (dataCadastro, dataPublicacao, descricao, telefone, regiao, mostrar)
                            VALUES
                            ('$data','$dataPublicacao','$descricao','$telefone','$regiao','$mostrar')");
        	
            //echo mysql_error();
            if($q)
        	{
        		$cod = mysql_insert_id();
  
                $foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';
                $foto_temp = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : '';
    
                if($foto != "")
                {               
                    $codigo = rand(1,999999).date('dmYHis');
                    $fileM = insere_foto($foto, $foto_temp, $pasta,'200','140');
            
                    $sqlM = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, codigo)
                            VALUES ('$data', 'achadoseperdidos', '{$cod}', '2', '{$fileM}', '$codigo')";
                    for($b=0;$b<5;$b++)
                    {
                        $qM = mysql_query($sqlM);
                        if($qM)
                        {
                            break;
                        }
                    }
                }
                atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Documentos Perdidos', 'Inseriu', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
                
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
            $q = mysql_query("UPDATE achadoseperdidos SET 
                            dataAlteracao = '$data',
                            dataPublicacao = '$dataPublicacao',
                            descricao = '$descricao',
                            telefone = '$telefone',
                            regiao = '$regiao',
                            mostrar = '$mostrar'
                            WHERE cod = {$cod}");
            //echo mysql_error(); 
                                        
            if($q)
        	{
                 // apaga foto marcada para apagar
                 $codFotoApagar = isset($_POST['apagarFoto']) ? $_POST['apagarFoto'] : '' ;
        
                 if($codFotoApagar != '')
                 {
                     $qUnlink = mysql_query("SELECT arquivo FROM arquivos WHERE codigo='$codFotoApagar' AND referencia = 'achadoseperdidos'");
                     while($tpUnlink = mysql_fetch_assoc($qUnlink))
                     {
                         @unlink($pasta.DIRECTORY_SEPARATOR.$tpUnlink['arquivo']);
                     }
                     $qDelete = mysql_query("DELETE FROM arquivos WHERE codigo = '$codFotoApagar' AND referencia = 'achadoseperdidos'");
                 }
                 
                 $foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';
                /*
                echo "<pre>";
                    var_dump($foto);
                echo "</pre>"; 
                */
                if($foto != '')
                {
                    $qFotosBanco = mysql_query("SELECT cod, arquivo, codigo FROM arquivos WHERE codReferencia = '$cod'
                                            AND referencia = 'achadoseperdidos' AND tipo = '2'");
                    $nFotosBanco = mysql_num_rows($qFotosBanco);
                    
                    // apaga foto que existe no banco e deleta da pasta arquivos
                    if($nFotosBanco>0)
                    {
                        $tpUnlink = mysql_fetch_assoc($qFotosBanco);
                        @unlink($pasta.DIRECTORY_SEPARATOR.$tpUnlink['arquivo']);
                        $qDelete = mysql_query("DELETE FROM arquivos WHERE codigo = '{$tpUnlink['codigo']}' AND referencia = 'achadoseperdidos'");
                    }

                    $foto_temp = $_FILES['foto']['tmp_name'];
                    /*
                    echo "<pre>";
                        var_dump($foto_temp);
                    echo "</pre>";
                    */

                    $codigo = rand(1,999999).date('dmYHis');
                    $fileM = insere_foto($foto, $foto_temp, $pasta,'200','140');
            
                    $sqlM = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, codigo)
                            VALUES ('$data', 'achadoseperdidos', '{$cod}', '2', '{$fileM}', '$codigo')";
                    for($b=0;$b<5;$b++)
                    {
                        $qM = mysql_query($sqlM);
                        if($qM)
                        {
                            break;
                        }
                    }
                    
                }
                atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Documentos Perdidos', 'Alterou', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
                
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
        $q = mysql_query("SELECT * FROM achadoseperdidos WHERE cod = $cod LIMIT 1",$conexao);
        $n = mysql_num_rows($q);
        if($n > 0)
        {
            $tp = mysql_fetch_assoc($q);
            $dataPublicacao = $tp['dataPublicacao'];
            $descricao = $tp['descricao'];
            $telefone = $tp['telefone'];
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
        $dataPublicacao = '';
        $descricao = '';
        $telefone = '';
        $mostrar = 0;
    }
}
?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">
         <div class="divTr">
            <div class="divTd">
                <label>Data da divulgação:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="dataPublicacao" id="dataPublicacao" value="<?=$dataPublicacao != '' ? dataBr($dataPublicacao) : '';?>" title="data da Divulgação"/>        
            </div>
        </div> 
        <div class="divTr">
            <div class="divTd">
                <label>Descrição:</label>
            </div>
            <div class="divTd">
                <?
                    //imprimeTinymce('descricao', html_entity_decode($descricao, ENT_QUOTES, 'UTF-8'), 610, 350, "Descrição");
                ?>
                <textarea id="descricao" name="descricao" title="Descrição"><?=str_replace("<br />", "\n", $descricao);?></textarea>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Telefone:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" maxlength="15" name="telefone" id="telefone" value="<?=$telefone;?>" title="Telefone"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Foto/imagem:</label>
            </div>
            <div class="divTd">
                <input class="foto" name="foto" id="foto" type="file" title="Imagem ilustrativa">
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">&nbsp;</div>
            <div class="divTd">
                <input type="checkbox" name="mostrar" id="mostrar" value="1" <?=$mostrar == 1 || $subid == 2 ? "checked='1'" : '';?>/>
                <span>Mostrar</span>
            </div>
        </div>
    </div>
    <div class="divTableForm clear">    
        <?php
        $qFotos = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '$cod' AND tipo = '2' AND referencia = 'achadoseperdidos' ORDER BY ordem ASC");
        $nFotos = mysql_num_rows($qFotos);
        if($nFotos > 0)
        {
            $tpFotos = mysql_fetch_assoc($qFotos);
        ?>
            <div class="divTr">
                <div class="divTd">
                    <label style="font-weight: bold;">Imagem atual</label>
                </div>
                <div class="divTd">
                    <div class="boxFoto">
                        <div class="divTr clear">
                            <div class="divTd">
                                <img src="http://<?=PROJECT_URL.'/assets/arquivos/achadoseperdidos/'.$tpFotos['arquivo'];?>" title="<?=$tpFotos['legenda'];?>" />
                                <input type="hidden" name="codigos[]" value="<?=$tpFotos['codigo'];?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="divTr">
        <div class="divTd">&nbsp;</div>
        <div class="divTd">
            <input type="submit" value="Salvar" name="submit" class="salvar" />
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#dataPuclicacao').mask('99/99/9999');
        objValidadorCadastro = new xform('#cadastro',
        {
    	   callbackTrue:function()
           {
    	        _erros = new Array();
                $("input[name='fotos[]']").each(function(_k)
                {
                    _file = $(this).val();
                    if(_file != '')
                    {
                        _extFile = _file.split("").reverse().join("").split(".");
                        _extFile = _extFile[0].split("").reverse().join("").toLowerCase();
                        if(_extFile != "png" && _extFile != "jpg" && _extFile != "jpeg")
                        {
                            _erros.push("Formato de arquivo para \"Foto "+(_k+1)+"\" inválido!");
                        }
                    }
                });
                if(_erros.length > 0)
                {
                    _erros.push("\nExtensões permitidas: \".png\", \".jpg\", \".jpeg\"");
                    alert(_erros.join("\n"));
                    return false;
                }
                else
                {
                    return true;
                }
    	   }
        });

        $('#dataPublicacao').mask('99/99/9999');
        objValidadorCadastro . adicionar('#dataPublicacao');
        
        $("#telefone")
        .keyup(function()
        {
            tel = $(this).val();
            v = tel;
            v += '';
            v = v . replace(/\D/g, ''); //Remove tudo o que não é dígito
            v = v . replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v . replace(/(\d{1})?(\d{4})(\d{4})$/, '$1$2-$3');
            return this.value = v;
        })
        .keypress(function(e)
        {
            return validaTecla(e, 'inteiro');
        })
    });
</script>