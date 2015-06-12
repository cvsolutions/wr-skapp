<?php

namespace Application\Controller;

use Application\Form\LostPasswordForm;
use Application\Form\RegistrationForm;
use Application\Form\ResetPasswordForm;
use Application\Service\UserService;
use WebReattivoCore\Entity\User;
use WebReattivoCore\Entity\UserToken;
use WebReattivoCore\Utility\MessageError;
use WebReattivoCore\Utility\MessageSuccess;
use WebReattivoCore\Utility\Templates;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    const ROUTE_REGISTER = 'user/registration';
    const ROUTE_LOST_PWD = 'user/lost-pwd';

    /** @var  UserService */
    private $userService;

    /** @var RegistrationForm */
    private $registrationForm;

    /** @var  LostPasswordForm */
    private $lostPasswordForm;

    /** @var  ResetPasswordForm */
    private $resetPasswordForm;

    function __construct(
        UserService $userService,
        RegistrationForm $registrationForm,
        LostPasswordForm $lostPasswordForm,
        ResetPasswordForm $resetPasswordForm
    ) {
        $this->userService = $userService;
        $this->registrationForm = $registrationForm;
        $this->lostPasswordForm = $lostPasswordForm;
        $this->resetPasswordForm = $resetPasswordForm;
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

                    /** @var UserToken $token */
                    $token = $this->userService->registration($user);
                    $emailService = $this->userService->getEmailService();
                    $emailService->setTemplate(Templates::VERIFY_ACCOUNT, [
                        'user'  => $user,
                        'token' => $token->getToken()
                    ]);
                    $emailService->getMessage()
                        ->setSubject('Conferma Email')
                        ->addTo($user->getEmail());
                    $emailService->send();

                    $this->flashMessenger()->addSuccessMessage(MessageSuccess::DEFALUT_MESSAGE);

                } catch (\Exception $e) {

                    $this->flashMessenger()->addErrorMessage($e->getMessage());

                }

                return $this->redirect()->toRoute(self::ROUTE_REGISTER);
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

        if ($statusToken === true) {
            $this->userService->confirm($verifyToken);
        }

        return new ViewModel([
            'message'     => $message,
            'statusToken' => $statusToken
        ]);
    }

    public function lostPwdAction()
    {
        $form = $this->lostPasswordForm;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost()->toArray();
            $form->setData($data);

            if ($form->isValid()) {

                try {

                    $formData = $form->getData();

                    /** @var User $user */
                    $user = $this->userService->findOneByEmail($formData['email']);

                    if (is_null($user)) {

                        $this->flashMessenger()->addSuccessMessage(MessageSuccess::LOSTPWD_CONFIRM);

                        return $this->redirect()->toRoute(self::ROUTE_LOST_PWD);
                    }

                    $this->userService->lostPwd($user);
                    $this->flashMessenger()->addSuccessMessage(MessageSuccess::LOSTPWD_CONFIRM);

                } catch (\Exception $e) {

                    $this->flashMessenger()->addErrorMessage($e->getMessage());

                }

                return $this->redirect()->toRoute(self::ROUTE_LOST_PWD);
            }
        }

        return new ViewModel([
            'lostPasswordForm' => $form
        ]);
    }

    public function resetPwdAction()
    {
        $token = $this->params()->fromRoute('token', '');
        $id = (int)$this->params()->fromRoute('id', 0);
        $statusToken = true;
        $message = MessageSuccess::RESETPWD_CONFIRM;

        $verifyToken = $this->userService->verifyTokenLostPwd($token, $id);

        if (is_null($verifyToken)) {
            $message = MessageError::TOKEN_NOT_VALID;
            $statusToken = false;
        }

        $form = $this->resetPasswordForm;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost()->toArray();
            $data['id'] = $verifyToken->getUser()->getId();
            $form->setData($data);

            if ($form->isValid()) {

                try {

                    $this->userService->resetPwd($form->getData(), $verifyToken);
                    $this->flashMessenger()->addSuccessMessage($message);

                } catch (\Exception $e) {

                    $this->flashMessenger()->addErrorMessage($e->getMessage());

                }

                return $this->redirect()->toRoute(self::ROUTE_LOST_PWD);
            }
        }

        return new ViewModel([
            'message'      => $message,
            'statusToken'  => $statusToken,
            'resetPwdFrom' => $form
        ]);
    }
}