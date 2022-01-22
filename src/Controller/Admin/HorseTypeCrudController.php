<?php

namespace App\Controller\Admin;

use App\Entity\HorseType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HorseTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HorseType::class;
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
