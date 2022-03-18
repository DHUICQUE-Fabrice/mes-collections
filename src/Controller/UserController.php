<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\HorseSchleichRepository;
use App\Repository\PetshopRepository;
use App\Repository\UserRepository;
use Aws\S3\S3Client;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;
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
            'avatar' => $user->getImageFile(),
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
        $userForm = $this->createForm(UserType::class, $userChecked);

        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()){

//            $client = new S3Client([
//                'credentials' => [
//                    'key'    => 'minioUser',
//                    'secret' => 'LOuhNpUgz6wOsYTU4Hrf6enEibV3yWOBxkupTdkm',
//                ],
//                'region' => 'eu-west-3',
//                'version' => 'latest',
//            ]);
//
//            $adapter = new AwsS3V3Adapter($client, 'mes-collections',
//                'https://u7aw0j.stackhero-network.com/',null, null,
//                [
//                'StorageClass'  =>  'REDUCED_REDUNDANCY',
//            ]);
//
//            $filesystem = new Filesystem($adapter);
//            $filesystem->write('https://u7aw0j.stackhero-network.com/mes-collections', $userForm->getData());
//
//            dd($adapter, $filesystem);


            $entityManager->persist($userChecked);
            $entityManager->flush();
            return $this->redirectToRoute('profile', [
                'nickname' => $userChecked->getNickname()
            ]);
        }

        return $this->render('user/edit.html.twig', [
            'userForm' => $userForm->createView()
        ]);
    }
}

