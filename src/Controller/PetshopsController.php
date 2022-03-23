<?php

namespace App\Controller;

use App\Entity\Petshop;
use App\Entity\User;
use App\Form\PetshopType;
use App\Repository\ObjectFamilyRepository;
use App\Repository\PetshopRepository;
use App\Service\PaginatorService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetshopsController extends AbstractController
{
    /**
     * @var PetshopRepository
     */
    private $repository;


    /**
     * @param PetshopRepository $petshopRepository
     */
    public function __construct(PetshopRepository $petshopRepository)
    {
        $this->repository = $petshopRepository;
    }

    /**
     * @Route("/petshops", name="petshops")
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function allPetshops(Request $request, PaginatorInterface $paginator): Response
    {
        $paginatorSvc = new PaginatorService();
        $petshops = $paginatorSvc->paginate($this->repository,$paginator,$request);
        return $this->render('petshops/all.html.twig', [
            'petshops' => $petshops,
        ]);
    }


    /**
     * @Route ("/petshop/details/{slug}-{id}", name="petshop_details", requirements={"id"="\d+", "slug": "[a-z0-9\-]*"})
     * @param Petshop $petshop
     * @param string $slug
     * @return Response
     */
    public function details(Petshop $petshop, string $slug): Response
    {
        $currentSlug = $petshop->getSlug();
        if($currentSlug !== $slug) {
            return $this->redirectToRoute('petshop_details', [
                'id' => $petshop->getId(),
                'slug' => $currentSlug
            ], 301);
        }
        return $this->render('petshops/details.html.twig', [
            'petshop' => $petshop
        ]);
    }


    /**
     * @Route("/nouveau/petshop", name="create_new_petshop")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param ObjectFamilyRepository $objectFamilyRepository
     * @return Response
     */
    public function createNewPetshop(EntityManagerInterface $entityManager,
                                     Request                $request,
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
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param PetshopRepository $petshopRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editPetshop(int                    $id, Request $request,
                                EntityManagerInterface $entityManager,
                                PetshopRepository      $petshopRepository){
        $petshop = $petshopRepository->find($id);

        $this->denyAccessUnlessGranted('edit', $petshop);

        $petshopForm = $this->createForm(PetshopType::class, $petshop);
        $petshopForm->handleRequest($request);
        if ($petshopForm->isSubmitted() && $petshopForm->isValid()){
            $entityManager->persist($petshop);
            $entityManager->flush();
            return $this->redirectToRoute('petshop_details', ['id'=>$id, 'slug'=>$petshop->getSlug()]);
        }
        return $this->render('petshops/edit.html.twig',[
            'petshopForm' => $petshopForm->createView()
        ]);
    }

    /**
     * @Route ("/supprimer/petshop/{id}", name="delete_petshop")
     * @param int $id
     * @param EntityManagerInterface $entityManager
     * @param PetshopRepository $petshopRepository
     * @return Response
     */
    public function deletePetshop(int                    $id,
                                  EntityManagerInterface $entityManager,
                                  PetshopRepository      $petshopRepository): Response
    {
        $petshop = $petshopRepository->find($id);
        $this->denyAccessUnlessGranted('delete', $petshop);
        $image = $petshop->getImageFile();
        $petshop->setImageFile(null);
        $entityManager->remove($image);
        $entityManager->remove($petshop);
        $entityManager->flush();
        return $this->redirectToRoute('profile', ['nickname' => $petshop->getUser()->getNickName()]);
    }

}
