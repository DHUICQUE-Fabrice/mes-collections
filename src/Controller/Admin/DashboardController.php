<?php

namespace App\Controller\Admin;

use App\Entity\HorseCoat;
use App\Entity\HorseSchleich;
use App\Entity\HorseSpecies;
use App\Entity\HorseType;
use App\Entity\ImageFile;
use App\Entity\ObjectFamily;
use App\Entity\Petshop;
use App\Entity\PetshopSize;
use App\Entity\PetshopSpecies;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
        ]);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mes Collections');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Mes-collections', 'fa fa-globe-europe', 'accueil');

        yield MenuItem::section('Petshops', 'fas fa-paw');
        yield MenuItem::linkToCrud('Petshop Species', null, PetshopSpecies::class);
        yield MenuItem::linkToCrud('Petshop Sizes', null, PetshopSize::class);
        yield MenuItem::linkToCrud('Petshops', null, Petshop::class);

        yield MenuItem::section('Horse Schleich', 'fas fa-horse');
        yield MenuItem::linkToCrud('Horse Coats', null, HorseCoat::class);
        yield MenuItem::linkToCrud('Horse Type', null, HorseType::class);
        yield MenuItem::linkToCrud('Horse Species', null, HorseSpecies::class);
        yield MenuItem::linkToCrud('Horses', null, HorseSchleich::class);

        yield MenuItem::section('Object Families', 'fas fa-book');
        yield MenuItem::linkToCrud('Families', null, ObjectFamily::class);

        yield MenuItem::section('Users', 'fas fa-users');
        yield MenuItem::linkToCrud('Registered Users', null, User::class);
        yield MenuItem::linkToCrud('Image Files', null, ImageFile::class);



    }
}
