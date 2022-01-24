<?php

namespace App\Services;

use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


class MailjetService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    function sendEmail($sender, $receiver, $subject, $message){
        $email = (new Email())
            ->from($sender)
            ->to($receiver)
            ->subject($subject)
            ->text($message);

        $this->mailer->send($email);

    }
}