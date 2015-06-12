<?php
namespace Application\Form;

use WebReattivoCore\Entity\User;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class RegistrationForm extends Form implements InputFilterProviderInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, $options = [])
    {
        $this->entityManager = $options['entity_manager'];

        parent::__construct($name, $options);
        $this->setHydrator($options['hydrator']);
        $this->setObject(new User());
        $this->setAttribute('method', 'post');

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
            'name'      => [
                'required' => true,
                'filters'  => [
                    [
                        'name' => 'StringTrim'
                    ]
                ]
            ],
            'surname'   => [
                'required' => true,
                'filters'  => [
                    [
                        'name' => 'StringTrim'
                    ]
                ]
            ],
            'email'     => [
                'required'   => true,
                'validators' => [
                    [
                        'name'                   => 'EmailAddress',
                        'break_chain_on_failure' => true
                    ],
                    [
                        'name'    => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => [
                            'object_repository' => $this->entityManager->getRepository('WebReattivoCore\Entity\User'),
                            'fields'            => 'email'
                        ]
                    ]
                ]
            ],
            'email2'    => [
                'required'   => true,
                'validators' => [
                    [
                        'name'                   => 'EmailAddress',
                        'break_chain_on_failure' => true
                    ],
                    [
                        'name'    => 'Identical',
                        'options' => [
                            'token' => 'email'
                        ]
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
            ],
        ];
    }
}