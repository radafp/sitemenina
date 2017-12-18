<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novomenina_model extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function GetAll_noticias($categoria, $regiao, $limit = null, $offset = null) {
        // $this->db->where('categoria', $categoria);
        // $this->db->where('regiao', $regiao);
        $this->db->order_by('data', 'desc');
        $this->db->select('*');
        $this->db->from('noticias');
        $this->db->join('categorias', "categorias.cod = noticias.codCategoria and categorias.categoriaPt = '$categoria' and noticias.destaque = 1 and noticias.mostrar = 1 and noticias.regiao = '$regiao'");
    
        if($limit)
            $this->db->limit($limit,$offset);
            $query = $this->db->get();
            
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
    
    public function CountAll($tabela){
        return $this->db->count_all($tabela);
    }

     // tabela noticias
    public function noticias_turistmo_destaque($regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt FROM noticias INNER JOIN categorias WHERE categorias.cod = noticias.codCategoria and noticias.destaque = 1 and noticias.mostrar = 1 and noticias.regiao = '$regiao' ORDER BY data desc limit 3");
        return $query->result_array();
    }

    public function fotos_noticias($regiao) {
        $query = $this->db->query("SELECT arquivo FROM arquivos join noticias
                                    WHERE codReferencia = noticias.cod AND referencia = 'noticias'
                                    AND capa = '1' AND tipo = '2'  and noticias.regiao = '$regiao' LIMIT 1");
        return $query->result_array();
    }
    

    public function outras_noticias($regiao)  {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt FROM noticias INNER JOIN categorias WHERE categorias.cod = noticias.codCategoria and noticias.destaque = 0 and noticias.mostrar = 1 and noticias.regiao = '$regiao' ORDER BY data desc limit 4;");
        return $query->result_array();
    }

    public function eventos($regiao)  {
        $this->db->where('regiao', '$regiao');
        $query = $this->db->get('eventos');
        return $query->result_array();
    }

    // TABELA programacao
    public function programacao($regiao) {
        $this->db->where('regiao', '$regiao');
        $query = $this->db->get('programacao');
        return $query->result_array();
    }

    public function programacao_impar($regiao)  {
        $query = $this->db->query("SELECT * FROM programacao WHERE cod % 2 != 0 and programacao.regiao = '$regiao' ");
        return $query->result_array();
    }

    public function programacao_par($regiao)  {
        $query = $this->db->query("SELECT * FROM programacao WHERE cod % 2 = 0 and programacao.regiao = '$regiao'");
        return $query->result_array();
    }

    public function videos($regiao)  {
        $query = $this->db->query("SELECT * FROM videos WHERE videos.regiao = '$regiao' and videos.mostrar = 1");
        return $query->result_array();
    }

    // tabela categorias
    public function titulo_jornalismo($regiao)  {
        $query = $this->db->query("SELECT DISTINCT categorias.categoriaPt, noticias.codCategoria from categorias inner join noticias WHERE categorias.cod = noticias.codCategoria and noticias.regiao = '$regiao' ");
        return $query->result_array();
    }

    public function jornalismo($categoria, $regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt FROM noticias INNER JOIN categorias WHERE categorias.cod = noticias.codCategoria and noticias.destaque = 1 and noticias.mostrar = 1 and categoriaPt = '$categoria'  and noticias.regiao = '$regiao' ORDER BY data desc");
        return $query->result_array();
    }

    public function descricao_noticia($id, $regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt FROM noticias INNER JOIN categorias WHERE categorias.cod = noticias.codCategoria and noticias.destaque = 1 and noticias.mostrar = 1 and noticias.cod = $id  and noticias.regiao = '$regiao' ORDER BY data DESC");
        return $query->result_array();
    }

    public function descricao_evento($id, $regiao) {
        $query = $this->db->query("SELECT * FROM eventos WHERE cod = $id and eventos.regiao = '$regiao'");
        return $query->result_array();
    }

    public function cliques($id, $regiao) {
        $query = $this->db->query("UPDATE noticias SET cliques = cliques + 1 WHERE cod = $id  and noticias.regiao= '$regiao'");
    }

    public function mais_lidas($categoria, $regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt FROM noticias INNER JOIN categorias WHERE categorias.cod = noticias.codCategoria and noticias.mostrar = 1 and categoriaPt = '$categoria'  and noticias.regiao= '$regiao' ORDER BY cliques desc");
        return $query->result_array();
    }

    public function evento_inpar($regiao) {
        $this->db->where('regiao', "$regiao");
        $query = $this->db->get('eventos');
        return $query->result_array();
    }

    // tabela promocoes
    public function promocoes($regiao) {
        $this->db->where('regiao', "$regiao");
        $query = $this->db->get('promocoes');
        return $query->result_array();
    }

    public function descricao_promocoes($id, $regiao) {
        $query = $this->db->query("SELECT * FROM promocoes WHERE cod = $id and promocoes.regiao = '$regiao'");
        return $query->result_array();
    }
}