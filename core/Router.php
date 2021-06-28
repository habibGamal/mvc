<?php 

    namespace app\core;
    use app\Utility as u;
    class Router {
        public Request $request;
        protected $routes = [];

        public function __construct($request){
            $this->request = $request;
        }

        public function get($path,$callback){
            $this->routes['get'][$path] = $callback;
        }

        public function resolve(){
            $path = $this->request->getPath();
            $method = $this->request->getMethod();
            $callback = $this->routes[$method][$path] ?? false;
            if($callback === false){
                echo "Page not found";
                exit;
            }
            echo call_user_func($callback);
        }
    }