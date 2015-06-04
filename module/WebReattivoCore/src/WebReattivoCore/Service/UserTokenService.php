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
     *
     * @return string|UserToken
     */
    public function createToken(User $user)
    {
        try {

            $token = new UserToken();
            $token->setType(TypeToken::REGISTRATION);
            $token->setUser($user);
            $token->setToken(sha1(Rand::getBytes(32)));
            $token->setDateRegistration(new \DateTime());

            $this->getEntityManager()->persist($token);
            $this->getEntityManager()->flush();

            return $token;

        } catch (\Exception $e) {

            throw $e;
        }
    }
}