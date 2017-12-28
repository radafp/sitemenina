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
        
$count = count($uri);

echo 'cont da url: '.$count;
switch($count){
    case 1:
        echo '<br>cidade: '.$uri[0];
        break;
    case 2:
        echo '<br>cidade: '.$uri[0];
        echo '<br>view: '.$uri[1];
        break;
    case 3:
        echo '<br>cidade: '.$uri[0];
        echo '<br>view: '.$uri[1];
        echo '<br>categoria: '.$uri[2];
        break;
}


// echo '<br>cont da url: '.$count;
$regiao = isset($uri[0]) && !empty($uri[0]) ? $uri[0] : '';// regiao
$codigoSecao = isset($uri[1]) && !empty($uri[1]) ? $uri[1] : ''; //menu
//echo $codigoSecao;
$codigoConteudo = isset($uri[2]) && !empty($uri[2]) ? $uri[2] : ''; //codigo


// $regiao.'/noticias/?categoria='.$categoria;



$route['balneario-camboriu'] = 'home/regiao/?regiao=bc';
$route['blumenal'] = 'home/regiao/?regiao=bl';
$route['lages'] = 'home/regiao/?regiao=lg';

$route['balneario-camboriu/programacao'] = 'home/programacao';
$route['blumenal/programacao'] = 'home/programacao';
$route['lages/programacao'] = 'home/programacao';

$route['balneario-camboriu/noticias'] = 'home/noticia';
$route['blumenal/noticias'] = 'home/noticia';
$route['lages/noticias'] = 'home/noticia';

$route['balneario-camboriu/top-10'] = 'home/top_10';
$route['blumenal/top-10'] = 'home/top_10';
$route['lages/top-10'] = 'home/top_10';

$route['balneario-camboriu/promocoes'] = 'home/promocoes';
$route['blumenal/promocoes'] = 'home/promocoes';
$route['lages/promocoes'] = 'home/promocoes';

$route['balneario-camboriu/eventos'] = 'home/eventos';
$route['blumenal/eventos'] = 'home/eventos';
$route['lages/eventos'] = 'home/eventos';

$route['balneario-camboriu/bolsa-de-empregos'] = 'home/bolsa_de_empregos';
$route['blumenal/bolsa-de-empregos'] = 'home/bolsa_de_empregos';
$route['lages/bolsa-de-empregos'] = 'home/bolsa_de_empregos';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
