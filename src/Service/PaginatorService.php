<?php

namespace App\Service;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PaginatorService
{
    public function paginate($repository, PaginatorInterface $paginator, Request $request){
        $data = $repository->findAll();
        return $paginator->paginate($data, $request->query->getInt('page', 1), 12);
    }
}