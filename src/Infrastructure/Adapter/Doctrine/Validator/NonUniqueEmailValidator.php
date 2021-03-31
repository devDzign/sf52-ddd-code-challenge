<?php

namespace App\Infrastructure\Adapter\Doctrine\Validator;

use Chabour\Domain\Security\Gateway\ParticipantGateway;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NonUniqueEmailValidator extends ConstraintValidator
{

    /**
     * @var ParticipantGateway
     */
    private ParticipantGateway $participantGateway;

    /**
     * NonUniqueEmailValidator constructor.
     * @param ParticipantGateway $participantGateway
     */
    public function __construct(ParticipantGateway $participantGateway)
    {
        $this->participantGateway = $participantGateway;
    }


    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint NonUniqueEmail */
        if (null === $value || '' === $value) {
            return;
        }

        if (!$this->participantGateway->isEmailUnique($value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
