<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Sendmail {
    // Adiciona o arquivo class.phpmailer.php - você deve especificar corretamente o caminho da pasta com o este arquivo.
    
    public function __construct() {
        require_once("phpmailer/PHPMailerAutoload.php");
        // Inicia a classe PHPMailer
        $mail = new PHPMailer();
            
        // DEFINIÇÃO DOS DADOS DE AUTENTICAÇÃO - Você deve auterar conforme o seu domínio!
        $mail->IsSMTP(); // Define que a mensagem será SMTP
        $mail->Host = "smtp.agenciaset.com.br"; // Seu endereço de host SMTP
        $mail->SMTPAuth = true; // Define que será utilizada a autenticação -  Mantenha o valor "true"
        $mail->Port = 587; // Porta de comunicação SMTP - Mantenha o valor "587"
        $mail->SMTPSecure = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
        $mail->SMTPAutoTLS = false; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
        $mail->Username = 'webmaster@agenciaset.com.br'; // Conta de email existente e ativa em seu domínio
        $mail->Password = 'agEncia445'; // Senha da sua conta de email
        
        // DADOS DO REMETENTE
        $mail->Sender = "webmaster@agenciaset.com.br"; // Conta de email existente e ativa em seu domínio
        $mail->From = "webmaster@agenciaset.com.br"; // Sua conta de email que será remetente da mensagem
        $mail->FromName = "Contato Menina"; // Nome da conta de email
        

        if($_POST['setor'] = 'comercial') {
            $email_destino = 'comercial@radiomenina.com.br';
        }elseif($_POST['setor'] = 'jornalismo') {
            $email_destino = 'jornalismo@radiomenina.com.br';
        }elseif($_POST['setor'] = 'utilidade_publica') {
            $email_destino = 'recepcao@sistemamenina.com.br';
        }


        // DADOS DO DESTINATÁRIO
        $mail->AddAddress($email_destino, 'Nome - Recebe'); // Define qual conta de email receberá a mensagem
        //$mail->AddAddress('recebe2@dominio.com.br'); // Define qual conta de email receberá a mensagem
        $mail->AddCC('atendimentoset@gmail.com'); // Define qual conta de email receberá uma cópia
        //$mail->AddBCC('copiaoculta@dominio.info'); // Define qual conta de email receberá uma cópia oculta
        
        // Definição de HTML/codificação
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
        
        // DEFINIÇÃO DA MENSAGEM
        // if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['mensagem'])) {
        $mail->Subject  = "Formulário de Contato"; // Assunto da mensagem
        $mail->Body .= " Nome: ".$_POST['nome']."<br>"; // Texto da mensagem
        $mail->Body .= " E-mail: ".$_POST['email']."<br>"; // Texto da mensagem
        $mail->Body .= " Telefone: ".$_POST['telefone']."<br>"; // Texto da mensagem
        $mail->Body .= " Assunto: Contato do site  - Radio Menina <br>"; // Texto da mensagem
        $mail->Body .= " Mensagem: ". $_POST['mensagem']."<br>"; // Texto da mensagem
    
        
        // ENVIO DO EMAIL
        $enviado = $mail->Send();
        // Limpa os destinatários e os anexos
            
        $mail->ClearAllRecipients();
        
        // Exibe uma mensagem de resultado do envio (sucesso/erro)
        if ($enviado) {
            $_SESSION['enviado'] = 'E-mail enviado com sucesso. Aguarde contato.';
            $dados['email_enviado'] = 'E-mail enviado com sucesso. Aguarde contato.';
        } else {
            $_SESSION['enviado'] = 'Erro ao enviar o email. Favor enviar um e-mail para xxx@xxx.com.br';
            $dados['email_enviado'] = 'Erro ao enviar o email. Favor enviar um e-mail para xxx@xxx.com.br';
        // echo "<b>Detalhes do erro:</b> " . $mail->ErrorInfo;
        }
        // }
    }
}