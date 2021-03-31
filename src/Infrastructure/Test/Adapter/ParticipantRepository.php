<?php

namespace App\Infrastructure\Test\Adapter;

use Chabour\Domain\Security\Gateway\ParticipantGateway;
use Chabour\Domain\Security\Model\Participant;

class ParticipantRepository implements ParticipantGateway
{
    /**
     * @inheritDoc
     */
    public function isEmailUnique(?string $email): bool
    {
        return $email !== "used@email.com";
    }

    /**
     * @inheritDoc
     */
    public function isPseudoUnique(?string $pseudo): bool
    {
        return $pseudo !== "used_pseudo";
    }

    /**
     * @inheritDoc
     */
    public function register(Participant $participant): void
    {
    }
}
