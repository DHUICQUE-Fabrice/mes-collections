<?php

namespace App\Controller;

use App\Repository\HorseSchleichRepository;
use App\Repository\PetshopRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profil/{nickname}", name="profile")
     */
    public function profile(string $nickname,
                            UserRepository $userRepository,
                            PetshopRepository $petshopRepository,
                            HorseSchleichRepository $horseSchleichRepository,
                            PaginatorInterface $paginator,
                            Request $request
                            ): Response
    {

        $user = $userRepository->findOneBy(['nickname' => $nickname]);
        $petshops = $petshopRepository->findBy(['user' => $user]);
        $horseSchleiches = $horseSchleichRepository->findBy(['user' => $user]);

        $rawItems = array_merge($petshops, $horseSchleiches);
        $items = $paginator->paginate(
            $rawItems,
            $request->query->getInt('page', 1), 12
        );

        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'items' => $items
        ]);
    }
}

