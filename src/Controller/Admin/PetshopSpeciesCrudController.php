<?php

namespace App\Controller\Admin;

use App\Entity\PetshopSpecies;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PetshopSpeciesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PetshopSpecies::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
