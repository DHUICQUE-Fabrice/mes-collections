<?php

namespace App\Controller\Admin;

use App\Entity\ImageFile;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

class ImageFileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageFile::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->hideOnForm(),
            TextField::new('imageFile', 'Upload')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            ImageField::new('imageName', 'Fichier')
                ->setBasePath('https://gq4bqq.stackhero-network.com/mes-collections/')
                ->hideOnForm()

        ];
    }

}
