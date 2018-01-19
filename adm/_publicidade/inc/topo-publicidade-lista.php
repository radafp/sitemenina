<?php

$getCodDepartamento = isset($_GET['codDepartamento']) ? $_GET['codDepartamento'] : '';



$codDepartamento = '';
$codSecao = '';
$codCategoria = '';
// if($getCodCategoria > 0)
// {
//     $qLocais = mysql_query("SELECT c.cod AS codCategoria, s.cod AS codSecao, d.cod AS codDepartamento 
//                             FROM categorias AS c
//                             INNER JOIN secoes AS s ON s.cod = c.codSecao
//                             INNER JOIN departamentos AS d ON d.cod = s.codDepartamento
//                             WHERE c.cod = '{$getCodCategoria}'");
//     $nLocais = mysql_num_rows($qLocais);
//     if($nLocais > 0)
//     {
//         $tpLocais = mysql_fetch_assoc($qLocais);
//         $codDepartamento = $tpLocais['codDepartamento'];
//         $codSecao = $tpLocais['codSecao'];
//         $codCategoria = $tpLocais['codCategoria'];
//     }
// }
// elseif($getCodSecao > 0)
// {
//     $qLocais = mysql_query("SELECT s.cod AS codSecao, d.cod AS codDepartamento
//                             FROM secoes AS s
//                             INNER JOIN departamentos AS d ON d.cod = s.codDepartamento
//                             WHERE s.cod = '{$getCodSecao}'");
//     $nLocais = mysql_num_rows($qLocais);
//     if($nLocais > 0)
//     {
//         $tpLocais = mysql_fetch_assoc($qLocais);
//         $codDepartamento = $tpLocais['codDepartamento'];
//         $codSecao = $tpLocais['codSecao'];
//     }
// }
// else
// {
//     $qLocais = mysql_query("SELECT d.cod AS codDepartamento FROM departamentos AS d
//                             WHERE d.cod = '{$getCodDepartamento}'");
//     $nLocais = mysql_num_rows($qLocais);
//     if($nLocais > 0)
//     {
//         $tpLocais = mysql_fetch_assoc($qLocais);
//         $codDepartamento = $tpLocais['codDepartamento'];
//     }
// }
$qPublicidades = mysql_query(
    // "SELECT razaoSocial, nome, sobrenome, tipoPessoa, publicidades.codCliente FROM clientes
    //     INNER JOIN publicidades 
    // ON publicidades.codCliente = clientes.cod GROUP BY publicidades.codCliente"
<<<<<<< HEAD
    "SELECT * FROM `clientes` INNER JOIN publicidades GROUP BY clientes.cod"
);
$nPublicidades = mysql_num_rows($qPublicidades);
=======


    "SELECT razaoSocial FROM `clientes` INNER JOIN publicidades"
);
$tpRazaoSocial = mysql_fetch_assoc($qPublicidades);
var_dump($tpRazaoSocial);
echo '<br> count registros: '.count($tpRazaoSocial) . '<br>';


>>>>>>> 0412a20c2b67749f4ab78bb060b6535dc47b0d9c
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
            <div class="divTd">EMPRESA</div>
            <div class="divTd">DATA INICIAL</div>
            <div class="divTd">DATA FINAL</div>
            <div class="divTd">&nbsp;</div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <select id="codDepartamento" name="codDepartamento" class="campoM" title="Departamento">
                    <option value="">Selecione</option>
<<<<<<< HEAD
                    <?php for($i=0;$i<$nPublicidades;$i++){ 
                        $tpRazaoSocial = mysql_fetch_assoc($qPublicidades);
                        ?>
                        <option value="<?=$tpRazaoSocial['codCliente'];?>"><?=$tpRazaoSocial['razaoSocial'];?></option>
                    <?php } ?>
=======
                    <?php foreach($razaoSocial as $info):?>
                    <option value="<?=$info['codCliente'];?>"><?=$info['razaoSocial'];?></option>
                    <?php endforeach ?>
>>>>>>> 0412a20c2b67749f4ab78bb060b6535dc47b0d9c
                </select>
            </div>
            <div class="divTd">
                <!-- <select id="codSecao" name="codSecao" class="campoM" title="Seção">
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
                </select> -->
                <input type="date">
                <span class="carregandoSecao" style="color:#666;display:none;">Aguarde, carregando...</span>
            </div>
            <div class="divTd">
                <!-- <select id="codCategoria" name="codCategoria" class="campoP" title="Categoria">
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
                </select> -->
                <input type="date">
                <span class="carregandoCategoria" style="color:#666;display:none;">Aguarde, carregando...</span>
            </div>
            <div class="divTd">
                <input type="submit" value="Filtrar" class="salvar"/>
            </div>
        </div>    
          
    </div>
</form>