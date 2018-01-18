<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Novomenina_model', 'Novomenina');
        $this->load->helper('url');
        $this->load->library('email');
    }

    public function index() {
        $this->load->view('home');

    }

    public function regiao() {
        $uri = explode('/', isset($_SERVER['REQUEST_URI']) ? preg_replace('/^\//', '', $_SERVER['REQUEST_URI'], 1) : '');
        
        $regiao = isset($uri[0]) && !empty($uri[0]) ? $uri[0] : '';// regiao
        if($regiao == 'balneario-camboriu') {
            $_SESSION['regiao'] =  'bc';
            $_SESSION['city']   = 'balneario-camboriu';
        }if($regiao == 'blumenal') {
            $_SESSION['regiao'] =  'bl';
            $_SESSION['city']   = 'blumenal';
        }if($regiao == 'lages') {
            $_SESSION['regiao'] = 'lg';
            $_SESSION['city']   = 'lages';
        };

        if(empty($_SESSION['regiao'])) {
            if($regiao == 'balneario-camboriu') {
                $_SESSION['regiao'] =  'bc';
                $_SESSION['city']   = 'balneario-camboriu';
            }if($regiao == 'blumenal') {
                $_SESSION['regiao'] =  'bl';
                $_SESSION['city']   = 'blumenal';
            }if($regiao == 'lages') {
                $_SESSION['regiao'] = 'lg';
                $_SESSION['city']   = 'lages';
            };
        }

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
        switch($_SESSION['regiao']){
            case 'bc':
                $_SESSION['slogam'] = "+ DE UM MILHÃO DE AMIGOS";
                $_SESSION['socialFace'] = "https://www.facebook.com/radiomeninabc";
                $_SESSION['socialInsta'] = "https://www.instagram.com/meninafm/";
                $_SESSION['socialYoutube'] = "https://www.youtube.com/channel/UCCuiZ1TmPD2gnl_ASpg99xg";
                break;
            case 'bl': 
                $_SESSION['slogam'] = "A NÚMERO UM DE BLUMENAU E REGIÃO";
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
        $dados['banner_tipo1']          = $this->Novomenina->banners($_SESSION['regiao'], 'regiao', '1');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'regiao', '2');

    
        // SELECT numero de impessoes da publicidade, pegao codigo da publicidade vista por session e altera o numero de vizualizações + 1
        $cod_banner = isset($_SESSION['cod_banner']) ? $_SESSION['cod_banner'] : '';
        if($cod_banner!='')
        {
            $num_impresoes = $this->Novomenina->select('publicidadeImpressoes', 'nImpressoes', 'publicidadeImpressoes.codPublicidade', $_SESSION['cod_banner']);
            foreach($num_impresoes as $info):
                $valor = $info['nImpressoes'] + 1;
                $this->Novomenina->update('publicidadeImpressoes', 'nImpressoes', $valor, 'codPublicidade', $_SESSION['cod_banner']);
            endforeach;
        }

        $dados['viewName'] = 'regiao';
        $this->load->view('Template', $dados);
    }

    public function programacao() {
        // link de progrmacao semanal/sabado/domingo
        $_SESSION['menuAtivoProgramacao'] = addslashes(isset($_GET['programacao']) ? $_GET['programacao'] : 'Semanal');
        
        if(isset($_GET['programacao'])) {
            $_SESSION['menuAtivoProgramacao'] = addslashes(isset($_GET['programacao']) ? $_GET['programacao'] : 'Semanal');
            $programacao = addslashes($_GET['programacao']);
            $dados['programacao_impar'] = $this->Novomenina->programacao_programacao($_SESSION['regiao'], $programacao);
        }else{
            $dados['programacao_impar'] = $this->Novomenina->programacao_programacao($_SESSION['regiao'], 'Semanal');
        }
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'programacao', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'programacao', '2');        
        $dados['viewName'] = 'programacao/programacao';
        $this->load->view('Template', $dados);

    }
    
    public function noticia() {
        $categoria                  = addslashes($_GET['categoria']);
        // --------------------- PAGINAÇÂO --------------------
        //|                                                    |
        //|                                                    |
        //|___________________________________________________ |
        if(isset($_GET['p'])) {
            $pg = $_GET['p'];
        }else{
            $pg = 0;
        }

        $p = ($pg - 1) * 10;
        if($p < 0) {
            $p = 0;
        }
        echo (isset($_POST['busca']))?$_POST['busca']: 'dddd';
        $dados['pHome'] = $p;
        $dados['total_registros']   = 15;
        $dados['jornalismo']        = $this->Novomenina->jornalismo_noticias($categoria, $_SESSION['regiao'], $p);
        $dados['count']             = count($dados['jornalismo']);
        $dados['paginas']           = ceil($dados['count'] / 15); 

        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['mais_lidas']        = $this->Novomenina->mais_lidas($categoria, $_SESSION['regiao']);
        $dados['banner_tipo3']      = $this->Novomenina->banners($_SESSION['regiao'], 'noticia', '3');
        $dados['banner_tipo2']      = $this->Novomenina->banners($_SESSION['regiao'], 'noticia', '2'); 
        $dados['viewName']          = 'jornalismo/noticia';
        $this->load->view('Template', $dados);
        
    }

    public function descricao_noticia() {
        $id = addslashes($_GET['id']);
        $categoria = addslashes($_GET['categoria']);
        $this->Novomenina->cliques($id, $_SESSION['regiao']);
        $dados['descricao_noticia'] = $this->Novomenina->descricao_noticia($id, $_SESSION['regiao']);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['mais_lidas'] = $this->Novomenina->mais_lidas($categoria, $_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_noticia', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_noticia', '2'); 
        $dados['viewName'] = 'jornalismo/descricao_noticia';
        $this->load->view('Template', $dados);
    }

    public function agenda() {
        // $id = $_GET['id'];
        $regiao = addslashes($_SESSION['regiao']);
        
        // --------------------- PAGINAÇÂO --------------------
        //|                                                    |
        //|                                                    |
        //|___________________________________________________ |
        if(isset($_GET['p'])) {
            $pg = $_GET['p'];
        }else{
            $pg = 0;
        }

        $p = ($pg - 1) * 10;
        if($p < 0) {
            $p = 0;
        }
        
        
        $dados['pHome'] = $p;
        $dados['count']             = count($this->Novomenina-> CountAll('eventos', $_SESSION['regiao']));
        $dados['total_registros']   = 10;
        $dados['paginas']           = ceil($dados['count'] / 10);      
        
        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['eventos']           = $this->Novomenina->eventos($regiao, $p);
        $dados['titulo_jornalismo'] = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']      = $this->Novomenina->banners($_SESSION['regiao'], 'eventos', '3');
        $dados['banner_tipo2']      = $this->Novomenina->banners($_SESSION['regiao'], 'eventos', '2'); 
        $dados['viewName']          = 'agenda/agenda';
        $this->load->view('Template', $dados);
    }

    public function top_10() {
        $dados['top_10']   = $this->Novomenina->top_10();
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'top_10', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'top_10', '2'); 
        $dados['viewName'] = 'artistico/top_10';
        $this->load->view('Template', $dados);
    }

    public function videos_home() {
        $regiao = $_SESSION['regiao'];

        // --------------------- PAGINAÇÂO --------------------
        //|                                                    |
        //|                                                    |
        //|___________________________________________________ |
         if(isset($_GET['p'])) {
            $pg = $_GET['p'];
        }else{
            $pg = 0;
        }

        $p = ($pg - 1) * 10;
        if($p < 0) {
            $p = 0;
        }
                
        $dados['pHome'] = $p;
        $dados['total_registros']   = 10;
        $dados['videos_videos']     = $this->Novomenina-> videos($regiao, $p);
        $dados['count']             = count($this->Novomenina-> CountAll('videos', $_SESSION['regiao']));
        $dados['paginas']           = ceil($dados['count'] / 10); 

        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['videos']                = $this->Novomenina-> videos_home($regiao);
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'videos_home', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'videos_home', '2'); 
        $dados['viewName'] = 'artistico/videos_home';
        $this->load->view('Template', $dados);
    }

    

    public function descricao_eventos() {
        $id = addslashes($_GET['id']);
        $regiao = $_SESSION['regiao'];
        $dados['descricao_eventos'] = $this->Novomenina->descricao_eventos($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_eventos', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_eventos', '2'); 
        $dados['viewName'] = 'eventos/descricao_eventos';
        $this->load->view('Template', $dados);
    }

    public function promocoes() {
        // --------------------- PAGINAÇÂO --------------------
        //|                                                    |
        //|                                                    |
        //|___________________________________________________ |
        if(isset($_GET['p'])) {
            $pg = $_GET['p'];
        }else{
            $pg = 0;
        }

        $p = ($pg - 1) * 10;
        if($p < 0) {
            $p = 0;
        }
                
        $dados['pHome'] = $p;
        $dados['total_registros']       = 10;
        $dados['promocoes_promocoes']   = $this->Novomenina->promocoes_promocoes($_SESSION['regiao'], $p);
        $dados['count']                 = count($this->Novomenina-> CountAll('promocoes', $_SESSION['regiao']));
        $dados['paginas']               = ceil($dados['count'] / 10); 
        
        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'promocoes', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'promocoes', '2'); 
        $dados['viewName'] = 'promocoes/promocoes';
        $this->load->view('Template', $dados);
    }

    public function descricao_promocoes() {
        $id = addslashes($_GET['id']);
        $regiao = $_SESSION['regiao'];
        $dados['descricao_promocoes'] = $this->Novomenina->descricao_promocoes($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_promocoes', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_promocoes', '2'); 
        $dados['viewName'] = 'promocoes/descricao_promocoes';
        $this->load->view('Template', $dados);
    }

    public function descricao_programacao() {
        $id = addslashes($_GET['id']);
        $regiao = $_SESSION['regiao'];
        $dados['descricao_programacao'] = $this->Novomenina->descricao_programacao($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_programacao', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_programacao', '2'); 
        $dados['viewName'] = 'programacao/descricao_programacao';
        $this->load->view('Template', $dados);
    }

    public function descricao_utilidade() {
        $id = addslashes($_GET['id']);
        $regiao = $_GET['regiao'];
        $dados['descricao_promocoes'] = $this->Novomenina->descricao_promocoes($id, $regiao);
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['cidade']            = $this->Novomenina->cidade($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_utilidade', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'descricao_utilidade', '2'); 
        $dados['viewName'] = 'promocoes/descricao_promocoes';
        $this->load->view('Template', $dados);
    }

    public function bolsa_de_empregos() {
        // --------------------- PAGINAÇÂO --------------------
        //|                                                    |
        //|                                                    |
        //|___________________________________________________ |
        if(isset($_GET['p'])) {
            $pg = $_GET['p'];
        }else{
            $pg = 0;
        }

        $p = ($pg - 1) * 10;
        if($p < 0) {
            $p = 0;
        }
                
        $dados['pHome'] = $p;
        $dados['total_registros']       = 10;
        $dados['empregos']              = $this->Novomenina->empregos($_SESSION['regiao'], $p);
        $dados['count']                 = count($this->Novomenina-> CountAll('empregos', $_SESSION['regiao']));
        $dados['paginas']               = ceil($dados['count'] / 10); 
        
        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'bolsa_de_empregos', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'bolsa_de_empregos', '2');

        $dados['viewName']          = 'utilidade_publica/bolsa_de_empregos';
        $this->load->view('Template', $dados);
    }

    public function documentos_perdidos() {
        // --------------------- PAGINAÇÂO --------------------
        //|                                                    |
        //|                                                    |
        //|___________________________________________________ |
        if(isset($_GET['p'])) {
            $pg = $_GET['p'];
        }else{
            $pg = 0;
        }

        $p = ($pg - 1) * 10;
        if($p < 0) {
            $p = 0;
        }
                
        $dados['pHome'] = $p;
        $dados['total_registros']       = 10;
        $dados['documentos_perdidos']   = $this->Novomenina->documentos_perdidos($_SESSION['regiao'], $p);
        $dados['count']                 = count($this->Novomenina-> CountAll('empregos', $_SESSION['regiao']));
        $dados['paginas']               = ceil($dados['count'] / 10); 
        

        // --------------------- METODOS DO MODEL ------------------
        //|                                                         |
        //|                                                         |
        //|_________________________________________________________|
        $dados['titulo_jornalismo']     = $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '2'); 
        $dados['viewName']              = 'utilidade_publica/documentos_perdidos';
        $this->load->view('Template', $dados);
    }   

    public function historia() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'quem_somos/historia';
        $this->load->view('Template', $dados);
    }

    public function equipe() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['viewName'] = 'quem_somos/equipe';
        $this->load->view('Template', $dados);
    }

    public function midia() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['banner_tipo3']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '3');
        $dados['banner_tipo2']          = $this->Novomenina->banners($_SESSION['regiao'], 'documentos_perdidos', '2'); 
        $dados['viewName'] = 'quem_somos/midia';
        $this->load->view('Template', $dados);
    }

    public function contato() {
        $dados['titulo_jornalismo']= $this->Novomenina->titulo_jornalismo($_SESSION['regiao']);
        $dados['action'] = site_url('home/enviaEmail');
        // $this->load->library('email');

        // $this->email->set_newline("\r\n");
    
        // $config['protocol'] = 'smtp';
        // $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        // $config['smtp_port'] = '465';
        // $config['smtp_user'] = 'defaltern@gmail.com';
        // $config['smtp_from_name'] = 'FROM NAME';
        // $config['smtp_pass'] = 'fodassegmail';
        // $config['wordwrap'] = TRUE;
        // $config['newline'] = "\r\n";
        // $config['mailtype'] = 'html';                       
    
        // $this->email->initialize($config);
    
        // $this->email->from($config['smtp_user'], $config['smtp_from_name']);
        // $this->email->to('defaltern@gmail.com');
        // $this->email->cc('dionathan_bass@hotmail.com');
        // $this->email->subject('teste');
    
        // $this->email->message('message');
    
        // $em = $this->email->send();
        // if ($em) {
        //     $dados['email_enviado'] = 'E-mail enviado com sucesso. Aguarde contato.';
        // } else {
        //     // $dados['email_enviado'] = 'Erro ao enviar o email. Favor enviar um e-mail para xxx@xxx.com.br';
        //     $dados['email_enviado'] = $this->email->print_debugger();
        // }
            
        $dados['viewName'] = 'contato';
        $this->load->view('Template', $dados);
    }

    public function enviaEmail() {
        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $email = $this->input->post('email', TRUE);
        $nome = $this->input->post('nome', TRUE);
        $telefone = $this->input->post('telefone', TRUE);
        $cidade = $this->input->post('cidade', TRUE);
        $estado = $this->input->post('estado', TRUE);
        $mensagem = $this->input->post('mensagem', TRUE);
        $assunto = $this->input->post('assunto', TRUE);

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.agenciaset.com.br';
        $config['smtp_port'] = '587';
        $config['charset'] = 'utf8';
        $config['smtp_user'] = 'webmaster@agenciaset.com.br';
        $config['smtp_from_name'] = 'Radio Menina';
        $config['smtp_pass'] = 'agEncia445';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; 

        $this->email->initialize($config);

        $this->email->from($email, $nome);
        $this->email->to('atendimentoset@gmail.com');
        //$this->email->cc('dionathan_bass@hotmail.com');

        $this->email->subject($assunto);
        $this->email->message('<html><head></head><body>
            Nome:       ' . $nome . ' <br />
            E-mail:     ' . $email . ' <br />
            Telefone:   ' . $telefone . ' <br />
            Cidade:     ' . $cidade . ' <br />
            Estado:     ' . $estado . ' <br />
            Assunto:    ' . $assunto . ' <br />
            Mensagem:   ' . $mensagem . ' <br />
            </body></html>');

        $em = $this->email->send();
        if ($em) {
            $dados['email_enviado'] = 'E-mail enviado com sucesso. Aguarde contato.';
        } else {
            $dados['email_enviado'] = 'Erro ao enviar o email. Favor enviar um e-mail para xxx@xxx.com.br';
        }
        $dados['action'] = site_url('contato/enviaEmail');

        $dados['viewName'] = 'contato';
        $this->load->view('Template', $dados);
    }
 }