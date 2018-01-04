<?php
function imprimeBannerPrincipal()
{

    try
    {
        $conn = new PDO('mysql:host=mysql03-farm70.uni5.net;dbname=novomenina', 'novomenina', 'agEncia445');
    }
    catch ( PDOException $e )
    {
        echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
    }

    //$conexao = conexao();
    $dataHoje = date("Y-m-d");


    // CRIAR SELECT PRA PEGAR CÓDIGO DA PERGUNTA 
    $array = array();
    $query = $conn->query(
        "SELECT codPagina, cod, empresa, link FROM publicidades 
        WHERE codPagina = 1 
        AND codTipo = 1 
        AND mostrar = 1 
        AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()"
    );
    $array = $query->fetchAll(\PDO::FETCH_ASSOC);
    
    $nBanners = count($array);
    
    if($nBanners>0){

        foreach($array as $info) {
            echo $info['link'];
        }
    
    }

    /*
    
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 1 AND codTipo = 1 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nbanners = mysql_num_rows($sqlBanner);
	
	if($nbanners>0)
	{
	?>
	<div class="bannerbloco">
		<div class="banner">
			<ul>
				<?php
				for($i=0;$i<$nbanners;$i++)
				{
					$tpBanners = mysql_fetch_assoc($sqlBanner);
					
					$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ". $tpBanners['cod']." AND tipo = 1");
					$tpImgBanner = mysql_fetch_assoc($sqlImgBanner);
					
					$extensaoImgBanner = pathinfo($tpImgBanner['arquivo'], PATHINFO_EXTENSION);
					
					if($extensaoImgBanner == "jpg" || $extensaoImgBanner == "jpeg" || $extensaoImgBanner == "png" || $extensaoImgBanner == "gif")
					{
					?>
                        <li class="verPubli" data-codcliente="<?=$tpBanners['codCliente'];?>" data-codpubli="<?=$tpBanners['cod'];?>" data-codpagina="<?=$tpBanners['codPagina'];?>" >
                            <?php
                            if($tpBanners['link'])
                            {
                            ?>
                                <a href="<?=$tpBanners['link'];?>" target="_blank">
                            <?php
                            }
                            ?>
                                <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$tpImgBanner['arquivo'];?>" alt="<?=$tpBanners['link'];?>" />
                            <?php
                            if($tpBanners['link'])
                            {
                            ?>
                                </a>
                            <?php
                            }
                            ?>
                        </li>
					<?php
					}
				
				}
				?>
			</ul>
		</div>
		<p class="bannerlegenda">Publicidade</p>
		<div class="controle" style="display: none;">
			<!--<img class="elipse" id="elip1" src="<?=ssl().PROJECT_URL;?>/img/elipseativa.png" />-->
			<?php
			$qtd = $nbanners;
			for($i=0;$i<$qtd;$i++)
			{
			?>
				<img class="elipse" id="elip<?=$i+1;?>" src="<?=ssl().PROJECT_URL;?>/img/elipse.png" />
			<?php
			}
			?>
		</div>
	</div>
	<?php
	}
    mysql_close();
    */
}

function imprimeFullBanner()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 1 AND codTipo = 2 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
    <script>
        _time1 = 10000;
        $(function()
        {
            jQuery('#bannerFull').show();
            <?php
            if($nBan > 1)
            {
            ?>
            jQuery('#bannerFull').css(
            {
        			width: "796px",
        			height: "150px",
        			position: 'relative',
        			overflow: 'hidden'
    		});
    		jQuery('#bannerFull > *').css(
            {
    			position: 'absolute',
    			width: "796px",
    			height: "150px"
    		});
            slidesUm = jQuery('#bannerFull > *').length;
    		slidesUm = slidesUm-1;
    		actSlideUm = slidesUm;
    		jqSlideUm = jQuery('#bannerFull > *');
            
            setInterval(function()
            {
                jqSlideUm.eq(actSlideUm).fadeOut();
                if(actSlideUm <= 0){
    				jqSlideUm.fadeIn();
    				actSlideUm = slidesUm;
    			}else{
    				actSlideUm = actSlideUm-1;	
    			}
            },_time1);
            <?php
            }
            ?>
        })
    </script>
    <?php
    if($nBan>0)
	{
	   echo "<ul id='bannerFull' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}

function imprimeFullBannerNoticias()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 10 AND codTipo = 2 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
    <script>
        _time1 = 10000;
        $(function()
        {
            jQuery('#bannerFull').show();
            <?php
            if($nBan > 1)
            {
            ?>
            jQuery('#bannerFull').css(
            {
        			width: "796px",
        			height: "150px",
        			position: 'relative',
        			overflow: 'hidden'
    		});
    		jQuery('#bannerFull > *').css(
            {
    			position: 'absolute',
    			width: "796px",
    			height: "150px"
    		});
            slidesUmNoticia = jQuery('#bannerFull > *').length;
    		slidesUmNoticia = slidesUmNoticia-1;
    		actSlideUmNoticia = slidesUmNoticia;
    		jqSlideUmNoticia = jQuery('#bannerFull > *');
            
            setInterval(function()
            {
                jqSlideUmNoticia.eq(actSlideUmNoticia).fadeOut();
                if(actSlideUmNoticia <= 0){
    				jqSlideUmNoticia.fadeIn();
    				actSlideUmNoticia = slidesUmNoticia;
    			}else{
    				actSlideUmNoticia = actSlideUmNoticia-1;	
    			}
            },_time1);
            <?php
            }
            ?>
        })
    </script>
    <?php
    if($nBan>0)
	{
	   echo "<ul id='bannerFull' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
            <li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}

function imprimeBannerRetangulo()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 1 AND codTipo = 3 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 3)
        {
            $num_por_pagina = floor($nBan/3);
            //echo $num_por_pagina."<br />";
            $bannerTres = array_splice($banners,-($num_por_pagina));
            $nBan = count($banners);
            $num_por_pagina = floor($nBan/2);
            //echo $num_por_pagina."<br />";
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
            $bannerTres = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        $nBannerTres = count($bannerTres);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time2 = 10000;
            $(function()
            {
                jQuery('#bannerUm, #bannerDois, #bannerTres').css(
                {
            			width: "290px",
            			height: "89px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUm > *, #bannerDois > *, #bannerTres > *').css(
                {
        			position: 'absolute',
        			width: "290px",
        			height: "89px"
        		});
                slidesUm = jQuery('#bannerUm > *').length;
        		slidesUm = slidesUm-1;
        		actSlideUm = slidesUm;
        		jqSlideUm = jQuery('#bannerUm > *');
                
                slidesDois = jQuery('#bannerDois > *').length;
        		slidesDois = slidesDois-1;
        		actSlideDois = slidesDois;
        		jqSlideDois = jQuery('#bannerDois > *');
                
                slidesTres = jQuery('#bannerTres > *').length;
        		slidesTres = slidesTres-1;
        		actSlideTres = slidesTres;
        		jqSlideTres = jQuery('#bannerTres > *');
                
                setInterval(function()
                {
                    jqSlideUm.eq(actSlideUm).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            jqSlideDois.eq(actSlideDois).fadeOut(function()
                            {
                                <?php
                                if($nBannerTres > 1)
                                {
                                ?>
                                    jqSlideTres.eq(actSlideTres).fadeOut()
                                    if(actSlideTres <= 0){
                        				jqSlideTres.fadeIn();
                        				actSlideTres = slidesTres;
                        			}else{
                        				actSlideTres = actSlideTres-1;	
                        			}
                                <?php
                                }
                                ?>
                            });
                            if(actSlideDois <= 0){
                				jqSlideDois.fadeIn();
                				actSlideDois = slidesDois;
                			}else{
                				actSlideDois = actSlideDois-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUm <= 0){
        				jqSlideUm.fadeIn();
        				actSlideUm = slidesUm;
        			}else{
        				actSlideUm = actSlideUm-1;	
        			}
                },_time2);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUm" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank">
                            <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" />
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDois" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                    <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerTres > 0)
        {
        ?>
            <ul id="bannerTres" class="bannerRetangulo">
                <?php
                foreach($bannerTres as $banTres)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banTres['codCliente'];?>" data-codpubli="<?=$banTres['cod'];?>" data-codpagina="<?=$banTres['codPagina'];?>" >
                        <a href="<?=$banTres['link'] != '' ? $banTres['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banTres['arquivo'];?>" alt="<?=$banTres['empresa'];?>" title="<?=$banTres['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerLateral()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 7 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerLateral').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerLateral').css(
                    {
                			width: "153px",
                			height: "243px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerLateral > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "243px"
            		});
                    slidesUm = jQuery('#bannerLateral > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerLateral > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerLateral' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequeno()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 7 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 3)
        {
            $num_por_pagina = floor($nBan/3);
            //echo $num_por_pagina."<br />";
            $bannerTres = array_splice($banners,-($num_por_pagina));
            $nBan = count($banners);
            $num_por_pagina = floor($nBan/2);
            //echo $num_por_pagina."<br />";
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
            $bannerTres = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        $nBannerTres = count($bannerTres);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateralPeq, #bannerDoisLateralPeq, #bannerTresLateralPeq').css(
                {
            			width: "153px",
            			height: "128px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateralPeq > *, #bannerDoisLateralPeq > *, #bannerTresLateralPeq > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "128px"
        		});
                slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
        		slidesUmLateralPeq = slidesUmLateralPeq-1;
        		actSlideUmLateralPeq = slidesUmLateralPeq;
        		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                
                slidesDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *').length;
        		slidesDoisLateralPeq = slidesDoisLateralPeq-1;
        		actSlideDoisLateralPeq = slidesDoisLateralPeq;
        		jqSlideDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *');
                
                slidesTresLateralPeq = jQuery('#bannerTresLateralPeq > *').length;
        		slidesTresLateralPeq = slidesTresLateralPeq-1;
        		actSlideTresLateralPeq = slidesTresLateralPeq;
        		jqSlideTresLateralPeq = jQuery('#bannerTresLateralPeq > *');
                
                setInterval(function()
                {
                    jqSlideUmLateralPeq.eq(actSlideUmLateralPeq).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            jqSlideDoisLateralPeq.eq(actSlideDoisLateralPeq).fadeOut(function()
                            {
                                <?php
                                if($nBannerTres > 1)
                                {
                                ?>
                                    jqSlideTresLateralPeq.eq(actSlideTresLateralPeq).fadeOut()
                                    if(actSlideTresLateralPeq <= 0){
                        				jqSlideTresLateralPeq.fadeIn();
                        				actSlideTresLateralPeq = slidesTresLateralPeq;
                        			}else{
                        				actSlideTresLateralPeq = actSlideTresLateralPeq-1;	
                        			}
                                <?php
                                }
                                ?>
                            });
                            if(actSlideDoisLateralPeq <= 0){
                				jqSlideDoisLateralPeq.fadeIn();
                				actSlideDoisLateralPeq = slidesDoisLateralPeq;
                			}else{
                				actSlideDoisLateralPeq = actSlideDoisLateralPeq-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateralPeq <= 0){
        				jqSlideUmLateralPeq.fadeIn();
        				actSlideUmLateralPeq = slidesUmLateralPeq;
        			}else{
        				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerTres > 0)
        {
        ?>
            <ul id="bannerTresLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerTres as $banTres)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banTres['codCliente'];?>" data-codpubli="<?=$banTres['cod'];?>" data-codpagina="<?=$banTres['codPagina'];?>" >
                        <a href="<?=$banTres['link'] != '' ? $banTres['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banTres['arquivo'];?>" alt="<?=$banTres['empresa'];?>" title="<?=$banTres['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerLateralDet($tipo = 1)
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = ".($tipo == 2 ? '5' : '4')." AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time5 = 10000;
            $(function()
            {
                jQuery('#bannerLateral').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerLateral').css(
                    {
                			width: "153px",
                			height: "243px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerLateral > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "243px"
            		});
                    slidesUm = jQuery('#bannerLateral > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerLateral > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time5);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerLateral' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoDet($tipo = 1)
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = ".($tipo == 2 ? '5' : '4')." AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 3)
        {
            $num_por_pagina = floor($nBan/3);
            //echo $num_por_pagina."<br />";
            $bannerTres = array_splice($banners,-($num_por_pagina));
            $nBan = count($banners);
            $num_por_pagina = floor($nBan/2);
            //echo $num_por_pagina."<br />";
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
            $bannerTres = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        $nBannerTres = count($bannerTres);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time6 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateralPeq, #bannerDoisLateralPeq, #bannerTresLateralPeq').css(
                {
            			width: "153px",
            			height: "128px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateralPeq > *, #bannerDoisLateralPeq > *, #bannerTresLateralPeq > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "128px"
        		});
                slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
        		slidesUmLateralPeq = slidesUmLateralPeq-1;
        		actSlideUmLateralPeq = slidesUmLateralPeq;
        		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                
                slidesDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *').length;
        		slidesDoisLateralPeq = slidesDoisLateralPeq-1;
        		actSlideDoisLateralPeq = slidesDoisLateralPeq;
        		jqSlideDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *');
                
                slidesTresLateralPeq = jQuery('#bannerTresLateralPeq > *').length;
        		slidesTresLateralPeq = slidesTresLateralPeq-1;
        		actSlideTresLateralPeq = slidesTresLateralPeq;
        		jqSlideTresLateralPeq = jQuery('#bannerTresLateralPeq > *');
                
                setInterval(function()
                {
                    jqSlideUmLateralPeq.eq(actSlideUmLateralPeq).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            jqSlideDoisLateralPeq.eq(actSlideDoisLateralPeq).fadeOut(function()
                            {
                                <?php
                                if($nBannerTres > 1)
                                {
                                ?>
                                    jqSlideTresLateralPeq.eq(actSlideTresLateralPeq).fadeOut()
                                    if(actSlideTresLateralPeq <= 0){
                        				jqSlideTresLateralPeq.fadeIn();
                        				actSlideTresLateralPeq = slidesTresLateralPeq;
                        			}else{
                        				actSlideTresLateralPeq = actSlideTresLateralPeq-1;	
                        			}
                                <?php
                                }
                                ?>
                            });
                            if(actSlideDoisLateralPeq <= 0){
                				jqSlideDoisLateralPeq.fadeIn();
                				actSlideDoisLateralPeq = slidesDoisLateralPeq;
                			}else{
                				actSlideDoisLateralPeq = actSlideDoisLateralPeq-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateralPeq <= 0){
        				jqSlideUmLateralPeq.fadeIn();
        				actSlideUmLateralPeq = slidesUmLateralPeq;
        			}else{
        				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
        			}
                },_time6);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerTres > 0)
        {
        ?>
            <ul id="bannerTresLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerTres as $banTres)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banTres['codCliente'];?>" data-codpubli="<?=$banTres['cod'];?>" data-codpagina="<?=$banTres['codPagina'];?>" >
                        <a href="<?=$banTres['link'] != '' ? $banTres['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banTres['arquivo'];?>" alt="<?=$banTres['empresa'];?>" title="<?=$banTres['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}

function imprimeBannerLateralDetrans()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 11 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerLateral').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerLateral').css(
                    {
                			width: "153px",
                			height: "243px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerLateral > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "243px"
            		});
                    slidesUm = jQuery('#bannerLateral > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerLateral > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerLateral' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoDetrans()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 11 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 3)
        {
            $num_por_pagina = floor($nBan/3);
            //echo $num_por_pagina."<br />";
            $bannerTres = array_splice($banners,-($num_por_pagina));
            $nBan = count($banners);
            $num_por_pagina = floor($nBan/2);
            //echo $num_por_pagina."<br />";
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
            $bannerTres = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        $nBannerTres = count($bannerTres);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateralPeq, #bannerDoisLateralPeq, #bannerTresLateralPeq').css(
                {
            			width: "153px",
            			height: "128px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateralPeq > *, #bannerDoisLateralPeq > *, #bannerTresLateralPeq > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "128px"
        		});
                slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
        		slidesUmLateralPeq = slidesUmLateralPeq-1;
        		actSlideUmLateralPeq = slidesUmLateralPeq;
        		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                
                slidesDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *').length;
        		slidesDoisLateralPeq = slidesDoisLateralPeq-1;
        		actSlideDoisLateralPeq = slidesDoisLateralPeq;
        		jqSlideDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *');
                
                slidesTresLateralPeq = jQuery('#bannerTresLateralPeq > *').length;
        		slidesTresLateralPeq = slidesTresLateralPeq-1;
        		actSlideTresLateralPeq = slidesTresLateralPeq;
        		jqSlideTresLateralPeq = jQuery('#bannerTresLateralPeq > *');
                
                setInterval(function()
                {
                    jqSlideUmLateralPeq.eq(actSlideUmLateralPeq).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            jqSlideDoisLateralPeq.eq(actSlideDoisLateralPeq).fadeOut(function()
                            {
                                <?php
                                if($nBannerTres > 1)
                                {
                                ?>
                                    jqSlideTresLateralPeq.eq(actSlideTresLateralPeq).fadeOut()
                                    if(actSlideTresLateralPeq <= 0){
                        				jqSlideTresLateralPeq.fadeIn();
                        				actSlideTresLateralPeq = slidesTresLateralPeq;
                        			}else{
                        				actSlideTresLateralPeq = actSlideTresLateralPeq-1;	
                        			}
                                <?php
                                }
                                ?>
                            });
                            if(actSlideDoisLateralPeq <= 0){
                				jqSlideDoisLateralPeq.fadeIn();
                				actSlideDoisLateralPeq = slidesDoisLateralPeq;
                			}else{
                				actSlideDoisLateralPeq = actSlideDoisLateralPeq-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateralPeq <= 0){
        				jqSlideUmLateralPeq.fadeIn();
        				actSlideUmLateralPeq = slidesUmLateralPeq;
        			}else{
        				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerTres > 0)
        {
        ?>
            <ul id="bannerTresLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerTres as $banTres)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banTres['codCliente'];?>" data-codpubli="<?=$banTres['cod'];?>" data-codpagina="<?=$banTres['codPagina'];?>" >
                        <a href="<?=$banTres['link'] != '' ? $banTres['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banTres['arquivo'];?>" alt="<?=$banTres['empresa'];?>" title="<?=$banTres['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerLateralGuias()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 9 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerLateral').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerLateral').css(
                    {
                			width: "153px",
                			height: "243px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerLateral > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "243px"
            		});
                    slidesUm = jQuery('#bannerLateral > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerLateral > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerLateral' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoGuias()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 9 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 3)
        {
            $num_por_pagina = floor($nBan/3);
            //echo $num_por_pagina."<br />";
            $bannerTres = array_splice($banners,-($num_por_pagina));
            $nBan = count($banners);
            $num_por_pagina = floor($nBan/2);
            //echo $num_por_pagina."<br />";
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
            $bannerTres = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        $nBannerTres = count($bannerTres);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateralPeq, #bannerDoisLateralPeq, #bannerTresLateralPeq').css(
                {
            			width: "153px",
            			height: "128px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateralPeq > *, #bannerDoisLateralPeq > *, #bannerTresLateralPeq > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "128px"
        		});
                slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
        		slidesUmLateralPeq = slidesUmLateralPeq-1;
        		actSlideUmLateralPeq = slidesUmLateralPeq;
        		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                
                slidesDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *').length;
        		slidesDoisLateralPeq = slidesDoisLateralPeq-1;
        		actSlideDoisLateralPeq = slidesDoisLateralPeq;
        		jqSlideDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *');
                
                slidesTresLateralPeq = jQuery('#bannerTresLateralPeq > *').length;
        		slidesTresLateralPeq = slidesTresLateralPeq-1;
        		actSlideTresLateralPeq = slidesTresLateralPeq;
        		jqSlideTresLateralPeq = jQuery('#bannerTresLateralPeq > *');
                
                setInterval(function()
                {
                    jqSlideUmLateralPeq.eq(actSlideUmLateralPeq).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            jqSlideDoisLateralPeq.eq(actSlideDoisLateralPeq).fadeOut(function()
                            {
                                <?php
                                if($nBannerTres > 1)
                                {
                                ?>
                                    jqSlideTresLateralPeq.eq(actSlideTresLateralPeq).fadeOut()
                                    if(actSlideTresLateralPeq <= 0){
                        				jqSlideTresLateralPeq.fadeIn();
                        				actSlideTresLateralPeq = slidesTresLateralPeq;
                        			}else{
                        				actSlideTresLateralPeq = actSlideTresLateralPeq-1;	
                        			}
                                <?php
                                }
                                ?>
                            });
                            if(actSlideDoisLateralPeq <= 0){
                				jqSlideDoisLateralPeq.fadeIn();
                				actSlideDoisLateralPeq = slidesDoisLateralPeq;
                			}else{
                				actSlideDoisLateralPeq = actSlideDoisLateralPeq-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateralPeq <= 0){
        				jqSlideUmLateralPeq.fadeIn();
        				actSlideUmLateralPeq = slidesUmLateralPeq;
        			}else{
        				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerTres > 0)
        {
        ?>
            <ul id="bannerTresLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerTres as $banTres)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banTres['codCliente'];?>" data-codpubli="<?=$banTres['cod'];?>" data-codpagina="<?=$banTres['codPagina'];?>" >
                        <a href="<?=$banTres['link'] != '' ? $banTres['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banTres['arquivo'];?>" alt="<?=$banTres['empresa'];?>" title="<?=$banTres['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerLateralNoticias()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 10 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerLateral').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerLateral').css(
                    {
                			width: "153px",
                			height: "243px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerLateral > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "243px"
            		});
                    slidesUm = jQuery('#bannerLateral > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerLateral > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerLateral' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoNoticias()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 10 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBannerUm = count($banners);
        
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                <?php
                if($nBannerUm > 1)
                {
                ?>
                    jQuery('#bannerUmLateralPeq').css(
                    {
                			width: "153px",
                			height: "128px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerUmLateralPeq > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "128px"
            		});
                    slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
            		slidesUmLateralPeq = slidesUmLateralPeq-1;
            		actSlideUmLateralPeq = slidesUmLateralPeq;
            		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                    
                    setInterval(function()
                    {
                        if(actSlideUmLateralPeq <= 0){
            				jqSlideUmLateralPeq.fadeIn();
            				actSlideUmLateralPeq = slidesUmLateralPeq;
            			}else{
            				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
            			}
                    },_time4);
                <?php
                }
                ?>
            })
            </script>
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($banners as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerSuperFaleConosco()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 13 AND codTipo = 4 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerSuper').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerSuper').css(
                    {
                			width: "634px",
                			height: "167px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerSuper > *').css(
                    {
            			position: 'absolute',
            			width: "634px",
                		height: "167px"
            		});
                    slidesUm = jQuery('#bannerSuper > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerSuper > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerSuper' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralFaleConosco()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 13 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerLateral').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerLateral').css(
                    {
                			width: "153px",
                			height: "243px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerLateral > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "243px"
            		});
                    slidesUm = jQuery('#bannerLateral > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerLateral > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerLateral' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoFaleConosco()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 13 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBannerUm = count($banners);
        
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                <?php
                if($nBannerUm > 1)
                {
                ?>
                    jQuery('#bannerUmLateralPeq').css(
                    {
                			width: "153px",
                			height: "128px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerUmLateralPeq > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "128px"
            		});
                    slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
            		slidesUmLateralPeq = slidesUmLateralPeq-1;
            		actSlideUmLateralPeq = slidesUmLateralPeq;
            		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                    
                    setInterval(function()
                    {
                        if(actSlideUmLateralPeq <= 0){
            				jqSlideUmLateralPeq.fadeIn();
            				actSlideUmLateralPeq = slidesUmLateralPeq;
            			}else{
            				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
            			}
                    },_time4);
                <?php
                }
                ?>
            })
            </script>
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($banners as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerSuperAnunciosLista($tipo = '1')
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $pagina = $tipo == '1' ? '2' : '3';
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = $pagina AND codTipo = 4 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerSuper').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerSuper').css(
                    {
                			width: "634px",
                			height: "167px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerSuper > *').css(
                    {
            			position: 'absolute',
            			width: "634px",
                		height: "167px"
            		});
                    slidesUm = jQuery('#bannerSuper > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerSuper > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerSuper' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoAnunciosLista($tipo = '1')
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $pagina = $tipo == '1' ? '2' : '3';
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = $pagina AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 3)
        {
            $num_por_pagina = floor($nBan/3);
            //echo $num_por_pagina."<br />";
            $bannerTres = array_splice($banners,-($num_por_pagina));
            $nBan = count($banners);
            $num_por_pagina = floor($nBan/2);
            //echo $num_por_pagina."<br />";
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
            $bannerTres = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        $nBannerTres = count($bannerTres);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateralPeq, #bannerDoisLateralPeq, #bannerTresLateralPeq').css(
                {
            			width: "153px",
            			height: "128px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateralPeq > *, #bannerDoisLateralPeq > *, #bannerTresLateralPeq > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "128px"
        		});
                slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
        		slidesUmLateralPeq = slidesUmLateralPeq-1;
        		actSlideUmLateralPeq = slidesUmLateralPeq;
        		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                
                slidesDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *').length;
        		slidesDoisLateralPeq = slidesDoisLateralPeq-1;
        		actSlideDoisLateralPeq = slidesDoisLateralPeq;
        		jqSlideDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *');
                
                slidesTresLateralPeq = jQuery('#bannerTresLateralPeq > *').length;
        		slidesTresLateralPeq = slidesTresLateralPeq-1;
        		actSlideTresLateralPeq = slidesTresLateralPeq;
        		jqSlideTresLateralPeq = jQuery('#bannerTresLateralPeq > *');
                
                setInterval(function()
                {
                    jqSlideUmLateralPeq.eq(actSlideUmLateralPeq).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            jqSlideDoisLateralPeq.eq(actSlideDoisLateralPeq).fadeOut(function()
                            {
                                <?php
                                if($nBannerTres > 1)
                                {
                                ?>
                                    jqSlideTresLateralPeq.eq(actSlideTresLateralPeq).fadeOut()
                                    if(actSlideTresLateralPeq <= 0){
                        				jqSlideTresLateralPeq.fadeIn();
                        				actSlideTresLateralPeq = slidesTresLateralPeq;
                        			}else{
                        				actSlideTresLateralPeq = actSlideTresLateralPeq-1;	
                        			}
                                <?php
                                }
                                ?>
                            });
                            if(actSlideDoisLateralPeq <= 0){
                				jqSlideDoisLateralPeq.fadeIn();
                				actSlideDoisLateralPeq = slidesDoisLateralPeq;
                			}else{
                				actSlideDoisLateralPeq = actSlideDoisLateralPeq-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateralPeq <= 0){
        				jqSlideUmLateralPeq.fadeIn();
        				actSlideUmLateralPeq = slidesUmLateralPeq;
        			}else{
        				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerTres > 0)
        {
        ?>
            <ul id="bannerTresLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerTres as $banTres)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banTres['codCliente'];?>" data-codpubli="<?=$banTres['cod'];?>" data-codpagina="<?=$banTres['codPagina'];?>" >
                        <a href="<?=$banTres['link'] != '' ? $banTres['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banTres['arquivo'];?>" alt="<?=$banTres['empresa'];?>" title="<?=$banTres['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerLateralAnunciosLista($tipo = '1')
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $pagina = $tipo == '1' ? '2' : '3';
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = $pagina AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 2)
        {
            $num_por_pagina = floor($nBan/2);
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateral, #bannerDoisLateral').css(
                {
            			width: "153px",
            			height: "243px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateral > *, #bannerDoisLateral > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "243px"
        		});
                slidesUmLateral = jQuery('#bannerUmLateral > *').length;
        		slidesUmLateral = slidesUmLateral-1;
        		actSlideUmLateral = slidesUmLateral;
        		jqSlideUmLateral = jQuery('#bannerUmLateral > *');
                
                slidesDoisLateral = jQuery('#bannerDoisLateral > *').length;
        		slidesDoisLateral = slidesDoisLateral-1;
        		actSlideDoisLateral = slidesDoisLateral;
        		jqSlideDoisLateral = jQuery('#bannerDoisLateral > *');
                
                setInterval(function()
                {
                    jqSlideUmLateral.eq(actSlideUmLateral).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            if(actSlideDoisLateral <= 0){
                				jqSlideDoisLateral.fadeIn();
                				actSlideDoisLateral = slidesDoisLateral;
                			}else{
                				actSlideDoisLateral = actSlideDoisLateral-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateral <= 0){
        				jqSlideUmLateral.fadeIn();
        				actSlideUmLateral = slidesUmLateral;
        			}else{
        				actSlideUmLateral = actSlideUmLateral-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateral" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateral" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}

function imprimeBannerLateralBuscaAvancada()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 8 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 2)
        {
            $num_por_pagina = floor($nBan/2);
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateral, #bannerDoisLateral').css(
                {
            			width: "153px",
            			height: "243px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateral > *, #bannerDoisLateral > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "243px"
        		});
                slidesUmLateral = jQuery('#bannerUmLateral > *').length;
        		slidesUmLateral = slidesUmLateral-1;
        		actSlideUmLateral = slidesUmLateral;
        		jqSlideUmLateral = jQuery('#bannerUmLateral > *');
                
                slidesDoisLateral = jQuery('#bannerDoisLateral > *').length;
        		slidesDoisLateral = slidesDoisLateral-1;
        		actSlideDoisLateral = slidesDoisLateral;
        		jqSlideDoisLateral = jQuery('#bannerDoisLateral > *');
                
                setInterval(function()
                {
                    jqSlideUmLateral.eq(actSlideUmLateral).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            if(actSlideDoisLateral <= 0){
                				jqSlideDoisLateral.fadeIn();
                				actSlideDoisLateral = slidesDoisLateral;
                			}else{
                				actSlideDoisLateral = actSlideDoisLateral-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateral <= 0){
        				jqSlideUmLateral.fadeIn();
        				actSlideUmLateral = slidesUmLateral;
        			}else{
        				actSlideUmLateral = actSlideUmLateral-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateral" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateral" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}

function imprimeBannerLateralPequenoBuscaAvancada()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 8 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBannerUm = count($banners);
        
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                <?php
                if($nBannerUm > 1)
                {
                ?>
                    jQuery('#bannerUmLateralPeq').css(
                    {
                			width: "153px",
                			height: "128px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerUmLateralPeq > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "128px"
            		});
                    slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
            		slidesUmLateralPeq = slidesUmLateralPeq-1;
            		actSlideUmLateralPeq = slidesUmLateralPeq;
            		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                    
                    setInterval(function()
                    {
                        if(actSlideUmLateralPeq <= 0){
            				jqSlideUmLateralPeq.fadeIn();
            				actSlideUmLateralPeq = slidesUmLateralPeq;
            			}else{
            				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
            			}
                    },_time4);
                <?php
                }
                ?>
            })
            </script>
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($banners as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerLateralFavoritos()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 6 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerLateral').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerLateral').css(
                    {
                			width: "153px",
                			height: "243px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerLateral > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "243px"
            		});
                    slidesUm = jQuery('#bannerLateral > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerLateral > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerLateral' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoFavoritos()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 6 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 3)
        {
            $num_por_pagina = floor($nBan/3);
            //echo $num_por_pagina."<br />";
            $bannerTres = array_splice($banners,-($num_por_pagina));
            $nBan = count($banners);
            $num_por_pagina = floor($nBan/2);
            //echo $num_por_pagina."<br />";
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
            $bannerTres = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        $nBannerTres = count($bannerTres);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateralPeq, #bannerDoisLateralPeq, #bannerTresLateralPeq').css(
                {
            			width: "153px",
            			height: "128px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateralPeq > *, #bannerDoisLateralPeq > *, #bannerTresLateralPeq > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "128px"
        		});
                slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
        		slidesUmLateralPeq = slidesUmLateralPeq-1;
        		actSlideUmLateralPeq = slidesUmLateralPeq;
        		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                
                slidesDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *').length;
        		slidesDoisLateralPeq = slidesDoisLateralPeq-1;
        		actSlideDoisLateralPeq = slidesDoisLateralPeq;
        		jqSlideDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *');
                
                slidesTresLateralPeq = jQuery('#bannerTresLateralPeq > *').length;
        		slidesTresLateralPeq = slidesTresLateralPeq-1;
        		actSlideTresLateralPeq = slidesTresLateralPeq;
        		jqSlideTresLateralPeq = jQuery('#bannerTresLateralPeq > *');
                
                setInterval(function()
                {
                    jqSlideUmLateralPeq.eq(actSlideUmLateralPeq).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            jqSlideDoisLateralPeq.eq(actSlideDoisLateralPeq).fadeOut(function()
                            {
                                <?php
                                if($nBannerTres > 1)
                                {
                                ?>
                                    jqSlideTresLateralPeq.eq(actSlideTresLateralPeq).fadeOut()
                                    if(actSlideTresLateralPeq <= 0){
                        				jqSlideTresLateralPeq.fadeIn();
                        				actSlideTresLateralPeq = slidesTresLateralPeq;
                        			}else{
                        				actSlideTresLateralPeq = actSlideTresLateralPeq-1;	
                        			}
                                <?php
                                }
                                ?>
                            });
                            if(actSlideDoisLateralPeq <= 0){
                				jqSlideDoisLateralPeq.fadeIn();
                				actSlideDoisLateralPeq = slidesDoisLateralPeq;
                			}else{
                				actSlideDoisLateralPeq = actSlideDoisLateralPeq-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateralPeq <= 0){
        				jqSlideUmLateralPeq.fadeIn();
        				actSlideUmLateralPeq = slidesUmLateralPeq;
        			}else{
        				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerTres > 0)
        {
        ?>
            <ul id="bannerTresLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerTres as $banTres)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banTres['codCliente'];?>" data-codpubli="<?=$banTres['cod'];?>" data-codpagina="<?=$banTres['codPagina'];?>" >
                        <a href="<?=$banTres['link'] != '' ? $banTres['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banTres['arquivo'];?>" alt="<?=$banTres['empresa'];?>" title="<?=$banTres['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerLateralRevendas()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 7 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerLateral').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerLateral').css(
                    {
                			width: "153px",
                			height: "243px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerLateral > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "243px"
            		});
                    slidesUm = jQuery('#bannerLateral > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerLateral > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerLateral' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoRevendas()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 7 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 3)
        {
            $num_por_pagina = floor($nBan/3);
            //echo $num_por_pagina."<br />";
            $bannerTres = array_splice($banners,-($num_por_pagina));
            $nBan = count($banners);
            $num_por_pagina = floor($nBan/2);
            //echo $num_por_pagina."<br />";
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
            $bannerTres = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        $nBannerTres = count($bannerTres);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateralPeq, #bannerDoisLateralPeq, #bannerTresLateralPeq').css(
                {
            			width: "153px",
            			height: "128px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateralPeq > *, #bannerDoisLateralPeq > *, #bannerTresLateralPeq > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "128px"
        		});
                slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
        		slidesUmLateralPeq = slidesUmLateralPeq-1;
        		actSlideUmLateralPeq = slidesUmLateralPeq;
        		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                
                slidesDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *').length;
        		slidesDoisLateralPeq = slidesDoisLateralPeq-1;
        		actSlideDoisLateralPeq = slidesDoisLateralPeq;
        		jqSlideDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *');
                
                slidesTresLateralPeq = jQuery('#bannerTresLateralPeq > *').length;
        		slidesTresLateralPeq = slidesTresLateralPeq-1;
        		actSlideTresLateralPeq = slidesTresLateralPeq;
        		jqSlideTresLateralPeq = jQuery('#bannerTresLateralPeq > *');
                
                setInterval(function()
                {
                    jqSlideUmLateralPeq.eq(actSlideUmLateralPeq).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            jqSlideDoisLateralPeq.eq(actSlideDoisLateralPeq).fadeOut(function()
                            {
                                <?php
                                if($nBannerTres > 1)
                                {
                                ?>
                                    jqSlideTresLateralPeq.eq(actSlideTresLateralPeq).fadeOut()
                                    if(actSlideTresLateralPeq <= 0){
                        				jqSlideTresLateralPeq.fadeIn();
                        				actSlideTresLateralPeq = slidesTresLateralPeq;
                        			}else{
                        				actSlideTresLateralPeq = actSlideTresLateralPeq-1;	
                        			}
                                <?php
                                }
                                ?>
                            });
                            if(actSlideDoisLateralPeq <= 0){
                				jqSlideDoisLateralPeq.fadeIn();
                				actSlideDoisLateralPeq = slidesDoisLateralPeq;
                			}else{
                				actSlideDoisLateralPeq = actSlideDoisLateralPeq-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateralPeq <= 0){
        				jqSlideUmLateralPeq.fadeIn();
        				actSlideUmLateralPeq = slidesUmLateralPeq;
        			}else{
        				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerTres > 0)
        {
        ?>
            <ul id="bannerTresLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerTres as $banTres)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banTres['codCliente'];?>" data-codpubli="<?=$banTres['cod'];?>" data-codpagina="<?=$banTres['codPagina'];?>" >
                        <a href="<?=$banTres['link'] != '' ? $banTres['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banTres['arquivo'];?>" alt="<?=$banTres['empresa'];?>" title="<?=$banTres['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}

function imprimeBannerSuperRevendaLista()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 14 AND codTipo = 4 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerSuper').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerSuper').css(
                    {
                			width: "634px",
                			height: "167px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerSuper > *').css(
                    {
            			position: 'absolute',
            			width: "634px",
                		height: "167px"
            		});
                    slidesUm = jQuery('#bannerSuper > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerSuper > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerSuper' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoRevendaLista()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 14 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 3)
        {
            $num_por_pagina = floor($nBan/3);
            //echo $num_por_pagina."<br />";
            $bannerTres = array_splice($banners,-($num_por_pagina));
            $nBan = count($banners);
            $num_por_pagina = floor($nBan/2);
            //echo $num_por_pagina."<br />";
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
            $bannerTres = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        $nBannerTres = count($bannerTres);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateralPeq, #bannerDoisLateralPeq, #bannerTresLateralPeq').css(
                {
            			width: "153px",
            			height: "128px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateralPeq > *, #bannerDoisLateralPeq > *, #bannerTresLateralPeq > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "128px"
        		});
                slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
        		slidesUmLateralPeq = slidesUmLateralPeq-1;
        		actSlideUmLateralPeq = slidesUmLateralPeq;
        		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                
                slidesDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *').length;
        		slidesDoisLateralPeq = slidesDoisLateralPeq-1;
        		actSlideDoisLateralPeq = slidesDoisLateralPeq;
        		jqSlideDoisLateralPeq = jQuery('#bannerDoisLateralPeq > *');
                
                slidesTresLateralPeq = jQuery('#bannerTresLateralPeq > *').length;
        		slidesTresLateralPeq = slidesTresLateralPeq-1;
        		actSlideTresLateralPeq = slidesTresLateralPeq;
        		jqSlideTresLateralPeq = jQuery('#bannerTresLateralPeq > *');
                
                setInterval(function()
                {
                    jqSlideUmLateralPeq.eq(actSlideUmLateralPeq).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            jqSlideDoisLateralPeq.eq(actSlideDoisLateralPeq).fadeOut(function()
                            {
                                <?php
                                if($nBannerTres > 1)
                                {
                                ?>
                                    jqSlideTresLateralPeq.eq(actSlideTresLateralPeq).fadeOut()
                                    if(actSlideTresLateralPeq <= 0){
                        				jqSlideTresLateralPeq.fadeIn();
                        				actSlideTresLateralPeq = slidesTresLateralPeq;
                        			}else{
                        				actSlideTresLateralPeq = actSlideTresLateralPeq-1;	
                        			}
                                <?php
                                }
                                ?>
                            });
                            if(actSlideDoisLateralPeq <= 0){
                				jqSlideDoisLateralPeq.fadeIn();
                				actSlideDoisLateralPeq = slidesDoisLateralPeq;
                			}else{
                				actSlideDoisLateralPeq = actSlideDoisLateralPeq-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateralPeq <= 0){
        				jqSlideUmLateralPeq.fadeIn();
        				actSlideUmLateralPeq = slidesUmLateralPeq;
        			}else{
        				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerTres > 0)
        {
        ?>
            <ul id="bannerTresLateralPeq" class="bannerRetangulo">
                <?php
                foreach($bannerTres as $banTres)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banTres['codCliente'];?>" data-codpubli="<?=$banTres['cod'];?>" data-codpagina="<?=$banTres['codPagina'];?>" >
                        <a href="<?=$banTres['link'] != '' ? $banTres['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banTres['arquivo'];?>" alt="<?=$banTres['empresa'];?>" title="<?=$banTres['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerLateralRevendaLista()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 14 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBan = count($banners);
        if($nBan > 2)
        {
            $num_por_pagina = floor($nBan/2);
            $bannerDois = array_splice($banners,-($num_por_pagina));
            $bannerUm = $banners;
        }
        else
        {
            $bannerUm = array_splice($banners,0,1);
            $bannerDois = array_splice($banners,0,1);
        }
        
        
        $nBannerUm = count($bannerUm);
        $nBannerDois = count($bannerDois);
        
        if($nBannerUm > 1)
        {
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                jQuery('#bannerUmLateral, #bannerDoisLateral').css(
                {
            			width: "153px",
            			height: "243px",
            			position: 'relative',
            			overflow: 'hidden'
        		});
        		jQuery('#bannerUmLateral > *, #bannerDoisLateral > *').css(
                {
        			position: 'absolute',
        			width: "153px",
        			height: "243px"
        		});
                slidesUmLateral = jQuery('#bannerUmLateral > *').length;
        		slidesUmLateral = slidesUmLateral-1;
        		actSlideUmLateral = slidesUmLateral;
        		jqSlideUmLateral = jQuery('#bannerUmLateral > *');
                
                slidesDoisLateral = jQuery('#bannerDoisLateral > *').length;
        		slidesDoisLateral = slidesDoisLateral-1;
        		actSlideDoisLateral = slidesDoisLateral;
        		jqSlideDoisLateral = jQuery('#bannerDoisLateral > *');
                
                setInterval(function()
                {
                    jqSlideUmLateral.eq(actSlideUmLateral).fadeOut(function()
                    {
                        <?php
                        if($nBannerDois > 1)
                        {
                        ?>
                            if(actSlideDoisLateral <= 0){
                				jqSlideDoisLateral.fadeIn();
                				actSlideDoisLateral = slidesDoisLateral;
                			}else{
                				actSlideDoisLateral = actSlideDoisLateral-1;	
                			}
                        <?php
                        }
                        ?>
                    });
                    if(actSlideUmLateral <= 0){
        				jqSlideUmLateral.fadeIn();
        				actSlideUmLateral = slidesUmLateral;
        			}else{
        				actSlideUmLateral = actSlideUmLateral-1;	
        			}
                },_time4);
            })
            </script>
        <?php
        }
        ?>
        
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateral" class="bannerRetangulo">
                <?php
                foreach($bannerUm as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        if($nBannerDois > 0)
        {
        ?>
            <ul id="bannerDoisLateral" class="bannerRetangulo">
                <?php
                foreach($bannerDois as $banDois)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banDois['codCliente'];?>" data-codpubli="<?=$banDois['cod'];?>" data-codpagina="<?=$banDois['codPagina'];?>" >
                        <a href="<?=$banDois['link'] != '' ? $banDois['link'] : '#';?>" target="_blank"><img class="middleads" src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banDois['arquivo'];?>" alt="<?=$banDois['empresa'];?>" title="<?=$banDois['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
function imprimeBannerSuperFipe()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 12 AND codTipo = 4 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerSuper').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerSuper').css(
                    {
                			width: "634px",
                			height: "167px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerSuper > *').css(
                    {
            			position: 'absolute',
            			width: "634px",
                		height: "167px"
            		});
                    slidesUm = jQuery('#bannerSuper > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerSuper > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerSuper' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralFipe()
{
    $conexao = conexao();
	$dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 12 AND codTipo = 5 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
    }
    mysql_close();
    $nBan = count($banners);
	?>
        <script>
            _time3 = 10000;
            $(function()
            {
                jQuery('#bannerLateral').show();
                <?php
                if($nBan > 1)
                {
                ?>
                    jQuery('#bannerLateral').css(
                    {
                			width: "153px",
                			height: "243px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerLateral > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "243px"
            		});
                    slidesUm = jQuery('#bannerLateral > *').length;
            		slidesUm = slidesUm-1;
            		actSlideUm = slidesUm;
            		jqSlideUm = jQuery('#bannerLateral > *');
                    
                    setInterval(function()
                    {
                        jqSlideUm.eq(actSlideUm).fadeOut();
                        if(actSlideUm <= 0){
            				jqSlideUm.fadeIn();
            				actSlideUm = slidesUm;
            			}else{
            				actSlideUm = actSlideUm-1;	
            			}
                    },_time3);
                <?php
                }
                ?>
            })
            </script>
        <?php
    
    if($nBan>0)
	{
	   echo "<ul id='bannerLateral' class='bannerRetangulo' style='display: none;'>";
       foreach($banners as $banner)
       {
	?>	
        	<li class="verPubli" data-codcliente="<?=$banner['codCliente'];?>" data-codpubli="<?=$banner['cod'];?>" data-codpagina="<?=$banner['codPagina'];?>" >
                <!--<img src="<?=ssl().PROJECT_URL;?>/img/kia.png" />-->
                <a href="<?=$banner['link'] != '' ? $banner['link'] : '#';?>" target="_blank">
                    <img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banner['arquivo'];?>" alt="<?=$banner['empresa'];?>" title="<?=$banner['empresa'];?>" />
                </a>
            </li>
	<?php	
       }
       echo "</ul>";
	}
}
function imprimeBannerLateralPequenoFipe()
{
    $conexao = conexao();
    $dataHoje = date("Y-m-d");
    $sqlBanner = mysql_query("SELECT codCliente, codPagina, cod, empresa, link FROM publicidades WHERE codPagina = 12 AND codTipo = 6 AND mostrar = 1 AND '$dataHoje' BETWEEN dataInicio AND dataFim ORDER BY RAND()");
    $nBanners = mysql_num_rows($sqlBanner);
	$banners = array();
	if($nBanners>0)
	{
        while($tpBanners = mysql_fetch_assoc($sqlBanner))
		{
			$sqlImgBanner = mysql_query("SELECT arquivo FROM arquivos WHERE referencia = 'publicidade' AND codReferencia = ".$tpBanners['cod']." AND tipo = 1 LIMIT 1");
			while($tpImgBanner = mysql_fetch_assoc($sqlImgBanner))
            {
                $banners[] = array(
                                    "cod" => $tpBanners['cod'],
                                    "codCliente" => $tpBanners['codCliente'],
                                    "codPagina" => $tpBanners['codPagina'],
                                    "empresa" => $tpBanners['empresa'],
                                    "link" => $tpBanners['link'],
                                    "arquivo" => $tpImgBanner['arquivo'],
                                  );
            }
        }
        
        $nBannerUm = count($banners);
        
        ?>
            <script>
            _time4 = 10000;
            $(function()
            {
                <?php
                if($nBannerUm > 1)
                {
                ?>
                    jQuery('#bannerUmLateralPeq').css(
                    {
                			width: "153px",
                			height: "128px",
                			position: 'relative',
                			overflow: 'hidden'
            		});
            		jQuery('#bannerUmLateralPeq > *').css(
                    {
            			position: 'absolute',
            			width: "153px",
            			height: "128px"
            		});
                    slidesUmLateralPeq = jQuery('#bannerUmLateralPeq > *').length;
            		slidesUmLateralPeq = slidesUmLateralPeq-1;
            		actSlideUmLateralPeq = slidesUmLateralPeq;
            		jqSlideUmLateralPeq = jQuery('#bannerUmLateralPeq > *');
                    
                    setInterval(function()
                    {
                        if(actSlideUmLateralPeq <= 0){
            				jqSlideUmLateralPeq.fadeIn();
            				actSlideUmLateralPeq = slidesUmLateralPeq;
            			}else{
            				actSlideUmLateralPeq = actSlideUmLateralPeq-1;	
            			}
                    },_time4);
                <?php
                }
                ?>
            })
            </script>
        <?php
        if($nBannerUm > 0)
        {
        ?>
            <ul id="bannerUmLateralPeq" class="bannerRetangulo">
                <?php
                foreach($banners as $banUm)
                {
                ?>
                    <li class="verPubli" data-codcliente="<?=$banUm['codCliente'];?>" data-codpubli="<?=$banUm['cod'];?>" data-codpagina="<?=$banUm['codPagina'];?>" >
                        <a href="<?=$banUm['link'] != '' ? $banUm['link'] : '#';?>" target="_blank"><img src="<?=ssl().PROJECT_URL;?>/arquivos/publicidades/<?=$banUm['arquivo'];?>" alt="<?=$banUm['empresa'];?>" title="<?=$banUm['empresa'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }
    mysql_close();
}
?>

