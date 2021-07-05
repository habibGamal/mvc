<?php

    namespace app\core;

    class Application {
        /**
         * $ROOT_PATH => hold the root path of the project
         * $app => hold instance of the application
         * Application class link {request,response,controller} with router
         */
        public static string $ROOT_PATH;
        public string $userClass;
        public static Application $app;
        public Router $router;
        public Request $request;
        public Response $response;
        public Session $session;
        public Database $db;
        public ?DbModel $user; // it might be null
        public ?Controller $controller = null;
        public function __construct($root_path ,array $config){
            $this->userClass = $config['userClass'];
            self::$ROOT_PATH = $root_path;
            self::$app = $this;
            $this->requst = new Request();
            $this->response = new Response();
            $this->session = new Session();
            $this->router = new Router($this->requst,$this->response);
            $this->db = new Database($config['db']);
            $primaryValue = $this->session->get('user');
            if($primaryValue){
                $primaryKey = $this->userClass::primaryKey();
                $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
            }else{
                $this->user = null;
            }
        }
        public function setController($controller){
            $this->controller = $controller;
        }
        public function getController(){
            return $this->controller;
        }
        public function login(DbModel $user){
            $this->user = $user;
            $primaryKey = $user->primaryKey();
            $primaryValue = $user->{$primaryKey};
            $this->session->set('user' , $primaryValue);
            return true;
        }
        public static function isGuest(){
            return !self::$app->user;
        }
        public function logout(){
            $this->user = null;
            $this->session->remove('user');
        }
        public function run(){
            echo $this->router->resolve();
        }
    }