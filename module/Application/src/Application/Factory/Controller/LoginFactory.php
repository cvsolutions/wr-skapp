<?php
namespace Application\Factory\Controller;

use Application\Controller\LoginController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LoginFactory
 * @package Application\Factory\Controller
 */
class LoginFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|\Zend\Mvc\Controller\ControllerManager $serviceLocator
     * @return LoginController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $LoginForm = $serviceLocator->getServiceLocator()->get('LoginForm');
        $Login     = $serviceLocator->getServiceLocator()->get('WebReattivoCore\Service\Login');
        return new LoginController($LoginForm, $Login);
    }
}