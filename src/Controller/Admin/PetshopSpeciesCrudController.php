<?php

namespace App\Controller\Admin;

use App\Entity\PetshopSpecies;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PetshopSpeciesCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return PetshopSpecies::class;
    }

}
