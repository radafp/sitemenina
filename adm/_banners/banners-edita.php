<?php
$acessoLiberado = false;
if(!isset($acesso))
{
    $acesso = "banners-edita";
    if(verifica_permissao($cod_user, $nivel, $acesso))
    {
        $acessoLiberado = true;
    }
    elseif(verifica_permissao($cod_user, $nivel, "banners-visualiza"))
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
require_once ADMIN_PATH."_banners/func/funcoes.php";
require_once ADMIN_PATH."func/imprimeTinymce.php";

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
    //$dataPost = isset($_POST['data']) ? dataEn($_POST['data']) : '';
    $linkPt = isset($_POST['linkPt']) ? $_POST['linkPt'] : '';
    //$linkEn = isset($_POST['linkEn']) ? $_POST['linkEn'] : '';
    //$nomeEn = isset($_POST['nomeEn']) ? $_POST['nomeEn'] : '';
    //$cleanTitlePt = cleanTitle($nomePt);
    //$cleanTitleEn = cleanTitle($nomeEn);
    //$descricaoPt = isset($_POST['descricaoPt']) ? $_POST['descricaoPt'] : '';
    //$descricaoEn = isset($_POST['descricaoEn']) ? $_POST['descricaoEn'] : '';
    $mostrar = isset($_POST['mostrar']) ? 1 : 0;
    
    
    $msg = array();
    $erro = 0;
    
    if($erro == 0)
    {
        $pasta = PROJECT_PATH."arquivos/banners";
        if($subid == 2) //insert
        {
        	$q = mysql_query("INSERT INTO banners 
                            (dataCadastro, mostrar, linkPt)
                            VALUES
                            ('$data', '$mostrar', '$linkPt')");
        	
            if($q)
        	{
        		$cod = mysql_insert_id();
                reordenarBanners();
                $qtdFotos = count(isset($_FILES['fotos']['name']) ? $_FILES['fotos']['name'] : array());
                for ($a=0;$a<$qtdFotos;$a++)
                {
                    $foto = isset($_FILES['fotos']['name'][$a]) ? $_FILES['fotos']['name'][$a] : '';
                    $foto_temp = $_FILES['fotos']['tmp_name'][$a];
                    $legenda = isset($_POST['legendas'][$a]) ? $_POST['legendas'][$a] : '';
        
                    if($foto != "")
                    {
                        if($qtdFotos == 1)
                        {
                            $capa = 1;
                        }
                        elseif ($qtdFotos > 1 && $a == 0)
                        {
                            $capa = 1;
                        }
                        else
                        {
                            $capa = 0;
                        }                    
                        $codigo = rand(1,999999).date('dmYHis');
                        $fileG = insere_foto($foto, $foto_temp, $pasta,'1920','602');
        				$fileM = insere_foto($foto, $foto_temp, $pasta,'500','157');
        				//$fileP = insere_foto($foto, $foto_temp, $pasta,'114','85');
        		        /*
        				$sqlP = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'banners', '{$cod}', '1', '{$fileP}', '$legenda', '$codigo', '$capa')";
    					for($b=0;$b<5;$b++)
                        {
                            $qP = mysql_query($sqlP);
                            if($qP)
                            {
                                break;
                            }
                        }
                        */
                        $sqlM = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'banners', '{$cod}', '2', '{$fileM}', '$legenda', '$codigo', '$capa')";
    					for($b=0;$b<5;$b++)
                        {
                            $qM = mysql_query($sqlM);
                            if($qM)
                            {
                                break;
                            }
                        }
                        $sqlG = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'banners', '{$cod}', '3', '{$fileG}', '$legenda', '$codigo', '$capa')";
    					for($b=0;$b<5;$b++)
                        {
                            $qG = mysql_query($sqlG);
                            if($qG)
                            {
                                break;
                            }
                        }
					}
        		}
                atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Banners', 'Inseriu', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
                
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
            $q = mysql_query("UPDATE banners SET 
                            dataAlteracao = '$data',
                            linkPt = '$linkPt',
                            mostrar = '$mostrar'
                            WHERE cod = {$cod}");
            //echo mysql_error(); 
                                        
            if($q)
        	{
        	    $qtdFotos = count(isset($_FILES['fotos']['name']) ? $_FILES['fotos']['name'] : array());
                $qFotosBanco = mysql_query("SELECT cod FROM arquivos WHERE codReferencia = '$cod'
                                            AND referencia = 'banners' AND tipo = '2'");
                $nFotosBanco = mysql_num_rows($qFotosBanco);
                
                
                for($c=0;$c<$nFotosBanco;$c++)
                {
                    $codigo = isset($_POST['codigos'][$c]) ? $_POST['codigos'][$c] : '' ;
                    $legenda = isset($_POST['legendasFotos'][$c]) ? $_POST['legendasFotos'][$c] : '' ;
        
                    $qLegenda = mysql_query("UPDATE arquivos SET legenda = '$legenda'
                                            WHERE codReferencia = '$cod' AND
                                            codigo = '$codigo' AND referencia = 'banners'");
                }
                
                if($nFotosBanco > 0)
                {
                    $qCapa = mysql_query("UPDATE arquivos SET capa = '0'
                                          WHERE codReferencia = '$cod' AND referencia = 'banners'");
                    for ($e=0;$e<$nFotosBanco;$e++)
                    {
                        $codigo = isset($_POST['capaFotos'][$e]) ? $_POST['capaFotos'][$e] : '';
                        if($codigo != '')
                        {
                            $qCapa = mysql_query("UPDATE arquivos SET capa = '1' WHERE codReferencia = '$cod'
                                                  AND codigo = '$codigo' AND referencia = 'banners'");
                        }
                    }
                }
                
                for ($i=0; $i < $nFotosBanco; $i++)
                {
                    $codigo = isset($_POST['apagarFotos'][$i]) ? $_POST['apagarFotos'][$i] : '' ;
        
                    $qUnlink = mysql_query("SELECT arquivo FROM arquivos WHERE codigo='$codigo' AND referencia = 'banners'");
                    while($tpUnlink = mysql_fetch_assoc($qUnlink))
                    {
                        @unlink($pasta.DIRECTORY_SEPARATOR.$tpUnlink['arquivo']);
                    }
                    $qDelete = mysql_query("DELETE FROM arquivos WHERE codigo = '$codigo' AND referencia = 'banners'");
        			
					$qCapas = mysql_query("SELECT cod FROM arquivos WHERE codReferencia = '$cod' AND referencia = 'banners' AND capa = '1'");
					$nCapas = mysql_num_rows($qCapas);
					
					if($nCapas == 0)
					{
						$qCapa = mysql_query("SELECT codigo FROM arquivos WHERE codReferencia = '$cod' AND referencia = 'banners' AND capa = '0' LIMIT 1");
						$tpCapa = mysql_fetch_assoc($qCapa);
						$qMarcaCapa = mysql_query("UPDATE arquivos SET capa = '1' WHERE codReferencia = '$cod'
                                                   AND codigo = '{$tpCapa['codigo']}' AND referencia = 'banners'");
					}
                }
                
                $qFotosBanco = mysql_query("SELECT cod FROM arquivos WHERE codReferencia = '$cod' AND referencia = 'banners'");
                $nFotosBanco = mysql_num_rows($qFotosBanco);
                for($a=0;$a<$qtdFotos;$a++)
                {
                    $foto = isset($_FILES['fotos']['name'][$a]) ? $_FILES['fotos']['name'][$a] : '';
                    $foto_temp = $_FILES['fotos']['tmp_name'][$a];
                    $legenda = isset($_POST['legendas'][$a]) ? $_POST['legendas'][$a] : '';
        
                    if ($foto != "")
                    {
                        if ($nFotosBanco > 0)
                        {
                            $capa = 0;
                        }
                        elseif ($qtdFotos == 1 && $nFotosBanco < 1)
                        {
                            $capa = 1;
                        }
                        elseif ($qtdFotos > 1 && $a == 0)
                        {
                            $capa = 1;
                        }
                        else
                        {
                            $capa = 0;
                        }              
                        $codigo = rand(1,999999).date('dmYHis');
                        $fileG = insere_foto($foto, $foto_temp, $pasta,'1920','602');
        				$fileM = insere_foto($foto, $foto_temp, $pasta,'500','157');
        				//$fileP = insere_foto($foto, $foto_temp, $pasta,'114','85');
		                /*
        				$sqlP = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'banners', '{$cod}', '1', '{$fileP}', '$legenda', '$codigo', '$capa')";
    					for($b=0;$b<5;$b++)
                        {
                            $qP = mysql_query($sqlP);
                            if($qP)
                            {
                                break;
                            }
                        }
                        */
                        $sqlM = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'banners', '{$cod}', '2', '{$fileM}', '$legenda', '$codigo', '$capa')";
    					for($b=0;$b<5;$b++)
                        {
                            $qM = mysql_query($sqlM);
                            if($qM)
                            {
                                break;
                            }
                        }
                        $sqlG = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'banners', '{$cod}', '3', '{$fileG}', '$legenda', '$codigo', '$capa')";
    					for($b=0;$b<5;$b++)
                        {
                            $qG = mysql_query($sqlG);
                            if($qG)
                            {
                                break;
                            }
                        }
					}
                }
                atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Banners', 'Alterou', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
                
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
        $q = mysql_query("SELECT * FROM banners WHERE cod = $cod LIMIT 1",$conexao);
        $n = mysql_num_rows($q);
        if($n > 0)
        {
            $tp = mysql_fetch_assoc($q);
            //$dataPost = $tp['data'];
            //$nomeEn = $tp['nomeEn'];
            //$descricaoEn = $tp['descricaoEn'];
            $linkPt = $tp['linkPt'];
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
        $dataPost = '';
        $linkPt = '';
        //$nomeEn = '';
        //$descricaoEn = '';
        $mostrar = 0;
    }
}
?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">
        <?php
        $qFotos = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '$cod' AND tipo = '2' AND referencia = 'banners' ORDER BY cod ASC LIMIT 1");
        $nFotos = mysql_num_rows($qFotos);
        
        $aux = 0;
        while($tpFotos = mysql_fetch_assoc($qFotos))
        {
            $aux++;
        ?>
            <div class="divTr">
                <div class="divTd">
                    <label>Foto:</label>
                </div>
                <div class="divTd">
                    <img style="width: 500px;" src="http://<?=PROJECT_URL.'/arquivos/banners/'.$tpFotos['arquivo'];?>" title="<?=$tpFotos['legenda'];?>" />
                    <input type="hidden" name="codigos[]" value="<?=$tpFotos['codigo'];?>" />
                </div>
            </div>
            <!--
            <div class="divTr">
                <div class="divTd">
                    <label for="legendasFotos<?=$aux;?>">Legenda :</label>
                </div>
                <div class="divTd">
                    <input class="campoG" type="text" name="legendasFotos[]" id="legendasFotos<?=$aux;?>" value="<?=$tpFotos['legenda'];?>" />
                </div>
            </div>
            -->
            <div class="divTr">
                <div class="divTd">
                    <label>Link:</label>
                </div>
                <div class="divTd">
                    <input class="campoG" type="text" name="linkPt" id="linkPt" value="<?=$linkPt;?>" /><br /> Ex.: http://www.endereco.com.br
                </div>
            </div>
            <!--<div class="divTr">
                <div class="divTd">
                    <label>Link (En):</label>
                </div>
                <div class="divTd">
                    <input class="campoG" type="text" name="linkEn" id="linkEn" value="<?=$linkEn;?>" /><br /> Ex.: www.endereco.com.br  ( sem http:// )
                </div>
            </div>
             
            <div class="divTr">
                <div class="divTd">
                    <label>Apagar Foto:</label>
                </div>
                <div class="divTd">
                    <input type="checkbox" name="apagarFotos[]" title="Apagar Foto" value="<?=$tpFotos['codigo'];?>" />
                </div>
            </div>
            
            <div class="divTr">
                <div class="divTd">
                    <label>Capa:</label>
                </div>
                <div class="divTd">
                    <input type="radio" <?=$tpFotos['capa'] == 1 ? "checked='true'" : '' ;?> name="capaFotos[]" title="Capa" value="<?=$tpFotos['codigo'];?>" />
                </div>
            </div>
            -->
            <br /> 
        <?php
        }
        if($nFotos < 1)
        {
        ?>
            <div class="divTr">
                <div class="divTd">
                    <label>Foto</label>
                </div>
                <div class="divTd">
                    <input class="campoG" type="file" name="fotos[]" id="fotos[]" value="" />
                </div>
            </div>
            <div class="divTr">
                <div class="divTd">
                    <label>Link</label>
                </div>
                <div class="divTd">
                    <input class="campoG"  type="text" name="linkPt" id="linkPt" value=""/> <br /> Ex.: http://www.endereco.com.br
                </div>
            </div>
            <!--
            <div class="divTr">
                <div class="divTd">
                    <label>Link (En)</label>
                </div>
                <div class="divTd">
                    <input class="campoG"  type="text" name="linkEn" id="linkEn" value=""/> <br /> Ex.: www.endereco.com.br  ( sem http:// )
                </div>
            </div>
            -->
        <?
        }
        ?>
        <div class="divTr">
            <div class="divTd">&nbsp;</div>
            <div class="divTd">
                <input type="checkbox" name="mostrar" id="mostrar" value="1"  <?=$mostrar == 1 ? "checked='1'" : '';?>/>
                <span>Mostrar</span>
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
        //$('#data').mask('99/99/9999');
        //objValidadorCadastro . adicionar('#data');
        //objValidadorCadastro . adicionar('#nomeEn');
        //objValidadorCadastro . adicionar('#descricaoEn');
    });
</script>