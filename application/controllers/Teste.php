<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teste extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('My_PHPMailer');
    }


    public function teste_email_envia(){
        echo 'teste de envio de emails';
        
        $subject = 'teste';
        $body = '<p>Isso  um teste</p>'; 
        $bodyalt = null;
        $destino =  'dionathan_bass@hotmail.com';
        $destino_nome = 'teste';
        $cc=null;
        $anexo = null;

        $retorno = send($subject, $body, $bodyalt, $destino, $destino_nome, $cc, $anexo);

        var_dump($retorno);
    
    }
}