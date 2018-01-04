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
    $horario = isset($_POST['horario']) ? $_POST['horario'] : '';
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
                            (dataCadastro, cleanTitle, programacao, titulo, descricao, horario, apresentador, regiao, mostrar)
                            VALUES
                            ('$data', '$cleanTitle', '$programacao', '$titulo', '$descricao','$horario','$apresentador','$regiao','$mostrar')");
        	
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
                            horario = '$horario',
                            apresentador = '$apresentador',
                            regiao = '$regiao',
                            mostrar = '$mostrar'
                            WHERE cod = {$cod}");
            //echo mysql_error(); 
                                        
            if($q)
        	{
        	    $foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';
                /*
                echo "<pre>";
                    var_dump($foto);
                echo "</pre>"; 
                */
                if($foto != '')
                {
                    $qFotosBanco = mysql_query("SELECT cod, arquivo, codigo FROM arquivos WHERE codReferencia = '$cod'
                                            AND referencia = 'empregos' AND tipo = '2'");
                    $nFotosBanco = mysql_num_rows($qFotosBanco);
                    
                    // apaga foto que existe no banco e deleta da pasta arquivos
                    if($nFotosBanco>0)
                    {
                        $tpUnlink = mysql_fetch_assoc($qFotosBanco);
                        @unlink($pasta.DIRECTORY_SEPARATOR.$tpUnlink['arquivo']);
                        $qDelete = mysql_query("DELETE FROM arquivos WHERE codigo = '{$tpUnlink['codigo']}' AND referencia = 'empregos'");
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
                            VALUES ('$data', 'empregos', '{$cod}', '2', '{$fileM}', '$codigo')";
                    for($b=0;$b<5;$b++)
                    {
                        $qM = mysql_query($sqlM);
                        if($qM)
                        {
                            break;
                        }
                    }
                    
                }
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
            $horario = $tp['horario'];
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
        $horario = '';
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
                <label>Horário*:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="horario" id="horario" value="<?=$horario;?>" title="Horário"/>
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
                
                <input class="foto" name="fotos[]" id="fotos[]" type="file" title="Logo do Programa">
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
        ?>
            <br />
            <div class="">
                <div class="divTd">
                    <label style="font-weight: bold;">Logo Atual</label>
                </div>
                <div class="divTd">&nbsp;</div>
            </div>
            <div class="drag">
            <?php
                $aux = 0;
                while($tpFotos = mysql_fetch_assoc($qFotos))
                {
                    $aux++;
            ?>
                    <div class="boxFoto">
                        <div class="divTr clear">
                            <div class="divTd" style="border: 1px solid #cccccc">
                                <img src="http://<?=PROJECT_URL.'/assets/arquivos/programacao/'.$tpFotos['arquivo'];?>" title="<?=$tpFotos['legenda'];?>" />
                                <input type="hidden" name="codigos[]" value="<?=$tpFotos['codigo'];?>" />
                            </div>
                        </div>
                    </div>
        <?php
                }
        ?>
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
        objValidadorCadastro . adicionar('#horario');
        objValidadorCadastro . adicionar('#apresentador'); 

        $("#horario").mask("99:99");       
        
        /*
        $('input#numFotos').val(Contador . init(1, 1, 10))
        .keyup(function()
        {
            if(window.mg_dalay)
            {
                window.clearTimeout(window.mg_dalay);
            }
    
            window.mg_dalay = window.setTimeout(function(){
                var num = $('input#numFotos').val();
                if (num >= Contador . valorMinimo && num <= Contador . valorMaximo) {
                    Contador . contador = num;
                } else {
                    $('input#numFotos').val(Contador . contador);
                }
                adicionarInputs($('div#groupDivs').get(0), Contador . contador, 'Foto', 'file', 'fotos[]', 2, 'Legenda', 'text', 'legendas[]');
            }, 700);
        });
        adicionarInputs($('div#groupDivs').get(0), Contador . contador, 'Foto', 'file', 'fotos[]', 2, 'Legenda', 'text', 'legendas[]');
    
        $('#maisFotos').click(function()
        {
    		var num = Contador . aumenta();
            $('input#numFotos').val(num);
            adicionarInputs($('div#groupDivs').get(0), num, 'Foto', 'file', 'fotos[]', 2, 'Legenda', 'text', 'legendas[]');
    	});
    
        $('#menosFotos').click(function()
        {
    		var num = Contador . diminui();
            $('input#numFotos').val(num);
            adicionarInputs($('div#groupDivs').get(0), num, 'Foto', 'file', 'fotos[]', 2, 'Legenda', 'text', 'legendas[]');
    	});
        */
    });
    



</script>