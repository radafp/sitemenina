<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novomenina_model extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function noticias_turistmo_destaque() {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt FROM noticias INNER JOIN categorias WHERE categorias.cod = noticias.codCategoria and noticias.destaque = 1 and noticias.mostrar = 1 ORDER BY data desc limit 3");
        return $query->result_array();
    }

    public function outras_noticias() {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt FROM noticias INNER JOIN categorias WHERE categorias.cod = noticias.codCategoria and noticias.destaque = 0 and noticias.mostrar = 1 ORDER BY data desc limit 4;");
        return $query->result_array();
    }

    public function eventos() {
        $query = $this->db->get('eventos');
        return $query->result_array();
    }

    public function programacao() {
        $query = $this->db->get('programacao');
        return $query->result_array();
    }

    public function programacao_impar() {
        $query = $this->db->query('SELECT * FROM programacao WHERE cod % 2 != 0');
        return $query->result_array();
    }

    public function programacao_par() {
        $query = $this->db->query('SELECT * FROM programacao WHERE cod % 2 = 0');
        return $query->result_array();
    }

    public function videos() {
        $query = $this->db->get('videos');
        return $query->result_array();
    }

    public function titulo_jornalismo() {
        $query = $this->db->query('SELECT DISTINCT categorias.categoriaPt, noticias.codCategoria from categorias inner join noticias WHERE categorias.cod = noticias.codCategoria');
        return $query->result_array();
    }
}