<?php
namespace WebReattivoCore\Provider;

use BjyAuthorize\Provider\Identity\ProviderInterface;
use WebReattivoCore\Utility\Roles;

/**
 * Class IdentityProvider
 * @package WebReattivoCore\Provider
 */
class IdentityProvider implements ProviderInterface
{
    /**
     * @return array
     */
    public function getIdentityRoles()
    {
        return [Roles::GUEST];
    }
}