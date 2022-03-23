<?php

namespace App\Controller;

use App\Repository\HorseSchleichRepository;
use App\Repository\PetshopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{

    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     * @param Request $request
     * @param PetshopRepository $petshopRepository
     * @param HorseSchleichRepository $horseSchleichRepository
     * @return Response
     */
    public function index(Request $request, PetshopRepository $petshopRepository, HorseSchleichRepository $horseSchleichRepository): Response
    {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

        $urls[] = ['loc' => $this->generateUrl('contact')];
        $urls[] = ['loc' => $this->generateUrl('accueil')];
        $urls[] = ['loc' => $this->generateUrl('horse_schleich')];
        $urls[] = ['loc' => $this->generateUrl('petshops')];
        $urls[] = ['loc' => $this->generateUrl('app_login')];
        $urls[] = ['loc' => $this->generateUrl('app_register')];

        $petshops = $petshopRepository->findAll();
        foreach ($petshops as $petshop){
            $urls[] = [
                'loc' =>$this->generateUrl('petshop_details', [
                    'id'=>$petshop->getId(),
                    'slug'=>$petshop->getSlug()
                ])
            ];
        }

        $schleichs = $horseSchleichRepository->findAll();
        foreach ($schleichs as $schleich){
            $urls[] = [
                'loc' =>$this->generateUrl('petshop_details', [
                    'id'=>$schleich->getId(),
                    'slug'=>$schleich->getSlug()
                ])
            ];
        }
        $response = new Response(
            $this->renderView('sitemap/index.html.twig', ['urls' => $urls, 'hostname'=>$hostname]),200
        );

        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
