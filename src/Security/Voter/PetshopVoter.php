<?php

namespace App\Security\Voter;

use App\Entity\Petshop;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PetshopVoter extends Voter
{
    public const EDIT = 'edit';
    public const DELETE = 'delete';

    protected function supports(string $attribute, $petshop): bool
    {
        return in_array($attribute, [self::DELETE, self::EDIT])
            && ( $petshop instanceof Petshop);
    }

    protected function voteOnAttribute(string $attribute, $petshop, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        return $user === $petshop->getUser();
    }
}
