<?php
/*
* Formulário de contato do website
*
* @author William Rufino
* @version 1.0
* @category model
* @access public
*/
class Contato extends Controller {

    /*
    * Construtor da classe
    * @author William Rufino
    * @version 1.0
    */
    public function __construct() {
        parent::Controller();
    }

    /*
    * Método Index, página inicial do formulário de contato
    *
    * @author William Rufino
    * @version 1.0
    * @access public
    */
    public function index() {
        $data['action'] = site_url('contato/enviaEmail');
        $this->load->view('contato', $data);
    }

    /*
    * Método enviaEmail, onde será realmente enviado nosso formulário.
    *
    * @author William Rufino
    * @version 1.0
    * @access public
    */
    public function enviaEmail() {
        $this->load->library('email');

        $email = $this->input->post('email', TRUE);
        $nome = $this->input->post('nome', TRUE);
        $telefone = $this->input->post('telefone', TRUE);
        $cidade = $this->input->post('cidade', TRUE);
        $estado = $this->input->post('estado', TRUE);
        $mensagem = $this->input->post('mensagem', TRUE);
        $assunto = $this->input->post('assunto', TRUE);

        $this->email->from($email, $nome);
        $this->email->to('atendimentoset@gmail.com');

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
            $data['email_enviado'] = 'E-mail enviado com sucesso. Aguarde contato.';
        } else {
            $data['email_enviado'] = 'Erro ao enviar o email. Favor enviar um e-mail para xxx@xxx.com.br';
        }
        $data['action'] = site_url('contato/enviaEmail');
        $this->load->view('contato',$data);
    }

}
/* End of file contato.php */
/* Location: ./system/application/controllers/contato.php */

?>