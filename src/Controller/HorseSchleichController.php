<?php

namespace App\Controller;

use App\Repository\HorseSchleichRepository;
use App\Services\PaginatorService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorseSchleichController extends AbstractController
{
    /**
     * @Route("/chevaux-schleich", name="horse_schleich")
     */
    public function index(HorseSchleichRepository $horseSchleichRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $paginatorSvc = new PaginatorService();
        $horseSchleiches = $paginatorSvc->paginate($horseSchleichRepository, $paginator, $request);
        return $this->render('horse_schleich/all.html.twig', [
            'horseSchleiches' => $horseSchleiches,
        ]);
    }
}
