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
     public function noticias_em_destaque($regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo
                                        FROM noticias
                                    INNER JOIN categorias
                                        on noticias.codCategoria = categorias.cod
                                    INNER JOIN arquivos
                                        WHERE arquivos.codReferencia = noticias.cod
                                        AND noticias.regiao = '$regiao'
                                        AND noticias.destaque = 1 
                                        AND noticias.mostrar = 1
                                        GROUP by noticias.cod
                                        ORDER by DATA DESC
                                        LIMIT 3"
        );

        return $query->result_array();
    }


     // tabela noticias mostradas na home
    public function ultimas_noticias($regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt
                                        FROM noticias
                                    INNER JOIN categorias
                                        on noticias.codCategoria = categorias.cod
                                        AND noticias.regiao = '$regiao'
                                        AND noticias.destaque = 0
                                        AND noticias.mostrar = 1
                                        GROUP by noticias.cod
                                        ORDER by DATA DESC
                                        LIMIT 3"
        );
        return $query->result_array();
    }


    public function outras_noticias($regiao)  {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo
                                        FROM noticias 
                                    INNER JOIN categorias 
                                        on categorias.cod = noticias.codCategoria
                                    INNER JOIN arquivos
                                        WHERE noticias.destaque = 0 
                                        and noticias.mostrar = 1 
                                        and noticias.regiao = '$regiao'
                                        GROUP BY noticias.cod
                                        ORDER BY data DESC 
                                        limit 4");
        return $query->result_array();
    }

    // public function eventos($regiao)  {
    //     $this->db->where('regiao', '$regiao');
    //     $query = $this->db->get('eventos');
    //     return $query->result_array();
    // }

    // TABELA programacao
    // public function programacao($regiao) {
    //     $this->db->where('regiao', '$regiao');
    //     $query = $this->db->get('programacao');
    //     return $query->result_array();
    // }

    // public function programacao2($regiao) {
    //     $query = $this->db->query("SELECT programacao.*, arquivos.arquivo FROM programacao INNER JOIN arquivos WHERE arquivos.codReferencia = programacao.cod AND programacao.regiao = '$regiao'");
    //     return $query->result_array();
    // }

    // metodo mostrado na div esquerda 
    public function programacao_home($regiao)  {
        $query = $this->db->query("SELECT programacao.*, arquivos.arquivo 
                                    FROM programacao 
                                        INNER JOIN arquivos 
                                    WHERE programacao.cod % 2 != 0 
                                    and arquivos.codReferencia = programacao.cod 
                                    and programacao.regiao = '$regiao'
                                    GROUP by programacao.cod
                                    LIMIT 3"
        );
        return $query->result_array();
    }

    // metodo mostrado na div esquerda 
    public function programacao_impar($regiao)  {
        $query = $this->db->query("SELECT programacao.*, arquivos.arquivo 
                                    FROM programacao 
                                        INNER JOIN arquivos 
                                    WHERE programacao.cod % 2 != 0 
                                    and arquivos.codReferencia = programacao.cod 
                                    and programacao.regiao = '$regiao'
                                    GROUP by programacao.cod"
        );
        return $query->result_array();
    }

    // public function programacao_par($regiao)  {
    //     $query = $this->db->query("SELECT * FROM programacao WHERE cod % 2 = 0 and programacao.regiao = '$regiao'");
    //     return $query->result_array();
    // }

    // public function programacao_par($regiao)  {
    //     $query = $this->db->query("SELECT programacao.*, arquivos.arquivo FROM programacao INNER JOIN arquivos WHERE programacao.cod % 2 = 0 and arquivos.codReferencia = programacao.cod and programacao.regiao = '$regiao' ");
    //     return $query->result_array();
    // }

    public function videos($regiao)  {
        $query = $this->db->query("SELECT * FROM videos WHERE videos.regiao = '$regiao' and videos.mostrar = 1");
        return $query->result_array();
    }

    // tabela categorias para mostrar as noticias existentes no menu de noticias
    public function titulo_jornalismo($regiao)  {
        $query = $this->db->query("SELECT DISTINCT categorias.categoriaPt, noticias.codCategoria from categorias inner join noticias WHERE categorias.cod = noticias.codCategoria and noticias.regiao = '$regiao' ");
        return $query->result_array();
    }

    public function jornalismo($categoria, $regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt FROM noticias INNER JOIN categorias WHERE categorias.cod = noticias.codCategoria and noticias.destaque = 1 and noticias.mostrar = 1 and categoriaPt = '$categoria'  and noticias.regiao = '$regiao' ORDER BY data desc");
        return $query->result_array();
    }

    public function jornalismo_noticias($categoria, $regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.*
                                    FROM noticias 
                                        INNER JOIN categorias, arquivos 
                                    WHERE categorias.cod = noticias.codCategoria 
                                    and noticias.destaque = 1 
                                    and noticias.mostrar = 1 
                                    and categoriaPt = '$categoria' 
                                    and noticias.regiao = '$regiao' 
                                    and arquivos.codReferencia = noticias.cod 
                                    and referencia = 'noticias' 
                                    AND capa = '1' 
                                    AND tipo = '2' 
                                    and noticias.regiao = '$regiao' 
                                    ORDER BY data"
        );
        return $query->result_array();
    }
    public function descricao_noticia($id, $regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo
                                        FROM noticias 
                                    INNER JOIN categorias, arquivos
                                        WHERE categorias.cod = noticias.codCategoria 
                                        and arquivos.codReferencia = noticias.cod 
                                        and noticias.destaque = 0
                                        and noticias.mostrar = 1 
                                        and noticias.cod = $id  
                                        and noticias.regiao = '$regiao' 
                                        ORDER BY data DESC");
        return $query->result_array();
    }

    public function descricao_eventos($id, $regiao) {
        $query = $this->db->query("SELECT * FROM eventos WHERE cod = $id and eventos.regiao = '$regiao'");
        return $query->result_array();
    }

    public function cliques($id, $regiao) {
        $query = $this->db->query("UPDATE noticias SET cliques = cliques + 1 WHERE cod = $id  and noticias.regiao= '$regiao'");
    }

    public function mais_lidas($categoria, $regiao) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo 
                                        FROM noticias 
                                    INNER JOIN categorias, arquivos 
                                        WHERE categorias.cod = noticias.codCategoria 
                                        AND noticias.cod = arquivos.codReferencia 
                                        and noticias.mostrar = 1 
                                        and categoriaPt = '$categoria'  
                                        and noticias.regiao= '$regiao'
                                        GROUP BY noticias.cod
                                        ORDER BY cliques desc
        ");
        return $query->result_array();
    }


    // limite de 2 eventos para mostrar na home
    public function eventos_home($regiao) {
        $query = $this->db->query("SELECT eventos.*, arquivos.arquivo
                                    FROM eventos 
                                    INNER JOIN arquivos 
                                    ON eventos.cod = arquivos.codReferencia 
                                    and eventos.regiao = 'bc' 
                                    GROUP BY eventos.cod
                                    ORDER BY eventos.dataCadastro 
                                    LIMIT 2"
        );
        return $query->result_array();
    }

    // eventos da pagina de eventos
    public function eventos($regiao) {
        $query = $this->db->query("SELECT eventos.*, arquivos.arquivo
                                    FROM eventos 
                                    INNER JOIN arquivos 
                                    ON eventos.cod = arquivos.codReferencia 
                                    and eventos.regiao = 'bc' 
                                    GROUP BY eventos.cod
                                    ORDER BY eventos.dataCadastro"
        );
        return $query->result_array();
    }

    // tabela promocoes puchadas na home
    public function promocoes_home($regiao, $limit = null) {
        // $this->db->where('regiao', "$regiao");
        // $query = $this->db->get('promocoes');
        // return $query->result_array();
        $query = $this->db->query("SELECT promocoes.*, arquivos.arquivo
                                        FROM promocoes 
                                    INNER JOIN arquivos 
                                        ON promocoes.cod = arquivos.codReferencia 
                                        and promocoes.regiao = '$regiao' 
                                        GROUP BY promocoes.cod
                                        ORDER BY promocoes.dataCadastro DESC
                                        LIMIT 2"
        );
        return $query->result_array();
    }

    // tabela promocoes puchadas na home
    public function promocoes($regiao, $limit = null) {
        // $this->db->where('regiao', "$regiao");
        // $query = $this->db->get('promocoes');
        // return $query->result_array();
        $query = $this->db->query("SELECT promocoes.*, arquivos.arquivo
                                        FROM promocoes 
                                    INNER JOIN arquivos 
                                        ON promocoes.cod = arquivos.codReferencia 
                                        and promocoes.regiao = '$regiao' 
                                        GROUP BY promocoes.cod
                                        ORDER BY promocoes.dataCadastro DESC"
        );
        return $query->result_array();
    }
    public function descricao_promocoes($id, $regiao) {
        $query = $this->db->query("SELECT * FROM promocoes WHERE cod = $id and promocoes.regiao = '$regiao'");
        return $query->result_array();
    }
}