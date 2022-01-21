<?php

namespace App\Controller;

use App\Entity\HorseSchleich;
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
     * @param HorseSchleich $horseSchleich
     */
    public function details(HorseSchleich $horseSchleich, string $slug)
    {
        $currentSlug = $horseSchleich->getSlug();
        if($currentSlug !== $slug){
            return $this->redirectToRoute('horse_schleich_details', [
                'id' => $horseSchleich->getId(),
                'slug' => $currentSlug
            ], 301);
        }
        return $this->render('horse_schleich/details.html.twig', [
            'schleich' => $horseSchleich
       ]);

    }
}
