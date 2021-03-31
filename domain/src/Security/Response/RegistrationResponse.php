<?php

namespace Chabour\Domain\Security\Response;

use Chabour\Domain\Security\Model\Participant;
use Chabour\Domain\Security\Model\User;

/**
 * Class RegistrationResponse
 * @package Chabour\Domain\Security\Response
 */
class RegistrationResponse
{
    /**
     * @var Participant
     */
    private Participant $participant;

    /**
     * RegistrationResponse constructor.
     *
     * @param Participant $participant
     */
    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * @return Participant
     */
    public function getParticipant(): Participant
    {
        return $this->participant;
    }
}
