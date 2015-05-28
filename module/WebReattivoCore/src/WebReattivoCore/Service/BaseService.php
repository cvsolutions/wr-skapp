<?php
namespace WebReattivoCore\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class BaseService
 * @package WebReattivoCore\Servic
 */
class BaseService implements ServiceLocatorAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
       // return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        return true;
    }

    /**
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @param ServiceLocatorInterface $ServiceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $ServiceLocator)
    {
        $this->serviceLocator = $ServiceLocator;
    }


}