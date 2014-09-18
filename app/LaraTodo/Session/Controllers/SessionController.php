<?php namespace LaraTodo\Session\Controllers;

use Illuminate\View\Factory as ViewFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

use BaseController;
use View;
use Input;
use Redirect;
use Auth;
use LaraTodo\Session\Forms\SessionForm;

class SessionController extends BaseController {

    protected $view;
    protected $input;
    protected $redirect;
    protected $form;

    public function __construct(ViewFactory $view,
                                Request $input,
                                Redirector $redirect,
                                SessionForm $form)
    {
        $this->view = $view;
        $this->input = $input;
        $this->redirect = $redirect;
        $this->form = $form;
    }

    public function getCreate()
    {
        return $this->view->make('Session::session.create');
    }

    public function postCreate()
    {
        $params = array(
            'username' => $this->input->get('username'),
            'password' => $this->input->get('password')
        );

        if ($this->form->create($params)) {
            return 'Successfully logged-in';
        }

        return $this->redirect->route('session.getCreate')
            ->with('message', 'Wrong username or password');
    }

}
