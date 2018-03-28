<?php
if(!verifica_permissao($cod_user, $nivel, 'eventos'))
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
    $dataInicio = isset($_POST['dataInicio']) ? dataEn($_POST['dataInicio']) : '';
    $horarioInicio = isset($_POST['horarioInicio']) ? $_POST['horarioInicio'] : '';
    $dataFim = isset($_POST['dataFim']) ? dataEn($_POST['dataFim']) : $dataInicio;
    $horarioFim = isset($_POST['horarioFim']) ? $_POST['horarioFim'] : '';
    $tituloPt = isset($_POST['tituloPt']) ? $_POST['tituloPt'] : '';
    //$tituloEn = isset($_POST['nomeEn']) ? $_POST['nomeEn'] : '';
    //$cleanTitlePt = cleanTitle($nomePt);
    $cleanTitlePt = cleanTitle($tituloPt);
    $descricaoPt = isset($_POST['descricaoPt']) ? $_POST['descricaoPt'] : '';
    
    $mapa = isset($_POST['mapa']) ? $_POST['mapa'] : '';
    
    $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';
    
    $mostrar = isset($_POST['mostrar']) ? 1 : 0;
    
    
    $msg = array();
    $erro = 0;
    
    if($erro == 0)
    {
        $pasta = PROJECT_PATH."assets/arquivos/eventos";
        if($subid == 2) //insert
        {
        	$q = mysql_query("INSERT INTO eventos 
                            ( dataCadastro, dataInicio, horarioInicio, dataFim, horarioFim, tituloPt, cleanTitlePt, descricaoPt, mapa, regiao, mostrar)
                            VALUES
                            ('$data','$dataInicio','$horarioInicio', '$dataFim','$horarioFim', '$tituloPt', '$cleanTitlePt', '$descricaoPt','$mapa','$regiao', '$mostrar')");
        	
            if($q)
        	{
        		$cod = mysql_insert_id();
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
        				$fileM = insere_foto($foto, $foto_temp, $pasta,'640','480');
                        $fileG = insere_foto($foto, $foto_temp, $pasta,'1024','768');
        		
                        $sqlM = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'eventos', '{$cod}', '2', '{$fileM}', '$legenda', '$codigo', '$capa')";
    					for($b=0;$b<5;$b++)
                        {
                            $qM = mysql_query($sqlM);
                            if($qM)
                            {
                                break;
                            }
                        }
                        $sqlG = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'eventos', '{$cod}', '3', '{$fileG}', '$legenda', '$codigo', '$capa')";
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
                atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Eventos', 'Inseriu', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
                
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
            $q = mysql_query("UPDATE eventos SET
                            dataAlteracao = '$data',
                            dataInicio = '$dataInicio',
                            horarioInicio = '$horarioInicio',
                            dataFim = '$dataFim',
                            horarioFim = '$horarioFim',
                            tituloPt = '$tituloPt',
                            cleanTitlePt = '$cleanTitlePt',
                            descricaoPt = '$descricaoPt',
                            mapa = '$mapa',
                            mostrar = '$mostrar'
                            WHERE cod = {$cod}");
            //echo 'erro: '.mysql_error(); 
                                        
            if($q)
        	{
        	    $qtdFotos = count(isset($_FILES['fotos']['name']) ? $_FILES['fotos']['name'] : array());
                $qFotosBanco = mysql_query("SELECT cod FROM arquivos WHERE codReferencia = '$cod'
                                            AND referencia = 'eventos' AND tipo = '2'");
                $nFotosBanco = mysql_num_rows($qFotosBanco);
                
                
                for($c=0;$c<$nFotosBanco;$c++)
                {
                    $codigo = isset($_POST['codigos'][$c]) ? $_POST['codigos'][$c] : '' ;
                    $legenda = isset($_POST['legendasFotos'][$c]) ? $_POST['legendasFotos'][$c] : '' ;
                    $qLegenda = mysql_query("UPDATE arquivos SET legenda = '$legenda'
                                            WHERE codReferencia = '$cod' AND
                                            codigo = '$codigo' AND referencia = 'eventos'");
                }
                
                // Define a foto de capa
                if($nFotosBanco > 0)
                {
                    $qCapa = mysql_query("UPDATE arquivos SET capa = '0'
                                          WHERE codReferencia = '$cod' AND referencia = 'eventos'");
                    for ($e=0;$e<$nFotosBanco;$e++)
                    {
                        $codigo = isset($_POST['capaFotos'][$e]) ? $_POST['capaFotos'][$e] : '';
                        if($codigo != '')
                        {
                            $qCapa = mysql_query("UPDATE arquivos SET capa = '1' WHERE codReferencia = '$cod'
                                                  AND codigo = '$codigo' AND referencia = 'eventos'");
                        }
                    }
                }
                
                for ($i=0; $i < $nFotosBanco; $i++)
                {
                    $codigo = isset($_POST['apagarFotos'][$i]) ? $_POST['apagarFotos'][$i] : '' ;
        
                    $qUnlink = mysql_query("SELECT arquivo FROM arquivos WHERE codigo='$codigo' AND referencia = 'eventos'");
                    while($tpUnlink = mysql_fetch_assoc($qUnlink))
                    {
                        @unlink($pasta.DIRECTORY_SEPARATOR.$tpUnlink['arquivo']);
                    }
                    $qDelete = mysql_query("DELETE FROM arquivos WHERE codigo = '$codigo' AND referencia = 'eventos'");
        			
					$qCapas = mysql_query("SELECT cod FROM arquivos WHERE codReferencia = '$cod' AND referencia = 'eventos' AND capa = '1'");
					$nCapas = mysql_num_rows($qCapas);
					
					if($nCapas == 0)
					{
						$qCapa = mysql_query("SELECT codigo FROM arquivos WHERE codReferencia = '$cod' AND referencia = 'eventos' AND capa = '0' LIMIT 1");
						$tpCapa = mysql_fetch_assoc($qCapa);
						$qMarcaCapa = mysql_query("UPDATE arquivos SET capa = '1' WHERE codReferencia = '$cod'
                                                   AND codigo = '{$tpCapa['codigo']}' AND referencia = 'eventos'");
					}
                }
                
                $qFotosBanco = mysql_query("SELECT cod FROM arquivos WHERE codReferencia = '$cod' AND referencia = 'eventos'");
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
                        $fileM = insere_foto($foto, $foto_temp, $pasta,'640','480');
                        $fileG = insere_foto($foto, $foto_temp, $pasta,'1024','768');
        		
                        $sqlM = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'eventos', '{$cod}', '2', '{$fileM}', '$legenda', '$codigo', '$capa')";
    					for($b=0;$b<5;$b++)
                        {
                            $qM = mysql_query($sqlM);
                            if($qM)
                            {
                                break;
                            }
                        }
                        $sqlG = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, legenda, codigo, capa)
                                VALUES ('$data', 'eventos', '{$cod}', '3', '{$fileG}', '$legenda', '$codigo', '$capa')";
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
                atualiza_usuarios_stats($_SESSION[ADMIN_SESSION_NAME.'_cod_user'], $_SESSION[ADMIN_SESSION_NAME.'_nome'], 'Eventos', 'Alterou', $_SESSION[ADMIN_SESSION_NAME.'_regiao']);
                
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
        $q = mysql_query("SELECT * FROM eventos WHERE cod = $cod LIMIT 1",$conexao);
        $n = mysql_num_rows($q);
        if($n > 0)
        {
            $tp = mysql_fetch_assoc($q); 
            $dataInicio = $tp['dataInicio'];
            $horarioInicio = $tp['horarioInicio'];
            $dataFim = $tp['dataFim'];
            $horarioFim = $tp['horarioFim'];
            $tituloPt = $tp['tituloPt'];
            $descricaoPt = $tp['descricaoPt'];
            $mapa = $tp['mapa']; 
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
        $dataInicio = '';
        $horarioInicio = '';
        $dataFim = '';
        $horarioFim = '';
        $tituloPt = '';
        $descricaoPt = '';
        $mapa = '';
        $mostrar = 0;
    }
}
?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">
        <div class="divTr">
            <div class="divTd">
                <label>Data Inicio:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="dataInicio" id="dataInicio" value="<?=$dataInicio != '0000-00-00' ? dataBr($dataInicio) : '';?>" title="Data início"/>        
            </div>
        </div>  
        <div class="divTr">
            <div class="divTd">
                <label>Horário Inicio:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="horarioInicio" id="horarioInicio" value="<?=$horarioInicio != '' ? $horarioInicio : '';?>" title="Horário início"/>        
            </div>
        </div>  
        <div class="divTr">
            <div class="divTd">
                <label>Data Fim:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="dataFim" id="dataFim" value="<?=$dataFim != '0000-00-00' ? dataBr($dataFim) : '';?>" title="Data Fim"/>        
            </div>
        </div> 
        <div class="divTr">
            <div class="divTd">
                <label>Horário Fim:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="horarioFim" id="horarioFim" value="<?=$horarioFim != '' ? $horarioFim : '';?>" title="Horário Fim"/>        
            </div>
        </div> 
        <div class="divTr">
            <div class="divTd">
                <label>Título*:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoG" name="tituloPt" id="tituloPt" value="<?=$tituloPt;?>" title="Título"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Descrição</label>
            </div>
            <div class="divTd">
                <?
                    imprimeTinymce('descricaoPt', html_entity_decode($descricaoPt, ENT_QUOTES, 'UTF-8'), 610, 500, "Descrição");
                ?>
                <!--<textarea id="descricaoPt" name="descricaoPt" class="campoG" title="Descrição"><?=str_replace("<br />", "\n", $descricaoPt);?></textarea>-->

            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Local (Mapa):</label>
            </div>
            <div class="divTd">
                <textarea id="mapa" name="mapa" class="campoM" title="Mapa"><?=$mapa;?></textarea>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">&nbsp;</div>
            <div class="divTd">
                <input type="checkbox" name="mostrar" id="mostrar" value="1" <?=$mostrar == 1 || $subid == 2 ? "checked='1'" : '';?>/>
                <span>Mostrar</span>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label for="numFotos">N&ordm; de Fotos:</label>
            </div>
            <div class="divTd ctnrContArq">
                <div>
                     <input type="button" value="-" name="menosFotos" id="menosFotos" class="estiloBotao1" style="width: 30px;"/>
                     &nbsp;<input type="text" name="numFotos" id="numFotos" class="tiny" style="text-align: center; width: 100px;" />&nbsp;
                     <input type="button" value="+" name="maisFotos" id="maisFotos" class="estiloBotao1" style="width: 30px;"/>
                </div>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">&nbsp;</div>
            <div class="divTd">
                <div id="groupDivs">
                    <!-- AQUI VÃO OS INPUTS PRA UPLOAD DE ARQUIVO -->
                </div>
            </div>
        </div>
    </div>
    <div class="divTableForm clear">    
        <?php
        $qFotos = mysql_query("SELECT * FROM arquivos WHERE codReferencia = '$cod' AND tipo = '2' AND referencia = 'eventos' ORDER BY ordem ASC");
        $nFotos = mysql_num_rows($qFotos);
        if($nFotos > 0)
        {
        ?>
            <br />
            <div class="">
                <div class="divTd">
                    <label style="font-weight: bold;">FOTOS</label>
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
                            <div class="divTd">
                                <label>Foto <?=$aux;?>:</label>
                            </div>
                            <div class="divTd">
                                <img src="http://<?=PROJECT_URL.'/assets/arquivos/eventos/'.$tpFotos['arquivo'];?>" title="<?=$tpFotos['legenda'];?>" style="max-width: 150px;" />
                                <input type="hidden" name="codigos[]" value="<?=$tpFotos['codigo'];?>" />
                            </div>
                        </div>
                        <div class="divTr clear">
                            <div class="divTd">
                                <label for="legendasFotos<?=$aux;?>">Legenda <?=$aux;?>:</label>
                            </div>
                            <div class="divTd">
                                <input class="campoP" type="text" name="legendasFotos[]" id="legendasFotos<?=$aux;?>" value="<?=$tpFotos['legenda'];?>" />
                            </div>
                        </div>   
                        <div class="divTr clear">
                            <div class="divTd">
                                <label>Apagar Foto <?=$aux;?>:</label>
                            </div>
                            <div class="divTd">
                                <input type="checkbox" name="apagarFotos[]" title="Apagar Foto" value="<?=$tpFotos['codigo'];?>" />
                            </div>
                        </div>
                        <div class="divTr clear">
                            <div class="divTd">
                                <label>Capa:</label>
                            </div>
                            <div class="divTd">
                                <input type="radio" <?=$tpFotos['capa'] == 1 ? "checked='true'" : '' ;?> name="capaFotos[]" title="Capa" value="<?=$tpFotos['codigo'];?>" />
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
        $('#dataInicio').mask('99/99/9999');
        $('#dataFim').mask('99/99/9999');
        //objValidadorCadastro . adicionar('#dataInicio');
        //objValidadorCadastro . adicionar('#dataFim');
        objValidadorCadastro . adicionar('#tituloPt');
        //objValidadorCadastro . adicionar('#descricaoEn');
        
        
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
    });
    



</script>