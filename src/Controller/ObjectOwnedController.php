<?php

namespace App\Controller;

use App\Entity\Petshop;
use App\Entity\User;
use App\Form\PetshopType;
use App\Repository\ObjectFamilyRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ObjectOwnedController extends AbstractController
{
    private User $user;
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
}
