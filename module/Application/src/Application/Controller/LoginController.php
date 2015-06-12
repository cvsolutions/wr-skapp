<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    /**
     * @var \Application\Form\LoginForm
     */
    protected $loginForm;

    function __construct($loginForm)
    {
        $this->loginForm = $loginForm;
    }

    public function indexAction()
    {
        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();
        $form    = $this->loginForm;
        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $form->setData($data);
            if ($form->isValid()) {
                var_dump($form->getData());
            }
        }
        return new ViewModel([
            'htmlForm' => $form
        ]);
    }
}
