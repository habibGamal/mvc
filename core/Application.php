<?php

    namespace app\core;

    class Application {
        public Router $router;
        public Request $request;
        public function __construct(){
            $this->requst = new Request();
            $this->router = new Router($this->requst);
        }
        public function run(){
            $this->router->resolve();
        }
    }