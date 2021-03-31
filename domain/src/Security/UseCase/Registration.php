<?php

namespace Chabour\Domain\Security\UseCase;

use Chabour\Domain\Security\Gateway\ParticipantGateway;
use Chabour\Domain\Security\Model\Participant;
use Chabour\Domain\Security\Model\User;
use Chabour\Domain\Security\Request\RegistrationRequest;
use Chabour\Domain\Security\Response\RegistrationResponse;
use Chabour\Domain\Security\Presenter\RegistrationPresenterInterface;

/**
 * Class Registration
 * @package Chabour\Domain\Security\UseCase
 */
class Registration
{
    /**
     * @var ParticipantGateway
     */
    private ParticipantGateway $participantGateway;

    /**
     * Registration constructor.
     *
     * @param ParticipantGateway $participantGateway
     */
    public function __construct(ParticipantGateway $participantGateway)
    {
        $this->userGateway = $participantGateway;
    }

    /**
     * @param RegistrationRequest            $request
     * @param RegistrationPresenterInterface $presenter
     */
    public function execute(RegistrationRequest $request, RegistrationPresenterInterface $presenter)
    {
        $request->validate($this->userGateway);
        $participant = Participant::fromRegistration($request);
        $this->userGateway->register($participant);
        $presenter->present(new RegistrationResponse($participant));
    }
}
