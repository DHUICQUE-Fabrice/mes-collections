<?php

namespace App\Security\Voter;

use App\Entity\HorseSchleich;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class HorseSchleichVoter extends Voter
{
    public const EDIT = 'edit';
    public const DELETE = 'delete';

    protected function supports(string $attribute, $horseSchleich): bool
    {
        return in_array($attribute, [self::DELETE, self::EDIT])
            && ( $horseSchleich instanceof HorseSchleich);
    }

    protected function voteOnAttribute(string $attribute, $horseSchleich, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        return $user === $horseSchleich->getUser();
    }


}
