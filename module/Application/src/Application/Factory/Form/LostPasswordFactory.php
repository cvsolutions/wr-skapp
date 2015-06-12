<?php

namespace Application\Factory\Form;

use Application\Form\LostPasswordForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class LostPasswordFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return LostPasswordForm
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new LostPasswordForm();
    }
}