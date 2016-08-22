<?php

namespace Controller;

use Library\Controller;
use Library\Password;
use Library\Request;
use Library\Router;
use Library\Session;
use Model\LoginForm;
use Model\UserModel;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @return string
     * @throws \Library\Exception
     */
    public function loginAction(Request $request)
    {
        $form = new LoginForm($request);

        if ($request->isPost()) {
            if ($form->isValid()) {
                $model = new UserModel();
                $password = new Password($form->password);

                if ($user = $model->find($form->email, $password)) {

                    Session::set('id', $user['id']);
                    Session::set('user', $user['email']);  // може і не треба
                    Session::set('surname', $user['surname']);
                    Session::set('username', $user['username']);
                    Session::set('father', $user['father']);
                    Session::set('id_region', $user['id_region']);
                    Session::set('starwork', $user['startwork']);
                    Session::set('contact', $user['contact']);
                    Session::set('foto', $user['foto']);
                    Session::set('status', $user['status']);
                    Session::set('email', $user['email']);
                    Session::set('password', $user['password']);




//                    тут добавити провірку умов що робити коли
//
//                    if ($_SESSION['status']=null){
//                        Router::init('routes_login.php');
//                    } elseif ($_SESSION['status']==1){
//                        Router::init('outes.php');
//                    } else {
//                        Router::init('routes_login.php');
//                    };



//                    $request = new Request();

                    Router::redirect('/');
                }

                Session::setFlash('Користувача не знайдено');
                Router::redirect('/login');
            }

            Session::setFlash('Заповніть усі поля');
        }

        return $this->render('login', array('form' => $form));
    }

    public function logoutAction(Request $request)
    {
        Session::remove('user');
        Session::remove('id');
        Session::remove('surname');
        Session::remove('username');
        Session::remove('father');
        Session::remove('id_region');
        Session::remove('starwork');
        Session::remove('contact');
        Session::remove('foto');
        Session::remove('status');
        Session::remove('email');
        Session::remove('password');












        Router::redirect('/');
    }


}