<?php

/**
 * Description of MailUnca
 *
 * @author Arcjas
 */
class MailUnca
{

    protected $_di;
    private $_mail;
    private $toEmail;
    private $toName;
    private $subject;
    public $body;
    private $altBody = '';
    private $charset = 'UTF-8';
    private $view;
    private $config;
    private $From = '';
    private $FromName = '';
    private $attachment = [];


    public function __construct($di)
    {
        $this->_di = $di;
        $this->view = $di->getShared('view');
        $this->config = $di->getShared('config');
        $this->_mail = new PHPMailer();
        $this->smtpConnect();
        $this->initMailConfig();
    }

    private function initMailConfig()
    {
        $this->_mail->XMailer = "{$this->config->global->xAbrevIns}";
        $this->_mail->Host = "smtp.gmail.com";
        $this->_mail->SMTPAuth = true;
        $this->_mail->Username = "mail@unca.edu.pe";
        $this->_mail->Password = "UNCA2025+";
        $this->_mail->SMTPSecure = 'tls';
        $this->_mail->Port = 587;
        $this->_mail->FromName = "{$this->config->global->xAbrevIns}";
        $this->From = $this->config->mail->from;
        $this->FromName = '';
    }
    private function smtpConnect()
    {
        $this->_mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);
    }
    public function setTo($email, $name = '')
    {
        $this->toEmail = $email;
        $this->toName = $name == '' ? $this->config->mail->from : $name;
    }

    public function setFrom($email, $name = '')
    {
        $this->From = $email;
        $this->FromName = $name;
    }


    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setPathView($path, $params = [])
    {
        $content = $this->view->getRender('emails', $path, $params);
        $this->body = $content;
    }

    public function setAltBody($altbody)
    {
        $this->altBody = $altbody;
    }

    public function setCharset($charset)
    {
        $this->charset = $charset;
    }
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
    }
    public function send()
    {
        foreach ($this->attachment as $file) {
            $this->_mail->addAttachment($file);
        }
        $this->_mail->isHTML(true);
        $this->_mail->setFrom($this->From, $this->FromName);
        $this->_mail->addAddress($this->toEmail, $this->toName);
        $this->_mail->CharSet = $this->charset;
        $this->_mail->Subject = $this->subject;
        $this->_mail->Body = $this->body;
        $this->_mail->AltBody = $this->altBody;
        return $this->_mail->send();
    }

    public function getError()
    {
        return $this->_mail->ErrorInfo;
    }
}
