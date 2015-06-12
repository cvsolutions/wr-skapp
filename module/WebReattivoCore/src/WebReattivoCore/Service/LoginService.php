<?php
namespace WebReattivoCore\Service;

/**
 * Class LoginService
 * @package WebReattivoCore\Service
 */
class LoginService extends BaseService
{
    /**
     * @param string $usermail
     * @param string $pwd
     * @return bool
     */
    public function isValid($usermail = '', $pwd = '')
    {
        if (empty($usermail) || empty($pwd)) {
            return false;
        }
        /** @var \DoctrineModule\Authentication\Adapter\ObjectRepository $adapter */
        $adapter = $this->getAuthentication()->getAdapter();
        $adapter->setIdentity($usermail);
        $adapter->setCredential($pwd);
        $authResult = $this->getAuthentication()->authenticate();
        if ($authResult->isValid()) {
            $identity = $authResult->getIdentity();
            $this->getAuthentication()->getStorage()->write($identity);
            return true;
        }
    }
}