<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carreganho o model Tabelas_model e setando um apelido de Tabelas
        $this->load->model('Novomenina_model', 'Novomenina');
        // $this->load->model('Gastos_model', 'Gastos');
        $this->load->helper('url');
        
    }

    public function index() {
        $this->load->view('home');

    }

    public function regiao() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');
        
        $regiao = isset($uri[0]) && !empty($uri[0]) ? $uri[0] : '';// regiao
        if($regiao == 'balneario-camboriu')
            $_SESSION['regiao'] =  'bc';
        if($regiao == 'blumenal')
            $_SESSION['regiao'] =  'bl';
        if($regiao == 'lages')
            $_SESSION['regiao'] =  'lg';
        
        $codigoSecao = isset($uri[1]) && !empty($uri[1]) ? $uri[1] : ''; //menu
        //echo $codigoSecao;
        $codigoConteudo = isset($uri[2]) && !empty($uri[2]) ? $uri[2] : ''; //codigo

        // $dados['cidade']            = $this->Novomenina->cidade($regiao);
        $dados['cidade'] = $regiao;
        switch($_SESSION['regiao']){
            case 'bc':
                $_SESSION['slogam'] = "+ DE UM MILHÃO DE AMIGOS";
                $_SESSION['socialFace'] = "https://www.facebook.com/radiomeninabc";
                $_SESSION['socialInsta'] = "https://www.instagram.com/meninafm/";
                $_SESSION['socialYoutube'] = "https://www.youtube.com/channel/UCCuiZ1TmPD2gnl_ASpg99xg";
                break;
            case 'bl': 
                $_SESSION['slogam'] = "A NÚMERO UM DE BLUMENAL E REGIÃO";
                $_SESSION['socialFace'] = "https://www.facebook.com/radiomeninablu";
                $_SESSION['socialInsta'] = "https://www.instagram.com/meninafmblu/";
                $_SESSION['socialYoutube'] = "https://www.youtube.com/channel/UCCuiZ1TmPD2gnl_ASpg99xg";
                break;
            case 'lg':
                $_SESSION['slogam'] = "A PRIMEIRA DA FM";
                $_SESSION['socialFace'] = "https://www.facebook.com/meninafmlages";
                $_SESSION['socialInsta'] = "https://www.instagram.com/meninafmlages/";
                $_SESSION['socialYoutube'] = "https://www.youtube.com/channel/UCCuiZ1TmPD2gnl_ASpg99xg";
                break;
            default:
                $_SESSION['slogam'] = "";
                $_SESSION['socialFace'] = "";
                $_SESSION['socialInsta'] = "";
                $_SESSION['socialYoutube'] = "";
                break;
        }

        $dados['noticias_em_destaque']  = $this->Novomenina->noticias_em_destaque($_SESSION['regiao']);
        $dados['ultimas_noticias']      = $this->Novomenina->ultimas_noticias($_SESSION['regiao']);
        $dados['programacao_home']      = $this->Novomenina->programacao_home($_SESSION['regiao']);
        $dados['eventos_home']          = $this->Novomenina->eventos_home($_SESSION['regiao']);
        $dados['videos']                = $this->Novomenina->videos($_SESSION['regiao']);
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['promocoes_home']        = $this->Novomenina->promocoes_home($_SESSION['regiao']);
        $dados['viewName']              = 'regiao';
        $this->load->view('Template', $dados);
    }

    public function programacao() {
        if(isset($_GET['programacao'])) {
            $programacao = $_GET['programacao'];
            $dados['programacao_impar'] = $this->Novomenina->programacao_programacao($_SESSION['regiao'], $programacao);
        }else{
            $dados['programacao_impar'] = $this->Novomenina->programacao_impar($_SESSION['regiao']);
        }
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['programacao_par']   = $this->Novomenina->programacao_par($_SESSION['regiao']); 
        $dados['viewName'] = 'programacao/programacao';
        $this->load->view('Template', $dados);

    }

    // public function programacao_programacao() {
    //     $programacao = $_GET['programacao'];
    //     $dados['programacao_programacao'] = $this->Novomenina->programacao_programacao($_SESSION['regiao'], $programacao);
    //     $dados['viewName'] = 'programacao/programacao_programacao';
    //     $this->load->view('Template', $dados);
    // }

    public function artistico() {
        // $categoria = $_GET['categoria'];
        // $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['videos'] = $this->Novomenina->videos($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'artistico/videos';
        $this->load->view('Template', $dados);
    }

    public function noticia() {
        $categoria = $_SESSION['categoria'];
        $dados['jornalismo'] = $this->Novomenina->jornalismo_noticias($categoria, $_SESSION['regiao']);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        // $dados['outras_noticias'] = $this->Novomenina->outras_noticias($_SESSION['regiao']); 
        $dados['mais_lidas'] = $this->Novomenina->mais_lidas($categoria, $_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        // $dados = json_encode($dados['jornalismo']);
        $count = count($dados['jornalismo']);
        $dados['count'] = $count;
        $dados['viewName'] = 'jornalismo/noticia';
        $this->load->view('Template', $dados);
    }

    public function descricao_noticia() {
        $id = $_GET['id'];
        $categoria = $_GET['categoria'];
        $this->Novomenina->cliques($id, $_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['descricao_noticia'] = $this->Novomenina->descricao_noticia($id, $_SESSION['regiao'], $categoria);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['mais_lidas'] = $this->Novomenina->mais_lidas($categoria, $_SESSION['regiao']);
        $dados['viewName'] = 'jornalismo/descricao_noticia';
        $this->load->view('Template', $dados);
    }
    
    public function eventos() {
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['eventos']           = $this->Novomenina->eventos($_SESSION['regiao']); 
        $dados['viewName']          = 'eventos/eventos';
        $this->load->view('Template', $dados);
    }

    public function descricao_eventos() {
        $id = $_GET['id'];
        $regiao = $_SESSION['regiao'];
        $dados['descricao_eventos'] = $this->Novomenina->descricao_eventos($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'eventos/descricao_eventos';
        $this->load->view('Template', $dados);
    }

    public function promocoes() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['promocoes_impar'] = $this->Novomenina->promocoes_home($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'promocoes/promocoes';
        $this->load->view('Template', $dados);
    }

    public function descricao_promocoes() {
        $id = $_GET['id'];
        $regiao = $_SESSION['regiao'];
        $dados['descricao_promocoes'] = $this->Novomenina->descricao_promocoes($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'promocoes/descricao_promocoes';
        $this->load->view('Template', $dados);
    }

    public function descricao_programacao() {
        $id = $_GET['id'];
        $regiao = $_SESSION['regiao'];
        $dados['descricao_programacao'] = $this->Novomenina->descricao_programacao($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'programacao/descricao_programacao';
        $this->load->view('Template', $dados);
    }

    public function emprego() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'utilidade_publica/emprego';
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $this->load->view('Template', $dados);
    }

    public function documentos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'utilidade_publica/documentos';
        $this->load->view('Template', $dados);
    }

    public function achados_e_perdidos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'utilidade_publica/achados_e_perdidos';
        $this->load->view('Template', $dados);
    }

    public function descricao_utilidade() {
        $id = $_GET['id'];
        $regiao = $_GET['regiao'];
        $dados['descricao_promocoes'] = $this->Novomenina->descricao_promocoes($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'promocoes/descricao_promocoes';
        $this->load->view('Template', $dados);
    }

    public function empregos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'quem_somos';
        $this->load->view('Template', $dados);
    }
        

    public function quem_somos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['viewName'] = 'quem_somos';
        $this->load->view('Template', $dados);
    }

 }