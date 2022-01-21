<?php

namespace App\Services;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ContactService
{
     private $entityManager;
     private $flash;

     public function __construct(EntityManagerInterface $entityManager, FlashBagInterface $flash)
     {
         $this->flash = $flash;
         $this->entityManager = $entityManager;
     }

     public function persistContact(Contact $contact):void
     {
         $contact->setIsSent(false)
             ->setCreatedAt(new \DateTime());
         $this->entityManager->persist($contact);
         $this->entityManager->flush();
         $this->flash->add('success', 'Votre message a bien été envoyé, merci.');
     }

     public function isSent(Contact $contact):void{
         $contact->setIsSent(true);

         $this->entityManager->persist($contact);
         $this->entityManager->flush();
     }
}