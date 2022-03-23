<?php

namespace App\Controller;

use App\Entity\HorseSchleich;
use App\Entity\User;
use App\Form\HorseSchleichType;
use App\Repository\HorseSchleichRepository;
use App\Repository\ObjectFamilyRepository;
use App\Service\PaginatorService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorseSchleichController extends AbstractController
{
    /**
     * @var HorseSchleichRepository
     */
    private $repository;

    /**
     * @param HorseSchleichRepository $horseSchleichRepository
     */
    public function __construct(HorseSchleichRepository $horseSchleichRepository)
    {
        $this->repository = $horseSchleichRepository;
    }

    /**
     * @Route("/chevaux-schleich", name="horse_schleich")
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $paginatorSvc = new PaginatorService();
        $horseSchleiches = $paginatorSvc->paginate($this->repository, $paginator, $request);
        return $this->render('horse_schleich/all.html.twig', [
            'horseSchleiches' => $horseSchleiches,
        ]);
    }

    /**
     * @Route ("/schleich/details/{slug}-{id}", name="horse_schleich_details", requirements={"id"="\d+", "slug": "[a-z0-9\-]*"})
     * @param HorseSchleich $horseSchleich
     * @return Response
     */
    public function details(HorseSchleich $horseSchleich, string $slug): Response
    {
        $currentSlug = $horseSchleich->getSlug();
        if($currentSlug !== $slug){
            return $this->redirectToRoute('horse_schleich_details', [
                'id' => $horseSchleich->getId(),
                'slug' => $currentSlug
            ], 301);
        }
        return $this->render('horse_schleich/details.html.twig', [
            'schleich' => $horseSchleich
       ]);
    }


    /**
     * @Route("/nouveau/cheval-schleich", name="create_new_horseSchleich")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param ObjectFamilyRepository $objectFamilyRepository
     * @return Response
     */
    public function createNewHorseSchleich(EntityManagerInterface $entityManager,
                                           Request                $request,
                                           ObjectFamilyRepository $objectFamilyRepository
    ): Response
    {
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

    /**
     * @Route ("/modifier/schleich/{id}", name="edit_horseschleich")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param HorseSchleichRepository $horseSchleichRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editHorseSchleich(int                     $id, Request $request,
                                      EntityManagerInterface  $entityManager,
                                      HorseSchleichRepository $horseSchleichRepository){
        $horseSchleich = $horseSchleichRepository->find($id);

        $this->denyAccessUnlessGranted('edit', $horseSchleich);

        $horseSchleichForm = $this->createForm(HorseSchleichType::class, $horseSchleich);
        $horseSchleichForm->handleRequest($request);
        if ($horseSchleichForm->isSubmitted() && $horseSchleichForm->isValid()){
            $entityManager->persist($horseSchleich);
            $entityManager->flush();
            return $this->redirectToRoute('horse_schleich_details', ['id'=>$id, 'slug'=>$horseSchleich->getSlug()]);
        }
        return $this->render('horse_schleich/edit.html.twig',[
            'horseSchleichForm' => $horseSchleichForm->createView()
        ]);
    }
}
