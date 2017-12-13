<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $_SESSION['regiao']         = 'BC';
        $_SESSION['controller']     = 'balneario_camboriu';
        $dados['titulo']            = $this->Novomenina->noticias_turistmo_destaque();
        $dados['eventos']           = $this->Novomenina->eventos();
        $dados['programacao']       = $this->Novomenina->programacao();
        $dados['videos']            = $this->Novomenina->videos();
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
        $dados['outras_noticias']   = $this->Novomenina->outras_noticias();
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
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
        $dados['programacao_impar'] = $this->Novomenina->programacao_impar();
        $dados['programacao_par']   = $this->Novomenina->programacao_par(); 
        $this->load->view('Template', $dados);

    }

    public function artistico() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
        $dados['viewName'] = 'artistico';
        $this->load->view('Template', $dados);
    }

    public function eventos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
        $dados['viewName'] = 'eventos';
        $this->load->view('Template', $dados);
    }

    public function promocoes() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
        $dados['viewName'] = 'promocoes';
        $this->load->view('Template', $dados);
    }

    public function quem_somos() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo();
        $dados['viewName'] = 'quem_somos';
        $this->load->view('Template', $dados);
    }
 }