<?php

    namespace app\core;

    class Application {
        /**
         * $ROOT_PATH => hold the root path of the project
         * $app => hold instance of the application
         * Application class link {request,response,controller} with router
         */
        public static string $ROOT_PATH;
        public static Application $app;
        public Router $router;
        public Request $request;
        public Response $response;
        public Database $db;
        public Controller $controller;
        public function __construct($root_path ,array $config){
            self::$ROOT_PATH = $root_path;
            self::$app = $this;
            $this->requst = new Request();
            $this->response = new Response();
            $this->router = new Router($this->requst,$this->response);
            $this->db = new Database($config['db']);
        }
        public function setController($controller){
            $this->controller = $controller;
        }
        public function getController(){
            return $this->controller;
        }
        public function run(){
            echo $this->router->resolve();
        }
    }