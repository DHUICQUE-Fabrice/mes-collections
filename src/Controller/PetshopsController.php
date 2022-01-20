<?php

namespace App\Controller;

use App\Repository\PetshopRepository;
use App\Services\PaginatorService;
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
     */
    public function details(string $slug, int $id)
    {
        $petshop= $this->repository->find($id);
        return $this->render('petshops/details.html.twig', [
            'petshop' => $petshop
        ]);

    }
}
