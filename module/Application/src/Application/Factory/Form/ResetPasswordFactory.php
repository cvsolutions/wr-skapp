<?php

namespace Application\Factory\Form;

use Application\Form\ResetPasswordForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ResetPasswordFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ResetPasswordForm
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator = new DoctrineHydrator($entityManager);
        return new ResetPasswordForm(null, ['hydrator' => $hydrator]);
    }
}