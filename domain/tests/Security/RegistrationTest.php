<?php

namespace Chabour\Domain\Tests\Security;

use Assert\AssertionFailedException;
use Chabour\Domain\Security\Gateway\ParticipantGateway;
use Chabour\Domain\Security\Model\Participant;
use Chabour\Domain\Security\Model\User;
use Chabour\Domain\Security\Presenter\RegistrationPresenterInterface;
use Chabour\Domain\Security\Request\RegistrationRequest;
use Chabour\Domain\Security\Response\RegistrationResponse;
use Chabour\Domain\Security\UseCase\Registration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

/**
 * Class RegistrationTest
 * @package Chabour\Domain\Tests\Security
 */
final class RegistrationTest extends TestCase
{

    /**
     * @var Registration
     */
    private Registration $useCase;

    /**
     * @var RegistrationPresenterInterface
     */
    private RegistrationPresenterInterface $presenter;

    protected function setUp(): void
    {
        $this->presenter = new class () implements RegistrationPresenterInterface {
            public RegistrationResponse $response;

            public function present(RegistrationResponse $response): void
            {
                $this->response = $response;
            }

            public function getResponse(): RegistrationResponse
            {
                return $this->response;
            }
        };

        $participantGateway = new class () implements ParticipantGateway {
            public function isEmailUnique(?string $email): bool
            {
                return !in_array($email, ["used@email.com"]);
            }

            public function isPseudoUnique(?string $pseudo): bool
            {
                return !in_array($pseudo, ["used_pseudo"]);
            }

            public function register(Participant $participant): void
            {
            }
        };

        $this->useCase = new Registration($participantGateway);
    }

    public function testSuccessful(): void
    {
        $request = RegistrationRequest::create("email@email.com", "pseudo", "password");

        $this->useCase->execute($request, $this->presenter);

        $this->assertInstanceOf(RegistrationResponse::class, $this->presenter->getResponse());
        $participant = $this->presenter->response->getParticipant();
        $this->assertInstanceOf(Uuid::class, $participant->getId());
        $this->assertEquals("email@email.com", $participant->getEmail());
        $this->assertEquals("pseudo", $participant->getPseudo());
        $this->assertTrue(password_verify("password", $participant->getPassword()));
    }

    /**
     * @dataProvider provideFailedRequestData
     *
     * @param string $email
     * @param string $pseudo
     * @param string $plainPassword
     */
    public function testFailedRequest(string $email, string $pseudo, string $plainPassword): void
    {
        $request = RegistrationRequest::create($email, $pseudo, $plainPassword);

        $this->expectException(AssertionFailedException::class);

        $this->useCase->execute($request, $this->presenter);
    }

    /**
     * @return \Generator
     */
    public function provideFailedRequestData(): \Generator
    {
        yield ["", "pseudo", "password"];
        yield ["email", "pseudo", "password"];
        yield ["email@email.com", "", "password"];
        yield ["email@email.com", "pseudo", ""];
        yield ["email@email.com", "pseudo", "fail"];
        yield ["used@email.com", "pseudo", "password"];
        yield ["email@email.com", "used_pseudo", "password"];
    }
}
