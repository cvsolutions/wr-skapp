<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class LostPasswordForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->add([
            'name'       => 'email',
            'type'       => 'Zend\Form\Element\Email',
            'attributes' => [
                'id'       => 'email',
                'class'    => 'form-control',
                'required' => 'required'
            ]
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'email' => [
                'required'   => true,
                'validators' => [
                    [
                        'name'                   => 'EmailAddress',
                        'break_chain_on_failure' => true
                    ]
                ]
            ],
        ];
    }
}