<?php
namespace WebReattivoCore\Factory\Provider;

use WebReattivoCore\Provider\IdentityProvider;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class IdentityFactory
 * @package WebReattivoCore\Factory\Provider
 */
class IdentityFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return IdentityProvider
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new IdentityProvider();
    }
}