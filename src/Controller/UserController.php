<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\HorseSchleichRepository;
use App\Repository\PetshopRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
            'avatar' => $user->getAvatar(),
            'items' => $items
        ]);
    }

    /**
     * @Route("/profil/{nickname}/modifier", name="editProfile")
     */
    public function editProfile(string $nickname,
                                UserRepository $userRepository,
                                EntityManagerInterface $entityManager,
                                Request $request,
                                UserPasswordHasherInterface $userPasswordHasher){
        $user = $userRepository->findOneBy(['nickname' => $nickname]);
        $userChecked = $this->getUser();
        if($user !== $userChecked){
            return $this->render('home/index.html.twig');
        }
        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()){
            if ($userChecked->getNickname() !== $userForm->get('nickname')->getData()){
                $userChecked->setNickname($userForm->get('nickname')->getData());
            }
            if ($userChecked->getEmail() !== $userForm->get('email')->getData()){
                $userChecked->setEmail($userForm->get('email')->getData());
            }
            if ($userChecked->getAbout() !== $userForm->get('about')->getData()){
                $userChecked->setAbout($userForm->get('about')->getData());
            }
            $entityManager->persist($userChecked);
            $entityManager->flush();
            return $this->redirectToRoute('profile', [
                'nickname' => $userChecked->getNickname()
            ]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'userForm' => $userForm->createView()
        ]);
    }
}

