<?php

namespace WebReattivoCore\Form\Validator;

use WebReattivoCore\Entity\User;
use WebReattivoCore\Service\UserService;
use Zend\Validator\AbstractValidator;

class DuplicateEmail extends AbstractValidator
{
    const DUPLICATE = 'duplicateEmail';

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var array
     */
    private $emailsToAvoid = [];

    protected $messageTemplates = [
        self::DUPLICATE => "Esiste già un utente con lo stesso indirizzo email"
    ];

    public function __construct($options)
    {
        parent::__construct();
        $this->userService = $options['userService'];

        if (isset($options['avoid'])) {
            $this->emailsToAvoid = $options['avoid'];
        }
    }

    public function isValid($value)
    {
        $this->setValue($value);

        /** @var User $user */
        $user = $this->userService->findOneBy(['email' => $value]);

        if (!empty($user) && !in_array($user->getEmail(), $this->emailsToAvoid)) {
            $this->error(self::DUPLICATE);

            return false;
        }

        return true;
    }
}