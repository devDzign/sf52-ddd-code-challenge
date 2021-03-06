<?php

namespace Chabour\Domain\Security\Assert;

use Chabour\Domain\Security\Exception\NonUniqueEmailException;
use Chabour\Domain\Security\Exception\NonUniquePseudoException;
use Chabour\Domain\Security\Gateway\ParticipantGateway;

class Assertion extends \Assert\Assertion
{
    public const EXISTING_EMAIL = 500;
    public const EXISTING_PSEUDO = 501;

    /**
     * @param string      $pseudo
     * @param ParticipantGateway $participantGateway
     */
    public static function nonUniquePseudo(string $pseudo, ParticipantGateway $participantGateway): void
    {
        if (!$participantGateway->isPseudoUnique($pseudo)) {
            throw new NonUniquePseudoException("This email should be unique !", self::EXISTING_PSEUDO);
        }
    }

    /**
     * @param string      $email
     * @param ParticipantGateway $participantGateway
     */
    public static function nonUniqueEmail(string $email, ParticipantGateway $participantGateway): void
    {
        if (!$participantGateway->isEmailUnique($email)) {
            throw new NonUniqueEmailException("This email should be unique !", self::EXISTING_EMAIL);
        }
    }
}
