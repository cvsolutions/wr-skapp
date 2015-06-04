<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use WebReattivoCore\Entity\User;
use WebReattivoCore\Service\UserTokenService;
use WebReattivoCore\Utility\Roles;
use WebReattivoCore\Utility\UserStatus;
use Zend\Crypt\Password\Bcrypt;
use Zend\Http\PhpEnvironment\RemoteAddress;

class UserService extends \WebReattivoCore\Service\UserService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var UserTokenService
     */
    private $userTokenService;

    public function __construct(EntityManager $entityManager, UserTokenService $userTokenService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->userTokenService = $userTokenService;
    }

    public function registration(User $user)
    {
        $this->getConnection()->beginTransaction();

        try {

            /** @var RemoteAddress $ip */
            $ip = new RemoteAddress();

            /** @var Bcrypt $bcrypt */
            $bcrypt = new Bcrypt();

            $user->setDateRegistration(new \DateTime());
            $user->setIp($ip->getIpAddress());
            $user->setStatus(UserStatus::PENDING);
            $user->setRole(Roles::USER);
            $user->setPassword($bcrypt->create($user->getPassword()));

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->userTokenService->createToken($user);

            $this->getConnection()->commit();

            return $user;

        } catch (\Exception $e) {

            $this->getConnection()->rollback();
            throw $e;
        }
    }
}