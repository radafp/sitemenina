<?php
@session_start();
/** Define o desenvolvedor do projeto **/
define('PROJECT_DEV_NOME', 'Agência Set');
define('PROJECT_DEV_SITE', 'www.agenciaset.com.br');
define('PROJECT_DEV_EMAIL', 'programacao@agenciaset.com.br');

/** Define as configurações para LOCALWEB **/
date_default_timezone_set('America/Sao_Paulo'); // Etc/GMT-3
setlocale(LC_ALL, 'pt_BR');
setlocale(LC_NUMERIC, 'en_US'); // setting the numeric locale to
setlocale(LC_MONETARY, 'en_US'); // setting the monetary locale to


define('HOST', 'mysql.portalmenina.com.br');
define('USER', 'portalmenina01');
define('PASS', 'u9d4s2'); 
define('BD', 'portalmenina01');

define('HOSTMG', 'mysql.agenciaset.com.br');
define('USERMG', 'agenciaset03');
define('PASSMG', 'agE445MG');
define('BDMG', 'agenciaset03');


if (!defined('PROJECT_TITLE'))
{
    define('PROJECT_TITLE', '');
}
if (!defined('PROJECT_DESCRIPTION'))
{
    define('PROJECT_DESCRIPTION', '');
}
if (!defined('PROJECT_KEYWORDS'))
{
    define('PROJECT_KEYWORDS', '');
}

//Rodapé e Dev
if (!defined('PROJECT_CODAREA_TELEFONE'))
{
    define('PROJECT_CODAREA_TELEFONE', '(47)');
}
if (!defined('PROJECT_TELEFONE_COMERCIAL'))
{
    define('PROJECT_TELEFONE_COMERCIAL', '');
}
if (!defined('PROJECT_TELEFONE_CELULAR'))
{
    define('PROJECT_TELEFONE_CELULAR', '99990.7099');
}
if (!defined('PROJECT_EMAIL'))
{
    define('PROJECT_EMAIL', 'falecom@nandabrittes.com.br');
}
if (!defined('PROJECT_EMAIL_SENDER'))
{
    define('PROJECT_EMAIL_SENDER', 'webmaster@nandabrittes.com.br');
}
if (!defined('PROJECT_ENDERECO'))
{
    define('PROJECT_ENDERECO', '');
}
if (!defined('PROJECT_PLUGINFACE'))
{
    define('PROJECT_PLUGINFACE','https://www.facebook.com/nbnandabrittes');
}
if (!defined('PROJECT_LINK_MAPS'))
{
    define('PROJECT_LINK_MAPS', '');
}
if (!defined('PROJECT_COPY'))
{
    define('PROJECT_COPY', '©'.date('Y').' - NandaBrittes - Todos direitos reservados <!-- - <a href="">Política de privacidade</a>-->');
}
if (!defined('PROJECT_DEV'))
{
    define('PROJECT_DEV', 'Desenvolvido por <a href="http://www.agenciaset.com.br" target="_blank">Agência Set</a>');
}


/** define se esconde os erros do navegadorr **/
if (!defined('PROJECT_DEBUG'))
{
    define('PROJECT_DEBUG', false);
}

/** Domínio com WWW **/
if (!defined('SERVER_NAME')) {
    define('SERVER_NAME', $_SERVER['SERVER_NAME']);
}

/** define o email de contato **/
if (!defined('PROJECT_EMAIL')) {
    define('PROJECT_EMAIL', '');
}

/** define o título curto do projeto. **/
if (!defined('PROJECT_SHORT_TITLE')) {
    define('PROJECT_SHORT_TITLE', '');
}

/** define o título do projeto. **/
if (!defined('PROJECT_TITLE')) {
    define('PROJECT_TITLE', ' ');
}

/** URL do diretório raiz do projeto. **/
if (!defined('PROJECT_URL')) {
    define('PROJECT_URL', SERVER_NAME);
}

/** Caminho absoluto do diretório raiz do projeto. **/
if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

/** URL do arquivo principal do projeto. **/
if (!defined('INDEX_URL')) {
    define('INDEX_URL', PROJECT_URL . '/home');
}

/** Caminho absoluto do arquivo principal do projeto. **/
if (!defined('INDEX_PATH')) {
    define('INDEX_PATH', PROJECT_PATH . 'home.php');
}

/** URL do diretório de estilos do projeto. */
if (!defined('PROJECT_CSS_URL')) {
    define('PROJECT_CSS_URL', PROJECT_URL . '/css');
}

/** Caminho absoluto do diretório de estilos do projeto. */
if (!defined('PROJECT_CSS_PATH')) {
    define('PROJECT_CSS_PATH', PROJECT_PATH . 'css' . DIRECTORY_SEPARATOR);
}

/** URL do diretório de estilos do funções do projeto. */
if (!defined('PROJECT_FUNC_URL')) {
    define('PROJECT_FUNC_URL', PROJECT_URL . '/func');
}

/** Caminho absoluto do diretório de funções do projeto. */
if (!defined('PROJECT_FUNC_PATH')) {
    define('PROJECT_FUNC_PATH', PROJECT_PATH . 'func' . DIRECTORY_SEPARATOR);
}

/** URL do diretório de imagens do projeto. */
if (!defined('PROJECT_IMG_URL')) {
    define('PROJECT_IMG_URL', PROJECT_URL . '/img');
}

/** Caminho absoluto do diretório de imagens do projeto. */
if (!defined('PROJECT_IMG_PATH')) {
    define('PROJECT_IMG_PATH', PROJECT_PATH . 'img' . DIRECTORY_SEPARATOR);
}

/** URL do diretório de includes do projeto. */
if (!defined('PROJECT_INC_URL')) {
    define('PROJECT_INC_URL', PROJECT_URL . '/inc');
}

/** Caminho absoluto do diretório de includes do projeto. */
if (!defined('PROJECT_INC_PATH')) {
    define('PROJECT_INC_PATH', PROJECT_PATH . 'inc' . DIRECTORY_SEPARATOR);
}

/** URL do diretório de scripts javascript do projeto. */
if (!defined('PROJECT_JS_URL')) {
    define('PROJECT_JS_URL', PROJECT_URL . '/js');
}

/** Caminho absoluto do diretório de scripts javascript do projeto. */
if (!defined('PROJECT_JS_PATH')) {
    define('PROJECT_JS_PATH', PROJECT_PATH . 'js' . DIRECTORY_SEPARATOR);
}

/** URL do arquivo temporário quando o banco está fora. */
if (!defined('PROJECT_OUT_URL')) {
    define('PROJECT_OUT_URL', PROJECT_URL . '/out.php');
}

/** Caminho absoluto do arquivo temporário quando o banco está fora. */
if (!defined('PROJECT_OUT_PATH')) {
    define('PROJECT_OUT_PATH', PROJECT_PATH . 'out.php');
}

/** URL do diretório de scripts flash do projeto. */
if (!defined('PROJECT_SWF_URL')) {
    define('PROJECT_SWF_URL', PROJECT_URL . '/swf');
}

/** Caminho absoluto do diretório de scripts flash do projeto. */
if (!defined('PROJECT_SWF_PATH')) {
    define('PROJECT_SWF_PATH', PROJECT_PATH . 'swf' . DIRECTORY_SEPARATOR);
}

if (!defined('PROJECT_TEMPLATE_URL')) {
    define('PROJECT_TEMPLATE_URL', PROJECT_URL . '/templates');
}

if (!defined('PROJECT_TEMPLATE_PATH')) {
    define('PROJECT_TEMPLATE_PATH', PROJECT_PATH . 'templates' . DIRECTORY_SEPARATOR);
}




$admin_project = isset($admin_project) ? $admin_project : '';
switch ($admin_project)
{
    case 'adm':
    default:
        include_once PROJECT_PATH . 'adm' . DIRECTORY_SEPARATOR . 'config.php';
}


//mod_rewrite Settings
$rewrite = array
(
    'ativo' => true
);
$modulo = array('AdmDisplayErrors' => array
                    (
                		'ativo' => 1
                		,'debug' => 0
                		,'dev' => 0
                	)
               );
error_reporting(E_ALL | E_STRICT);
if ($modulo['AdmDisplayErrors']['ativo'])
{
    /** modo desenvolvimento **/
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'Off');
}
else
{
    /** modo produção **/
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', PROJECT_PATH . 'log.log');
}


try
{
    include_once PROJECT_FUNC_PATH."funcoes.php";
}
catch (exception $e)
{
    echo 'Mensagem: funcoes.php';
}

// caso não tenha digitado a url com www redireciona para endereço com www
$www = substr(SERVER_NAME,0,3);
if($www != "www")
{
    //redireciona
    header("Location: ".ssl()."www.".PROJECT_URL.(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : ''));
    die();
}

try
{
    $conexao;
    $conexaoMG;
    
    include_once ADMIN_FUNC_PATH.'conexao.php';
    
    $conexao = conexao();
    //$conexaoMG = conexaoMG();
}
catch (exception $e)
{
    echo 'Mensagem: conexao.php';
}

$restrita = isset($_SESSION['restrita']) ? $_SESSION['restrita'] : 0;
$dev = isset($_GET['dev']) ? $_GET['dev'] : '';

?>