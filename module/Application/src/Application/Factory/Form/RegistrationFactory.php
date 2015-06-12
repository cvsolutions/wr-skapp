<?php
namespace Application\Factory\Form;

use Application\Form\RegistrationForm;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RegistrationFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return RegistrationForm
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator      = new DoctrineHydrator($entityManager);
        return new RegistrationForm(null, [
            'hydrator'       => $hydrator,
            'entity_manager' => $entityManager
        ]);
    }
}