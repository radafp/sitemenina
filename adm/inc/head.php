<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
    <?=PROJECT_TITLE;?>
</title>
<meta name="description" content="<?=PROJECT_METADESCRIPTION;?>"  />

<link rel="stylesheet" type="text/css" href="<?=ssl().PROJECT_URL;?>/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="<?=ssl().ADMIN_URL;?>/css/webfontkit/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?=ssl().ADMIN_URL;?>/css/base.css" />

<?php
    if(isset($modulos[$id][$subid]['css']) && count($modulos[$id][$subid]['css']) > 0)
    {
        foreach($modulos[$id][$subid]['css'] AS $css)
        {
        ?>
            <link rel="stylesheet" type="text/css" href="<?=$css;?>" />
        <?php
        }
    }
?>
<link rel="stylesheet" type="text/css" href="<?=ssl().ADMIN_URL;?>/css/jquery.fancybox.css" media="screen" />

<!-- jQuery -->
<script type="text/javascript" src="<?=ssl().ADMIN_URL;?>/js/jquery.1.8.0.min.js"></script>
<script type="text/javascript" src="<?=ssl().PROJECT_URL;?>/assets/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="<?=ssl().ADMIN_URL;?>/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?=ssl().ADMIN_URL;?>/js/jquery.maskMoney.js"></script>

<script type="text/javascript" src="<?=ssl().ADMIN_URL;?>/tinymce/tiny_mce.js"></script>

<script type="text/javascript" src="<?=ssl().ADMIN_URL;?>/js/validador1.4.js"></script> 
<script type="text/javascript" src="<?=ssl().ADMIN_URL;?>/js/jquery.mousewheel.pack.js"></script>
<script type="text/javascript" src="<?=ssl().ADMIN_URL;?>/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?=ssl().ADMIN_URL;?>/js/adicionarInputs.js"></script>

<script type="text/javascript" src="<?=ssl().ADMIN_URL;?>/js/jscolor.js"></script>

<?php
    if(isset($modulos[$id][$subid]['js']) && count($modulos[$id][$subid]['js']) > 0)
    {
        foreach($modulos[$id][$subid]['js'] AS $js)
        {
        ?>
            <script type="text/javascript" src="<?=$js;?>"></script>
        <?php
        }
    }
?>

<script type="text/javascript">

    ADMIN_URL = "<?=ADMIN_URL;?>";
    $id = "<?=$id;?>";
    $subid = "<?=$subid;?>";
    $cod = "<?=$cod;?>";
    
    /*
    function autoResize()
    {
        _w = $(window).width();
        $(".right").width(_w-250);
    };
    */
    $(document).ready(function()
    {
        /*
        autoResize();
        $(window).resize(function()
        {
            autoResize();
        });
        */
        $("a[rel=galeria]").fancybox(
        {
    		'transitionIn' : 'none',
    		'transitionOut': 'none',
    		'titlePosition': 'over',
    		'titleFormat'  : function(title, currentArray, currentIndex, currentOpts)
            {
    			/*return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';*/
    		}
    	});

        /* Tratamento submenu jornalismo*/
        if($("li.jornalismo").children("ul").hasClass("submenu"))
        {
            $("li.jornalismo").mouseover(function(){
                
                var tamanhoViewport = $(window).width();
                if (tamanhoViewport > 768) 
                {
                    $(this).find("ul.submenu").show();
                    
                    $(this).mouseout(function(){
                        $(this).find("ul.submenu").hide();
                    })
                }
            })
        }
        $("ul.submenu").mouseover(function(){
            $(this).show();
            $(this).mouseout(function(){
                $(this).hide();
            })
        })
        /* final tratamento submenu */

        /* Tratamento submenu artístico*/
        if($("li.artistico").children("ul").hasClass("submenu"))
        {
            $("li.artistico").mouseover(function(){
                
                var tamanhoViewport = $(window).width();
                if (tamanhoViewport > 768) 
                {
                    $(this).find("ul.submenu").show();
                    
                    $(this).mouseout(function(){
                        $(this).find("ul.submenu").hide();
                    })
                }
            })
        }
        $("ul.submenu").mouseover(function(){
            $(this).show();
            $(this).mouseout(function(){
                $(this).hide();
            })
        })
        /* final tratamento submenu */

        /* Tratamento submenu artístico*/
        if($("li.artistico").children("ul").hasClass("submenu"))
        {
            $("li.artistico").mouseover(function(){
                
                var tamanhoViewport = $(window).width();
                if (tamanhoViewport > 768) 
                {
                    $(this).find("ul.submenu").show();
                    
                    $(this).mouseout(function(){
                        $(this).find("ul.submenu").hide();
                    })
                }
            })
        }
        $("ul.submenu").mouseover(function(){
            $(this).show();
            $(this).mouseout(function(){
                $(this).hide();
            })
        })
        /* final tratamento submenu */

        /* Tratamento submenu Utilidade publica*/
        if($("li.utilidadePublica").children("ul").hasClass("submenu"))
        {
            $("li.utilidadePublica").mouseover(function(){
                
                var tamanhoViewport = $(window).width();
                if (tamanhoViewport > 768) 
                {
                    $(this).find("ul.submenu").show();
                    
                    $(this).mouseout(function(){
                        $(this).find("ul.submenu").hide();
                    })
                }
            })
        }
        $("ul.submenu").mouseover(function(){
            $(this).show();
            $(this).mouseout(function(){
                $(this).hide();
            })
        })
        /* final tratamento submenu */

        /* Tratamento submenu Publicidade*/
        if($("li.publicidade").children("ul").hasClass("submenu"))
        {
            $("li.publicidade").mouseover(function(){
                
                var tamanhoViewport = $(window).width();
                if (tamanhoViewport > 768) 
                {
                    $(this).find("ul.submenu").show();
                    
                    $(this).mouseout(function(){
                        $(this).find("ul.submenu").hide();
                    })
                }
            })
        }
        $("ul.submenu").mouseover(function(){
            $(this).show();
            $(this).mouseout(function(){
                $(this).hide();
            })
        })
        /* final tratamento submenu */


        $('#formRegiao').change(function(){
            var parametro = $(this).find(':selected').val();
            //alert(window.location.href); 
            location.href = 'principal.php?regiao=' + parametro;
        });


        /*$('#formRegiao').on('change', function() {
            alert('teste');
        //$('#formRegiao').change = function(e){
            var regiao = document.querySelector('#regiao');
            window.location = 'regiao?regiao=' + regiao.value;              
        )}*/

    });	
    

        

</script>