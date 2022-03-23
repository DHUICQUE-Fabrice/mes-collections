<?php

namespace App\Controller\Admin;

use App\Entity\HorseType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HorseTypeCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return HorseType::class;
    }

}
