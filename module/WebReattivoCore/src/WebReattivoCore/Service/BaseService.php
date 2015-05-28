<?php
namespace WebReattivoCore\Service;

use WebReattivoCore\Utility\ErrorException;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class BaseService
 * @package WebReattivoCore\Service
 */
class BaseService implements ServiceLocatorAwareInterface
{
    /**
     * @var
     */
    public $entity;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

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

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository($this->entity);
    }

    /**
     * @param int $id
     *
     * @return null|object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function find($id = 0)
    {
        if(empty($id)) {
            throw new \InvalidArgumentException(ErrorException::INVALID_ARGUMENT);
        }

        return $this->getEntityManager()->find($this->entity, $id);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findBy(array $criteria = [])
    {
        return $this->getRepository()->findBy($criteria);
    }

    /**
     * @param array $criteria
     *
     * @return null|object
     */
    public function findOneBy(array $criteria = [])
    {
        return $this->getRepository()->findOneBy($criteria);
    }
}