<?php
namespace Application\Factory\Form;

use Application\Form\LoginForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return LoginForm
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new LoginForm();
    }
}