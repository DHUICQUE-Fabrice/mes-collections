<?php

namespace App\Controller\Admin;

use App\Entity\HorseCoat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HorseCoatCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return HorseCoat::class;
    }

}
