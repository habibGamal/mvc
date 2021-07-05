<?php 

    namespace app\core;
    use app\Utility as u;
    class Router {
        public Request $request;
        public Response $response;
        protected $routes = [];

        public function __construct(Request $request,Response $response){
            $this->request = $request;
            $this->response = $response;
        }

        public function get($path,$callback){
            $this->routes['get'][$path] = $callback;
        }

        public function post($path,$callback){
            $this->routes['post'][$path] = $callback;
        }

        public function resolve(){
            $path = $this->request->getPath();
            $method = $this->request->getMethod();
            $callback = $this->routes[$method][$path] ?? false;
            if($callback === false){
                $this->response->setStatusCode(404);
                return $this->renderView('_404');
                exit;
            }
            if(is_string($callback)){
                return $this->renderView($callback);
            }
            if(is_array($callback)){
                Application::$app->controller = new $callback[0]();
                $callback[0] = Application::$app->controller;
            }
            return call_user_func($callback , $this->request ,$this->response);
        }

        public function renderView($view ,$params = []){
            $layoutContent = $this->layoutContent();
            $viewContent = $this->renderOnlyView($view ,$params);
            return str_replace('{{content}}',$viewContent,$layoutContent);
        }

        public function layoutContent(){
            $layout = Application::$app->controller !== null ? Application::$app->controller->layout : 'main' ;
            ob_start();
            include_once Application::$ROOT_PATH . "/views/layout/$layout.php";
            return ob_get_clean();
        }

        public function renderOnlyView($view ,$params){
            foreach($params as $key=>$val){
                $$key = $val; // to be like this : $name = "value"
            }
            ob_start();
            include_once Application::$ROOT_PATH . "/views/$view.php";
            return ob_get_clean();
        }
    }