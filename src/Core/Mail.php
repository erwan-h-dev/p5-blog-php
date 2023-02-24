<?php


namespace App\Core;

use Swift_Message;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Attachment;


class Mail {

    private $mailer;
    private $message;

    public function __construct()
    {
        $this->message = (new Swift_Message());

        $transport = (new Swift_SmtpTransport($_ENV['SMTP_HOST'], $_ENV['SMTP_PORT']))
            ->setUsername($_ENV['SMTP_USER'])
            ->setPassword($_ENV['SMTP_PASSWORD'])
        ;

        $this->mailer = new Swift_Mailer($transport);
    }

    public function send()
    {
        $result = $this->mailer->send($this->message);

        return $result;
    }

    public function setSubject(string $subject)
    {
        $this->message->setSubject($subject);

        return $this;
    }

    public function setFrom(array $from)
    {
        $this->message->setFrom($from);
        
        return $this;
    }

    public function setTo(array $to)
    {
        $this->message->setTo($to);

        return $this;
    }

    public function setBody(string $body)
    {
        $this->message->setBody($body);

        return $this;
    }

    public function addPart(string $part)
    {
        $this->message->addPart($part, 'text/html');
        
        return $this;
    }

    public function attach(string $filePath)
    {
        $this->message->attach(Swift_Attachment::fromPath($filePath));

        return $this;
    }
}