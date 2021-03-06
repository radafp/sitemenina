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
    public function programacao_home($regiao, $hora_atua, $hora_add, $dia)  {
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
                    AND programacao.programacao = '$dia'
                    AND programacao.mostrar = 1
					AND programacao.inicio >= '$hora_atua' 
                    AND programacao.fim <= '$hora_add' 			
                GROUP BY programacao.cod
                ORDER BY programacao.inicio ASC
                LIMIT 3
        "); 
        return $query->result_array();
    }

    // metodo mostrado na div esquerda 
    // public function programacao_impar($regiao)  {
    //     $query = $this->db->query("SELECT programacao.*, arquivos.arquivo  
    //                                 FROM programacao 
    //                                     INNER JOIN arquivos 
    //                                 WHERE programacao.cod % 2 != 0 
    //                                 and arquivos.codReferencia = programacao.cod 
    //                                 and programacao.regiao = '$regiao'
    //                                 GROUP by programacao.cod"
    //     );
    //     return $query->result_array();
    // }

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
                ORDER BY programacao.inicio ASC
        "); 
        return $query->result_array();
    }


    public function descricao_programacao($cleanTitle, $regiao, $limit = null) {
        $query = $this->db->query("SELECT programacao.*, arquivos.arquivo
                                        FROM programacao
                                    INNER JOIN arquivos 
                                        ON programacao.cod = arquivos.codReferencia 
                                        AND arquivos.referencia = 'programacao'
                                        AND programacao.regiao = '$regiao'
                                        AND programacao.cleanTitle = '$cleanTitle'
                                        GROUP BY programacao.cod
                                        ORDER BY programacao.dataCadastro DESC
                                        LIMIT 1"
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
        $query = $this->db->query("SELECT DISTINCT categorias.categoriaPt, categorias.cleanTitlePt, noticias.codCategoria from categorias inner join noticias WHERE categorias.cod = noticias.codCategoria and noticias.regiao = '$regiao' ORDER BY categorias.cleanTitlePt asc");
        return $query->result_array();
    }

     // tabela noticias
     public function noticias_em_destaque($regiao) {

        $query = $this->db->query(
            "SELECT noticias.*, categorias.categoriaPt, categorias.cor, categorias.corTexto,
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
                ORDER by data DESC, noticias.cod DESC 
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
            "SELECT noticias.*, categorias.categoriaPt, categorias.cleanTitlePt as categoria, categorias.cor, categorias.corTexto,
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
                ORDER by DATA DESC, noticias.cod DESC
                LIMIT 3
        "); 
        return $query->result_array();
    }

    // metodo sendo usado no metodo noticias do home controller
    public function jornalismo_noticias($categoria = null, $regiao, $limit = null) {
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
        if($categoria == 'todas')
        {
            $query = $this->db->query(
                "SELECT noticias.*, categorias.categoriaPt, categorias.cleanTitlePt as categoria, categorias.cor, categorias.corTexto,
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
                        AND noticias.codCategoria != 10
                        AND noticias.mostrar = 1 
                    GROUP BY noticias.cod
                    ORDER by DATA DESC, noticias.cod DESC
                    LIMIT $limit, 15 
            ");
        }
        else{
            $query = $this->db->query(
                "SELECT noticias.*, categorias.categoriaPt, categorias.cleanTitlePt as categoria, categorias.cor, categorias.corTexto,
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
                        AND categoriaPt like '%$categoria%'
                        AND noticias.mostrar = 1 
                    GROUP BY noticias.cod
                    ORDER by DATA DESC, noticias.cod DESC
                    LIMIT $limit, 15
            "); 
        }
  
        
        return $query->result_array();
    }

    public function jornalismo_noticias_busca($busca, $regiao, $limit = null) {
        $query = $this->db->query(
            "SELECT noticias.*, categorias.categoriaPt, categorias.cleanTitlePt as categoria,categorias.cor, categorias.corTexto,
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
                    AND tituloPt like _utf8  '%$busca%'  COLLATE utf8_unicode_ci
                    OR noticias.codCategoria = categorias.cod
                    AND  descricaoPt like '%$busca%'
                    AND noticias.regiao = '$regiao'
                    AND noticias.mostrar = 1
                GROUP BY noticias.cod
                ORDER by DATA DESC, noticias.cod DESC
                LIMIT $limit, 15
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


    // metodo sendo usado na action de descricao da noticia no home controller
    public function descricao_noticia($cleanTitlePt, $regiao) {
        // $query = $this->db->query("SELECT noticias.*, categorias.categoriaPt, arquivos.arquivo 
        //                                 FROM noticias 
        //                             INNER JOIN categorias, arquivos 
        //                                 WHERE arquivos.codReferencia  = noticias.cod 
        //                                 AND noticias.codCategoria = categorias.cod 
        //                                 AND noticias.cod = $id
        //                                 AND categorias.categoriaPt = '$categoria' 
        //                                 AND arquivos.codReferencia = noticias.cod 
        //                                 AND noticias.regiao = '$regiao' 
        //                                 AND noticias.mostrar = 1 
        //                                 LIMIT 1"
        // );
        // if ($query->num_rows() > 0) {
        //     return $query->result_array();
        // } else {
        //     $query1 = $this->db->query(
        //         "SELECT noticias.*, categorias.categoriaPt
        //             FROM noticias 
        //         INNER JOIN categorias
        //             ON noticias.codCategoria = categorias.cod 
        //             AND noticias.cod = $id
        //             AND categorias.categoriaPt = '$categoria' 
        //             AND noticias.regiao = '$regiao' 
        //             AND noticias.mostrar = 1 
        //             LIMIT 1"
        //     );
        //     return $query1->result_array();
        // }
        $query = $this->db->query(
            "SELECT noticias.*, categorias.categoriaPt, categorias.cor, categorias.corTexto,
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
                    AND noticias.cleanTitlePt = '$cleanTitlePt'
                    AND noticias.regiao = '$regiao'
                    AND noticias.mostrar = 1 
                GROUP BY noticias.cod
                ORDER BY cliques desc
                LIMIT 1
        "); 
        return $query->result_array();
    }


    public function mais_lidas($cleanTitlePt, $regiao) {
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
            "SELECT noticias.*, categorias.categoriaPt, categorias.cleanTitlePt as categoria, categorias.cor, categorias.corTexto,
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
                    -- AND categorias.cleanTitlePt= '$cleanTitlePt'
                    AND noticias.regiao = '$regiao'
                    AND noticias.mostrar = 1 
                GROUP BY noticias.cod
                ORDER BY cliques desc
                LIMIT 4
        "); 
        return $query->result_array();
    }

    // metodo almenta lidas += 1 na tabela de noticias ao clicar em alguma noticia
    public function cliques($cleanTitlePt, $regiao) {
        $query = $this->db->query("UPDATE noticias SET cliques = cliques + 1 WHERE cleanTitlePt = '$cleanTitlePt' and noticias.regiao= '$regiao'");
    }
    // ================================ PAGINAS DE ARTISTICO ================================
    // |                                                                                    |
    // |                          TODAS AS PAGINAS SOBRE ARTISTIC                           |
    // |                                                                                    |
    // ======================================================================================

    public function top_10($regiao) {
        $query = $this->db->query(
            "SELECT top10.* from top10 WHERE regiao = '$regiao' AND mostrar = 1 LIMIT 10 
        ");
        return $query->result_array();
    }

    public function videos_home($regiao)  {
        $query = $this->db->query(
            "SELECT * FROM videos 
                WHERE videos.regiao = '$regiao' 
                AND videos.mostrar = 1 
                AND videos.mensagemDoDia = 1
                ORDER BY cod desc
                LIMIT 1");
        return $query->result_array();
    }

    public function videos($regiao, $limit = null)  {
        $query = $this->db->query(
            "SELECT * FROM videos 
                WHERE videos.regiao = '$regiao' 
                AND videos.mostrar = 1
            ORDER BY cod DESC
            LIMIT $limit, 16"
        );
        return $query->result_array();
    }



    // ================================ PAGINAS DE PROMOÇÕES ====================================
    // |                                                                                        |
    // |                          TODAS AS PAGINAS SOBRE PROMOÇÕES                              |
    // |                                                                                        |
    // ==========================================================================================


    // tabela promocoes puxadas na home
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

     // tabela promocoes puxadas na view promocoes
     public function promocoes_promocoes($regiao, $limit = null) {
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
        $date = date('Y-m-d');
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
                    AND promocoes.dataFim >= '$date'
                GROUP BY promocoes.cod
                ORDER BY promocoes.dataCadastro DESC
                LIMIT $limit, 15
        "); 
        return $query->result_array();
    }


    public function descricao_promocoes($cleanTitlePt, $regiao) {
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
                    AND promocoes.cleanTitlePt = '$cleanTitlePt'
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
    public function eventos($regiao, $limit = null) {
        // $query = $this->db->query("SELECT eventos.*, arquivos.arquivo
        //                             FROM eventos 
        //                             INNER JOIN arquivos 
        //                             ON eventos.cod = arquivos.codReferencia 
        //                             and eventos.regiao = 'bc' 
        //                             GROUP BY eventos.cod
        //                             ORDER BY eventos.dataCadastro"
        // );
        // return $query->result_array();
        $date = date('Y-m-d');

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
                    AND eventos.dataFim >= '$date'
                GROUP BY eventos.cod
                ORDER BY eventos.dataInicio ASC 
                LIMIT $limit, 15
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
        $date = date('Y-m-d');
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
                    AND eventos.dataInicio >= '$date'
                GROUP BY eventos.cod
                ORDER BY eventos.dataInicio ASC
                LIMIT 2
        "); 
        return $query->result_array();
    }

    public function descricao_eventos($cleanTitlePt, $regiao) {
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
                    AND eventos.cleanTitlePt = '$cleanTitlePt'
                GROUP BY eventos.cod
                ORDER BY eventos.dataCadastro DESC
                LIMIT 1
        "); 
        return $query->result_array();
    }
    
    // public function count_eventos($regiao) {
    //     // $query = $this->db->query("SELECT eventos.*, arquivos.arquivo
    //     //                             FROM eventos 
    //     //                             INNER JOIN arquivos 
    //     //                             ON eventos.cod = arquivos.codReferencia 
    //     //                             and eventos.regiao = 'bc' 
    //     //                             GROUP BY eventos.cod
    //     //                             ORDER BY eventos.dataCadastro"
    //     // );
    //     // return $query->result_array();
    //     $query = $this->db->query(
    //         "SELECT eventos.*, 
    //             (SELECT a.arquivo 
    //                 FROM arquivos AS a 
    //                     WHERE a.codReferencia = eventos.cod 
    //                     AND a.referencia = 'eventos' 
    //                     AND a.tipo = 2 
    //                 ORDER BY a.capa 
    //                 DESC LIMIT 1) 
    //         AS arquivo 
    //             FROM eventos 
    //                 WHERE eventos.regiao = '$regiao' 
    //                 AND eventos.mostrar = 1 
    //             GROUP BY eventos.cod
    //             ORDER BY eventos.dataCadastro DESC
    //     "); 
    //     return $query->result_array();
    // }

    // ================================ PAGINAS DE ULTILIDADES ================================
    // |                                                                                      |
    // |                          TODAS AS PAGINAS SOBRE ULTILIDADES                          |
    // |                                                                                      |
    // ========================================================================================
     
    public function empregos($regiao, $limit = null) {
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
            "SELECT empregos.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = empregos.cod 
                        AND a.referencia = 'empregos' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM empregos 
                    WHERE empregos.regiao = '$regiao' 
                    AND empregos.mostrar = 1 
                GROUP BY empregos.cod
                ORDER BY empregos.dataPublicacao DESC
                LIMIT $limit, 15
        "); 
        return $query->result_array();
    }

    public function documentos_perdidos($regiao, $limit = null) {
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
            "SELECT achadoseperdidos.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = achadoseperdidos.cod 
                        AND a.referencia = 'achadoseperdidos' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM achadoseperdidos 
                    WHERE achadoseperdidos.regiao = '$regiao' 
                    AND achadoseperdidos.mostrar = 1 
                GROUP BY achadoseperdidos.cod
                ORDER BY achadoseperdidos.dataCadastro DESC
                LIMIT $limit, 15
        "); 
        return $query->result_array();
    }

    public function descricao_equipe_documentos_perdidos($id, $regiao) {
        $query = $this->db->query(
            "SELECT achadoseperdidos.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = achadoseperdidos.cod 
                        AND a.referencia = 'achadoseperdidos' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM achadoseperdidos 
                    WHERE achadoseperdidos.regiao = '$regiao' 
                    AND achadoseperdidos.mostrar = 1 
                    AND achadoseperdidos.cod = '$id'
                GROUP BY achadoseperdidos.cod
                ORDER BY achadoseperdidos.dataCadastro DESC
        "); 
        return $query->result_array();
    }

    // metodo generico para descricao de views
    public function descricao_view($tabela, $id, $regiao) {
        $query = $this->db->query(
            "SELECT $tabela.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = $tabela.cod 
                        AND a.referencia = '$tabela' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM $tabela 
                    WHERE $tabela.regiao = '$regiao' 
                    AND $tabela.mostrar = 1 
                    AND $tabela.cod = '$id'
                GROUP BY $tabela.cod
                ORDER BY $tabela.dataCadastro DESC
        "); 
        return $query->result_array();
    }

    //  public function GetAll_noticias($categoria, $regiao, $limit = null, $offset = null) {
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

    public function CountAll_noticias($regiao, $condição = null, $valor = null){
            if($valor == 'todas') {
                $sql = "SELECT noticias.*,
                        categorias.categoriaPt
                        FROM noticias
                    INNER JOIN categorias
                        ON noticias.codCategoria = categorias.cod
                        AND noticias.regiao = '$regiao' 
                        AND noticias.mostrar = 1";
            }else{
                $sql = "SELECT noticias.*,
                            categorias.categoriaPt
                            FROM noticias
                        INNER JOIN categorias
                            ON noticias.codCategoria = categorias.cod
                            AND noticias.regiao = '$regiao' 
                            AND noticias.mostrar = 1 
                            AND $condição = '$valor'";    
            }
            $query = $this->db->query($sql);
            return $query->result_array();       
    }

    public function CountAll_eventos($regiao, $condição = null, $valor = null){
        $date = date('Y-m-d');
        $sql = "SELECT eventos.*, 
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
                AND eventos.dataFim >= '$date'
            GROUP BY eventos.cod
            ORDER BY eventos.dataInicio ASC";
        
        $query = $this->db->query($sql);
        return $query->result_array();       
    }
   
    
    public function CountAll($tabela, $regiao, $condição = null, $valor = null){
        if(isset($condicao) && $condicao != null) {
            $sql = "SELECT * FROM $tabela WHERE $tabela.regiao = '$regiao' 
                    AND $tabela.mostrar = 1 and $condição = '$valor'"; 
        }else{
            $sql = "SELECT * FROM $tabela WHERE $tabela.regiao = '$regiao' 
            AND $tabela.mostrar = 1";
        }
               
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // metodo usado na pagina inicial
    public function enquetes($regiao) {
        
        $query = $this->db->query(
            "SELECT 
            enquetesPerguntas.cod as cod_perg,
            enquetesRespostas.cod as cod_resp,
            enquetesPerguntas.dataCadastro,
            enquetesPerguntas.pergunta,
            enquetesRespostas.codPergunta,
            enquetesRespostas.resposta
            from enquetesPerguntas
        Inner join enquetesRespostas
            WHERE enquetesRespostas.codPergunta = enquetesPerguntas.cod
            AND enquetesPerguntas.regiao = '$regiao'
            AND enquetesPerguntas.mostrar = 1"
        );
        /*
        AND enquetesPerguntas.dataCadastro = 
            (SELECT MAX(enquetesPerguntas.dataCadastro) 
                 FROM enquetesPerguntas 
             WHERE enquetesPerguntas.dataCadastro <= curdate())
        */
        return $query->result_array();
    }

    public function banners($regiao, $tituloPagina, $codTipo, $limit = null) {
        // if(isset($limit) && $limit != null) {
        //     $sql = "SELECT 
        //                 publicidades.cod,
        //                 publicidades.tituloPagina,
        //                 publicidades.codTipo,
        //                 publicidades.link,
        //                 publicidades.linkTarget,
        //                 publicidades.pixel, 
        //                 (SELECT a.arquivo 
        //                 FROM arquivos AS a 
        //                 WHERE a.codReferencia = publicidades.cod 
        //                 AND a.referencia = 'publicidade' 
        //                 AND a.tipo = 2 
        //                 ORDER BY a.capa 
        //                 DESC LIMIT 1) 
        //                 AS arquivo 
        //             FROM publicidades 
        //             WHERE publicidades.regiao = '$regiao' 
        //                 AND publicidades.mostrar = 1
        //                 AND publicidades.tituloPagina = '$tituloPagina'
        //                 AND publicidades.codTipo = $codTipo
        //                 AND publicidades.dataInicio <= $hoje
        //                 AND publicidades.dataFim >= $hoje
        //             GROUP BY publicidades.cod
        //             LIMIT $limit";
        // }else{
            $hoje = date('Y-m-d');
            $sql = "SELECT 
                        publicidades.cod,
                        publicidades.tituloPagina,
                        publicidades.codTipo,
                        publicidades.link,
                        publicidades.linkTarget,
                        publicidades.pixel, 
                        (SELECT a.arquivo 
                            FROM arquivos AS a 
                            WHERE a.codReferencia = publicidades.cod 
                                AND a.referencia = 'publicidade' 
                                AND a.tipo = 2 
                            ORDER BY a.capa 
                            DESC LIMIT 1) 
                        AS arquivo 
                    FROM publicidades 
                    WHERE publicidades.regiao = '$regiao' 
                        AND publicidades.mostrar = 1
                        AND publicidades.tituloPagina = '$tituloPagina'
                        AND publicidades.codTipo = $codTipo
                        AND publicidades.dataInicio <= '$hoje'    
                        AND publicidades.dataFim >= '$hoje'
                    GROUP BY rand()
                    LIMIT $limit";
        
        $query = $this->db->query($sql); 
        return $query->result_array();
    }

    public function equipe($regiao) {
        $query = $this->db->query(
            "SELECT equipe.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = equipe.cod 
                        AND a.referencia = 'equipe' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM equipe 
                    WHERE equipe.regiao = '$regiao' 
                    AND equipe.mostrar = 1 
                GROUP BY equipe.cod
                ORDER BY equipe.tituloPt ASC
        "); 
        return $query->result_array();
    }

    public function descricao_equipe($id, $regiao) {
        $query = $this->db->query(
            "SELECT equipe.*, 
                (SELECT a.arquivo 
                    FROM arquivos AS a 
                        WHERE a.codReferencia = equipe.cod 
                        AND a.referencia = 'equipe' 
                        AND a.tipo = 2 
                    ORDER BY a.capa 
                    DESC LIMIT 1) 
            AS arquivo 
                FROM equipe 
                    WHERE equipe.regiao = '$regiao' 
                    AND equipe.mostrar = 1 
                    AND equipe.cod = '$id'
                GROUP BY equipe.cod
                ORDER BY equipe.dataCadastro DESC
        "); 
        return $query->result_array();
    }

    // metodo usado para acrescentar numero de visualizações dos banners
    public function update($tabela, $condicao, $valor, $campo, $id) { 
        // $query =$this->db->query("UPDATE $tabela SET $condicao = $valor WHERE cod = $id");
        $query =$this->db->query("UPDATE $tabela set $condicao = $valor  WHERE $campo = $id");
    }

    public function select($tabela, $campo, $condicao, $valor) {
        $query = $this->db->query("SELECT $campo FROM $tabela WHERE $condicao = $valor");
        return $query->result_array();
    }
}