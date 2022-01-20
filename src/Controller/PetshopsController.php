<?php

namespace App\Controller;

use App\Repository\PetshopRepository;
use App\Services\PaginatorService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetshopsController extends AbstractController
{
    /**
     * @Route("/petshops", name="petshops")
     */
    public function allPetshops(PetshopRepository $petshopRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $paginatorSvc = new PaginatorService();
        $petshops = $paginatorSvc->paginate($petshopRepository,$paginator,$request);
        return $this->render('petshops/all.html.twig', [
            'petshops' => $petshops,
        ]);
    }
}
