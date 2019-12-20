<?php

namespace Lib;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {

    private $mail;
    private $user;
    private $name;
    private $body;

    public function __construct(array $settings) {
        $this->user = $settings['user'];
        $this->name = $settings['name'];

        $this->mail = new PHPMailer(true);
        //Server settings
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                                       
        $this->mail->isSMTP();                                           
        $this->mail->Host       = $settings['host'];                   
        $this->mail->SMTPAuth   = true;                                  
        $this->mail->Username   = $this->user;                    
        $this->mail->Password   = $settings['password'];                             
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $this->mail->Port       = $settings['port'];
    }

    public function setAddress(string $correo, string $nombre)
    {
        $this->mail->addAddress($correo,$nombre);
    }

    public function setAddressArray(array $correos)
    {
        if($correos != null) {
            foreach($correos as $key => $correo) {
                $this->mail->addAddress($correo['mail'],$correo['name']);  
            }
        }
    }

    public function setReplyTo(string $correo, string $nombre)
    {
        $this->mail->addReplyTo($correo,$nombre);
    }

    public function setReplyToArray(array $correos)
    {
        if($correos != null) {
            foreach($correos as $key => $correo) {
                $this->mail->addReplyTo($correo['mail'],$correo['name']);  
            }
        }
    }

    public function setCC(string $correo)
    {
        $this->mail->addCC($correo);
    }

    public function setCCArray(array $correos)
    {
        if($correos != null) {
            foreach($correos as $correo) {
                $this->mail->addCC($correo);  
            }
        }
    }

    public function setBCC(string $correo)
    {
        $this->mail->addBCC($correo);
    }

    public function setBCCArray(array $correos)
    {
        if($correos != null) {
            foreach($correos as $correo) {
                $this->mail->addBCC($correo);  
            }
        }
    }

    public function setAttachments()
    {
        // Attachments
        $this->mail->addAttachment('/var/tmp/file.tar.gz');         
        $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');  
    }

    public function setAttachmentsArray()
    {
        // Attachments
        $this->mail->addAttachment('/var/tmp/file.tar.gz');         
        $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');  
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function sendMail(string $asunto) {
        try {
            //Recipients
            $this->mail->setFrom($this->user, $this->name);  

            // Content
            $this->mail->isHTML(true);                                 
            $this->mail->Subject = $asunto;
            $this->mail->Body   = $this->body;

            $this->mail->send();
            
            return true;
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            return false;
        }
    }
}