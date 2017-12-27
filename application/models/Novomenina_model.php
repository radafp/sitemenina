<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novomenina_model extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    // ================================ TUDO REFERENTE A PROGRAMACAO =============================
    // |                                                                                         |
    // |                          TODOS OS METODOS ENVOLVENDO PROGRAMACAO                        |
    // |                                                                                         |
    // ===========================================================================================

    // metodo mostrado na div esquerda 
    public function programacao_home($regiao)  {
        // $query = $this->db->query("SELECT programacao.*, arquivos.arquivo 
        //                             FROM programacao 
        //                                 INNER JOIN arquivos 
        //                             WHERE programacao.cod % 2 != 0 
        //                             and arquivos.codReferencia = programacao.cod 
        //                             and programacao.regiao = '$regiao'
        //                             GROUP by programacao.cod
        //                             LIMIT 3"
        // );
        // return $query->result_array();
        $query = $this->db->query(
            "SELECT programacao.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = programacao.cod 
                        AND a.referencia = 'programacao' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM programacao 
                    WHERE programacao.regiao = '$regiao' 
                    AND programacao.mostrar = 1 
                GROUP BY programacao.cod
        "); 
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

    // metodo mostrado na div esquerda 
    public function programacao_par($regiao)  {
        $query = $this->db->query("SELECT programacao.*, arquivos.arquivo 
                                    FROM programacao 
                                        INNER JOIN arquivos 
                                    WHERE programacao.cod % 2 = 0 
                                    and arquivos.codReferencia = programacao.cod 
                                    and programacao.regiao = '$regiao'
                                    GROUP by programacao.cod"
        );
        return $query->result_array();
    }

    public function programacao_programacao($regiao, $programacao)  {
        $query = $this->db->query(
            "SELECT programacao.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = programacao.cod 
                        AND a.referencia = 'programacao' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM programacao 
                    WHERE programacao.programacao = '$programacao' 
                    AND programacao.regiao = '$regiao' 
                    AND programacao.mostrar = 1 
                GROUP BY programacao.cod
        "); 
        return $query->result_array();
    }


    public function descricao_programacao($id, $regiao, $limit = null) {
        $query = $this->db->query("SELECT programacao.*, arquivos.arquivo
                                        FROM programacao
                                    INNER JOIN arquivos 
                                        ON programacao.cod = arquivos.codReferencia 
                                        and programacao.regiao = '$regiao'
                                        AND programacao.cod = $id
                                        GROUP BY programacao.cod
                                        ORDER BY programacao.dataCadastro DESC"
        );
        return $query->result_array();
    }

    // public function programacao_par($regiao)  {
    //     $query = $this->db->query("SELECT programacao.*, arquivos.arquivo FROM programacao INNER JOIN arquivos WHERE programacao.cod % 2 = 0 and arquivos.codReferencia = programacao.cod and programacao.regiao = '$regiao' ");
    //     return $query->result_array();
    // }

    
    // ================================ TUDO REFERENTE A NOTICIAS ===============================
    // |                                                                                         |
    // |                          TODOS OS METODOS ENVOLVENDO NOTICIAS                           |
    // |                                                                                         |
    // ===========================================================================================

    // tabela categorias para mostrar as noticias existentes no menu de noticias
    public function titulo_jornalismo($regiao)  {
        $query = $this->db->query("SELECT DISTINCT categorias.categoriaPt, noticias.codCategoria from categorias inner join noticias WHERE categorias.cod = noticias.codCategoria and noticias.regiao = '$regiao' ");
        return $query->result_array();
    }

     // tabela noticias
     public function noticias_em_destaque($regiao) {
        // $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo
        //                                 FROM noticias
        //                             INNER JOIN categorias, arquivos
        //                                 WHERE noticias.codCategoria = categorias.cod
        //                                 AND arquivos.codReferencia = noticias.cod
        //                                 AND noticias.regiao = '$regiao'
        //                                 AND noticias.destaque = 1 
        //                                 AND noticias.mostrar = 1
        //                                 AND arquivos.tipo = 2
        //                                 AND arquivos.capa = 1
        //                                 AND arquivos.referencia = 'noticias'
        //                                 GROUP by noticias.cod
        //                                 ORDER by DATA DESC
        //                                 LIMIT 3"
        // );

        // return $query->result_array();

        $query = $this->db->query(
            "SELECT noticias.*, categorias.categoriaPt,
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = noticias.cod 
                        AND a.referencia = 'noticias' 
                        AND a.tipo = 2 
                        AND a.capa = 1
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM noticias
                INNER JOIN categorias
                    WHERE noticias.codCategoria = categorias.cod
                    AND noticias.regiao = '$regiao' 
                    AND noticias.mostrar = 1 
                    AND noticias.destaque = 1 
                GROUP BY noticias.cod
                ORDER by DATA DESC
                LIMIT 3
        "); 
        return $query->result_array();
    }


    // método utilizado na listagem de outras notícias da Home
    public function ultimas_noticias($regiao) {
        // $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt
        //                                 FROM noticias
        //                             INNER JOIN categorias
        //                                 ON noticias.codCategoria = categorias.cod
        //                                 AND noticias.regiao = '$regiao'
        //                                 AND noticias.destaque = 0
        //                                 AND noticias.mostrar = 1
        //                                 GROUP by noticias.cod
        //                                 ORDER by DATA DESC
        //                                 LIMIT 3"
        // );
        // return $query->result_array();

        $query = $this->db->query(
            "SELECT noticias.*, categorias.categoriaPt,
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = noticias.cod 
                        AND a.referencia = 'noticias' 
                        AND a.tipo = 2 
                        AND a.capa = 1
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM noticias
                INNER JOIN categorias
                    WHERE noticias.codCategoria = categorias.cod
                    AND noticias.regiao = '$regiao' 
                    AND noticias.mostrar = 1
                    AND noticias.destaque = 0 
                GROUP BY noticias.cod
                ORDER by DATA DESC
                LIMIT 3
        "); 
        return $query->result_array();
    }

    // metodo sendo usado no metodo noticias do home controller
    public function jornalismo_noticias($categoria, $regiao) {
        // $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo
        //                                 FROM noticias 
        //                             INNER JOIN categorias, arquivos 
        //                                 WHERE categorias.cod = noticias.codCategoria 
        //                                 and noticias.mostrar = 1 
        //                                 and categoriaPt = '$categoria' 
        //                                 and noticias.regiao = 'bc' 
        //                                 and arquivos.codReferencia = noticias.cod 
        //                                 and referencia = 'noticias' 
        //                                 AND arquivos.capa = '1' 
        //                                 AND arquivos.tipo = '2' 
        //                                 GROUP BY noticias.cod
        //                                 ORDER BY DATA"
        // );
        // return $query->result_array();
        $query = $this->db->query(
            "SELECT noticias.*, categorias.categoriaPt,
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = noticias.cod 
                        AND a.referencia = 'noticias' 
                        AND a.tipo = 2 
                        AND a.capa = 1
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM noticias
                INNER JOIN categorias
                    WHERE noticias.codCategoria = categorias.cod
                    AND noticias.regiao = '$regiao' 
                    AND categoriaPt = '$categoria' 
                    AND noticias.mostrar = 1 
                    AND noticias.destaque = 1 
                GROUP BY noticias.cod
                ORDER by DATA DESC
        "); 
        return $query->result_array();
    }

    public function outras_noticias($regiao)  {
        // $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo
        //                                 FROM noticias 
        //                             INNER JOIN categorias 
        //                                 on categorias.cod = noticias.codCategoria
        //                             INNER JOIN arquivos
        //                                 WHERE noticias.destaque = 0 
        //                                 and noticias.mostrar = 1 
        //                                 and noticias.regiao = '$regiao'
        //                                 GROUP BY noticias.cod
        //                                 ORDER BY data DESC 
        //                                 limit 4");
        // return $query->result_array();
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

    // metodo sendo usado na action de descricao da noticia no home controller
    public function descricao_noticia($id, $regiao, $categoria) {
        $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo 
                                        FROM noticias 
                                    INNER JOIN categorias, arquivos 
                                        WHERE arquivos.codReferencia  = noticias.cod 
                                        AND noticias.codCategoria = categorias.cod 
                                        AND noticias.cod = $id
                                        AND categorias.categoriaPt = '$categoria' 
                                        AND arquivos.codReferencia = noticias.cod 
                                        AND noticias.regiao = '$regiao' 
                                        AND noticias.mostrar = 1 
                                        LIMIT 1"
        );
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            $query1 = $this->db->query(
                "SELECT noticias.*, categorias.categoriaPt
                    FROM noticias 
                INNER JOIN categorias
                    ON noticias.codCategoria = categorias.cod 
                    AND noticias.cod = $id
                    AND categorias.categoriaPt = '$categoria' 
                    AND noticias.regiao = '$regiao' 
                    AND noticias.mostrar = 1 
                    LIMIT 1"
            );
            return $query1->result_array();
        }
        // $query = $this->db->query(
        //     "SELECT noticias.*, categorias.categoriaPt,
        //         (SELECT a.arquivo 
        //             FROM arquivos AS a 
        //                 WHERE a.codReferencia = noticias.cod 
        //                 AND a.referencia = 'noticias' 
        //                 AND a.tipo = 2 
        //                 AND a.capa = 1
        //             ORDER BY a.capa 
        //             DESC LIMIT 1) 
        //     AS arquivo 
        //         FROM noticias
        //         INNER JOIN categorias
        //             WHERE noticias.codCategoria = categorias.cod
        //             AND noticias.regiao = '$regiao' 
        //             AND categoriaPt = '$categoria' 
        //             AND noticias.mostrar = 1 
        //             AND noticias.destaque = 1 
        //         GROUP BY noticias.cod
        //         ORDER BY cliques desc
        //         LIMIT 4
        // "); 
        // return $query->result_array();
    }


    public function mais_lidas($categoria, $regiao) {
        // $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo 
        //                                 FROM noticias 
        //                             INNER JOIN categorias, arquivos 
        //                                 WHERE categorias.cod = noticias.codCategoria 
        //                                 AND noticias.cod = arquivos.codReferencia 
        //                                 and noticias.mostrar = 1 
        //                                 and categoriaPt = '$categoria'  
        //                                 and noticias.regiao= '$regiao'
        //                                 GROUP BY noticias.cod
        //                                 ORDER BY cliques desc
        //                                 LIMIT 4
        // ");
        // return $query->result_array();

        $query = $this->db->query(
            "SELECT noticias.*, categorias.categoriaPt,
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = noticias.cod 
                        AND a.referencia = 'noticias' 
                        AND a.tipo = 2 
                        AND a.capa = 1
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM noticias
                INNER JOIN categorias
                    WHERE noticias.codCategoria = categorias.cod
                    AND noticias.regiao = '$regiao' 
                    AND categoriaPt = '$categoria' 
                    AND noticias.mostrar = 1 
                    AND noticias.destaque = 1 
                GROUP BY noticias.cod
                ORDER BY cliques desc
                LIMIT 4
        "); 
        return $query->result_array();
    }

    // metodo almenta lidas += 1 na tabela de noticias ao clicar em alguma noticia
    public function cliques($id, $regiao) {
        $query = $this->db->query("UPDATE noticias SET cliques = cliques + 1 WHERE cod = $id  and noticias.regiao= '$regiao'");
    }
    // ================================ PAGINAS DE ARTISTICO ================================
    // |                                                                                    |
    // |                          TODAS AS PAGINAS SOBRE ARTISTIC                           |
    // |                                                                                    |
    // ======================================================================================

    public function top_10() {
        $query = $this->db->query(
            "SELECT top10.* from top10 
        ");
        return $query->result_array();
    }


    // ================================ PAGINAS DE PROMOÇÕES ====================================
    // |                                                                                        |
    // |                          TODAS AS PAGINAS SOBRE PROMOÇÕES                              |
    // |                                                                                        |
    // ==========================================================================================


    // tabela promocoes puchadas na home
    public function promocoes_home($regiao, $limit = null) {
        // $query = $this->db->query("SELECT promocoes.*, arquivos.arquivo
        //                                 FROM promocoes 
        //                             INNER JOIN arquivos 
        //                                 ON promocoes.cod = arquivos.codReferencia 
        //                                 and promocoes.regiao = '$regiao' 
        //                                 GROUP BY promocoes.cod
        //                                 ORDER BY promocoes.dataCadastro DESC
        //                                 LIMIT 2"
        // );
        // return $query->result_array();
        $query = $this->db->query(
            "SELECT promocoes.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = promocoes.cod 
                        AND a.referencia = 'promocoes' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM promocoes 
                    WHERE promocoes.regiao = '$regiao' 
                    AND promocoes.mostrar = 1 
                GROUP BY promocoes.cod
                ORDER BY promocoes.dataCadastro DESC
                LIMIT 2
        "); 
        return $query->result_array();
    }


    public function descricao_promocoes($id, $regiao) {
        // $query = $this->db->query("SELECT * FROM promocoes WHERE cod = $id and promocoes.regiao = '$regiao'");
        // return $query->result_array();
        $query = $this->db->query(
            "SELECT promocoes.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = promocoes.cod 
                        AND a.referencia = 'promocoes' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM promocoes 
                    WHERE promocoes.regiao = '$regiao' 
                    AND promocoes.mostrar = 1 
                    AND promocoes.cod = '$id'
                GROUP BY promocoes.cod
                ORDER BY promocoes.dataCadastro DESC
                LIMIT 1
        "); 
        return $query->result_array();
    }

    // // tabela promocoes puchadas na home
    // public function promocoes($regiao, $limit = null) {
    //     $query = $this->db->query("SELECT promocoes.*, arquivos.arquivo
    //                                     FROM promocoes 
    //                                 INNER JOIN arquivos 
    //                                     ON promocoes.cod = arquivos.codReferencia 
    //                                     and promocoes.regiao = '$regiao' 
    //                                     GROUP BY promocoes.cod
    //                                     ORDER BY promocoes.dataCadastro DESC"
    //     );
    //     return $query->result_array();
    // }

    

    // public function jornalismo($categoria, $regiao) {
    //     $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt FROM noticias INNER JOIN categorias WHERE categorias.cod = noticias.codCategoria and noticias.destaque = 1 and noticias.mostrar = 1 and categoriaPt = '$categoria'  and noticias.regiao = '$regiao' ORDER BY data desc");
    //     return $query->result_array();
    // }

    
    
    // ================================ PAGINAS DE EVENTOS ====================================
    // |                                                                                      |
    // |                          TODAS AS PAGINAS SOBRE EVENTOS                              |
    // |                                                                                      |
    // ========================================================================================
     

    // eventos da pagina de eventos
    public function eventos($regiao) {
        // $query = $this->db->query("SELECT eventos.*, arquivos.arquivo
        //                             FROM eventos 
        //                             INNER JOIN arquivos 
        //                             ON eventos.cod = arquivos.codReferencia 
        //                             and eventos.regiao = 'bc' 
        //                             GROUP BY eventos.cod
        //                             ORDER BY eventos.dataCadastro"
        // );
        // return $query->result_array();
        $query = $this->db->query(
            "SELECT eventos.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = eventos.cod 
                        AND a.referencia = 'eventos' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM eventos 
                    WHERE eventos.regiao = '$regiao' 
                    AND eventos.mostrar = 1 
                GROUP BY eventos.cod
                ORDER BY eventos.dataCadastro DESC
                LIMIT 4
        "); 
        return $query->result_array();
    }

    // limite de 2 eventos para mostrar na home
    public function eventos_home($regiao) {
        // $query = $this->db->query("SELECT eventos.*, arquivos.arquivo
        //                             FROM eventos 
        //                             INNER JOIN arquivos 
        //                             ON eventos.cod = arquivos.codReferencia 
        //                             and eventos.regiao = 'bc' 
        //                             GROUP BY eventos.cod
        //                             ORDER BY eventos.dataCadastro 
        //                             LIMIT 2"
        // );
        // return $query->result_array();
        $query = $this->db->query(
            "SELECT eventos.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = eventos.cod 
                        AND a.referencia = 'eventos' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM eventos 
                    WHERE eventos.regiao = '$regiao' 
                    AND eventos.mostrar = 1 
                GROUP BY eventos.cod
                ORDER BY eventos.dataCadastro DESC
                LIMIT 2
        "); 
        return $query->result_array();
    }

    public function descricao_eventos($id, $regiao) {
        // $query = $this->db->query("SELECT * FROM eventos WHERE cod = $id and eventos.regiao = '$regiao'");
        // return $query->result_array();

         $query = $this->db->query(
            "SELECT eventos.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = eventos.cod 
                        AND a.referencia = 'eventos' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM eventos 
                    WHERE eventos.regiao = '$regiao' 
                    AND eventos.mostrar = 1 
                    AND eventos.cod = '$id'
                GROUP BY eventos.cod
                ORDER BY eventos.dataCadastro DESC
                LIMIT 1
        "); 
        return $query->result_array();
    }
    

    public function cidade($regiao) {
        if($regiao == 'bc') {
            return 'balneario-camboriu';
        }if($regiao == 'bl') {
            return 'blumenal';
        }if($regiao == 'lg') {
            return 'lages';
        }
    }
    
     // public function GetAll_noticias($categoria, $regiao, $limit = null, $offset = null) {
    //     // $this->db->where('categoria', $categoria);
    //     // $this->db->where('regiao', $regiao);
    //     $this->db->order_by('data', 'desc');
    //     $this->db->select('*');
    //     $this->db->from('noticias');
    //     $this->db->join('categorias', "categorias.cod = noticias.codCategoria and categorias.categoriaPt = '$categoria' and noticias.destaque = 1 and noticias.mostrar = 1 and noticias.regiao = '$regiao'");
    
    //     if($limit)
    //         $this->db->limit($limit,$offset);
    //         $query = $this->db->get();
            
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     } else {
    //         return null;
    //     }
    // }
    
    public function CountAll($tabela){
        return $this->db->count_all($tabela);
    }


    public function videos($regiao)  {
        $query = $this->db->query("SELECT * FROM videos WHERE videos.regiao = '$regiao' and videos.mostrar = 1");
        return $query->result_array();
    }

}