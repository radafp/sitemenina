<?php
if(!verifica_permissao($cod_user, $nivel, 'enquetes'))
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
    $dataCadastro = date('Y-m-d');
    $pergunta = isset($_POST['pergunta']) ? $_POST['pergunta'] : '';
    $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';

    $qtdRespostas = isset($_POST['resposta']) ? count($_POST['resposta'])  : '';
    $qtdRespostasUpDate = isset($_POST['respostaUpDate']) ? count($_POST['respostaUpDate'])  : '';

    $mostrar = isset($_POST['mostrar']) ? 1 : 0;
   
    $msg = array();
    $erro = 0;
    
    if($erro == 0)
    {
        if($subid == 2) //insert
        {
        	$q = mysql_query("INSERT INTO enquetesPerguntas 
                            (dataCadastro, pergunta, regiao, mostrar)
                            VALUES
                            ('$dataCadastro', '$pergunta', '$regiao', '$mostrar')");
                            //echo mysql_error();
        	
            if($q)
        	{
        		$codPergunta = mysql_insert_id();
                $qtdRespostas = count($_POST['resposta']);

                for($a=0; $a<$qtdRespostas; $a++)
                { 
                    $resposta = isset($_POST['resposta'][$a]) ? $_POST['resposta'][$a] : '';
                    if($resposta != '')
                    {    		
                        $sql = "INSERT INTO enquetesRespostas (dataCadastro, codPergunta, resposta) VALUES ('{$dataCadastro}', '{$codPergunta}', '{$resposta}')";
                        $resultado = mysql_query($sql);
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
            $q = mysql_query("UPDATE enquetesPerguntas  SET 
                                dataAlteracao = '$dataCadastro', 
                                pergunta = '{$pergunta}' 
                                WHERE cod = '$cod'"); 

            for($az=0; $az<$qtdRespostasUpDate; $az++)
            { 
                $respostaUpdate = isset($_POST['respostaUpDate'][$az]) ? $_POST['respostaUpDate'][$az] : '';
                $respostaUpdateCod = isset($_POST['respostaUpDateCod'][$az]) ? $_POST['respostaUpDateCod'][$az] : '';
                $sqlUpdate = "UPDATE enquetesRespostas SET resposta = '{$respostaUpdate}' WHERE cod = '$respostaUpdateCod'";
                $resultadoUpdate = mysql_query($sqlUpdate);
            }
            
            for($a=0; $a<$qtdRespostas; $a++)
            { 
                $resposta = isset($_POST['resposta'][$a]) ? $_POST['resposta'][$a] : '';
                if($resposta != '')
                {    		
                    $sql = "INSERT INTO enquetesRespostas (dataCadastro, codPergunta, resposta) VALUES ('{$dataCadastro}', '{$cod}', '{$resposta}')";
                    $resultado2 = mysql_query($sql);
                }
            }

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
        $q = mysql_query("SELECT * FROM enquetesPerguntas WHERE cod = $cod",$conexao);
        $n = mysql_num_rows($q);
        if($n > 0)
        {
            $tp = mysql_fetch_assoc($q);
            $pergunta = $tp['pergunta'];
            $mostrar = $tp['mostrar'];

            $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';
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

        $pergunta = '';
        $mostrar = 0;

        $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';
    }
}
?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">
        <div class="divTr">
            <div class="divTd">
                <label>Pergunta:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoG" name="pergunta" id="pergunta" value="<?=$pergunta;?>" title="Pergunta"/>
            </div>
        </div>
        <?
        $sqlRespostas = mysql_query("SELECT * FROM enquetesRespostas WHERE codPergunta = '$cod'");
        $nRespostas = mysql_num_rows($sqlRespostas);
        for($ad = 0;$ad < $nRespostas;$ad++)
        {
            $tpRespostas = mysql_fetch_assoc($sqlRespostas);
        ?>
            <div class="divTr">
                <div class="divTd">
                    <label for="pergunta">Resposta <?=($ad+1);?>: </label>
                </div>
                <div class="divTd">
                    <input style="margin-left:30px; width:500px;float: left;margin-right: 10px;" type="text" name="respostaUpDate[]" id="respostaUpDate" title="Resposta <?=($ad+1);?>" value="<?=$tpRespostas['resposta'];?>" />
                    <a style="display: block;background: #000000;color: #fff;padding: 7px;width: 38px;float: left;" href="<?=ssl().ADMIN_URL;?>/principal.php?id=45&subid=6&codPergunta=<?=$cod;?>&codResposta=<?=$tpRespostas['cod'];?>" >Excluir</a>
                    <input  type="hidden" name="respostaUpDateCod[]" id="respostaUpDateCod" value="<?=$tpRespostas['cod'];?>" />
                </div>
                <div class="divTd">
                    
                </div>
            </div>
        <?
        }
        ?>
    </div>
    <hr style="width:90%;float: left;margin-top: 25px;">
    <div class="divTableForm clear">
        <div class="divTr">
            <div class="divTd">
                <label for="numFotos">Incluir Respostas:</label>
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
        objValidadorCadastro = new xform('#cadastro');
        objValidadorCadastro . adicionar('#pergunta');
    });

</script>