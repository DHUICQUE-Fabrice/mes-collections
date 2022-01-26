<?php

namespace App\Controller\Admin;

use App\Entity\ObjectFamily;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ObjectFamilyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ObjectFamily::class;
    }

}
