<?php
namespace App\Commands;

use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use App\Services\ContactService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class SendContactCommand extends Command{
    private $contactRepository;
    private $mailer;
    private $contactService;
    private $userRepository;
    protected static $defaultName = 'app:send-contact';

    public function __construct(ContactRepository $contactRepository,MailerInterface $mailer, ContactService $contactService, UserRepository $userRepository )
    {
        $this->contactRepository = $contactRepository;
        $this->mailer = $mailer;
        $this->contactService = $contactService;
        $this->userRepository = $userRepository;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $toSend = $this->contactRepository->findBy(['isSent'=>false]);
        $address = new Address('aelhan.dev@gmail.com', 'Admin');

        foreach ($toSend as $mail){
            $email = (new Email())
                ->from($mail->getEmail())
                ->to($address)
                ->subject('Nouveau message de ' . $mail->getNickname())
                ->text('Message du ' . $mail->getCreatedAt()->format('d/m/Y') . $mail->getMessage());

            $this->mailer->send($email);
            $this->contactService->isSent($mail);
        }
        return Command::SUCCESS;
    }
}