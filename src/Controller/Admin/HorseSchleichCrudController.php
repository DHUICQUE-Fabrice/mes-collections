<?php

namespace App\Controller\Admin;

use App\Entity\HorseSchleich;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HorseSchleichCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HorseSchleich::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextareaField::new('biography'),
            TextField::new('type'),
            TextField::new('coat'),
            TextField::new('species'),
            TextField::new('user'),
            DateField::new('createdAt')->hideOnForm()
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdAt' => 'DESC']);
    }

}
