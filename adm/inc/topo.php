<!--<div class="left"></div>
<div class="right"></div>-->
<div class="topo">
    <div class="centro">
        <div class="logoAgencia">
            <img src="<?=ssl().ADMIN_URL;?>/img/base/topo/logoCliente.png" />
        </div>
        <div style="float: left; margin-top: 30px;">
            <b>Editando conteúdos da Região:</b><br>
            <form action="" id="formRegiao" method='POST'>
                <select name="selectRegiao" form="form" id='regiao' style="font-size:16px;height:40px;">
                    <?
                    $qPermissaoRegiao = mysql_query("SELECT bc,bl,lg FROM usuarios WHERE cod = '{$_SESSION[ADMIN_SESSION_NAME.'_cod_user']}'");
                    $tpPermissaoRegiao = mysql_fetch_assoc($qPermissaoRegiao);    
                    if($tpPermissaoRegiao['bc'] == 1)
                    {
                    ?>
                        <option value="bc" <?=$_SESSION[ADMIN_SESSION_NAME.'_regiao'] == 'bc' ? 'selected' : '';?> >Balneário Camboriú</option>
                    <?
                    }
                    if($tpPermissaoRegiao['bl'] == 1)
                    {
                    ?>
                        <option value="bl" <?=$_SESSION[ADMIN_SESSION_NAME.'_regiao'] == 'bl' ? 'selected' : '';?> >Blumenau</option>
                    <?
                    }
                    if($tpPermissaoRegiao['lg'] == 1)
                    {
                    ?>
                        <option value="lg" <?=$_SESSION[ADMIN_SESSION_NAME.'_regiao'] == 'lg' ? 'selected' : '';?> >Lages</option>
                    <?
                    }
                    ?>
                </select>
            </form>
        </div>
        <div class="logoCliente">
            <img src="<?=ssl().ADMIN_URL;?>/img/base/topo/logoAgencia.png" />
            <p>
                Gerenciador de <span>conteúdos</span>
            </p>
        </div>
    </div>
    <div style="background: <?=isset($corSecao) ? $corSecao : '#ffffff';?>; width: 100%; height: 15px;"></div>
</div>