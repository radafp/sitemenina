<?php
if($subid == 1)
{
?>
    <div class="boxAcoes clear">
        <div class="selecionarTodos">
            <input type="checkbox" title="Selecionar todos" />
        </div>
        <div class="apagarTodos">
            <a href="#" data-link='<?=isset($modulos[$id][$subid]['configLayout']['urlApagarConteudo']) ? $modulos[$id][$subid]['configLayout']['urlApagarConteudo'] : "#";?>'>
                <img src="<?=ssl().ADMIN_URL."/img/base/conteudo/ico-apagar.png";?>" />
            </a>
        </div>
        <div class="addConteudo">
            <a href="<?=isset($modulos[$id][$subid]['configLayout']['urlNovoConteudo']) ? $modulos[$id][$subid]['configLayout']['urlNovoConteudo'] : "#";?>">
                <img src="<?=ssl().ADMIN_URL."/img/base/conteudo/ico-adicionar.png";?>" />
                <span>
                    <?=isset($modulos[$id][$subid]['configLayout']['tituloNovoConteudo']) ? $modulos[$id][$subid]['configLayout']['tituloNovoConteudo'] : "";?>
                </span>
            </a>
        </div>
        <?
        /*
        if($id == 20)
        {
        ?>
            <div class="printConteudo">
                <a href="<?=isset($modulos[$id][$subid]['configLayout']['urlNovoConteudo']) ? $modulos[$id][$subid]['configLayout']['urlNovoConteudo'] : "#";?>">
                    <img src="<?=ssl().ADMIN_URL."/img/base/conteudo/ico-adicionar.png";?>" />
                    <span>
                        <?=isset($modulos[$id][$subid]['configLayout']['tituloNovoConteudo']) ? $modulos[$id][$subid]['configLayout']['tituloNovoConteudo'] : "";?>
                    </span>
                </a>
            </div>
        <?
        }
        */
        ?>
    </div>
<?php
}
else
{
?>
    <div class="voltar">
        <a href="<?=isset($modulos[$id][$subid]['configLayout']['urlListaConteudo']) ? $modulos[$id][$subid]['configLayout']['urlListaConteudo'] : "javascript: history.back();";?>">
            <img src="<?=ssl().ADMIN_URL."/img/base/conteudo/ico-voltar.png";?>" />
            <span>Voltar</span>
        </a>
    </div>    
<?php
}
?>