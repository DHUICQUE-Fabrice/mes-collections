<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->hideOnForm(),
            TextField::new('nickname'),
            TextField::new('password')->onlyWhenCreating(),
            ArrayField::new('roles'),
            TextField::new('email')->hideOnForm(),
            TextareaField::new('about'),
            AssociationField::new('petshops'),
            AssociationField::new('horseSchleiches'),
            DateField::new('registeredAt')->hideOnForm(),
            TextField::new('imageFile')->setFormType(VichImageType::class),
            ImageField::new('avatar')->setBasePath('uploads/images/')->onlyOnIndex()

        ];
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['registeredAt' => 'DESC']);
    }

}
