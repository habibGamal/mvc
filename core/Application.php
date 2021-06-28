<?php

    namespace app\core;

    class Application {
        public static string $ROOT_PATH;
        public Router $router;
        public Request $request;
        public Response $response;
        public function __construct($root_path){
            self::$ROOT_PATH = $root_path;
            $this->requst = new Request();
            $this->response = new Response();
            $this->router = new Router($this->requst,$this->response);
        }
        public function run(){
            echo $this->router->resolve();
        }
    }