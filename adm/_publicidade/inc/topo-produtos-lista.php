<script>
$(document).ready(function()
{
    $('#codDepartamento').change(function() //idEstado
    {
        if($(this).val())
        {
            $('#codSecao').hide(); //idCidade
            $('.carregandoSecao').show();
            
            $.ajax(
            {
                type: "POST",
                async: false,
                url: "http://"+ADMIN_URL+"/_produtos/ajax/ajaxSecoesLista.php", 
                data:
                {
                    codDepartamento: $(this).val()
                },
                dataType: "json",
                success: function(_json)
                { 
                    options = new Array();
                    options.push('<option value="">Selecione</option>');	
                    for(_a=0;_a<_json.length;_a++)
                    {
                        options.push("<option value='"+_json[_a].cod+"'>"+_json[_a].secaoPt+"/"+_json[_a].secaoEn+"</option>");
                    }	
                    $('#codSecao').html(options.join("")).show();
                    $('#codCategoria').html('<option value="">Selecione</option>');
                    $('.carregandoSecao').hide();
                }
            });              
        }
        else
        {
            $('#codSecao').html('<option value="">Selecione</option>');
            $('#codCategoria').html('<option value="">Selecione</option>');
        }
    });
    
    $('#codSecao').change(function() //idEstado
    {
        if($(this).val())
        {
            $('#codCategoria').hide(); //idCidade
            $('.carregandoCategoria').show();
            
            $.ajax(
            {
                type: "POST",
                async: false,
                url: "http://"+ADMIN_URL+"/_produtos/ajax/ajaxCategoriasLista.php", 
                data:
                {
                    codSecao: $(this).val()
                },
                dataType: "json",
                success: function(_json)
                { 
                    options = new Array();
                    options.push('<option value="">Selecione</option>');	
                    for(_a=0;_a<_json.length;_a++)
                    {
                        options.push("<option value='"+_json[_a].cod+"'>"+_json[_a].categoriaPt+"/"+_json[_a].categoriaEn+"</option>");
                    }	
                    $('#codCategoria').html(options.join("")).show();
                    $('.carregandoCategoria').hide();
                }
            });              
        }
        else
        {
            $('#codCategoria').html('<option value="">Selecione</option>');
        }
    });
});
</script>
<?php

$getCodDepartamento = isset($_GET['codDepartamento']) ? $_GET['codDepartamento'] : '';
$getCodSecao = isset($_GET['codSecao']) ? $_GET['codSecao'] : '';
$getCodCategoria = isset($_GET['codCategoria']) ? $_GET['codCategoria'] : '';


$codDepartamento = '';
$codSecao = '';
$codCategoria = '';
if($getCodCategoria > 0)
{
    $qLocais = mysql_query("SELECT c.cod AS codCategoria, s.cod AS codSecao, d.cod AS codDepartamento 
                            FROM categorias AS c
                            INNER JOIN secoes AS s ON s.cod = c.codSecao
                            INNER JOIN departamentos AS d ON d.cod = s.codDepartamento
                            WHERE c.cod = '{$getCodCategoria}'");
    $nLocais = mysql_num_rows($qLocais);
    if($nLocais > 0)
    {
        $tpLocais = mysql_fetch_assoc($qLocais);
        $codDepartamento = $tpLocais['codDepartamento'];
        $codSecao = $tpLocais['codSecao'];
        $codCategoria = $tpLocais['codCategoria'];
    }
}
elseif($getCodSecao > 0)
{
    $qLocais = mysql_query("SELECT s.cod AS codSecao, d.cod AS codDepartamento
                            FROM secoes AS s
                            INNER JOIN departamentos AS d ON d.cod = s.codDepartamento
                            WHERE s.cod = '{$getCodSecao}'");
    $nLocais = mysql_num_rows($qLocais);
    if($nLocais > 0)
    {
        $tpLocais = mysql_fetch_assoc($qLocais);
        $codDepartamento = $tpLocais['codDepartamento'];
        $codSecao = $tpLocais['codSecao'];
    }
}
else
{
    $qLocais = mysql_query("SELECT d.cod AS codDepartamento FROM departamentos AS d
                            WHERE d.cod = '{$getCodDepartamento}'");
    $nLocais = mysql_num_rows($qLocais);
    if($nLocais > 0)
    {
        $tpLocais = mysql_fetch_assoc($qLocais);
        $codDepartamento = $tpLocais['codDepartamento'];
    }
}
$qDepartamentos = mysql_query("SELECT * FROM departamentos ORDER BY departamentoPt ASC");
$qSecoes = mysql_query("SELECT * FROM secoes WHERE codDepartamento = '{$codDepartamento}' ORDER BY secaoPt ASC");
$qCategorias = mysql_query("SELECT * FROM categorias WHERE codSecao = '{$codSecao}' ORDER BY categoriaPt ASC");
?>
<a class="linkTopo" href="<?=ssl().ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=5&cod=1&codDepartamento=<?=$codDepartamento;?>&codSecao=<?=$codSecao;?>&codCategoria=<?=$codCategoria;?>">
    Ordenar todos
</a>
<a class="linkTopo" href="<?=ssl().ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=5&cod=2&codDepartamento=<?=$codDepartamento;?>&codSecao=<?=$codSecao;?>&codCategoria=<?=$codCategoria;?>">
    Ordenar destaques
</a>
<form action="">
    <input type="hidden" name="id" value="<?=$id;?>" />
    <input type="hidden" name="subid" value="<?=$subid;?>" />
    <div class="divTableFiltro clear">
        <div class="divTr head">
            <div class="divTd">Departamento</div>
            <div class="divTd">Seção</div>
            <div class="divTd">Categoria</div>
            <div class="divTd">&nbsp;</div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <select id="codDepartamento" name="codDepartamento" class="campoM" title="Departamento">
                    <option value="">Selecione</option>
                    <?
                    while($tpDepartamentos = mysql_fetch_assoc($qDepartamentos))
                    {
                    ?>
                        <option <?=$tpDepartamentos['cod'] == $codDepartamento ? "selected='true'" : '' ;?> value="<?=$tpDepartamentos['cod'];?>">
                            <?=$tpDepartamentos['departamentoPt'];?>/<?=$tpDepartamentos['departamentoEn'];?>
                        </option>
                    <?
                    }
                    ?>
                </select>
            </div>
            <div class="divTd">
                <select id="codSecao" name="codSecao" class="campoM" title="Seção">
                    <option value="">Selecione</option>
                    <?
                    while($tpSecoes = mysql_fetch_assoc($qSecoes))
                    {
                    ?>
                        <option <?=$tpSecoes['cod'] == $codSecao ? "selected='true'" : '' ;?> value="<?=$tpSecoes['cod'];?>">
                            <?=$tpSecoes['secaoPt'];?>/<?=$tpSecoes['secaoEn'];?>
                        </option>
                    <?
                    }
                    ?>
                </select>
                <span class="carregandoSecao" style="color:#666;display:none;">Aguarde, carregando...</span>
            </div>
            <div class="divTd">
                <select id="codCategoria" name="codCategoria" class="campoP" title="Categoria">
                    <option value="">Selecione</option>
                    <?
                    while($tpCategorias = mysql_fetch_assoc($qCategorias))
                    {
                    ?>
                        <option <?=$tpCategorias['cod'] == $codCategoria ? "selected='true'" : '' ;?> value="<?=$tpCategorias['cod'];?>">
                            <?=$tpCategorias['categoriaPt'];?>/<?=$tpCategorias['categoriaEn'];?>
                        </option>
                    <?
                    }
                    ?>
                </select>
                <span class="carregandoCategoria" style="color:#666;display:none;">Aguarde, carregando...</span>
            </div>
            <div class="divTd">
                <input type="submit" value="Filtrar" class="salvar"/>
            </div>
        </div>    
          
    </div>
</form>