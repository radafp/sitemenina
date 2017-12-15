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
        $_SESSION['regiao']         = $_GET['regiao'];
        $regiao                     = $_GET['regiao'];
        switch($regiao){
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

        $dados['titulo']            = $this->Novomenina->noticias_turistmo_destaque($regiao);
        $dados['eventos']           = $this->Novomenina->eventos($regiao);
        $dados['programacao']       = $this->Novomenina->programacao($regiao);
        $dados['videos']            = $this->Novomenina->videos($regiao);
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($regiao);
        $dados['outras_noticias']   = $this->Novomenina->outras_noticias($regiao);
        $dados['viewName']          = 'regiao';
        $this->load->view('Template', $dados);
    }

    public function programacao() {
        $dados['viewName'] = 'programacao';
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['programacao_impar'] = $this->Novomenina->programacao_impar($_SESSION['regiao']);
        $dados['programacao_par']   = $this->Novomenina->programacao_par($_SESSION['regiao'] ); 
        $this->load->view('Template', $dados);

    }

    public function artistico() {
        // $categoria = $_GET['categoria'];
        // $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['videos'] = $this->Novomenina->videos($_SESSION['regiao']);
        $dados['viewName'] = 'artistico/videos';
        $this->load->view('Template', $dados);
    }

    public function noticia() {
        $config = array(
			"base_url" => base_url('usuarios/p'),
			"per_page" => 3,
			"num_links" => 3,
			"uri_segment" => 3,
			"total_rows" => $this->Novomenina->CountAll('noticias'),
			"full_tag_open" => "<ul class='pagination' id='ajaxPagination'>",
			"full_tag_close" => "</ul>",
			"first_link" => FALSE,
			"last_link" => FALSE,
			"first_tag_open" => "<li>",
			"first_tag_close" => "</li>",
			"prev_link" => "Anterior",
			"prev_tag_open" => "<li class='prev'>",
			"prev_tag_close" => "</li>",
			"next_link" => "Próxima",
			"next_tag_open" => "<li class='next'>",
			"next_tag_close" => "</li>",
			"last_tag_open" => "<li>",
			"last_tag_close" => "</li>",
			"cur_tag_open" => "<li class='active'><a href='#'>",
			"cur_tag_close" => "</a></li>",
			"num_tag_open" => "<li>",
			"num_tag_close" => "</li>"
        );
        
        $this->pagination->initialize($config);
        $dados['pagination'] = $this->pagination->create_links();

        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $categoria = $_GET['categoria'];
        $dados['jornalismo'] = $this->Novomenina->GetAll_noticias($categoria, $_SESSION['regiao'], 2);
   
        // $dados['jornalismo'] = $this->Novomenina->jornalismo_impar($categoria, $_SESSION['regiao']);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['mais_lidas'] = $this->Novomenina->mais_lidas($categoria, $_SESSION['regiao']);
        
        $dados['viewName'] = 'jornalismo/noticia';
        $this->load->view('Template', $dados);
    }

    public function descricao_noticia() {
        $id = $_GET['id'];
        $categoria = $_GET['categoria'];
        $this->Novomenina->cliques($id, $_SESSION['regiao']);
        $dados['descricao_noticia'] = $this->Novomenina->descricao_noticia($id, $_SESSION['regiao']);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['mais_lidas'] = $this->Novomenina->mais_lidas($categoria, $_SESSION['regiao']);
        $dados['viewName'] = 'jornalismo/descricao_noticia';
        $this->load->view('Template', $dados);
    }
    
    

    public function eventos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['evento_impar']= $this->Novomenina->evento_inpar($_SESSION['regiao']); 
        $dados['viewName'] = 'eventos/eventos';
        $this->load->view('Template', $dados);
    }

    public function descricao_evento() {
        $id = $_GET['id'];
        $regiao = $_GET['regiao'];
        $dados['descricao_evento'] = $this->Novomenina->descricao_evento($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'eventos/descricao_eventos';
        $this->load->view('Template', $dados);
    }

    public function promocoes() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['promocoes_impar'] = $this->Novomenina->promocoes($_SESSION['regiao']);
        $dados['viewName'] = 'promocoes/promocoes';
        $this->load->view('Template', $dados);
    }

    public function descricao_promocoes() {
        $id = $_GET['id'];
        $regiao = $_GET['regiao'];
        $dados['descricao_promocoes'] = $this->Novomenina->descricao_promocoes($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'promocoes/descricao_promocoes';
        $this->load->view('Template', $dados);
    }

    public function emprego() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'utilidade_publica/emprego';
        $this->load->view('Template', $dados);
    }

    public function documentos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'utilidade_publica/documentos';
        $this->load->view('Template', $dados);
    }

    public function achados_e_perdidos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'utilidade_publica/achados_e_perdidos';
        $this->load->view('Template', $dados);
    }

    public function descricao_utilidade() {
        $id = $_GET['id'];
        $regiao = $_GET['regiao'];
        $dados['descricao_promocoes'] = $this->Novomenina->descricao_promocoes($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'promocoes/descricao_promocoes';
        $this->load->view('Template', $dados);
    }

    public function empregos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'quem_somos';
        $this->load->view('Template', $dados);
    }
        

    public function quem_somos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'quem_somos';
        $this->load->view('Template', $dados);
    }

 }