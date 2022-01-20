<?php

namespace App\Controller;

use App\Repository\HorseSchleichRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorseSchleichController extends AbstractController
{
    /**
     * @Route("/chevaux-schleich", name="horse_schleich")
     */
    public function index(HorseSchleichRepository $horseSchleichRepository): Response
    {
        $horseSchleiches = $horseSchleichRepository->findAll();
        return $this->render('horse_schleich/all.html.twig', [
            'horseSchleiches' => $horseSchleiches,
        ]);
    }
}
