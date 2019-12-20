<?php

namespace Lib;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {

    private $host;
    private $user;
    private $password;
    private $port;
    private $name;

    public function __construct(array $settings) {
        $this->host = $settings['host'];
        $this->user = $settings['user'];
        $this->password = $settings['password'];
        $this->port = $settings['port'];
        $this->name = $settings['name'];
    }

    public function sendMail(string $asunto, string $body, array $correos = null, array $archivos = null) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $this->host;                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $this->user;                     // SMTP username
            $mail->Password   = $this->password;                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = $this->port;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($this->user, $this->name);
            if($correos != null) {
                foreach($correos as $key => $correo) {
                    $mail->addAddress($correo['mail'],$correo['name']);  
                }
            }
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $body;

            if($correos != null) {
                //$mail->send();
            }
            
            return true;
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}