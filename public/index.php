<?php
    require_once __DIR__.'/../vendor/autoload.php';

    use app\core\Application;

    $app = new Application(dirname(__DIR__));

    $app->router->get('/', 'home');
    $app->router->get('/about',function (){
        echo 'about page';
    });
    $app->router->get('/info',function (){
        echo 'info page';
    });
    $app->router->get('/contact','contact');
    $app->router->post('/contact',function(){
        return 'handling submited'; // to be continued
    });
    $app->run();