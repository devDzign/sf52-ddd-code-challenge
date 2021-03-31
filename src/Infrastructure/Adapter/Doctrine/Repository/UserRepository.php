<?php

namespace App\Infrastructure\Adapter\Doctrine\Repository;

use App\Infrastructure\Adapter\Doctrine\Entity\User;
use Chabour\Domain\Security\Gateway\ParticipantGateway;
use Chabour\Domain\Security\Model\Participant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements ParticipantGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @inheritDoc
     */
    public function isEmailUnique(?string $email): bool
    {
        return $this->count(["email" => $email]) === 0;
    }

    /**
     * @inheritDoc
     */
    public function isPseudoUnique(?string $pseudo): bool
    {
        return $this->count(["pseudo" => $pseudo]) === 0;
    }

    /**
     * @inheritDoc
     */
    public function register(Participant $participant): void
    {
        $doctrineUser = new User();
        $doctrineUser->setEmail($participant->getEmail());
        $doctrineUser->setPassword($participant->getPassword());
        $doctrineUser->setPseudo($participant->getPseudo());

        $this->_em->persist($doctrineUser);
        $this->_em->flush();
    }
}
