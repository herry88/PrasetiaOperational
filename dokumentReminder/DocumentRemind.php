<?php 
	require 'PHPMailer-master\PHPMailerAutoload.php';

	class SentMail{
		private $sender = "admin@prasetia.co.id";
		private $host = "smtp.gmail.com";
		private $username = "admin@prasetia.co.id";
		private $password = "PDadmin1";
		private $from = "admin@prasetia.co.id";

		private $subject = "REMINDER DOCUMENT EXPIRED";
		
		private $body = "<h1>Sent</h1>";

		private $_mail = null;

		public function __construct(){
			$this->_mail = new PHPMailer();
			$header = "X-Mailer: PHP/".phpversion() . "Return-Path: $this->sender";
			$this->_mail->IsSMTP();
			$this->_mail->Host = $this->host; 
			$this->_mail->SMTPAuth = true;
			$this->_mail->SMTPSecure = "tls";
			$this->_mail->Port = 587;
			$this->_mail->SMTPDebug  = 2; // turn it off in production
			$this->_mail->Username   = $this->username;  
			$this->_mail->Password   = $this->password; 
			$this->_mail->From = $this->from;
			$this->_mail->FromName = "Legal Document Reminder";
			$this->_mail->IsHTML(true);
			$this->_mail->CreateHeader($header);
			$this->_mail->AltBody = nl2br("");
			$this->_mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);
		}

		public function setMessage($message){
			$this->body = $message;
		}

		public function sendEmail(){
			$this->_mail->Subject = $this->subject;
			$this->_mail->AddAddress("junifar@gmail.com");
			$this->_mail->AddAddress("yohanes.efrendi@prasetiadwidharma.co.id");
			//$this->_mail->AddAddress("daud.sugari@prasetiadwidharma.co.id");
			//$this->_mail->AddAddress("andreas.kembara@prasetiadwidharma.co.id");
			//$this->_mail->AddAddress("nessa@prasetia.co.id");
			//$mail->AddAddress("ririn.sundari@prasetiadwidharma.co.id");
			//$mail->AddCC("ririnsucis@gmail.com");
			$this->_mail->Body = $this->body;
			$this->_mail->send();
		}

	}
 ?>