
<form action="/adm/principal.php?id=40&subid=6&cliente=<?=$cliente;?>" method='GET'>
    <input type="hidden" name="id" value="<?=$id;?>" />
    <input type="hidden" name="subid" value="<?=$subid;?>" />
    <div class="divTableFiltro clear">
        <div class="divTr head">
            <div class="divTd">CLIENTE</div>
            <!-- <div class="divTd">DATA INICIAL</div>
            <div class="divTd">DATA FINAL</div> -->
            <div class="divTd">&nbsp;</div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <select id="cliente" name="cliente" class="campoM" title="Cliente" required>
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
                    <?php } ?>
                </select>
            </div>
            <!-- <div class="divTd">
                <input type="date" name='dataInicio'>
            </div>
            <div class="divTd">
                <input type="date" name='dataFim'>
            </div> -->
            <div class="divTd">
                <input type="submit" value="Filtrar" class="salvar"/>
            </div>
        </div>    
          
    </div>
</form>