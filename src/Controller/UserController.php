<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profil/{nickname}", name="profile")
     */
    public function profile(string $nickname, UserRepository $userRepository): Response
    {
        $user = new User();
        $user = $userRepository->findOneBy(['nickname' => $nickname]);

        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
