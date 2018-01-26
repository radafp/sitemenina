
<<<<<<< HEAD
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
    "SELECT razaoSocial, nome, sobrenome, tipoPessoa, publicidades.codCliente FROM clientes
        INNER JOIN publicidades 
    ON publicidades.codCliente = clientes.cod GROUP BY publicidades.codCliente"

    // "SELECT * FROM `clientes` INNER JOIN publicidades GROUP BY clientes.cod"
);
$nPublicidades = mysql_num_rows($qPublicidades);


?>
<a class="linkTopo" href="<?=ssl().ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=5&cod=1&codDepartamento=<?=$codDepartamento;?>&codSecao=<?=$codSecao;?>&codCategoria=<?=$codCategoria;?>">
    Ordenar todos
</a>
<a class="linkTopo" href="<?=ssl().ADMIN_URL;?>/principal.php?id=<?=$id;?>&subid=5&cod=2&codDepartamento=<?=$codDepartamento;?>&codSecao=<?=$codSecao;?>&codCategoria=<?=$codCategoria;?>">
    Ordenar destaques
</a>
<form action="/adm/principal.php?id=40&subid=6&codDepartamento=1" method='POST'>
=======
<form action="/adm/principal.php?id=40&subid=6&cliente=<?=$cliente;?>" method='GET'>
>>>>>>> a297408c52e07c9ff6e85a0493f228ef5a1922f5
    <input type="hidden" name="id" value="<?=$id;?>" />
    <input type="hidden" name="subid" value="<?=$subid;?>" />
    <div class="divTableFiltro clear">
        <div class="divTr head">
            <div class="divTd">CLIENTE</div>
            <div class="divTd">DATA INICIAL</div>
            <div class="divTd">DATA FINAL</div>
            <div class="divTd">&nbsp;</div>
        </div>
        <div class="divTr">
            <div class="divTd">
<<<<<<< HEAD
                <select id="codDepartamento" name="codPublicidade" class="campoM" title="Departamento">
                    <option value="">Selecione</option>
                    <?php for($i=0;$i<$nPublicidades;$i++){ 
                        $tpRazaoSocial = mysql_fetch_assoc($qPublicidades);
                        ?>
                        <option name="codPublicidade" value="<?=$tpRazaoSocial['codCliente'];?>"><?=$tpRazaoSocial['razaoSocial'];?></option>
=======
                <select id="cliente" name="cliente" class="campoM" title="Cliente">
                    <option value="">Selecione</option>
                    <?php 
                    $qCliente = mysql_query(
                        "SELECT clientes.cod as codCli, razaoSocial, nome, sobrenome, tipoPessoa, publicidades.codCliente FROM clientes
                            INNER JOIN publicidades 
                        ON publicidades.codCliente = clientes.cod GROUP BY publicidades.codCliente"
                    );
                    $nCliente = mysql_num_rows($qCliente);
                    for($i=0;$i<$nCliente;$i++){ 
                        $tpCliente = mysql_fetch_assoc($qCliente);
                        ?>
                        <option value="<?=$tpCliente['codCli'];?>" <?=$tpCliente['codCli'] == $cliente ? "selected='true'" : '' ;?>   ><?=$tpCliente['tipoPessoa'] == 'j' ? $tpCliente['razaoSocial'] : $tpCliente['nome'] .' '.$tpCliente['sobrenome'];?></option>
>>>>>>> a297408c52e07c9ff6e85a0493f228ef5a1922f5
                    <?php } ?>
                </select>
            </div>
            <div class="divTd">
                <input type="date" name='dataInicio'>
            </div>
            <div class="divTd">
                <input type="date" name='dataFim'>
            </div>
            <div class="divTd">
                <input type="submit" value="Filtrar" class="salvar"/>
            </div>
        </div>    
          
    </div>
</form>