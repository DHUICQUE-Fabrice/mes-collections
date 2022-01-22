<?php

namespace App\Controller\Admin;

use App\Entity\PetshopSize;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PetshopSizeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PetshopSize::class;
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
