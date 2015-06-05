<?php

namespace Application\Form;

use Zend\Form\Form;

class RegistrationForm extends Form
{
    public function __construct(RegistrationFieldset $registrationFieldset)
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');

        $this->add($registrationFieldset);
    }
}