<?php

namespace App\Controller;

use App\Entity\HorseSchleich;
use App\Entity\Petshop;
use App\Entity\User;
use App\Form\HorseSchleichType;
use App\Form\PetshopType;
use App\Repository\ObjectFamilyRepository;
use App\Repository\PetshopRepository;
use App\Repository\PetshopSizeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObjectOwnedController extends AbstractController
{
    /**
     * @Route("/nouveau", name="create_new")
     */
    public function chooseWhatToCreate(): Response
    {
        return $this->render('create/index.html.twig');
    }

    /**
     * @Route("/nouveau/petshop", name="create_new_petshop")
     */
    public function createNewPetshop(EntityManagerInterface $entityManager,
                                     Request $request,
                                     ObjectFamilyRepository $objectFamilyRepository
    ): Response
    {
        /** @var $user User */
        $user = $this->getUser();
        $family = $objectFamilyRepository->findOneBy(['name'=>'Petshop']);
        $petshop = new Petshop();
        $petshop->setUser($user)
                ->setObjectFamily($family);

        $petshopForm = $this->createForm(PetshopType::class, $petshop);

        $petshopForm->handleRequest($request);
        if ($petshopForm->isSubmitted() && $petshopForm->isValid()){
            $entityManager->persist($petshop);
            $entityManager->flush();
            $this->addFlash('success', $petshop->getName() . ' a bien été ajouté !');
            return $this->redirectToRoute('petshop_details', ['id'=>$petshop->getId(), 'slug'=>$petshop->getSlug()]);
        }
        return $this->render('create/petshop.html.twig', [
            'petshopForm'=>$petshopForm->createView()
        ]);
    }

    /**
     * @Route ("/modifier/petshop/{id}", name="edit_petshop")
     */
    public function editPetshop(int $id, Request $request,
                                EntityManagerInterface $entityManager,
                                PetshopRepository $petshopRepository){
        $petshop = $petshopRepository->find($id);
        if($petshop->getUser() !== $this->getUser()){
            return $this->render('home/index.html.twig');
        }
        $petshopForm = $this->createForm(PetshopType::class, $petshop);
        $petshopForm->handleRequest($request);
        if ($petshopForm->isSubmitted() && $petshopForm->isValid()){
            $entityManager->persist($petshop);
            $entityManager->flush();
            return $this->redirectToRoute('petshop_details', $id, $petshop->getSlug());
        }
    }


    /**
     * @Route("/nouveau/cheval-schleich", name="create_new_horseSchleich")
     */
    public function createNewHorseSchleich(EntityManagerInterface $entityManager,
                                     Request $request,
                                     ObjectFamilyRepository $objectFamilyRepository
    ): Response
    {
        /** @var $user User */
        $user = $this->getUser();
        $family = $objectFamilyRepository->findOneBy(['name'=>'HorseSchleich']);


        $horseSchleich = new HorseSchleich();
        $horseSchleich->setUser($user)->setObjectFamily($family);
        $horseSchleichForm = $this->createForm(HorseSchleichType::class, $horseSchleich);

        $horseSchleichForm->handleRequest($request);
        if ($horseSchleichForm->isSubmitted() && $horseSchleichForm->isValid()){
            $horseSchleich = new HorseSchleich();
            $horseSchleich->setUser($user)
                ->setObjectFamily($family);
            $entityManager->persist($horseSchleich);
            $entityManager->flush();
            $this->addFlash('success', $horseSchleich->getName() . ' a bien été ajouté !');
            return $this->redirectToRoute('horse_schleich_details', ['id'=>$horseSchleich->getId(), 'slug'=>$horseSchleich->getSlug()]);
        }
        return $this->render('create/horseschleich.html.twig', [
            'horseSchleichForm'=>$horseSchleichForm->createView()
        ]);
    }
}
