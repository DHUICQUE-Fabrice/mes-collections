<?php

namespace App\Controller;

use App\Repository\PetshopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetshopsController extends AbstractController
{
    /**
     * @Route("/petshops", name="petshops")
     */
    public function allPetshops(PetshopRepository $petshopRepository): Response
    {
        $petshops = $petshopRepository->findAll();
        return $this->render('petshops/all.html.twig', [
            'petshops' => $petshops,
        ]);
    }
}
