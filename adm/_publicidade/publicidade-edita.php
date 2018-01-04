<?php
if(!verifica_permissao($cod_user, $nivel, 'publicidade'))
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

    $tipoArquivo = isset($_POST['extensao'])? $_POST['extensao'] : '' ;
	$link = isset($_POST['link'])? $_POST['link'] : '' ;
    $pagina = isset($_POST['pagina'])? $_POST['pagina'] : '' ;
    $tipo = isset($_POST['tipo'])? $_POST['tipo'] : '' ;
    $dataInicio = isset($_POST['dataInicio']) ? dataEn($_POST['dataInicio']) : '' ;
    $dataFim = isset($_POST['dataFim']) ? dataEn($_POST['dataFim']) : '' ;
    $mostrar = isset($_POST['mostrar']) ? $_POST['mostrar'] : 0;

    $arquivo = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';

    $pixel = isset($_POST['pixel'])? $_POST['pixel'] : '' ;
    
    $extensaoArquivo = pathinfo($arquivo, PATHINFO_EXTENSION);
    
    $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';
    $mostrar = isset($_POST['mostrar']) ? 1 : 0;

    $tamanhoW = 0;
    $tamanhoH = 0;
    
    if($tipo == '1'){
		$tamanhoW = 1070;
		//$tamanhoH = 220;
	}elseif($tipo == '2'){
		$tamanhoW = 470;
		//$tamanhoH = 150;
	}elseif($tipo == '3'){
		$tamanhoW = 330;
		//$tamanhoH = 89;
    }
    
    if($arquivo != '')
	{
		$formato = $_FILES['foto']['name'];
		$formato = strrev($formato);
		$formato = explode('.',$formato);
		$formato = $formato[0];
		$formato = strrev($formato);
		$formato = strtolower($formato);
		$extensoesvalidas = array("jpg","jpeg","png","gif","swf");
		if(!in_array($formato,$extensoesvalidas))
		{
			echo "<script>
                    alert('Formato de arquivo inválido');
                </script>"; 
		}
		
		$tamImg = getimagesize($_FILES['foto']['tmp_name']);
		$w = $tamImg[0];
		$h = $tamImg[1];
		
		if($w != $tamanhoW) //|| $h != $tamanhoH
		{
            echo "<script>
                    alert('a imagem deve ter no máximo '.$tamanhoW.' px de largura');
                </script>";
		}
	}
    
    $msg = array();
    $erro = 0;
    
    if($erro == 0)
    {
        $pasta = PROJECT_PATH."assets/arquivos/publicidade";
        if($subid == 2) //insert
        {
            
        	$q = mysql_query("INSERT INTO publicidades (link, pixel, codPagina,  codTipo, tipoArquivo, dataInicio, dataFim, mostrar)
                            VALUES(
                            '{$link}', '{$pixel}', '{$pagina}', '{$tipo}', '{$tipoArquivo}','{$dataInicio}', '{$dataFim}', '{$mostrar}')");
        	
            echo mysql_error();
            if($q)
        	{
        		$cod = mysql_insert_id();
  
                $foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';
                $foto_temp = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : '';
    
                if($foto != "")
                {               
                    $codigo = rand(1,999999).date('dmYHis');
                    $fileM = insere_foto($foto, $foto_temp, $pasta,$w,$h);
            
                    $sqlM = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, codigo)
                            VALUES ('$data', 'publicidade', '{$cod}', '2', '{$fileM}', '$codigo')";
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
            $q = mysql_query("UPDATE publicidades SET
                    link = '{$link}',
                    tipoArquivo = '{$tipoArquivo}',
                    codPagina = '{$pagina}',
                    codTipo = '{$tipo}',
                    dataInicio = '{$dataInicio}',
                    dataFim = '{$dataFim}',
                    pixel = '{$pixel}',
                    mostrar = '{$mostrar}'
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
                                            AND referencia = 'publicidade' AND tipo = '2'");
                    $nFotosBanco = mysql_num_rows($qFotosBanco);
                    
                    // apaga foto que existe no banco e deleta da pasta arquivos
                    if($nFotosBanco>0)
                    {
                        $tpUnlink = mysql_fetch_assoc($qFotosBanco);
                        @unlink($pasta.DIRECTORY_SEPARATOR.$tpUnlink['arquivo']);
                        $qDelete = mysql_query("DELETE FROM arquivos WHERE codigo = '{$tpUnlink['codigo']}' AND referencia = 'publicidade'");
                    }

                    $foto_temp = $_FILES['foto']['tmp_name'];
                    /*
                    echo "<pre>";
                        var_dump($foto_temp);
                    echo "</pre>";
                    */

                    $codigo = rand(1,999999).date('dmYHis');
                    $fileM = insere_foto($foto, $foto_temp, $pasta,$w,$h);
            
                    $sqlM = "INSERT INTO arquivos (dataCadastro, referencia, codReferencia, tipo, arquivo, codigo)
                            VALUES ('$data', 'publicidade', '{$cod}', '2', '{$fileM}', '$codigo')";
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
        $sqlPublicidade = mysql_query("SELECT * FROM publicidades WHERE cod = '$cod'");
        $n = mysql_num_rows($sqlPublicidade);
        
        if($n > 0)
        {   
            $tp = mysql_fetch_assoc($sqlPublicidade);
        
            $link = $tp['link'];
            $pagina = $tp['codPagina'];
            $tipo = $tp['codTipo'];
            $dataInicio = dataBr($tp['dataInicio']);
            $dataFim = dataBr($tp['dataFim']);
            $pixel = $tp['pixel'];
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
        $link = '';
        $pagina = '';
        $tipo = '';
        $dataInicio = '';
        $dataFim = '';
        $pixel = '';
        $mostrar = 0;
        $foto = '';
        $tipoArquivo = '';
    }
}
?>
<script type="text/javascript">
    $(document).ready(function()
    {

        $('#pagina').change(function()
        {
            if($(this).val())
            {
                $('#tipo').hide();
                $('.carregando').show();
                
                $.ajax(
                {
                    type: "POST",
                    url: "http://"+ADMIN_URL+"/_publicidade/ajax/ajaxPubliTipo.php",
                    data:
                    {
                        cod: $(this).val()
                    
                    },
                    dataType: "json", 
                    success: function(j)
                    { 
                        var options = '<option value="">Selecione</option>';	
                        for (var i = 0; i < j.length; i++) 
                        {
                            options += '<option value="' + j[i].cod + '">' + j[i].tipo + '</option>';
                        }	
                        $('#tipo').html(options).show();
                        $('.carregando').hide();
                    }
                });              
            }
            else
            {
                $('#tipo').html('<option value="">Selecione</option>');
            }
        })
    });
</script>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">
        <div class="divTr">
            <div class="divTd">
                <label>Link*:</label>
            </div>
            <div class="divTd">
                <input type="text" name="link" id="link" title="Link" value="<?=$link;?>" />
            </div>
        </div>  
        <div class="divTr">
            <div class="divTd">
                <label>Página*:</label>
            </div>
            <div class="divTd">
                <select name="pagina" id="pagina" title="Página">
                    <option value="">Selecione</option>
                    <?php
                    $sqlPag = mysql_query("SELECT * FROM publiPaginas ORDER BY cod");
                    $numPag = mysql_num_rows($sqlPag);
                    for($x = 0;$x < $numPag;$x++)
                    {
                        $tpPag = mysql_fetch_assoc($sqlPag);
                    ?>
                        <option value="<?=$tpPag['cod'];?>" <?=$pagina == $tpPag['cod'] ? 'selected="selected"' : '';?>><?=$tpPag['pagina'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Tipo:</label>
            </div>
            <div class="divTd">
                <select name="tipo" id="tipo" title="Tipo">
                    <option value="">Selecione</option>
                    <?php
                    $sqlRel = mysql_query("SELECT * FROM publiRelacao WHERE codPubliPaginas = '$pagina'");
                    $numRel = mysql_num_rows($sqlRel);
                    for($x = 0;$x < $numRel;$x++)
                    {
                        $tpRel = mysql_fetch_assoc($sqlRel);
                        $sqlTipo = mysql_query("SELECT * FROM publiTipos WHERE cod = '{$tpRel['codPubliTipos']}'");
                        $tpTipo = mysql_fetch_assoc($sqlTipo); 
                    ?>
                        <option value="<?=$tpTipo['cod'];?>" <?=$tipo == $tpTipo['cod'] ? 'selected="selected"' : '';?>><?=$tpTipo['tipo'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Data início*:</label>
            </div>
            <div class="divTd">
                <input type="text" name="dataInicio" id="dataInicio" title="Data de inicio do anúncio" value="<?=$dataInicio;?>" />
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Data fim*:</label>
            </div>
            <div class="divTd">
                <input type="text" name="dataFim" id="dataFim" title="Data de fim do anúncio" value="<?=$dataFim;?>" />
            </div>
        </div>
        <?php
            $qFotos = mysql_query("SELECT * FROM arquivos WHERE codReferencia='$cod' AND tipo = '2' AND referencia = 'publicidade' ORDER BY cod ASC");
            $numFotos = mysql_num_rows($qFotos);
            if($numFotos > 0)
            {
                $tpFotos = mysql_fetch_assoc($qFotos);
            ?>
            <div class="divTr">
                <div class="divTd">
                    <label>Imagem Atual:</label>
                </div>
                <div class="divTd">
                    <img src="http://<?=PROJECT_URL.'/assets/arquivos/publicidade/'.$tpFotos['arquivo'];?>" title="<?=$tpFotos['legenda'];?>" />
                    <input type="hidden" name="codigo" value="<?=$tpFotos['codigo'];?>" />
                </div>
            </div>
            <?php
            }
        ?>
        <div class="divTr">
            <div class="divTd">
                <label>Imagem:</label>
            </div>
            <div class="divTd">
                <input class="foto" name="foto" id="foto" type="file" title="foto">
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Pixel:</label>
            </div>
            <div class="divTd">
                <textarea id="pixel" name="pixel" class="campoM" title="Pixel"><?=$pixel;?></textarea>
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
        objValidador = new xform('#cadastro');

        objValidador . adicionar('select#pagina');
        objValidador . adicionar('select#tipo');
        objValidador.adicionar('input#dataInicio','dataBr', true);
        objValidador.adicionar('input#dataFim','dataBr', true);
        
    });

</script>