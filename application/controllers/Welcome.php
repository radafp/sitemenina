<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {

        // $nome = $_POST['nome'];
        // $email = $_POST['email'];
        // $telefone = $_POST['telefone'];
        // $assunto = $_POST['assunto'];
        // $mensagem = $_POST['mensagem'];
        // $setor = $_POST['setor'];


        $nome = 'nome';
        $email = 'email';
        $telefone = 'telefone';
        $assunto = 'assunto';
        $mensagem = 'mensagem';
        $setor = 'setor';


//		$this->load->view('welcome_message');
        $this->load->library('email');
        $this->email->from('dionathan_bass@hotmail.com', 'Dionathan');
        $this->email->to('dionathan_bass@hotmail.com');
        $this->email->subject('Assunto do email');
        $this->email->message('<html><head></head><body>
            Nome:       ' . $nome . ' <br />
            E-mail:     ' . $email . ' <br />
            Telefone:   ' . $telefone . ' <br />
            Assunto:    ' . $assunto . ' <br />
            Mensagem:   ' . $mensagem . ' <br />
            Setor:      ' . $setor . ' <br />
            </body></html>');
        if($this->email->send()){
            echo "Email enviado com sucesso para <strong>dionathan_bass@hotmail.com</strong>";
        }else{
            echo $this->email->print_debugger();
        }
        
    }

}
