<?php
namespace WebReattivoCore\Service;

use WebReattivoCore\Entity\User;
use WebReattivoCore\Entity\UserToken;
use WebReattivoCore\Service\BaseService;
use WebReattivoCore\Utility\TypeToken;
use Zend\Math\Rand;


/**
 * Class UserTokenService
 * @package WebReattivoCore\Servic
 */
class UserTokenService extends BaseService
{
    /**
     * @var string
     */
    public $entity = 'WebReattivoCore\Entity\UserToken';

    public function __construct()
    {

    }

    /**
     * @param User $user
     * @param      $typeToken
     *
     * @return UserToken
     * @throws \Exception
     */
    public function createToken(User $user, $typeToken)
    {
        try {

            $token = new UserToken();
            $token->setType($typeToken);
            $token->setUser($user);
            $token->setToken(sha1(Rand::getString(32, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789',
                true)));
            $token->setDateRegistration($this->getDataTime());

            $this->getEntityManager()->persist($token);
            $this->getEntityManager()->flush();

            return $token;

        } catch (\Exception $e) {

            throw $e;
        }
    }

    /**
     * @param $token
     * @param $userId
     * @param $type
     *
     * @return null|UserToken
     */
    public function verifyToken($token, $userId, $type)
    {
        /** @var UserToken $verifyToken */
        $verifyToken = $this->findOneBy([
            'token' => $token,
            'user'  => $userId,
            'type'  => $type
        ]);

        if (empty($verifyToken)) {
            return null;
        }

        return $verifyToken;
    }

    /**
     * @param UserToken $userToken
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteToken(UserToken $userToken)
    {
        try {

            $this->getEntityManager()->remove($userToken);
            $this->getEntityManager()->flush();

            return true;

        } catch (\Exception $e) {

            throw $e;
        }
    }
}