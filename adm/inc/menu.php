<div class="menu">
    <ul class="centro">
        <?
        if(verifica_permissao($cod_user, $nivel, 'usuarios'))
        {
        ?>
            <li class="<?=$id == 1 ? "menuAtivo" : "";?>" >
                <a href="<?=ssl().ADMIN_URL."/principal.php?id=1&subid=1";?>">
                    <span>Usuários</span>
                </a>
            </li>
        <?
        }
        if(verifica_permissao($cod_user, $nivel, 'programacao'))
        {
        ?>
            <li class="<?=$id == 10 ? "menuAtivo" : "";?>" >
                <a href="<?=ssl().ADMIN_URL."/principal.php?id=10&subid=1";?>">
                    <span>Programação</span>
                </a>
            </li>
        <?
        }
        if(verifica_permissao($cod_user, $nivel, 'jornalismo'))
        {
        ?>
            <li class="<?=$id == 15 || $id == 16 ? "menuAtivo" : "";?> jornalismo" >
                <a style="cursor: pointer;">
                    <span>Jornalismo</span>
                </a>
                <ul class="submenu">
                    <li><a href="<?=ssl().ADMIN_URL."/principal.php?id=16&subid=1";?>">Categorias</a></li>
                    <li><a href="<?=ssl().ADMIN_URL."/principal.php?id=15&subid=1";?>">Notícias</a></li>
                </ul>  
            </li>
        <?
        }
        if(verifica_permissao($cod_user, $nivel, 'artistico'))
        {
        ?>
            <li class="<?=$id == 20 ? "menuAtivo" : "";?> artistico" >
                <a style="cursor: pointer;">
                    <span>Artístico</span>
                </a>
                <ul class="submenu">
                    <li><a href="<?=ssl().ADMIN_URL."/principal.php?id=20&subid=1";?>">Top 10</a></li>
                    <li><a href="<?=ssl().ADMIN_URL."/principal.php?id=21&subid=1";?>">Vídeos</a></li>
                </ul>  
            </li>
        <?
        }
        if(verifica_permissao($cod_user, $nivel, 'promocoes'))
        {
        ?>
            <li class="<?=$id == 25 ? "menuAtivo" : "";?>" >
                <a href="<?=ssl().ADMIN_URL."/principal.php?id=25&subid=1";?>">
                    <span>Promoções</span>
                </a>
            </li>
        <?
        }
        if(verifica_permissao($cod_user, $nivel, 'eventos'))
        {
        ?>
            <li class="<?=$id == 30 ? "menuAtivo" : "";?>" >
                <a href="<?=ssl().ADMIN_URL."/principal.php?id=30&subid=1";?>">
                    <span>Eventos</span>
                </a>
            </li>
        <?
        }
        /*
        if(verifica_permissao($cod_user, $nivel, 'utilidadePublica-lista'))
        {
        ?>
            <li class="<?=($id == 35 || $id == 36 || $id == 37) ? "menuAtivo" : "";?> utilidaePublica" >
                <a style="cursor: pointer;">
                    <span>Util. Pública</span>
                </a>
                <ul class="submenu">
                    <li><a href="<?=ssl().ADMIN_URL."/principal.php?id=35&subid=1";?>">Bolsa de empregos</a></li>
                    <li><a href="<?=ssl().ADMIN_URL."/principal.php?id=36&subid=1";?>">Achados e perdidos</a></li>
                    <li><a href="<?=ssl().ADMIN_URL."/principal.php?id=37&subid=1";?>">Campanhas</a></li>
                </ul>  
            </li>
        <?
        }
        /*
        if(verifica_permissao($cod_user, $nivel, 'publicidade-lista'))
        {
        ?>
            <li class="<?=$id == 40 ? "menuAtivo" : "";?>" >
                <a href="<?=ssl().ADMIN_URL."/principal.php?id=40&subid=1";?>">
                    <span>Publicidade</span>
                </a>
            </li>
        <?
        }
        if(verifica_permissao($cod_user, $nivel, 'mailing-lista'))
        {
        ?>
            <li class="<?=$id == 900 ? "menuAtivo" : "";?>" >
                <a href="<?=ssl().ADMIN_URL."/principal.php?id=900&subid=1";?>">
                    <span>Mailing</span>
                </a>
            </li>
        <?
        }
        */
        ?>
        <li>
            <a href="<?=ssl().ADMIN_URL."/logout.php";?>">
                <span>Sair</span>
            </a>
        </li>
        
    </ul>
</div>