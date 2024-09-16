<?php

namespace App\Service;

use App\Entity\PAction;
use Doctrine\ORM\EntityManagerInterface;

class UserOperation
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getOperations($user, $route, $request)
    {
        if(!$request->getSession()->get("modules")){
            die("session end!");
        }


        if(in_array('ROLE_ADMIN',$user->getRoles())){
            $actions = $this->entityManager->getRepository(PAction::class)->findActionsByUserAndRouteName($route);
            return $actions;
        }

        $dossier = $request->getSession()->get('dossier');

        $actions = $this->entityManager->getRepository(PAction::class)->findActionsByUserAndRouteName($route, $user, $dossier);
        return $actions;
    }
}