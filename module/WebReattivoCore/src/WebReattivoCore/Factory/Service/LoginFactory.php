<?php
namespace WebReattivoCore\Factory\Service;

use WebReattivoCore\Service\LoginService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LoginFactory
 * @package WebReattivoCore\Factory\Service
 */
class LoginFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return LoginService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new LoginService();
        return $service;
    }
}