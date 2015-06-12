<?php
namespace WebReattivoCore\Service;

use WebReattivoCore\Service\BaseService;


/**
 * Class UserService
 * @package WebReattivoCore\Service
 */
class UserService extends BaseService
{
    /**
     * @var string
     */
    public $entity = 'WebReattivoCore\Entity\User';

    public function __construct()
    {

    }

    /**
     * @param $email
     *
     * @return null|object
     */
    public function findOneByEmail($email)
    {

        return $this->findOneBy(['email' => $email]);
    }
}