<?php

namespace Application\Factory\Form;

use Application\Form\RegistrationFieldset;
use Application\Form\RegistrationForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class RegistrationFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return RegistrationForm
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $userService = $serviceLocator->get('WebReattivoCore\Service\UserService');

        $hydrator = new DoctrineHydrator($entityManager);
        $userFieldset = new RegistrationFieldset($userService, $hydrator);

        return new RegistrationForm($userFieldset);
    }
}