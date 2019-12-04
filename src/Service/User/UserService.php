<?php

/**
 * @author BaBeuloula <info@babeuloula.fr>
 */

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserService
{
    protected ?User $user;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $user = null;

        if ($tokenStorage->getToken() instanceof TokenInterface
            && false === \is_string($tokenStorage->getToken()->getUser())
        ) {
            /** @var User $user */
            $user = $tokenStorage->getToken()->getUser();
        }

        $this->user = $user;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
