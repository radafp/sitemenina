<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class balneario_camboriu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carreganho o model Tabelas_model e setando um apelido de Tabelas
        $this->load->model('Novomenina_model', 'Novomenina');
        // $this->load->model('Gastos_model', 'Gastos');
        $this->load->helper('url');
    }

    public function index() {
        $dados['viewName']          = 'balneario_camboriu';
        $_SESSION['regiao']         = 'BC';
        $_SESSION['controller']     = 'balneario_camboriu';
        $dados['titulo']            = $this->Novomenina->noticias_turistmo_destaque();
        $dados['eventos']           = $this->Novomenina->eventos();
        $dados['programacao']       = $this->Novomenina->programacao();
        $dados['videos']            = $this->Novomenina->videos();
        $dados['titulo_jornalistmo']= $this->Novomenina->titulo_jornalismo();
        $dados['outras_noticias']   = $this->Novomenina->outras_noticias();
        $this->load->view('Template', $dados);
    }

    public function programacao() {
        $dados['viewName'] = 'programacao';
        $dados['titulo_jornalistmo']= $this->Novomenina->titulo_jornalismo();
        $dados['programacao_impar'] = $this->Novomenina->programacao_impar();
        $dados['programacao_par']   = $this->Novomenina->programacao_par(); 
        $this->load->view('Template', $dados);

    }
}