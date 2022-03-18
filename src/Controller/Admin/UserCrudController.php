<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\ImageFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

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
            ArrayField::new('roles')->hideOnForm(),
            TextField::new('email')->onlyWhenCreating(),
            TextareaField::new('about'),
            AssociationField::new('petshops')->onlyOnIndex(),
            AssociationField::new('horseSchleiches')->onlyOnIndex(),
            DateField::new('registeredAt')->hideOnForm(),
            CollectionField::new('imageFile', 'Fichier')->setEntryType(ImageFileType::class)

        ];
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['registeredAt' => 'DESC']);
    }

}
