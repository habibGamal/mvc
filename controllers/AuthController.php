<?php

    namespace app\controllers;

    use app\core\Controller;
    use app\core\Request;
    use app\models\RegisterModel;
    use app\Utility as u;

    class AuthController extends Controller{
        public function login(){
            return $this->render('login');
        }
        public function register(Request $request){
            $registerModel = new RegisterModel();
            $this->setLayout('auth');
            if($request->isPost()){
                $body = $request->getBody();
                $registerModel->loadData($body);
                if($registerModel->validate() && $registerModel->register()){
                    return 'success';
                }
                return $this->render('register',[
                    'model' => $registerModel
                ]);
            }
            return $this->render('register',[
                'model' => $registerModel
            ]);
        }
    }