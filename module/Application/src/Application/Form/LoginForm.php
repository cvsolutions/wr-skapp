<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class LoginForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', '');

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
            'name'       => 'password',
            'type'       => 'Zend\Form\Element\Password',
            'attributes' => [
                'id'       => 'password',
                'class'    => 'form-control',
                'required' => 'required'
            ]
        ]);

        $this->add([
            'type'    => 'Zend\Form\Element\Csrf',
            'name'    => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 3600
                ]
            ]
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'email'    => [
                'required'   => true,
                'validators' => [
                    [
                        'name'                   => 'EmailAddress',
                        'break_chain_on_failure' => true
                    ]
                ]
            ],
            'password' => [
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
            ]
        ];
    }
}