<form action="" method='GET'>
    <input type="hidden" name="id" value="<?=$id;?>" />
    <input type="hidden" name="subid" value="<?=$subid;?>" />
    <div class="divTableFiltro clear">
        <div class="divTr head">
            <div class="divTd">Categoria</div>
            <div class="divTd">&nbsp;</div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <select id="categoria" name="categoria" class="campoM" title="Categoria">
                    <option value="">Selecione</option>
                    <?php 
                    $q= mysql_query("SELECT * FROM categorias WHERE regiao = '$regiao' ORDER BY categoriaPt");
                    $n = mysql_num_rows($q);
                    for($i=0;$i<$n;$i++){ 
                        $tp = mysql_fetch_assoc($q);
                        ?>
                        <option value="<?=$tp['cod'];?>" <?=$tp['cod'] == $categoria ? "selected='true'" : '' ;?>   ><?=$tp['categoriaPt'];?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="divTd">
                <input type="submit" value="Filtrar" class="salvar"/>
            </div>
        </div>    
          
    </div>
</form>