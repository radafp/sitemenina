<?php

function send_multiplos_destinos($subject, $body = null, $bodyalt = null, array $destino, array $cc=null, array $anexo = null) {
     
        $mail = new PHPMailer();
        $mail->IsSMTP(); //Definimos que usaremos o protocolo SMTP para envio.
        $mail->SMTPAuth = SMTPAuth_email; //Habilitamos a autenticação do SMTP. (true ou false)
        $mail->SMTPSecure = SMTPSecure_email; //Estabelecemos qual protocolo de segurança será usado.
        $mail->Host = Host_email; //Podemos usar o servidor do gMail para enviar.
        $mail->Port = Port_email; //Estabelecemos a porta utilizada pelo servidor do gMail.
        $mail->Username = username_email; //Usuário do gMail
        $mail->Password = password_email; //Senha do gMail        
        $mail->setFrom(setFrom_email, setFromNome_email); //Quem está enviando o e-mail.
        $mail->CharSet= codificacao_email;
        $mail->Subject = $subject; //Assunto do e-mail.
        
        if(count($cc)>0){
            
            foreach($cc as $c){
                $mail->addCC($c);
            }
        }
        
        $mail->Body = $body;
        $mail->AltBody = $bodyalt;
        
        if(count($destino)>0){
            
            foreach($destino as $d){
                $d = str_replace(' ', '', $d);
                $mail->AddAddress($d, '');
            }
        }
        

        /* Também é possível adicionar anexos. */
        if(count($anexo)>0){
            
            foreach($anexo as $a){
                $mail->AddAttachment($a);
            }
        }
        
        $mail->isHTML(true);  

        if (!$mail->Send()) {
            $data["retorno"] = 0;
            $data["subject"] = $subject;
            $data["body"] = htmlentities($body);
            $data["message"] = "ocorreu um erro durante o envio: " . $mail->ErrorInfo;
            return $data;
        } else {
            $data["retorno"] = 1;
            $data["message"] = "Mensagem enviada com sucesso!";
            return $data;
        }

    }

function send($subject, $body = null, $bodyalt = null, $destino, $destino_nome, array $cc=null, array $anexo = null) {
     
        $mail = new PHPMailer();
        $mail->IsSMTP(); //Definimos que usaremos o protocolo SMTP para envio.
        $mail->SMTPAuth = SMTPAuth_email; //Habilitamos a autenticação do SMTP. (true ou false)
        $mail->SMTPSecure = SMTPSecure_email; //Estabelecemos qual protocolo de segurança será usado.
        $mail->Host = Host_email; //Podemos usar o servidor do gMail para enviar.
        $mail->Port = Port_email; //Estabelecemos a porta utilizada pelo servidor do gMail.
        $mail->Username = username_email; //Usuário do gMail
        $mail->Password = password_email; //Senha do gMail        
        $mail->setFrom(setFrom_email, setFromNome_email); //Quem está enviando o e-mail.
        $mail->CharSet= codificacao_email;
        $mail->Subject = $subject; //Assunto do e-mail.
        
        if(count($cc)>0){
            
            foreach($cc as $c){
                $mail->addCC($c);
            }
        }
        
        $mail->Body = $body;
        $mail->AltBody = $bodyalt;
        $mail->AddAddress($destino, $destino_nome);

        /* Também é possível adicionar anexos. */
        if(count($anexo)>0){
            
            foreach($anexo as $a){
                $mail->AddAttachment($a);
            }
        }
        
        $mail->isHTML(true);  

        if (!$mail->Send()) {
            $data["retorno"] = 0;
            $data["subject"] = $subject;
            $data["body"] = htmlentities($body);
            $data["message"] = "ocorreu um erro durante o envio: " . $mail->ErrorInfo;
            return $data;
        } else {
            $data["retorno"] = 1;
            $data["message"] = "Mensagem enviada com sucesso!";
            return $data;
        }

    }