<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use WebReattivoCore\Entity\User;
use WebReattivoCore\Entity\UserToken;
use WebReattivoCore\Service\UserTokenService;
use WebReattivoCore\Utility\MessageError;
use WebReattivoCore\Utility\Roles;
use WebReattivoCore\Utility\Templates;
use WebReattivoCore\Utility\TypeToken;
use WebReattivoCore\Utility\UserStatus;

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

            $user->setDateRegistration($this->getDataTime());
            $user->setIp($this->getIpAddress());
            $user->setStatus(UserStatus::PENDING);
            $user->setRole(Roles::USER);
            $user->setPassword($this->getPasswordEncrypted($user->getPassword()));

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $token = $this->userTokenService->createToken($user, TypeToken::REGISTRATION);

            $this->getConnection()->commit();

            return $token;

        } catch (\Exception $e) {

            $this->getConnection()->rollback();
            throw $e;
        }
    }

    /**
     * @param $token
     * @param $userId
     *
     * @return null|UserToken
     */
    public function verify($token, $userId)
    {
        return $this->userTokenService->verifyToken($token, $userId, TypeToken::REGISTRATION);
    }

    /**
     * @param UserToken $userToken
     *
     * @return User
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Exception
     */
    public function confirm(UserToken $userToken)
    {
        $this->getConnection()->beginTransaction();

        /** @var User $user */
        $user = $this->find($userToken->getUser()->getId());

        if (empty($user)) {
            throw new \Exception(MessageError::USER_NOT_FOUND);
        }

        try {

            $user->setDateConfirm($this->getDataTime());
            $user->setIpConfirm($this->getIpAddress());
            $user->setStatus(UserStatus::ACTIVE);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->userTokenService->deleteToken($userToken);

            $this->getConnection()->commit();

            return $user;

        } catch (\Exception $e) {

            $this->getConnection()->rollback();
            throw $e;
        }
    }

    public function lostPwd(User $user)
    {
        try {

            $token = $this->userTokenService->createToken($user, TypeToken::LOST_PWD);
            $emailService = $this->getEmailService();
            $emailService->setTemplate(Templates::LOST_PWD, [
                'user'  => $user,
                'token' => $token->getToken()
            ]);
            $emailService->getMessage()
                ->setSubject('Richiesta Password Smarrita')
                ->addTo($user->getEmail());
            $emailService->send();

        } catch (\Exception $e) {

            throw $e;
        }
    }

    /**
     * @param $token
     * @param $userId
     *
     * @return null|UserToken
     */
    public function verifyTokenLostPwd($token, $userId)
    {
        return $this->userTokenService->verifyToken($token, $userId, TypeToken::LOST_PWD);
    }

    /**
     * @param User      $user
     * @param UserToken $userToken
     *
     * @return User
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Exception
     */
    public function resetPwd(User $user, UserToken $userToken)
    {
        $this->getConnection()->beginTransaction();

        try {

            $user->setPassword($this->getPasswordEncrypted($user->getPassword()));
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();

            $this->userTokenService->deleteToken($userToken);

            $this->getConnection()->commit();

            return $user;

        } catch (\Exception $e) {

            $this->getConnection()->rollback();
            throw $e;
        }
    }
}