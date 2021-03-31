<?php

namespace Chabour\Domain\Security\Model;

use Cassandra\UuidInterface;
use Chabour\Domain\Security\Request\RegistrationRequest;
use Symfony\Component\Uid\Uuid;

/**
 * Class Participant
 * @package Chabour\Domain\Security\Model
 */
class Participant
{
    /**
     * @var
     */
    private Uuid $id;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $pseudo;

    /**
     * @var string
     */
    private string $password;

    /**
     * @param  RegistrationRequest $request
     * @return static
     */
    public static function fromRegistration(RegistrationRequest $request): self
    {
        return new self($request->getEmail(), $request->getPseudo(), $request->getPlainPassword());
    }

    /**
     * User constructor.
     *
     * @param string $email
     * @param string $pseudo
     * @param string $plainPassword
     */
    public function __construct(string $email, string $pseudo, string $plainPassword)
    {
        $this->id = Uuid::v4();
        $this->email = $email;
        $this->pseudo = $pseudo;
        $this->password = password_hash($plainPassword, PASSWORD_ARGON2I);
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
