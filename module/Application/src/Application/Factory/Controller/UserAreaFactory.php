<?php
namespace Application\Factory\Controller;

use Application\Controller\IndexController;

use Application\Controller\UserAreaController;
use Application\Controller\UserController;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class UserAreaFactory
 * @package Application\Factory\Controller
 */
class UserAreaFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return UserAreaController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new UserAreaController();
    }
}