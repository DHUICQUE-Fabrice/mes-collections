<?php

namespace App\Controller;

use App\Entity\HorseSchleich;
use App\Entity\Petshop;
use App\Entity\User;
use App\Form\HorseSchleichType;
use App\Form\PetshopType;
use App\Repository\HorseSchleichRepository;
use App\Repository\ObjectFamilyRepository;
use App\Repository\PetshopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObjectOwnedController extends AbstractController
{
    /**
     * @Route("/nouveau", name="create_new")
     * @return Response
     */
    public function chooseWhatToCreate(): Response
    {
        return $this->render('create/index.html.twig');
    }
}
