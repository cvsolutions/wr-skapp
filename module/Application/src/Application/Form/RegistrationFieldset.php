<?php
namespace Application\Form;

use WebReattivoCore\Entity\User;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;


/**
 * Class RegistrationFieldset
 * @package Application\Form
 */
class RegistrationFieldset extends Fieldset implements InputFilterProviderInterface
{
    /**
     * @param string $name
     * @param array  $options
     */
    public function __construct(HydratorInterface $hydrator)
    {
        parent::__construct('registration', [
            'use_as_base_fieldset' => true
        ]);

        $this->setHydrator($hydrator);
        $this->setObject(new User());


        $this->add([
            'name'       => 'name',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => [
                'id'       => 'name',
                'class'    => 'form-control',
                'required' => 'required',
            ]
        ]);

        $this->add([
            'name'       => 'surname',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => [
                'id'       => 'surname',
                'class'    => 'form-control',
                'required' => 'required',
            ]
        ]);

        $this->add([
            'name'       => 'email',
            'type'       => 'Zend\Form\Element\Email',
            'attributes' => [
                'id'       => 'email',
                'class'    => 'form-control',
                'required' => 'required'
            ]
        ]);

        $this->add([
            'name'       => 'email2',
            'type'       => 'Zend\Form\Element\Email',
            'attributes' => [
                'id'       => 'email2',
                'class'    => 'form-control',
                'required' => 'required'
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
            'name'    => [
                'required' => true,
                'filters'  => [
                    [
                        'name' => 'StringTrim'
                    ]
                ]
            ],
            'surname'    => [
                'required' => true,
                'filters'  => [
                    [
                        'name' => 'StringTrim'
                    ]
                ]
            ],
            'email' => [
                'required' => true,
                'validators' => [
                    [
                        'name' => 'EmailAddress',
                        'break_chain_on_failure' => true
                    ]
                ]
            ],
            'email2' => [
                'required' => true,
                'validators' => [
                    [
                        'name' => 'EmailAddress',
                        'break_chain_on_failure' => true
                    ],
                    [
                        'name' => 'Identical',
                        'options' => [
                            'token' => 'email'
                        ]
                    ]
                ]
            ],
            'password' => [
                'required' => true,
                'filters' => [
                    [
                        'name' => 'StringTrim'
                    ]
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 8
                        ]
                    ]
                ]
            ],
            'password2' => [
                'required' => true,
                'filters' => [
                    [
                        'name' => 'StringTrim'
                    ]
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 8
                        ],
                        'break_chain_on_failure' => true
                    ],
                    [
                        'name' => 'Identical',
                        'options' => [
                            'token' => 'password'
                        ]
                    ]
                ]
            ],
        ];
    }
}