<?php
namespace WebReattivoCore\Factory\Service;

use WebReattivoCore\Service\UserService;
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
     * @return UserService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new UserService();

        return $service;
    }
}