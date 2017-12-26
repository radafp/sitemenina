<!--<div class="left"></div>
<div class="right"></div>-->
<div class="topo">
    <div class="centro">
        <div class="logoAgencia">
            <img src="<?=ssl().ADMIN_URL;?>/img/base/topo/logoCliente.png" />
        </div>
        <div style="float: left; margin-top: 30px;">
            <b>Região:</b><br>

            <form action="" id="formRegiao" method='POST'>
                <select name="selectRegiao" form="form" id='regiao'>
                    <option value="bc" <?=$_SESSION[ADMIN_SESSION_NAME.'_regiao'] == 'bc' ? 'selected' : '';?> >Balneário Camboriú</option>
                    <option value="bl" <?=$_SESSION[ADMIN_SESSION_NAME.'_regiao'] == 'bl' ? 'selected' : '';?> >Blumenau</option>
                    <option value="lg" <?=$_SESSION[ADMIN_SESSION_NAME.'_regiao'] == 'lg' ? 'selected' : '';?> >Lages</option>
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
</div>