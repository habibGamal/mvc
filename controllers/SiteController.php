<?php

    namespace app\controllers;

    use app\core\Application;
    use app\core\Controller;
    use app\core\Request;
    use app\Utility as u;
    class SiteController extends Controller{

        public function home(){
            $params = [
                'name' => "habib"
            ];
            return $this->render('home' , $params);
        }

        public function handleContact(Request $request){
            $body = $request->getBody();
            u::show($body);
            return 'handling submited data';
        }
        
        public function contact(){
            return $this->render('contact');
        }
    }