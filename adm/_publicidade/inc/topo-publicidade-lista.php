
<form action="" method='GET'>
    <input type="hidden" name="id" value="<?=$id;?>" />
    <input type="hidden" name="subid" value="<?=$subid;?>" />
    <div class="divTableFiltro clear">
        <div class="divTr head">
            <div class="divTd">CLIENTE</div>
            <div class="divTd">&nbsp;</div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <select id="cliente" name="banner" class="campoM" title="Cliente">
                    <option value="">Selecione</option>
                    <?php 
                    $regiao = isset($_SESSION[ADMIN_SESSION_NAME.'_regiao']) ? $_SESSION[ADMIN_SESSION_NAME.'_regiao'] : '';

                    $qCliente = mysql_query(
                        "SELECT p.*, pt.tipo, pp.pagina FROM publicidades AS p
                     INNER JOIN publiTipos AS pt ON pt.cod = p.codTipo
                     INNER JOIN publiPaginas AS pp ON pp.cod = p.codPagina
                     WHERE p.regiao = '$regiao'
                     GROUP BY p.codCliente"
                    );
                    $nCliente = mysql_num_rows($qCliente);
                    for($i=0;$i<$nCliente;$i++){ 
                        $tpCliente = mysql_fetch_assoc($qCliente);
                        ?>
                        <!-- <option value="<?=$tpCliente['codCli'];?>" <?=$tpCliente['codCli'] == $cliente ? "selected='true'" : '' ;?>   ><?=$tpCliente['tipoPessoa'] == 'j' ? $tpCliente['razaoSocial'] : $tpCliente['nome'] .' '.$tpCliente['sobrenome'];?></option> -->
                        <option value="<?=$tpCliente['codCliente'];?>"><?=$tpCliente['empresa'];?></option>

                    <?php } ?>
                </select>
            </div>
            
            <div class="divTd">
                <input type="submit" value="Filtrar" class="salvar"/>
            </div>
        </div>    
          
    </div>
</form>