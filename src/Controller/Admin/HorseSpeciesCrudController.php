<?php

namespace App\Controller\Admin;

use App\Entity\HorseSpecies;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HorseSpeciesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HorseSpecies::class;
    }

}
