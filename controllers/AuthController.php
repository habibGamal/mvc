<?php

    namespace app\controllers;

    use app\core\Controller;
    use app\core\Application;
    use app\core\Request;
    use app\core\Response;
    use app\models\LoginForm;
    use app\models\User;

    class AuthController extends Controller{

        public function login(Request $request, Response $response){
            $loginForm = new LoginForm;
            if($request->isPost()){
                $body = $request->getBody();
                $loginForm->loadData($body);
                if($loginForm->validate() && $loginForm->login()){
                    $response->redirect('/');
                    return; 
                }
            }
            return $this->render('login' ,[
                'model' => $loginForm
            ]);
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