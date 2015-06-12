<?php
namespace WebReattivoCore\Provider;

use BjyAuthorize\Provider\Identity\ProviderInterface;
use WebReattivoCore\Service\BaseService;
use WebReattivoCore\Utility\Roles;

/**
 * Class IdentityProvider
 * @package WebReattivoCore\Provider
 */
class IdentityProvider extends BaseService implements ProviderInterface
{
    /**
     * @return array
     */
    public function getIdentityRoles()
    {
        $logged = $this->getAuthentication();
        /** @var \WebReattivoCore\Entity\User $identity */
        $identity = $logged->getIdentity();
        if (is_null($identity)) {
            return [Roles::GUEST];
        }
        return [$identity->getRole()];
    }
}