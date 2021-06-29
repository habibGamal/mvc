<?php

    namespace app\controllers;

    use app\core\Controller;
    use app\core\Request;
    use app\Utility as u;
    class AuthController extends Controller{
        public function login(){
            return $this->render('login');
        }
        public function register(Request $request){
            $this->setLayout('auth');
            if($request->isPost()){
                $body = $request->getBody();
                u::show($body);
                return 'handling post';
            }
            return $this->render('register');
        }
    }