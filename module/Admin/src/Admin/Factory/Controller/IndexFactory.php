<?php
namespace Admin\Factory\Controller;

use Admin\Controller\IndexController;

use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class IndexFactory
 * @package Admin\Factory\Controller
 */
class IndexFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|ControllerManager $serviceLocator
     *
     * @return IndexController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new IndexController();
    }
}