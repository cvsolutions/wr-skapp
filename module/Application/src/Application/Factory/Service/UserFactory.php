<?php
namespace Application\Factory\Service;

use Application\Service\UserService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class UserFactory
 * @package WebReattivoCore\Factory\Service
 */
class UserFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $userTokenService = $serviceLocator->get('WebReattivoCore\Service\UserTokenService');

        return new UserService($entityManager, $userTokenService);
    }
}