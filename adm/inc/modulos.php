<?php
$modulos = array
(
    1 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_usuarios/usuarios-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_usuarios/css/usuarios-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_usuarios/js/usuarios-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Usuários</span>',
                'tituloNovoConteudo' => 'Novo usuário',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_usuarios/usuarios-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_usuarios/css/usuarios-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_usuarios/js/usuarios-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Usuários > <span>Novo usuário</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_usuarios/usuarios-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_usuarios/css/usuarios-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_usuarios/js/usuarios-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Usuários > <span>Editando usuário</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_usuarios/usuarios-apaga.php",
        ), #fim - subid
        100 => array #subid
        (
            'include' => ADMIN_PATH."_usuarios/usuarios-permissoes.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_usuarios/css/usuarios-permissoes.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_usuarios/js/usuarios-permissoes.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Usuários > <span>Editando permissões</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    10 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_programacao/programacao-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_programacao/css/programacao-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_programacao/js/programacao-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Programação</span>',
                'tituloNovoConteudo' => 'Novo programa',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_programacao/programacao-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_programacao/css/programacao-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_programacao/js/programacao-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Programação > <span>Novo programa</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_programacao/programacao-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_programacao/css/programacao-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_programacao/js/programacao-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Programação > <span>Editando programa</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_programacao/programacao-apaga.php",
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_programacao/programacao-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_programacao/css/programacao-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_programacao/js/programacao-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Programação > <span>ordenando fotos</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    15 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_noticias/noticias-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_noticias/css/noticias-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_noticias/js/noticias-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Notícias</span>',
                'tituloNovoConteudo' => 'Nova notícia',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_noticias/noticias-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_noticias/css/noticias-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_noticias/js/noticias-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Notícias > <span>Nova notícia</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_noticias/noticias-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_noticias/css/noticias-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_noticias/js/noticias-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Notícias > <span>Editando notícia</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_noticias/noticias-apaga.php",
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_noticias/noticias-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_noticias/css/noticias-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_noticias/js/noticias-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Notícias > <span>ordenando fotos</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    16 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_categorias/categorias-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_categorias/css/categorias-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_categorias/js/categorias-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Categorias</span>',
                'tituloNovoConteudo' => 'Nova categoria',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_categorias/categorias-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_categorias/css/categorias-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_categorias/js/categorias-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Categorias > <span>Nova categoria</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_categorias/categorias-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_categorias/css/categorias-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_categorias/js/categorias-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Categorias > <span>Editando categoria</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_categorias/categorias-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_categorias/categorias-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_categorias/css/categorias-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_categorias/js/categorias-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Categorias > <span>ordenando categorias</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id
    
    // Artístico
    20 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_top10/top10-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_top10/css/top10-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_top10/js/top10-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Top 10</span>',
                'tituloNovoConteudo' => 'Nova música',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_top10/top10-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_top10/css/top10-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_top10/js/top10-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Top 10 > <span>Nova música</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_top10/top10-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_top10/css/top10-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_top10/js/top10-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Top 10 > <span>Editando música</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_top10/top10-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_top10/top10-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_top10/css/top10-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_top10/js/top10-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Top 10 > <span>ordenando músicas</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_top10/top10-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_top10/css/top10-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_top10/js/top10-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Top 10 > <span>ordenando músicas</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    21 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_videos/videos-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_videos/css/videos-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_videos/js/videos-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Vídeos</span>',
                'tituloNovoConteudo' => 'Novo vídeo',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_videos/videos-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_videos/css/videos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_videos/js/videos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Vídeos > <span>Novo vídeo</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_videos/videos-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_videos/css/videos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_videos/js/videos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Vídeos > <span>Editando vídeo</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_videos/videos-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_videos/videos-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_videos/css/videos-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_videos/js/videos-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Vídeos > <span>ordenando vídeos</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id
    
    //Promoções
    25 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_promocoes/promocoes-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_promocoes/css/promocoes-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_promocoes/js/promocoes-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Promoções</span>',
                'tituloNovoConteudo' => 'Nova Promoção',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_promocoes/promocoes-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_promocoes/css/promocoes-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_promocoes/js/promocoes-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Promoções > <span>Nova Promoção</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_promocoes/promocoes-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_promocoes/css/promocoes-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_promocoes/js/promocoes-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Promoções > <span>Editando Promoção</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_promocoes/promocoes-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_promocoes/promocoes-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_promocoes/css/promocoes-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_promocoes/js/promocoes-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Promoções > <span>ordenando Promoções</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_promocoes/promocoes-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_promocoes/css/promocoes-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_promocoes/js/promocoes-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Promoções > <span>ordenando fotos</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    //Eventos
    30 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_eventos/eventos-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_eventos/css/eventos-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_eventos/js/eventos-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Eventos</span>',
                'tituloNovoConteudo' => 'Novo Evento',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_eventos/eventos-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_eventos/css/eventos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_eventos/js/eventos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Eventos > <span>Novo Evento</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_eventos/eventos-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_eventos/css/eventos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_eventos/js/eventos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Eventos > <span>Editando Evento</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_eventos/eventos-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_eventos/eventos-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_eventos/css/eventos-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_eventos/js/eventos-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Eventos > <span>ordenando Evetos</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_eventos/eventos-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_eventos/css/eventos-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_eventos/js/eventos-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Eventos > <span>ordenando eventos</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    //Eventos
    35 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Bolsa de empregos</span>',
                'tituloNovoConteudo' => 'Nova oferta',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Bolsa de empregos > <span>Nova oferta</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Bolsa de empregos > <span>Editando oferta</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Bolsa de empregos > <span>ordenando ofertas</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Bolsa de empregos > <span>ordenando ofertas</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    //Empregos
    35 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Bolsa de empregos</span>',
                'tituloNovoConteudo' => 'Nova oferta',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Bolsa de empregos > <span>Nova oferta</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Bolsa de empregos > <span>Editando oferta</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Bolsa de empregos > <span>ordenando ofertas</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_empregos/empregos-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_empregos/css/empregos-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_empregos/js/empregos-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Bolsa de empregos > <span>ordenando ofertas</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    //Achados e perdidos
    36 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_achadoseperdidos/achadoseperdidos-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_achadoseperdidos/css/achadoseperdidos-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_achadoseperdidos/js/achadoseperdidos-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Achados e perdidos</span>',
                'tituloNovoConteudo' => 'Novo item',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_achadoseperdidos/achadoseperdidos-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_achadoseperdidos/css/achadoseperdidos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_achadoseperdidos/js/achadoseperdidos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Achados e perdidos > <span>Novo item</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_achadoseperdidos/achadoseperdidos-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_achadoseperdidos/css/achadoseperdidos-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_achadoseperdidos/js/achadoseperdidos-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Achados e perdidos > <span>Editando item</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_achadoseperdidos/achadoseperdidos-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_achadoseperdidos/achadoseperdidos-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_achadoseperdidos/css/achadoseperdidos-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_achadoseperdidos/js/achadoseperdidos-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Achados e perdidos > <span>ordenando itens</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_achadoseperdidos/achadoseperdidos-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_achadoseperdidos/css/achadoseperdidos-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_achadoseperdidos/js/achadoseperdidos-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Achados e perdidos > <span>ordenando itens</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    //Campanhas
    37 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_campanhas/campanhas-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_campanhas/css/campanhas-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_campanhas/js/campanhas-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Campanhas</span>',
                'tituloNovoConteudo' => 'Nova campanha',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_campanhas/campanhas-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_campanhas/css/campanhas-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_campanhas/js/campanhas-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Campanhas > <span>Nova campanha</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_campanhas/campanhas-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_campanhas/css/campanhas-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_campanhas/js/campanhas-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Campanhas > <span>Editando campanha</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_campanhas/campanhas-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_campanhas/campanhas-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_campanhas/css/campanhas-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_campanhas/js/campanhas-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Campanhas > <span>ordenando campanhas</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_campanhas/campanhas-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_campanhas/css/campanhas-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_campanhas/js/campanhas-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Campanhas > <span>ordenando campanhas</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id

    40 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_banners/banners-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_banners/css/banners-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_banners/js/banners-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Banners</span>',
                'tituloNovoConteudo' => 'Novo banner',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_banners/banners-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_banners/css/banners-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_banners/js/banners-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Banners > <span>Novo banner</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_banners/banners-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_banners/css/banners-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_banners/js/banners-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Banners > <span>Editando banner</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_banners/banners-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_banners/banners-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_banners/css/banners-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_banners/js/banners-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Banners > <span>ordenando banners</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        
    ),#fim - id

    // mailing
    900 => array #id
    (
        1 => array #subid
        (
            'include' => ADMIN_PATH."_mailing/mailing-lista.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_mailing/css/mailing-lista.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_mailing/js/mailing-lista.js',
                    ),
            'configLayout' => array
            (
                'bread' => '<span>Mailing</span>',
                'tituloNovoConteudo' => 'Novo contato',
                'urlApagarConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=4",
                'urlNovoConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=2",
            ),
            
        ), #fim - subid
        2 => array #subid
        (
            'include' => ADMIN_PATH."_mailing/mailing-novo.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_mailing/css/mailing-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_mailing/js/mailing-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Mailing > <span>Novo contato</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        3 => array #subid
        (
            'include' => ADMIN_PATH."_mailing/mailing-edita.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_mailing/css/mailing-novo-edita.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_mailing/js/mailing-novo-edita.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Mailing > <span>Editando contato</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        4 => array #subid
        (
            'include' => ADMIN_PATH."_mailing/mailing-apaga.php",
        ), #fim - subid
        5 => array #subid
        (
            'include' => ADMIN_PATH."_mailing/mailing-ordena.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_mailing/css/mailing-ordena.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_mailing/js/mailing-ordena.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Mailing > <span>ordenando mailing</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
        6 => array #subid
        (
            'include' => ADMIN_PATH."_mailing/mailing-ordena-fotos.php",
            'css' => array
                    (
                        ssl().ADMIN_URL.'/_mailing/css/mailing-ordena-fotos.css',
                    ),
            'js' => array
                    (
                        //ssl().ADMIN_URL.'/_mailing/js/mailing-ordena-fotos.js',
                    ),
            'configLayout' => array
            (
                'bread' => 'Mailing > <span>ordenando fotos</span> ',
                'urlListaConteudo' => ssl().ADMIN_URL."/principal.php?id=$id&subid=1",
            ),
        ), #fim - subid
    ),#fim - id
   
);
?>