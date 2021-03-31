<?php

namespace Chabour\Domain\Security\Gateway;

use Chabour\Domain\Security\Model\Participant;

interface ParticipantGateway
{
    /**
     * @param  string|null $email
     * @return bool
     */
    public function isEmailUnique(?string $email): bool;

    /**
     * @param  string|null $pseudo
     * @return bool
     */
    public function isPseudoUnique(?string $pseudo): bool;

    /**
     * @param Participant $user
     */
    public function register(Participant $user): void;
}
