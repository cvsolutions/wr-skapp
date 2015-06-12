<?php

namespace Application\Form;

use WebReattivoCore\Entity\User;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class ResetPasswordForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->setHydrator($options['hydrator']);
        $this->setObject(new User());

        $this->add([
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => [
                'id' => 'id'
            ]
        ]);

        $this->add([
            'name'       => 'password',
            'type'       => 'Zend\Form\Element\Password',
            'attributes' => [
                'id'       => 'password',
                'class'    => 'form-control',
                'required' => 'required'
            ]
        ]);

        $this->add([
            'name'       => 'password2',
            'type'       => 'Zend\Form\Element\Password',
            'attributes' => [
                'id'       => 'password',
                'class'    => 'form-control',
                'required' => 'required'
            ]
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'id'  => [
                'required'   => true,
                'filters'    => [
                    [
                        'name' => 'StringTrim'
                    ]
                ]
            ],
            'password'  => [
                'required'   => true,
                'filters'    => [
                    [
                        'name' => 'StringTrim'
                    ]
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 8
                        ]
                    ]
                ]
            ],
            'password2' => [
                'required'   => true,
                'filters'    => [
                    [
                        'name' => 'StringTrim'
                    ]
                ],
                'validators' => [
                    [
                        'name'                   => 'StringLength',
                        'options'                => [
                            'min' => 8
                        ],
                        'break_chain_on_failure' => true
                    ],
                    [
                        'name'    => 'Identical',
                        'options' => [
                            'token' => 'password'
                        ]
                    ]
                ]
            ]
        ];
    }
}