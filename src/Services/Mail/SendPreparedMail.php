<?php

namespace App\Services\Mail;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendPreparedMail
{
    private $mailer;

    // j'appelle le mailerInterface
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMailToSupport(string $email, string $contentMessage, string $subjectMessage, string $nom, string $prenom, string $telephone)
    {
        $email = (new TemplatedEmail())
            ->from('noreply@monsite.com')
            ->to('support@monsite.com')
            ->subject($subjectMessage)
            ->htmlTemplate('email/support.html.twig')
            ->context([
                'emailCustomer' => $email,
                'contentMessage' => $contentMessage,
                'subjectMessage' => $subjectMessage,
                'nom' => $nom,
                'prenom' => $prenom,
                'telephone' => $telephone,
            ]);

        $this->mailer->send($email);
    }
    /*
    public function sendMailToContact(string $email, string $nom, string $prenom, string $message)
    {
        $contactEmail = (new TemplatedEmail())
            ->from('noreply@monsite.com')
            ->to('frank.bollea@gmail.com')
            /* ->to('support@monsite.com')
            ->subject($message)
            ->htmlTemplate('email/contact.html.twig')
            ->context([
                'email' => $email,
                'nom' => $nom,
                'prenom' => $prenom,
                'message' => $message, 
            ]);

        $this->mailer->send($contactEmail);
    } */


    public function sendMailToContact(string $email, string $prenom, string $nom, string $message, string $subjectMessage)
    {
        $contactEmail = (new TemplatedEmail())
            ->from('noreply@monsite.com')
            ->to('frank.bollea@gmail.com')

            ->subject($subjectMessage)
            ->htmlTemplate('email/contact.html.twig')
            ->context([
                'emailCustomer' => $email,
                'prenom' => $prenom,
                'nom' => $nom,
                'subjectMessage' => $subjectMessage,
                'message' => $message,
            ]);

        $this->mailer->send($contactEmail);
    }
}
