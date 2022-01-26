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

}
