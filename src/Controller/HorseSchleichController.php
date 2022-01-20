<?php

namespace App\Controller;

use App\Repository\HorseSchleichRepository;
use App\Services\PaginatorService;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorseSchleichController extends AbstractController
{
    private $repository;
    public function __construct(HorseSchleichRepository $horseSchleichRepository)
    {
        $this->repository = $horseSchleichRepository;
    }

    /**
     * @Route("/chevaux-schleich", name="horse_schleich")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $paginatorSvc = new PaginatorService();
        $horseSchleiches = $paginatorSvc->paginate($this->repository, $paginator, $request);
        return $this->render('horse_schleich/all.html.twig', [
            'horseSchleiches' => $horseSchleiches,
        ]);
    }

    /**
     * @Route ("/schleich/details/{slug}-{id}", name="horse_schleich_details", requirements={"id"="\d+"})
     */
    public function details(string $slug, int $id)
    {
        $schleich = $this->repository->find($id);
        return $this->render('horse_schleich/details.html.twig', [
            'schleich' => $schleich
       ]);

    }
}
