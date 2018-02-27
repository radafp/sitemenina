<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Novomenina_model', 'Novomenina');
        $this->load->helper('url');
        // $this->load->library('sendmail');


        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $_SESSION['slogam'] = "";
        $_SESSION['socialFace'] = "";
        $_SESSION['socialInsta'] = "";
        $_SESSION['socialYoutube'] = "";

        if($uri[0] == 'balneario-camboriu') {
            $_SESSION['regiao'] = 'bc';
            $_SESSION['city'] = 'balneario-camboriu';
            $_SESSION['slogam'] = "+ DE UM MILHÃO DE AMIGOS";
            $_SESSION['socialFace'] = "https://www.facebook.com/radiomeninabc";
            $_SESSION['socialInsta'] = "https://www.instagram.com/meninafm/";
            $_SESSION['socialYoutube'] = "https://www.youtube.com/channel/UCCuiZ1TmPD2gnl_ASpg99xg";
        }elseif($uri[0] == 'blumenau') {
            $_SESSION['regiao'] = 'bl';
            $_SESSION['city'] = 'blumenau';
            $_SESSION['slogam'] = "A NÚMERO UM DE BLUMENAU E REGIÃO";
            $_SESSION['socialFace'] = "https://www.facebook.com/radiomeninablu";
            $_SESSION['socialInsta'] = "https://www.instagram.com/meninafmblu/";
            $_SESSION['socialYoutube'] = "https://www.youtube.com/channel/UCCuiZ1TmPD2gnl_ASpg99xg";
        }elseif($uri[0] == 'lages') {
            $_SESSION['regiao'] = 'lg';
            $_SESSION['city'] = 'lages';
            $_SESSION['slogam'] = "A PRIMEIRA DA FM";
            $_SESSION['socialFace'] = "https://www.facebook.com/meninafmlages";
            $_SESSION['socialInsta'] = "https://www.instagram.com/meninafmlages/";
            $_SESSION['socialYoutube'] = "https://www.youtube.com/channel/UCCuiZ1TmPD2gnl_ASpg99xg";
        }
    }

    public function index() {
        $this->load->view('home');

        

    }

    public function regiao() {

        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        
        $regiao = isset($uri[0]) && !empty($uri[0]) ? $uri[0] : '';// regiao
       
        $data = date('d');
        
        $dia =  substr("$data", 8, 9);
        $diasemana = date("w", mktime(0,$dia) );
            
        switch($diasemana) {		
            case"0": $diasemana = "Domingo";
                break;		
            case"1": $diasemana = "Semanal"; 
                break;
            case"2": $diasemana = "Semanal";
                break;		
            case"3": $diasemana = "Semanal";  
                break;		
            case"4": $diasemana = "Semanal";  
                break;		
            case"5": $diasemana = "Semanal";   
                break;		
            case"6": $diasemana = "Sabado";
                break;	
        }

        $codigoSecao = addslashes(isset($uri[1]) && !empty($uri[1]) ? $uri[1] : ''); //menu
        $codigoConteudo = addslashes(isset($uri[2]) && !empty($uri[2]) ? $uri[2] : ''); //codigo

        $dados['cidade'] = $_SESSION['city'];
      

        $hora = date('H');
        $hora_atual = $hora.':00:00';
        
        $hora_num = date('H')+12;
        $hora_add = $hora_num.':00:00';

        $dados['noticias_em_destaque']  = $this->Novomenina->noticias_em_destaque($_SESSION['regiao']);
        $dados['ultimas_noticias']      = $this->Novomenina->ultimas_noticias($_SESSION['regiao']);
        $dados['programacao_home']      = $this->Novomenina->programacao_home($_SESSION['regiao'], $hora_atual, $hora_add, $diasemana);
        $dados['eventos_home']          = $this->Novomenina->eventos_home($_SESSION['regiao']);
        $dados['videos_home']           = $this->Novomenina->videos_home($_SESSION['regiao']);
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['promocoes_home']        = $this->Novomenina->promocoes_home($_SESSION['regiao']);
        $dados['enquetes']              = $this->Novomenina->enquetes($_SESSION['regiao']); 
        $dados['banner_tipo1']          = $this->Novomenina->banners($_SESSION['regiao'], 'regiao', '1', 1);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'regiao', '2', 2);

    
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner1 = isset($_SESSION['cod_banner_tipo1']) ? $_SESSION['cod_banner_tipo1'] : '';
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

        if($cod_banner1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner1);
            endforeach;
        }

        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }



        $dados['viewName'] = 'regiao';
        $this->load->view('Template', $dados);
    }

    public function programacao() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');
        // link de progrmacao semanal/sabado/domingo
        $_SESSION['menuAtivoProgramacao'] = addslashes(isset($uri[2]) ? $uri[2] : 'Semanal');

        
        if(isset($uri[2])) {
            $programacao = $uri[2];
            $_SESSION['menuAtivoProgramacao'] = (isset($uri[2]) ? $uri[2] : 'Semanal');
            $dados['programacao_impar'] = $this->Novomenina->programacao_programacao($_SESSION['regiao'], $programacao);
        }else{
            $dados['programacao_impar'] = $this->Novomenina->programacao_programacao($_SESSION['regiao'], 'Semanal');
        }
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'programacao', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'programacao', '2' , 2);        

        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
         // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
         
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;
        // echo '<br>cod_banner3_1: '.$cod_banner3_1;
        // echo '<br>cod_banner3_2: '.$cod_banner3_2;
        // echo '<br>cod_banner3_3: '.$cod_banner3_3;
        // echo '<br>cod_banner3_4: '.$cod_banner3_4;
 
        if($cod_banner2_1 != '') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }

        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }

        $dados['viewName'] = 'programacao/programacao';
        $this->load->view('Template', $dados);

    }

    public function descricao_programacao() {
        unset($_SESSION['cod_banner_tipo2_1']);
        unset($_SESSION['cod_banner_tipo2_2']);
        unset($_SESSION['cod_banner_tipo1']);

        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');


        $cleanTitle = $uri[2];
        $regiao = $_SESSION['regiao'];
        $dados['descricao_programacao'] = $this->Novomenina->descricao_programacao($cleanTitle, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'programacao', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'programacao', '2' , 2);        

        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'programacao/descricao_programacao';
        $this->load->view('Template', $dados);
    }
    
    public function noticia() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        // setando a session para nao retornar para o HOME quando for mandado o link direto
        // if($uri[0] == 'balneario-camboriu') {
        //     $_SESSION['regiao'] = 'bc';
        //     $_SESSION['city'] = 'balneario-camboriu';
        // }elseif($uri[0] == 'blumenau') {
        //     $_SESSION['regiao'] = 'bl';
        //     $_SESSION['city'] = 'blumenau';
        // }elseif($uri[0] == 'lages') {
        //     $_SESSION['regiao'] = 'lg';
        //     $_SESSION['city'] = 'lages';
        // }

        // $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'todas';
        $categoria = $uri[2];
        $dados['cat'] = $categoria;

        $pagina = $uri[3];
        $dados['pagina'] = $pagina;
        //echo $categoria;
        
        // --------------------- PAGINAÇÂO --------------------
        if(isset($uri[3])) {
            $pg = $uri[3];
        }else{
            $pg = 0;
        }

        $pagina= ($pg - 1) * 15;
        if( $pagina < 0) {
            $pagina = 0;
        }

        $dados['retorno_noticias'] = '';
        if($uri[1] == 'busca-noticias') {

            $busca = urldecode($uri[2]);
            
            $dados['pHome'] =  $pagina;
            $dados['total_registros']   = 15;
            $dados['jornalismo']        = $this->Novomenina->jornalismo_noticias_busca($busca, $_SESSION['regiao'],  $pagina);
            $dados['count']             = count($dados['jornalismo']);
            $dados['paginas']           = ceil($dados['count'] / 15);

            if(count($dados['jornalismo']) ==  0) {
                $dados['retorno_noticias'] = "Nenhuma ocorrência encontrada para a palavra $busca!";
            }

        }else{

            
            $dados['pHome'] =  $pagina;
            $dados['total_registros']   = 15;
            
            $dados['categoria'] = $categoria;
            $dados['jornalismo']        = $this->Novomenina->jornalismo_noticias($categoria, $_SESSION['regiao'],  $pagina);
            $dados['count_noticias']    = $this->Novomenina->CountAll_noticias($_SESSION['regiao'], 'categoriaPt', $categoria);
            $dados['count']             = count($dados['count_noticias']);
            $dados['paginas']           = ceil($dados['count'] / 15); 
        }


        
        
        // --------------------- METODOS DO MODEL ------------------
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['mais_lidas']        = $this->Novomenina->mais_lidas($categoria, $_SESSION['regiao']);

        $dados['banner_tipo3']      = $this->Novomenina->banners($_SESSION['regiao'], 'noticias', '3', 4);
        $dados['banner_tipo2']      = $this->Novomenina->banners($_SESSION['regiao'], 'noticias', '2', 2); 
           
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
            endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        } 
        
        $dados['viewName']  = 'jornalismo/noticia';
        $this->load->view('Template', $dados);
        
    }

    public function descricao_noticia() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');
        unset($_SESSION['cod_banner_tipo2_1']);
        unset($_SESSION['cod_banner_tipo2_2']);
        unset($_SESSION['cod_banner_tipo1']);


        // $id = addslashes($_GET['id']);
        // $categoria = addslashes($_GET['categoria']);

        $cleanTitlePt = $uri[3];

        // echo $cleanTitlePt;
        $categoria = $uri[2];
        $this->Novomenina->cliques($cleanTitlePt, $_SESSION['regiao']);
        $dados['descricao_noticia']     = $this->Novomenina->descricao_noticia($cleanTitlePt, $_SESSION['regiao']);
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['mais_lidas']            = $this->Novomenina->mais_lidas($categoria, $_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'noticias', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'noticias', '2', 2); 
           
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }

        $dados['viewName'] = 'jornalismo/descricao_noticia';
        $this->load->view('Template', $dados);
    }

    public function top_10() {

        $regiao = isset($_SESSION['regiao']) ? $_SESSION['regiao'] : '';

        $dados['top_10']   = $this->Novomenina->top_10($regiao);
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'top_10', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'top_10', '2', 2); 
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'artistico/top_10';
        $this->load->view('Template', $dados);
    }

    public function videos_home() {
        $regiao = $_SESSION['regiao'];
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        
        // --------------------- PAGINAÇÂO --------------------
        //|                                                    |
        //|                                                    |
        //|___________________________________________________ |

        $pagina = $uri[2];
        $dados['pagina'] = $pagina;
        if(isset($uri[2])) {
            $pg = $uri[2];
        }else{
            $pg = 0;
        }

        $pagina= ($pg - 1) * 15;
        if( $pagina < 0) {
            $pagina = 0;
        }
                
        $dados['pHome'] = $pagina;
        $dados['total_registros']   = 16;
        $dados['videos_videos']     = $this->Novomenina-> videos($regiao, $pagina);
        $dados['count']             = count($this->Novomenina-> CountAll('videos', $_SESSION['regiao']));
        $dados['paginas']           = ceil($dados['count'] / 16); 

        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['videos']                = $this->Novomenina-> videos_home($regiao);
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'videos_home', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'videos_home', '2', 2); 
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        
        $dados['viewName'] = 'artistico/videos_home';
        $this->load->view('Template', $dados);
    }

    public function promocoes() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $categoria = $uri[2];
        $dados['cat'] = $categoria;

        $pagina = $uri[2];
        $dados['pagina'] = $pagina;
        
        // --------------------- PAGINAÇÂO --------------------
        if(isset($uri[2])) {
            $pg = $uri[2];
        }else{
            $pg = 0;
        }

        $pagina= ($pg - 1) * 15;
        if( $pagina < 0) {
            $pagina = 0;
        }
                
        $dados['pHome'] = $pagina;
        $dados['total_registros']       = 15;
        $dados['promocoes_promocoes']   = $this->Novomenina->promocoes_promocoes($_SESSION['regiao'], $pagina);
        $dados['count']                 = count($this->Novomenina-> CountAll('promocoes', $_SESSION['regiao']));
        $dados['paginas']               = ceil($dados['count'] / 15); 
        
        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'promocoes', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'promocoes', '2', 2); 
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'promocoes/promocoes';
        $this->load->view('Template', $dados);
    }

    public function descricao_promocoes() {

        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $cleanTitle = $uri[2];
        $regiao = $_SESSION['regiao'];
        $dados['descricao_promocoes']   = $this->Novomenina->descricao_promocoes($cleanTitle, $regiao);
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'promocoes', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'promocoes', '2', 2); 
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'promocoes/descricao_promocoes';
        $this->load->view('Template', $dados);
    }

    public function agenda() {
        // unset($_SESSION['cod_banner_tipo2_1']);
        // unset($_SESSION['cod_banner_tipo2_2']);
        // unset($_SESSION['cod_banner_tipo1']);
        // $id = $_GET['id'];

        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $pagina = $uri[2];
        $regiao = addslashes($_SESSION['regiao']);
        
       // --------------------- PAGINAÇÂO --------------------
        if(isset($uri[2])) {
            $pg = $uri[2];
        }else{
            $pg = 0;
        }

        $pagina= ($pg - 1) * 15;
        if( $pagina < 0) {
            $pagina = 0;
        }
        
        $dados['pHome'] = $pagina;
        $dados['count']             = count($this->Novomenina->CountAll_eventos($regiao));
        $dados['total_registros']   = 15;
        $dados['paginas']           = ceil($dados['count'] / 15);      
        
        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['eventos']           = $this->Novomenina->eventos($regiao, $pagina);
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']      = $this->Novomenina->banners($_SESSION['regiao'], 'eventos', '3', 4);
        $dados['banner_tipo2']      = $this->Novomenina->banners($_SESSION['regiao'], 'eventos', '2', 2); 
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName']          = 'agenda/agenda';
        $this->load->view('Template', $dados);
    }

    public function descricao_agenda() {

        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $cleanTitle = $uri[2];
        $regiao = $_SESSION['regiao'];
        $dados['descricao_eventos']     = $this->Novomenina->descricao_eventos($cleanTitle, $regiao);
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'eventos', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'eventos', '2', 2); 
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'agenda/descricao_agenda';
        $this->load->view('Template', $dados);
    }

    

    // public function descricao_utilidade() {
        
    //     $id = addslashes($_GET['id']);
    //     $regiao = $_GET['regiao'];
    //     $dados['descricao_promocoes'] = $this->Novomenina->descricao_promocoes($id, $regiao);
    //     $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
    //     $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
    //     $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_utilidade', '3', 4);
    //     $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_utilidade', '2', 2); 
        
    //     // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
    //     $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
    //     $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

    //     $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
    //     $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
    //     $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
    //     $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
    //     // echo '<br>cod_banner2_1: '.$cod_banner2_1;
    //     // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
    //     if($cod_banner2_1!='') {
    //         $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
    //         foreach($num_impresoes as $info):
    //             $valor = $info['nImpressoes'] + 1;
    //             $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
    //         endforeach;
    //     }

    //     if($cod_banner2_2!='') {
    //         $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
    //         foreach($num_impresoes as $info):
    //             $valor = $info['nImpressoes'] + 1;
    //             $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
    //         endforeach;
    //     }


    //     if($cod_banner3_1!='') {
    //     $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
    //     foreach($num_impresoes as $info):
    //         $valor = $info['nImpressoes'] + 1;
    //         $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
    //     endforeach;
    //     }
    //     if($cod_banner3_2!='') {
    //         $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
    //         foreach($num_impresoes as $info):
    //             $valor = $info['nImpressoes'] + 1;
    //             $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
    //         endforeach;
    //     }
    //     if($cod_banner3_3!='') {
    //         $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
    //         foreach($num_impresoes as $info):
    //             $valor = $info['nImpressoes'] + 1;
    //             $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
    //         endforeach;
    //     }
    //     if($cod_banner3_4!='') {
    //         $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
    //         foreach($num_impresoes as $info):
    //             $valor = $info['nImpressoes'] + 1;
    //             $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
    //         endforeach;
    //     }
        
    //     $dados['viewName'] = 'promocoes/descricao_promocoes';
    //     $this->load->view('Template', $dados);
    // }

    public function bolsa_de_empregos() {

        // unset($_SESSION['cod_banner_tipo2_1']);
        // unset($_SESSION['cod_banner_tipo2_2']);
        // unset($_SESSION['cod_banner_tipo1']);
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $pagina = $uri[2];
        $regiao = addslashes($_SESSION['regiao']);
        
       // --------------------- PAGINAÇÂO --------------------
        if(isset($uri[2])) {
            $pg = $uri[2];
        }else{
            $pg = 0;
        }

        $pagina= ($pg - 1) * 15;
        if( $pagina < 0) {
            $pagina = 0;
        }
        
        $dados['pHome'] = $pagina;
        $dados['total_registros']       = 15;
        $dados['empregos']              = $this->Novomenina->empregos($_SESSION['regiao'], $pagina);
        $dados['count']                 = count($this->Novomenina-> CountAll('empregos', $_SESSION['regiao']));
        $dados['paginas']               = ceil($dados['count'] / 15); 
        
        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'bolsa_de_empregos', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'bolsa_de_empregos', '2', 2);


        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
 
        $dados['viewName']          = 'utilidade_publica/bolsa_de_empregos';
        $this->load->view('Template', $dados);
    }

    public function descricao_bolsa_de_empregos() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $id = $uri[2];
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['descricao_empregos']    = $this->Novomenina->descricao_view('empregos', $id, $_SESSION['regiao']);

        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'bolsa_de_empregos', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'bolsa_de_empregos', '2', 2);

        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner = isset($_SESSION['cod_banner']) ? $_SESSION['cod_banner'] : '';

        // echo $cod_banner;
        if($cod_banner!='')
        {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner);
            endforeach;
        }

        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'utilidade_publica/descricao_bolsa_de_empregos';
        $this->load->view('Template', $dados);
    }

    public function documentos_perdidos() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $pagina = $uri[2];
        $regiao = addslashes($_SESSION['regiao']);
        
       // --------------------- PAGINAÇÂO --------------------
        if(isset($uri[2])) {
            $pg = $uri[2];
        }else{
            $pg = 0;
        }

        $pagina= ($pg - 1) * 15;
        if( $pagina < 0) {
            $pagina = 0;
        }
        
        $dados['pHome'] = $pagina;
        $dados['total_registros']       = 15;
        $dados['documentos_perdidos']   = $this->Novomenina->documentos_perdidos($_SESSION['regiao'], $pagina);
        $dados['count']                 = count($this->Novomenina-> CountAll('empregos', $_SESSION['regiao']));
        $dados['paginas']               = ceil($dados['count'] / 15); 
        

        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '2', 2); 
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName']              = 'utilidade_publica/documentos_perdidos';
        $this->load->view('Template', $dados);
    }

    public function descricao_documentos_perdidos() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $id = $uri[2];
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['descricao_documento']   = $this->Novomenina->descricao_equipe_documentos_perdidos($id, $_SESSION['regiao']);

        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '2', 2); 
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner = isset($_SESSION['cod_banner']) ? $_SESSION['cod_banner'] : '';

        // echo $cod_banner;
        if($cod_banner!='')
        {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner);
            endforeach;
        }

        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'utilidade_publica/descricao_documentos_perdidos';
        $this->load->view('Template', $dados);
    }


    public function historia() {
        unset($_SESSION['cod_banner_tipo2_1']);
        unset($_SESSION['cod_banner_tipo2_2']);
        unset($_SESSION['cod_banner_tipo1']);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'quem_somos/historia';
        $this->load->view('Template', $dados);
    }

    public function equipe() {
        unset($_SESSION['cod_banner_tipo2_1']);
        unset($_SESSION['cod_banner_tipo2_2']);
        unset($_SESSION['cod_banner_tipo1']);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['equipe'] = $this->Novomenina->equipe($_SESSION['regiao']);

        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'equipe', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'equipe', '2', 2); 
        
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'quem_somos/equipe';
        $this->load->view('Template', $dados);
    }

    public function descricao_equipe() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');

        $id = $uri[2];
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['descricao_programacao'] = $this->Novomenina->descricao_equipe($id, $_SESSION['regiao']);

        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'equipe', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'equipe', '2', 2); 
        
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'quem_somos/descricao_equipe';
        $this->load->view('Template', $dados);
    }


    public function midia() {
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '3', 4);
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '2', 2); 
        
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner2_1 = isset($_SESSION['cod_banner_tipo2_1']) ? $_SESSION['cod_banner_tipo2_1'] : '';
        $cod_banner2_2 = isset($_SESSION['cod_banner_tipo2_2']) ? $_SESSION['cod_banner_tipo2_2'] : '';

        $cod_banner3_1 = isset($_SESSION['cod_banner_tipo3_1']) ? $_SESSION['cod_banner_tipo3_1'] : '';
        $cod_banner3_2 = isset($_SESSION['cod_banner_tipo3_2']) ? $_SESSION['cod_banner_tipo3_2'] : '';
        $cod_banner3_3 = isset($_SESSION['cod_banner_tipo3_3']) ? $_SESSION['cod_banner_tipo3_3'] : '';
        $cod_banner3_4 = isset($_SESSION['cod_banner_tipo3_4']) ? $_SESSION['cod_banner_tipo3_4'] : '';
        // echo '<br>cod_banner2_1: '.$cod_banner2_1;
        // echo '<br>cod_banner2_2: '.$cod_banner2_2;

 
        if($cod_banner2_1!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_1);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_1);
            endforeach;
        }

        if($cod_banner2_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner2_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner2_2);
            endforeach;
        }


        if($cod_banner3_1!='') {
        $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_1);
        foreach($num_impresoes as $info):
            $valor = $info['nImpressoes'] + 1;
            $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_1);
        endforeach;
        }
        if($cod_banner3_2!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_2);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_2);
            endforeach;
        }
        if($cod_banner3_3!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_3);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_3);
            endforeach;
        }
        if($cod_banner3_4!='') {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $cod_banner3_4);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $cod_banner3_4);
            endforeach;
        }
        
        $dados['viewName'] = 'quem_somos/midia';
        $this->load->view('Template', $dados);
    }

    public function contato() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['action'] = site_url('home/enviaEmail');
                    
        $dados['viewName'] = 'contato';
        $this->load->view('Template', $dados);
    }

    public function enviaEmail() {
        $this->load->library('Sendmail');
        $dados['email_enviado'] = $_SESSION['enviado'];
    
        $dados['viewName'] = 'contato';
        $this->load->view('Template', $dados);



        // $this->load->library('email');
        // $this->email->set_newline("\r\n");

        
        // $nome           = $this->input->post('nome', TRUE);
        // $emailContato   = $this->input->post('emailContato', TRUE);
        // $telefone       = $this->input->post('telefone', TRUE);
        // $mensagem       = $this->input->post('mensagem', TRUE);
        // $setor          = $this->input->post('setor', TRUE);
        // $assunto        = 'assunto';
        
        // $config['protocol'] = 'smtp';
        // $config['smtp_host'] = 'smtp.agenciaset.com.br';
        // $config['smtp_port'] = '587';
        // $config['charset'] = 'utf8';
        // $config['smtp_user'] = 'webmaster@agenciaset.com.br';
        // $config['smtp_from_name'] = 'Radio Menina';
        // $config['smtp_pass'] = 'agEncia445';
        // $config['wordwrap'] = TRUE;
        // $config['newline'] = "\r\n";
        // $config['mailtype'] = 'html'; 

        // $this->email->initialize($config);

        // $this->email->from($emailContato, $nome);
        // $this->email->to('atendimentoset@gmail.com');
        // $this->email->cc('dionathan_bass@hotmail.com');

        // $this->email->subject($assunto);
        // $this->email->message('<html><head></head><body>
        //     Nome:       ' . $nome . ' <br />
        //     E-mail:     ' . $emailContato . ' <br />
        //     Telefone:   ' . $telefone . ' <br />
        //     Assunto:    ' . $assunto . ' <br />
        //     Mensagem:   ' . $mensagem . ' <br />
        //     Setor:      ' . $setor . ' <br />
        //     </body></html>');

        // $em = $this->email->send();
        // if ($em) {
        //     $dados['email_enviado'] = 'E-mail enviado com sucesso. Aguarde contato.';
        // } else {
        //     $dados['email_enviado'] = 'Erro ao enviar o email. Favor enviar um e-mail para xxx@xxx.com.br';
        // }
        // $dados['action'] = site_url('home/enviaEmail');

        // $dados['viewName'] = 'contato';
        // $this->load->view('Template', $dados);
    }
}