<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class LoginController
 * @package Application\Controller
 */
class LoginController extends AbstractActionController
{
    /**
     * @var \Application\Form\LoginForm
     */
    protected $loginForm;

    /**
     * @var \WebReattivoCore\Service\LoginService
     */
    protected $loginService;

    /**
     * @param $loginForm
     * @param $loginService
     */
    function __construct($loginForm, $loginService)
    {
        $this->loginForm    = $loginForm;
        $this->loginService = $loginService;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();
        $form    = $this->loginForm;
        if ($request->isPost()) {
            $form->setData($request->getPost()->toArray());
            if ($form->isValid()) {
                $data = $form->getData();
                $auth = $this->loginService->isValid($data['email'], $data['password']);
                if (true === $auth) {
                    return $this->redirect()->toRoute('dashboard');
                }
            }
        }
        return new ViewModel([
            'htmlForm' => $form
        ]);
    }
}
