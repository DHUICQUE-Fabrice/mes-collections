<?php

namespace App\Controller\Admin;

use App\Entity\Petshop;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PetshopCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Petshop::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextareaField::new('biography'),
            AssociationField::new('size'),
            AssociationField::new('species'),
            AssociationField::new('user'),
            AssociationField::new('objectFamily'),
            DateField::new('createdAt')->hideOnForm(),
            TextField::new('imageFile', 'Upload')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('imageName')->setBasePath('%env(STACKHERO_MINIO_ENDPOINT)%')->hideOnForm(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdAt' => 'DESC']);
    }

}
