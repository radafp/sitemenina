<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';

$uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');
// echo $uri[2];
$nParametros = count($uri);


if($uri[0] == 'balneario-camboriu') {
    $_SESSION['regiao'] = 'bc';
}elseif($uri[0] == 'blumenau') {
    $_SESSION['regiao'] = 'bl';
}elseif($uri[0] == 'lages') {
    $_SESSION['regiao'] = 'lg';
}


if($nParametros==1)
{
    $cidade = $uri[0]; 
}
elseif($nParametros==2)
{
    $cidade = $uri[0];
    $view = $uri[1]; 
}
elseif($nParametros==2)
{
    $cidade = $uri[0];
    $view = $uri[1]; 
    $paremetro = $uri[2];
};

$route['balneario-camboriu'] = 'home/regiao/?regiao=bc';
$route['blumenau'] = 'home/regiao/?regiao=bl';
$route['lages'] = 'home/regiao/?regiao=lg';

$route['balneario-camboriu/programacao'] = 'home/programacao';
$route['blumenau/programacao'] = 'home/programacao';
$route['lages/programacao'] = 'home/programacao';

if(isset($uri[1])) {

    // ROUTE DA PAGINA PROGRAMACAO
    if($uri[1] == 'programacao' && isset($uri[2])) {
        $route['balneario-camboriu/programacao/'.$uri[2]] = 'home/programacao/'.$uri[2];
        $route['blumenau/programacao/'.$uri[2]] = 'home/programacao/'.$uri[2];
        $route['lages/programacao/'.$uri[2]] = 'home/programacao/'.$uri[2];
        
    }elseif($uri[1] == 'descricao_programacao' && isset($uri[2])) {
        $route['balneario-camboriu/descricao_programacao/'.$uri[2]] = 'home/descricao_programacao/'.$uri[2];
        $route['blumenau/descricao_programacao/'.$uri[2]] = 'home/descricao_programacao/'.$uri[2];
        $route['lages/descricao_programacao/'.$uri[2]] = 'home/descricao_programacao/'.$uri[2];
    }
    
    // ROUTE DA PAGINA NOTICIAS
    if($uri[1] == 'noticias' && isset($uri[2]) && isset($uri[3])) {
        $route['balneario-camboriu/noticias/'.$uri[2]. '/' . $uri[3]] = 'home/noticia';
        $route['blumenau/noticias/'.$uri[2]. '/' . $uri[3]] = 'home/noticia';
        $route['lages/noticias/'.$uri[2]. '/' . $uri[3]] = 'home/noticia';
    }elseif($uri[1] == 'descricao_noticia' && isset($uri[2]) && isset($uri[3])) {
        $route['balneario-camboriu/descricao_noticia/'.$uri[2]. '/' . $uri[3]] = 'home/descricao_noticia';
        $route['blumenau/descricao_noticia/'.$uri[2]. '/' . $uri[3]] = 'home/descricao_noticia';
        $route['lages/descricao_noticia/'.$uri[2]. '/' . $uri[3]] = 'home/descricao_noticia';
    }

    if($uri[1] == 'busca-noticias' && isset($uri[2]) && isset($uri[3])) {
        $route['balneario-camboriu/busca-noticias/'.$uri[2]. '/' . $uri[3]] = 'home/noticia';
        $route['blumenau/busca-noticias/'.$uri[2]. '/' . $uri[3]] = 'home/noticia';
        $route['lages/busca-noticias/'.$uri[2]. '/' . $uri[3]] = 'home/noticia';
    }

    // ROUTE DA PAGINA VIDEOS
    if($uri[1] == 'videos' && isset($uri[2])) {
        $route['balneario-camboriu/videos/'.$uri[2]] = 'home/videos_home/'.$uri[2];
        $route['blumenau/videos/'.$uri[2]] = 'home/videos_home/'.$uri[2];
        $route['lages/videos/'.$uri[2]] = 'home/videos_home/'.$uri[2];
        
    }

    // ROUTE DA PAGINA promocoes
    if($uri[1] == 'promocoes' && isset($uri[2])) {
        $route['balneario-camboriu/promocoes/'.$uri[2]] = 'home/promocoes/'.$uri[2];
        $route['blumenau/promocoes/'.$uri[2]] = 'home/promocoes/'.$uri[2];
        $route['lages/promocoes/'.$uri[2]] = 'home/promocoes/'.$uri[2];
    }elseif($uri[1] == 'descricao_promocoes' && isset($uri[2])) {
        $route['balneario-camboriu/descricao_promocoes/'.$uri[2]] = 'home/descricao_promocoes';
        $route['blumenau/descricao_promocoes/'.$uri[2]] = 'home/descricao_promocoes';
        $route['lages/descricao_promocoes/'.$uri[2]] = 'home/descricao_promocoes';
    }

    // ROUTE DA PAGINA AGENDA
    if($uri[1] == 'agenda' && isset($uri[2])) {
        $route['balneario-camboriu/agenda/'.$uri[2]] = 'home/agenda/'.$uri[2];
        $route['blumenau/agenda/'.$uri[2]] = 'home/agenda/'.$uri[2];
        $route['lages/agenda/'.$uri[2]] = 'home/agenda/'.$uri[2];
    }elseif($uri[1] == 'descricao_agenda' && isset($uri[2])) {
        $route['balneario-camboriu/descricao_agenda/'.$uri[2]] = 'home/descricao_agenda';
        $route['blumenau/descricao_agenda/'.$uri[2]] = 'home/descricao_agenda';
        $route['lages/descricao_agenda/'.$uri[2]] = 'home/descricao_agenda';
    }

    if($uri[1] == 'bolsa-de-empregos' && isset($uri[2])) {
        $route['balneario-camboriu/bolsa-de-empregos/'.$uri[2]] = 'home/bolsa_de_empregos';
        $route['blumenau/bolsa-de-empregos/'.$uri[2]] = 'home/bolsa_de_empregos';
        $route['lages/bolsa-de-empregos/'.$uri[2]] = 'home/bolsa_de_empregos';
    }elseif($uri[1] == 'descricao-bolsa-de-empregos' && isset($uri[2])) {
        $route['balneario-camboriu/descricao-bolsa-de-empregos/'.$uri[2]] = 'home/descricao_bolsa_de_empregos';
        $route['blumenau/descricao-bolsa-de-empregos/'.$uri[2]] = 'home/descricao_bolsa_de_empregos';
        $route['lages/descricao-bolsa-de-empregos/'.$uri[2]] = 'home/descricao_bolsa_de_empregos';
    }

    if($uri[1] == 'documentos-perdidos' && isset($uri[2])) {
        $route['balneario-camboriu/documentos-perdidos/'.$uri[2]] = 'home/documentos_perdidos';
        $route['blumenau/documentos-perdidos/'.$uri[2]] = 'home/documentos_perdidos';
        $route['lages/documentos-perdidos/'.$uri[2]] = 'home/documentos_perdidos';
    }elseif($uri[1] == 'documento-perdido' && isset($uri[2])) {
        $route['balneario-camboriu/documento-perdido/'.$uri[2]] = 'home/descricao_documentos_perdidos';
        $route['blumenau/documento-perdido/'.$uri[2]] = 'home/descricao_documentos_perdidos';
        $route['lages/documento-perdido/'.$uri[2]] = 'home/descricao_documentos_perdidos';
    }

    if($uri[1] == 'equipe' && isset($uri[2])) {
        $route['balneario-camboriu/equipe/'.$uri[2]] = 'home/descricao_equipe';
        $route['blumenau/equipe/'.$uri[2]] = 'home/descricao_equipe';
        $route['lages/equipe/'.$uri[2]] = 'home/descricao_equipe';
    }
}


$route['balneario-camboriu/top-10'] = 'home/top_10';
$route['blumenau/top-10'] = 'home/top_10';
$route['lages/top-10'] = 'home/top_10';

$route['balneario-camboriu/historia'] = 'home/historia';
$route['blumenau/historia'] = 'home/historia';
$route['lages/historia'] = 'home/historia';

$route['balneario-camboriu/equipe'] = 'home/equipe';
$route['blumenau/equipe'] = 'home/equipe';
$route['lages/equipe'] = 'home/equipe';

$route['balneario-camboriu/midia'] = 'home/midia';
$route['blumenau/midia'] = 'home/midia';
$route['lages/midia'] = 'home/midia';

$route['balneario-camboriu/contato'] = 'home/contato';
$route['blumenau/contato'] = 'home/contato';
$route['lages/contato'] = 'home/contato';

$route['balneario-camboriu/enviaEmail'] = 'home/enviaEmail';
$route['blumenau/enviaEmail'] = 'home/enviaEmail';
$route['lages/enviaEmail'] = 'home/enviaEmail';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
