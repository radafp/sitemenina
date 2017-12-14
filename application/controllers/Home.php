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

    public function balneario_camboriu() {
        $dados['viewName']          = 'balneario_camboriu';
        $_SESSION['regiao']         = 'bc';
        $regiao                     = 'bc';
        $_SESSION['controller']     = 'balneario_camboriu';
        $dados['titulo']            = $this->Novomenina->noticias_turistmo_destaque($regiao);
        $dados['eventos']           = $this->Novomenina->eventos($regiao);
        $dados['programacao']       = $this->Novomenina->programacao($regiao);
        $dados['videos']            = $this->Novomenina->videos($regiao);
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($regiao);
        $dados['outras_noticias']   = $this->Novomenina->outras_noticias($regiao);
        $this->load->view('Template', $dados);
    }

    public function blumenau() {
        $dados['viewName'] = 'blumenau';
        $_SESSION['regiao'] = 'BL';
        $this->load->view('Template', $dados);
    }

    public function lages() {
        $dados['viewName'] = 'lages';
        $_SESSION['regiao'] = 'LG';
        $this->load->view('Template', $dados);
    }

    public function programacao() {
        $dados['viewName'] = 'programacao';
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['programacao_impar'] = $this->Novomenina->programacao_impar($_SESSION['regiao']);
        $dados['programacao_par']   = $this->Novomenina->programacao_par($_SESSION['regiao'] ); 
        $this->load->view('Template', $dados);

    }

    // public function esporte() {
    //     $dados['jornalismo_impar'] = $this->Novomenina->jornalismo_impar('Esporte');
    //     $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
    //     $dados['mais_lidas'] = $this->Novomenina->mais_lidas('Esporte');
    //     $dados['viewName'] = 'jornalismo/esporte';
    //     $this->load->view('Template', $dados);
    // }

    // public function policial() {
    //     $dados['jornalismo_impar'] = $this->Novomenina->jornalismo_impar('Policial');
    //     $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
    //     $dados['mais_lidas'] = $this->Novomenina->mais_lidas('Policial');
    //     $dados['viewName'] = 'jornalismo/policial';
    //     $this->load->view('Template', $dados);
    // }

    // public function cultura() {
    //     $dados['jornalismo_impar'] = $this->Novomenina->jornalismo_impar('Cultura');
    //     $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
    //     $dados['mais_lidas'] = $this->Novomenina->mais_lidas('Cultura');
    //     $dados['viewName'] = 'jornalismo/cultura';
    //     $this->load->view('Template', $dados);
    // }

    // public function descricao_esporte() {
    //     $id = $_GET['id'];
    //     $this->Novomenina->cliques($id);
    //     $dados['descricao_noticia'] = $this->Novomenina->descricao_noticia($id);
    //     $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
    //     $dados['mais_lidas'] = $this->Novomenina->mais_lidas('Esporte');
    //     $dados['viewName'] = 'jornalismo/descricao_esporte';
    //     $this->load->view('Template', $dados);
    // }

    // public function descricao_cultura() {
    //     $id = $_GET['id'];
    //     $this->Novomenina->cliques($id);
    //     $dados['descricao_noticia'] = $this->Novomenina->descricao_noticia($id);
    //     $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
    //     $dados['mais_lidas'] = $this->Novomenina->mais_lidas('Cultura');
    //     $dados['viewName'] = 'jornalismo/descricao_cultura';
    //     $this->load->view('Template', $dados);
    // }

    // public function descricao_policial() {
    //     $id = $_GET['id'];
    //     $this->Novomenina->cliques($id);
    //     $dados['descricao_noticia'] = $this->Novomenina->descricao_noticia($id);
    //     $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
    //     $dados['mais_lidas'] = $this->Novomenina->mais_lidas('Policial');
    //     $dados['viewName'] = 'jornalismo/descricao_policial';
    //     $this->load->view('Template', $dados);
    // }

    public function noticia() {
        $categoria = $_GET['categoria'];
        $dados['jornalismo_impar'] = $this->Novomenina->jornalismo_impar($categoria, $_SESSION['regiao']);
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
    
    public function artistico() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'artistico';
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

    public function quem_somos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'quem_somos';
        $this->load->view('Template', $dados);
    }

 }