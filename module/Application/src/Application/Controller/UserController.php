<?php

namespace Application\Controller;

use Application\Form\RegistrationForm;
use Application\Service\UserService;
use WebReattivoCore\Entity\User;
use WebReattivoCore\Utility\MessageError;
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
                    /** @var User $user */
                    $user = $form->getData();
                    $this->userService->registration($user);
                    $emailService = $this->userService->getEmailService();
                    $emailService->setTemplate('application/emails/register/verify', ['user' => $user]);
                    $emailService->getMessage()
                        ->setSubject('Conferma Email')
                        ->setTo($user->getEmail());
                    $emailService->send();

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
        $token = $this->params()->fromRoute('token', '');
        $id = (int)$this->params()->fromRoute('id', 0);
        $statusToken = true;
        $message = MessageSuccess::ACCOUNT_ACTIVE;

        $verifyToken = $this->userService->verify($token, $id);

        if (is_null($verifyToken)) {
            $message = MessageError::TOKEN_NOT_VALID;
            $statusToken = false;
        }

        if($statusToken === true) {
            $this->userService->confirm($verifyToken);
        }

        return new ViewModel([
            'message'     => $message,
            'statusToken' => $statusToken
        ]);
    }
}