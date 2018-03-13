

<form action="/adm/principal.php?id=40&subid=6&usuario=<?=$usuario;?>" method='GET'>
    <input type="hidden" name="id" value="<?=$id;?>" />
    <input type="hidden" name="subid" value="<?=$subid;?>" />
    <div class="divTableFiltro clear">
        <div class="divTr head">
            <div class="divTd">USUARIO</div>
            <div class="divTd">DATA INICIAL</div>
            <div class="divTd">DATA FINAL</div>
            <div class="divTd">&nbsp;</div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <select id="usuario" name="usuario" class="campoM" title="usuario" required>
                    <option value="">Selecione</option>
                    <?php 
                    $qUsuarios = mysql_query(
                        "SELECT usuarios.cod, usuarios.nome from usuarios
                            GROUP BY usuarios.cod;"
                    );
                    $nUsuarios = mysql_num_rows($qUsuarios);
                    for($i=0;$i<$nUsuarios;$i++){ 
                        $tpUsuarios= mysql_fetch_assoc($qUsuarios);
                        ?>
                        <option value="<?=$tpUsuarios['cod'];?>" <?=$tpUsuarios['cod'] == $usuario ? "selected='true'" : '' ;?>   ><?=$tpUsuarios['nome'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="divTd">
                <input type="date" name="dataInicio">
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