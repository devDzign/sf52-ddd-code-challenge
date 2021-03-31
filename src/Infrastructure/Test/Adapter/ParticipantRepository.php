<?php

namespace App\Infrastructure\Test\Adapter;

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
