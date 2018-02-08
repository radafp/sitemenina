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
    if($uri[1] == 'noticias' && isset($uri[2]) && isset($uri[3])) {
        $route['balneario-camboriu/noticias/'.$uri[2]. '/' . $uri[3]] = 'home/noticia';
        $route['blumenau/noticias/'.$uri[2]. '/' . $uri[3]] = 'home/noticia';
        $route['lages/noticias/'.$uri[2]. '/' . $uri[3]] = 'home/noticia';
    }

    if($uri[1] == 'descricao_noticia' && isset($uri[2]) && isset($uri[3])) {
        $route['balneario-camboriu/descricao_noticia/'.$uri[2]. '/' . $uri[3]] = 'home/descricao_noticia';
        $route['blumenau/descricao_noticia/'.$uri[2]. '/' . $uri[3]] = 'home/descricao_noticia';
        $route['lages/descricao_noticia/'.$uri[2]. '/' . $uri[3]] = 'home/descricao_noticia';
    }
}


$route['balneario-camboriu/top-10'] = 'home/top_10';
$route['blumenau/top-10'] = 'home/top_10';
$route['lages/top-10'] = 'home/top_10';

$route['balneario-camboriu/videos'] = 'home/videos_home';
$route['blumenau/videos'] = 'home/videos_home';
$route['lages/videos'] = 'home/videos_home';

$route['balneario-camboriu/promocoes'] = 'home/promocoes';
$route['blumenau/promocoes'] = 'home/promocoes';
$route['lages/promocoes'] = 'home/promocoes';

$route['balneario-camboriu/agenda'] = 'home/agenda';
$route['blumenau/agenda'] = 'home/agenda';
$route['lages/agenda'] = 'home/agenda';

$route['balneario-camboriu/bolsa-de-empregos'] = 'home/bolsa_de_empregos';
$route['blumenau/bolsa-de-empregos'] = 'home/bolsa_de_empregos';
$route['lages/bolsa-de-empregos'] = 'home/bolsa_de_empregos';

$route['balneario-camboriu/documentos-perdidos'] = 'home/documentos_perdidos';
$route['blumenau/documentos-perdidos'] = 'home/documentos_perdidos';
$route['lages/documentos-perdidos'] = 'home/documentos_perdidos';

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

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
