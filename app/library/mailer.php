<?php

/**
 * Description of mailer
 *
 * @author Maurosoft
 */
class mailer {

    protected $_di;
    private $_mail;
    private $toEmail;
    private $toName;
    private $subject;
    private $body;
    private $altBody = '';
    private $charset = 'UTF-8';

    public function __construct($di) {
        $this->_di = $di;

        $this->_mail = new PHPMailer();
        //$this->_mail->IsSMTP();
        $this->_mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);
        $this->_mail->XMailer = "{$this->config->global->xAbrevIns}";
        //$this->_mail->XMailer = "UNCA";
        
        // $this->_mail->SMTPDebug = true; 
        $this->_mail->Host = "smtp.gmail.com";
        $this->_mail->SMTPAuth = true;
        $this->_mail->Username = "mail@unca.edu.pe";
        //$this->_mail->Username = "{$this->config->mail->from}";
        $this->_mail->Password = "UNCA2025+";
        $this->_mail->SMTPSecure = 'tls';
        //$this->_mail->Helo = $mail['fromEmail'];
        $this->_mail->Port = 587;

        //$this->_mail->From = "mail@unca.edu.pe";

        //$this->_mail->From = "{$this->config->mail->from}";

        $this->_mail->FromName = "{$this->config->global->xAbrevIns}";
        //$this->_mail->FromName = "UNCA";
        
    }

    public function setTo($email, $name = '') {
        $this->toEmail = $email;
        $this->toName = $name;
    }

    public function setFrom($email, $name = '') {
        $this->From = $email;
        $this->FromName = $name;
    }


    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function setAltBody($altbody) {
        $this->altBody = $altbody;
    }

    public function setCharset($charset) {
        $this->charset = $charset;
    }

    public function send() {

        // print("Llega from:".$this->From);
        // exit();

        $this->_mail->setFrom($this->From, $this->FromName);


        $this->_mail->addAddress($this->toEmail, $this->toName);
        $this->_mail->isHTML(true);
        $this->_mail->CharSet = $this->charset;
        $this->_mail->Subject = $this->subject;
        $this->_mail->Body = $this->body;
        $this->_mail->AltBody = $this->altBody;
        return $this->_mail->send();
    }

    public function getError() {
        return $this->_mail->ErrorInfo;
    }

}
