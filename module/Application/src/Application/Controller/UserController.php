<?php

namespace Application\Controller;

use Application\Form\RegistrationForm;
use Application\Service\UserService;
use WebReattivoCore\Utility\MessageSuccess;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    /** @var  UserService */
    private $userService;

    /** @var RegistrationForm */
    private $registrationForm;

    function __construct(UserService $userService, RegistrationForm $registrationForm)
    {
        $this->userService = $userService;
        $this->registrationForm = $registrationForm;
    }

    public function indexAction()
    {
        $form = $this->registrationForm;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost()->toArray();
            $form->setData($data);

            if ($form->isValid()) {

                try {

                    $this->userService->registration($form->getData());
                    $this->flashMessenger()->addSuccessMessage(MessageSuccess::DEFALUT_MESSAGE);

                } catch (\Exception $e) {

                    $this->flashMessenger()->addErrorMessage($e->getMessage());

                }

                return $this->redirect()->toRoute('registration');
            }
        }

        return new ViewModel([
            'registrationForm' => $form
        ]);
    }

    public function verifyAction()
    {
        return new ViewModel();
    }
}