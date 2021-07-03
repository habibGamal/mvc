<?php

    namespace app\controllers;

    use app\core\Controller;
    use app\core\Application;
    use app\core\Request;
    use app\models\User;
    use app\Utility as u;

    class AuthController extends Controller{

        public function login(){
            return $this->render('login');
        }

        public function register(Request $request){
            $user = new User(); // User model

            $this->setLayout('auth');

            if($request->isPost()){

                $body = $request->getBody();

                $user->loadData($body);

                if($user->validate() && $user->save()){

                    Application::$app->session->setFlash('success' , 'Thankes for registeration');

                    Application::$app->response->redirect('/');

                }

                return $this->render('register',[
                    'model' => $user
                ]);

            }

            return $this->render('register',[
                'model' => $user
            ]);
        }

    }