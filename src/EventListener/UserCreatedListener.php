<?php
namespace App\EventListener;

use App\Event\UserCreatedEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserCreatedListener
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function onUserCreated(UserCreatedEvent $event): void
    {
        $user = $event->getUser();

        $email = (new Email())
            ->from('no-reply@example.com')
            ->to($user->getEmail())
            ->subject('Bienvenue sur notre site !')
            ->text('Merci de vous être inscrit.');

        $this->mailer->send($email);
    }
}