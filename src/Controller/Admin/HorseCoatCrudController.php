<?php

namespace App\Controller\Admin;

use App\Entity\HorseCoat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HorseCoatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HorseCoat::class;
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
