<?php

namespace App\Controller\Admin;

use App\Entity\HorseSchleich;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            AssociationField::new('type'),
            AssociationField::new('coat'),
            AssociationField::new('species'),
            AssociationField::new('user'),
            AssociationField::new('objectFamily'),
            DateField::new('createdAt')->hideOnForm(),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('imageName')->setBasePath('http://77.149.66.147:9000/mes-collections' )->hideOnForm(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdAt' => 'DESC']);
    }

}
