<?php

namespace App\Controller;

use App\Entity\Petshop;
use App\Repository\PetshopRepository;
use App\Service\PaginatorService;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetshopsController extends AbstractController
{
    private $repository;

    public function __construct(PetshopRepository $petshopRepository)
    {
        $this->repository = $petshopRepository;
    }

    /**
     * @Route("/petshops", name="petshops")
     */
    public function allPetshops(Request $request, PaginatorInterface $paginator): Response
    {
        $paginatorSvc = new PaginatorService();
        $petshops = $paginatorSvc->paginate($this->repository,$paginator,$request);
        return $this->render('petshops/all.html.twig', [
            'petshops' => $petshops,
        ]);
    }

    /**
     * @Route ("/petshop/details/{slug}-{id}", name="petshop_details", requirements={"id"="\d+", "slug": "[a-z0-9\-]*"})
     * @param Petshop $petshop
     */
    public function details(Petshop $petshop, string $slug): Response
    {
        $currentSlug = $petshop->getSlug();
        if($currentSlug !== $slug) {
            return $this->redirectToRoute('petshop_details', [
                'id' => $petshop->getId(),
                'slug' => $currentSlug
            ], 301);
        }
        return $this->render('petshops/details.html.twig', [
            'petshop' => $petshop
        ]);

    }
}
