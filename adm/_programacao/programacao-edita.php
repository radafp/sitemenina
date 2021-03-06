<?php
if(!verifica_permissao($cod_user, $nivel, 'programacao'))
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
    $programacao = isset($_POST['programacao']) ? $_POST['programacao'] : '';
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $cleanTitle = cleanTitle($titulo);
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
    $inicio = isset($_POST['inicio']) ? $_POST['inicio'] : '';
    $fim = isset($_POST['fim']) ? $_POST['fim'] : '';
    $apresentador = isset($_POST['apresentador']) ? $_POST['apresentador'] : '';
    $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';
    $mostrar = isset($_POST['mostrar']) ? 1 : 0;
    
    $msg = array();
    $erro = 0;
    
    if($erro == 0)
    {
        $pasta = "../assets/arquivos/programacao";
        if($subid == 2) //insert
        {
        	$q = mysql_query("INSERT INTO programacao 
                            (dataCadastro, cleanTitle, programacao, titulo, descricao, inicio, fim, apresentador, regiao, mostrar)
                            VALUES
                            ('$data', '$cleanTitle', '$programacao', '$titulo', '$descricao','$inicio','$fim','$apresentador','$regiao','$mostrar')");
        	
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
                            VALUES ('$data', 'programacao', '{$cod}', '2', '{$fileM}', '$codigo')";
                    for($b=0;$b<5;$b++)
                    {
                        $qM = mysql_query($sqlM);
                        if($qM)
                        {
                            break;
                        }
                    }
                }
                atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Programacao', 'Inseriu', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
                
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
            $q = mysql_query("UPDATE programacao SET 
                            dataAlteracao = '$data',
                            cleanTitle = '$cleanTitle',
                            programacao = '$programacao',
                            titulo = '$titulo',
                            descricao = '$descricao',
                            inicio = '$inicio',
                            fim = '$fim',
                            apresentador = '$apresentador',
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
                    $qUnlink = mysql_query("SELECT arquivo FROM arquivos WHERE codigo='$codFotoApagar' AND referencia = 'programacao'");
                    while($tpUnlink = mysql_fetch_assoc($qUnlink))
                    {
                        @unlink($pasta.DIRECTORY_SEPARATOR.$tpUnlink['arquivo']);
                    }
                    $qDelete = mysql_query("DELETE FROM arquivos WHERE codigo = '$codFotoApagar' AND referencia = 'programacao'");
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
                                            AND referencia = 'programacao' AND tipo = '2'");
                    $nFotosBanco = mysql_num_rows($qFotosBanco);
                    
                    // apaga foto que existe no banco e deleta da pasta arquivos
                    if($nFotosBanco>0)
                    {
                        $tpUnlink = mysql_fetch_assoc($qFotosBanco);
                        @unlink($pasta.DIRECTORY_SEPARATOR.$tpUnlink['arquivo']);
                        $qDelete = mysql_query("DELETE FROM arquivos WHERE codigo = '{$tpUnlink['codigo']}' AND referencia = 'programacao'");
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
                            VALUES ('$data', 'programacao', '{$cod}', '2', '{$fileM}', '$codigo')";
                    for($b=0;$b<5;$b++)
                    {
                        $qM = mysql_query($sqlM);
                        if($qM)
                        {
                            break;
                        }
                    }
                    
                }
                atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Programacao', 'Alterou', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
                
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
        $q = mysql_query("SELECT * FROM programacao WHERE cod = $cod LIMIT 1",$conexao);
        $n = mysql_num_rows($q);
        if($n > 0)
        {
            $tp = mysql_fetch_assoc($q);
            $programacao = $tp['programacao'];
            $titulo = $tp['titulo'];
            $descricao = $tp['descricao'];
            $inicio = $tp['inicio'];
            $fim = $tp['fim'];
            $apresentador = $tp['apresentador'];
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
        $programacao = '';
        $titulo = '';
        $descricao = '';
        $inicio = '';
        $fim = '';
        $apresentador = '';
        $mostrar = 0;
    }
}
?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">
        <div class="divTr">
            <div class="divTd">
                <label>Programação*:</label>
            </div>
            <div class="divTd">
                <select id="programacao" name="programacao" class="campoM" title="Programação">
                    <option value="">Selecione</option>
                    <option <?=$programacao == 'Semanal' ? "selected='true'" : '' ;?> value="Semanal">Semanal</option>
                    <option <?=$programacao == 'Sabado' ? "selected='true'" : '' ;?> value="Sabado">Sábado</option>
                    <option <?=$programacao == 'Domingo' ? "selected='true'" : '' ;?> value="Domingo">Domingo</option>
                </select>
            </div>
        </div>  
        <div class="divTr">
            <div class="divTd">
                <label>Titulo*:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoG" name="titulo" id="titulo" value="<?=$titulo;?>" title="Título"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Descrição:</label>
            </div>
            <div class="divTd">
                <?
                    imprimeTinymce('descricao', html_entity_decode($descricao, ENT_QUOTES, 'UTF-8'), 610, 350, "Descrição");
                ?>
                <!--<textarea id="descricaoEn" name="descricaoEn" class="campoG" title="Descrição (En)"><?=str_replace("<br />", "\n", $descricaoEn);?></textarea>-->
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Início*:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="inicio" id="inicio" value="<?=$inicio;?>" title="Horário de início"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Fim*:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="fim" id="fim" value="<?=$fim;?>" title="Horário do fim"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Apresentador*:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoM" name="apresentador" id="apresentador" value="<?=$apresentador;?>" title="Apresentador"/>
            </div>
        </div>

        <div class="divTr">
            <div class="divTd">
                <label>Logo do Programa:</label>
            </div>
            <div class="divTd">
                <input class="foto" name="foto" id="foto" type="file" title="Logo do Programa">
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
        $qFotos = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '$cod' AND tipo = '2' AND referencia = 'programacao' ORDER BY ordem ASC");
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
                                <img src="http://<?=PROJECT_URL.'/assets/arquivos/programacao/'.$tpFotos['arquivo'];?>" title="<?=$tpFotos['legenda'];?>" />
                                <input type="hidden" name="codigos[]" value="<?=$tpFotos['codigo'];?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divTr clear">
                <div class="divTd">
                    <label>Apagar Foto:</label>
                </div>
                <div class="divTd">
                    <input type="checkbox" name="apagarFoto" title="Apagar Foto" value="<?=$tpFotos['codigo'];?>" />
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
        objValidadorCadastro . adicionar('#programacao');
        objValidadorCadastro . adicionar('#titulo');
        objValidadorCadastro . adicionar('#inicio');
        objValidadorCadastro . adicionar('#fim');
        objValidadorCadastro . adicionar('#apresentador'); 

        $("#inicio").mask("99:99");    
        $("#fim").mask("99:99");   
        
    });
    



</script>